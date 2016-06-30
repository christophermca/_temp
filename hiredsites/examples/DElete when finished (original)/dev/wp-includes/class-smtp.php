<?php
/*~ class.smtp.php
.---------------------------------------------------------------------------.
|  Software: PHPMailer - PHP email class                                    |
|   Version: 2.0.4                                                          |
|   Contact: via sourceforge.net support pages (also www.codeworxtech.com)  |
|      Info: http://phpmailer.sourceforge.net                               |
|   Support: http://sourceforge.net/projects/phpmailer/                     |
| ------------------------------------------------------------------------- |
|    Author: Andy Prevost (project admininistrator)                         |
|    Author: Brent R. Matzelle (original founder)                           |
| Copyright (c) 2004-2007, Andy Prevost. All Rights Reserved.               |
| Copyright (c) 2001-2003, Brent R. Matzelle                                |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
| ------------------------------------------------------------------------- |
| We offer a number of paid services (www.codeworxtech.com):                |
| - Web Hosting on highly optimized fast and secure servers                 |
| - Technology Consulting                                                   |
| - Oursourcing (highly qualified programmers and graphic designers)        |
'---------------------------------------------------------------------------'
 */
/**
 * SMTP is rfc 821 compliant and implements all the rfc 821 SMTP
 * commands except TURN which will always return a not implemented
 * error. SMTP also provides some utility methods for sending mail
 * to an SMTP server.
 * @package PHPMailer
 * @author Chris Ryan
 */

class SMTP
{
  /**
   *  SMTP server port
   *  @var int
   */
  var $SMTP_PORT = 25;

  /**
   *  SMTP reply line ending
   *  @var string
   */
  var $CRLF = "\r\n";

  /**
   *  Sets whether debugging is turned on
   *  @var bool
   */
  var $do_debug;       # the level of debug to perform

  /**
   *  Sets VERP use on/off (default is off)
   *  @var bool
   */
  var $do_verp = false;

  /**#@+
   * @access private
   */
  var $smtp_conn;      # the socket to the server
  var $error;          # error if any on the last call
  var $helo_rply;      # the reply the server sent to us for HELO
  /**#@-*/

  /**
   * Initialize the class so that the data is in a known state.
   * @access public
   * @return void
   */
  function SMTP() {
    $this->smtp_conn = 0;
    $this->error = null;
    $this->helo_rply = null;

    $this->do_debug = 0;
  }

  /*************************************************************
   *                    CONNECTION FUNCTIONS                  *
   ***********************************************************/

  /**
   * Connect to the server specified on the port specified.
   * If the port is not specified use the default SMTP_PORT.
   * If tval is specified then a connection will try and be
   * established with the server for that number of seconds.
   * If tval is not specified the default is 30 seconds to
   * try on the connection.
   *
   * SMTP CODE SUCCESS: 220
   * SMTP CODE FAILURE: 421
   * @access public
   * @return bool
   */
  function Connect($host,$port=0,$tval=30) {
    # set the error val to null so there is no confusion
    $this->error = null;

    # make sure we are __not__ connected
    if($this->connected()) {
      # ok we are connected! what should we do?
      # for now we will just give an error saying we
      # are already connected
      $this->error = array("error" => "Already connected to a server");
      return false;
    }

    if(empty($port)) {
      $port = $this->SMTP_PORT;
    }

    #connect to the smtp server
    $this->smtp_conn = fsockopen($host,    # the host of the server
                                 $port,    # the port to use
                                 $errno,   # error number if any
                                 $errstr,  # error message if any
                                 $tval);   # give up after ? secs
    # verify we connected properly
    if(empty($this->smtp_conn)) {
      $this->error = array("error" => "Failed to connect to server",
                           "errno" => $errno,
                           "errstr" => $errstr);
      if($this->do_debug >= 1) {
        echo "SMTP -> ERROR: " . $this->error["error"] .
                 ": $errstr ($errno)" . $this->CRLF;
      }
      return false;
    }

    # sometimes the SMTP server takes a little longer to respond
    # so we will give it a longer timeout for the first read
    // Windows still does not have support for this timeout function
    if(substr(PHP_OS, 0, 3) != "WIN")
     socket_set_timeout($this->smtp_conn, $tval, 0);

    # get any announcement stuff
    $announce = $this->get_lines();

    # set the timeout  of any socket functions at 1/10 of a second
    //if(function_exists("socket_set_timeout"))
    //   socket_set_timeout($this->smtp_conn, 0, 100000);

    if($this->do_debug >= 2) {
      echo "SMTP -> FROM SERVER:" . $this->CRLF . $announce;
    }

    return true;
  }

  /**
   * Performs SMTP authentication.  Must be run after running the
   * Hello() method.  Returns true if successfully authenticated.
   * @access public
   * @return bool
   */
  function Authenticate($username, $password) {
    // Start authentication
    fputs($this->smtp_conn,"AUTH LOGIN" . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($code != 334) {
      $this->error =
        array("error" => "AUTH not accepted from server",
              "smtp_code" => $code,
              "smtp_msg" => substr($rply,4));
      if($this->do_debug >= 1) {
        echo "SMTP -> ERROR: " . $this->error["error"] .
                 ": " . $rply . $this->CRLF;
      }
      return false;
    }

    // Send encoded username
    fputs($this->smtp_conn, base64_encode($username) . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($code != 334) {
      $this->error =
        array("error" => "Username not accepted from server",
              "smtp_code" => $code,
              "smtp_msg" => substr($rply,4));
      if($this->do_debug >= 1) {
        echo "SMTP -> ERROR: " . $this->error["error"] .
                 ": " . $rply . $this->CRLF;
      }
      return false;
    }

    // Send encoded password
    fputs($this->smtp_conn, base64_encode($password) . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($code != 235) {
      $this->error =
        array("error" => "Password not accepted from server",
              "smtp_code" => $code,
              "smtp_msg" => substr($rply,4));
      if($this->do_debug >= 1) {
        echo "SMTP -> ERROR: " . $this->error["error"] .
                 ": " . $rply . $this->CRLF;
      }
      return false;
    }

    return true;
  }

  /**
   * Returns true if connected to a server otherwise false
   * @access private
   * @return bool
   */
  function Connected() {
    if(!empty($this->smtp_conn)) {
      $sock_status = socket_get_status($this->smtp_conn);
      if($sock_status["eof"]) {
        # hmm this is an odd situation... the socket is
        # valid but we are not connected anymore
        if($this->do_debug >= 1) {
            echo "SMTP -> NOTICE:" . $this->CRLF .
                 "EOF caught while checking if connected";
        }
        $this->Close();
        return false;
      }
      return true; # everything looks good
    }
    return false;
  }

  /**
   * Closes the socket and cleans up the state of the class.
   * It is not considered good to use this function without
   * first trying to use QUIT.
   * @access public
   * @return void
   */
  function Close() {
    $this->error = null; # so there is no confusion
    $this->helo_rply = null;
    if(!empty($this->smtp_conn)) {
      # close the connection and cleanup
      fclose($this->smtp_conn);
      $this->smtp_conn = 0;
    }
  }

  /***************************************************************
   *                        SMTP COMMANDS                       *
   *************************************************************/

  /**
   * Issues a data command and sends the msg_data to the server
   * finializing the mail transaction. $msg_data is the message
   * that is to be send with the headers. Each header needs to be
   * on a single line followed by a <CRLF> with the message headers
   * and the message body being separated by and additional <CRLF>.
   *
   * Implements rfc 821: DATA <CRLF>
   *
   * SMTP CODE INTERMEDIATE: 354
   *     [data]
   *     <CRLF>.<CRLF>
   *     SMTP CODE SUCCESS: 250
   *     SMTP CODE FAILURE: 552,554,451,452
   * SMTP CODE FAILURE: 451,554
   * SMTP CODE ERROR  : 500,501,503,421
   * @access public
   * @return bool
   */
  function Data($msg_data) {
    $this->error = null; # so no confusion is caused

    if(!$this->connected()) {
      $this->error = array(
              "error" => "Called Data() without being connected");
      return false;
    }

    fputs($this->smtp_conn,"DATA" . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($this->do_debug >= 2) {
      echo "SMTP -> FROM SERVER:" . $this->CRLF . $rply;
    }

    if($code != 354) {
      $this->error =
        array("error" => "DATA command not accepted from server",
              "smtp_code" => $code,
              "smtp_msg" => substr($rply,4));
      if($this->do_debug >= 1) {
        echo "SMTP -> ERROR: " . $this->error["error"] .
                 ": " . $rply . $this->CRLF;
      }
      return false;
    }

    # the server is ready to accept data!
    # according to rfc 821 we should not send more than 1000
    # including the CRLF
    # characters on a single line so we will break the data up
    # into lines by \r and/or \n then if needed we will break
    # each of those into smaller lines to fit within the limit.
    # in addition we will be looking for lines that start with
    # a period '.' and append and additional period '.' to that
    # line. NOTE: this does not count towards are limit.

    # normalize the line breaks so we know the explode works
    $msg_data = str_replace("\r\n","\n",$msg_data);
    $msg_data = str_replace("\r","\n",$msg_data);
    $lines = explode("\n",$msg_data);

    # we need to find a good way to determine is headers are
    # in the msg_data or if it is a straight msg body
    # currently I am assuming rfc 822 definitions of msg headers
    # and if the first field of the first line (':' sperated)
    # does not contain a space then it _should_ be a header
    # and we can process all lines before a blank "" line as
    # headers.
    $field = substr($lines[0],0,strpos($lines[0],":"));
    $in_headers = false;
    if(!empty($field) && !strstr($field," ")) {
      $in_headers = true;
    }

    $max_line_length = 998; # used below; set here for ease in change

    while(list(,$line) = @each($lines)) {
      $lines_out = null;
      if($line == "" && $in_headers) {
        $in_headers = false;
      }
      # ok we need to break this line up into several
      # smaller lines
      while(strlen($line) > $max_line_length) {
        $pos = strrpos(substr($line,0,$max_line_length)," ");

        # Patch to fix DOS attack
        if(!$pos) {
          $pos = $max_line_length - 1;
        }

        $lines_out[] = substr($line,0,$pos);
        $line = substr($line,$pos + 1);
        # if we are processing headers we need to
        # add a LWSP-char to the front of the new line
        # rfc 822 on long msg headers
        if($in_headers) {
          $line = "\t" . $line;
        }
      }
      $lines_out[] = $line;

      # now send the lines to the server
      while(list(,$line_out) = @each($lines_out)) {
        if(strlen($line_out) > 0)
        {
          if(substr($line_out, 0, 1) == ".") {
            $line_out = "." . $line_out;
          }
        }
        fputs($this->smtp_conn,$line_out . $this->CRLF);
      }
    }

    # ok all the message data has been sent so lets get this
    # over with aleady
    fputs($this->smtp_conn, $this->CRLF . "." . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($this->do_debug >= 2) {
      echo "SMTP -> FROM SERVER:" . $this->CRLF . $rply;
    }