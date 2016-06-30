<?php
/*
Plugin Name: Contact Form ][
Plugin URI: http://chip.cuccio.us/projects/contact-form-ii/
Description: Contact Form ][ is a drop-in form that allows site visitors to contact you. It can be implemented easily (via QuickTags) within any post or page.  This version is *specifically* for WordPress 2.x only.
Author: Chip Cuccio
Author URI: http://chip.cuccio.us
Version: 2.0.13
*/

load_plugin_textdomain('wpcf'); // NLS

/* Declare strings that change depending on input. This also resets them so errors clear on resubmission. */
$wpcf_strings = array(
    'name' => '<div class="contactright"><input type="text" name="wpcf_your_name" id="wpcf_your_name" size="30" maxlength="50" value="' . $_POST['wpcf_your_name'] . '" /> (required)</div>',
    'email' => '<div class="contactright"><input type="text" name="wpcf_email" id="wpcf_email" size="30" maxlength="50" value="' . $_POST['wpcf_email'] . '" /> (required)</div>',
    'subject' => '<div class="contactright"><input type="text" name="wpcf_subject" id="wpcf_subject" size="30" maxlength="50" value="' .$_POST['wpcf_subject'] . '" /> (required)</div>',
    'msg' => '<div class="contactright"><textarea name="wpcf_msg" id="wpcf_msg" cols="'.get_option('wpcf_textarea_cols').'" rows="'.get_option('wpcf_textarea_rows').'" >' . $_POST['wpcf_msg'] . '</textarea></div>',
    'carbon_copy' => '<div class="contactright" id="carbon_copy"><input type="checkbox" name="carbon_copy" value="true" /></div>',
    'error' => '');

/*
This shows the quicktag on the write pages
Based off Buttonsnap Template
http://redalt.com/downloads
*/
if(get_option('wpcf_show_quicktag') == true) {
    include('buttonsnap.php');

    add_action('init', 'wpcf_button_init');
    add_action('marker_css', 'wpcf_marker_css');

    function wpcf_button_init() {
        $wpcf_button_url = buttonsnap_dirname(__FILE__) . '/wpcf_button.png';

        buttonsnap_textbutton($wpcf_button_url, 'Insert Contact Form', '[CONTACT-FORM]');
        buttonsnap_register_marker('CONTACT-FORM', 'wpcf_marker');
    }

    function wpcf_marker_css() {
        $wpcf_marker_url = buttonsnap_dirname(__FILE__) . '/wpcf_marker.gif';
        echo "
            .wpcf_marker {
                    display: block;
                    height: 15px;
                    width: 155px
                    margin-top: 5px;
                    background-image: url({$wpcf_marker_url});
                    background-repeat: no-repeat;
                    background-position: center;
            }
        ";
    }
}


function wpcf_is_malicious($input) {
	$is_malicious = false;
	$bad_inputs = array("<", ">", "&lt;", "&gt", "mime-version", "content-type", "cc:", "bcc:", "to:", "<a href", "</a>", "http://", "[/URL]", "[URL=");
	foreach($bad_inputs as $bad_input) {
		if(strpos(strtolower($input), strtolower($bad_input)) !== false) {
			$is_malicious = true; break;
		}
	}
	return $is_malicious;
}

/* This function checks for errors on input and changes $wpcf_strings if there are any errors. Shortcircuits if there has not been a submission */
function wpcf_check_input()
{
	if(!(isset($_POST['wpcf_stage']))) {return false;} // Shortcircuit.

    $_POST['wpcf_your_name'] = stripslashes(trim($_POST['wpcf_your_name']));
    $_POST['wpcf_email'] = stripslashes(trim($_POST['wpcf_email']));
    $_POST['wpcf_carbon_copy'] = stripslashes(trim($_POST['wpcf_email']));
    $_POST['wpcf_subject'] = stripslashes(trim($_POST['wpcf_subject']));
    $_POST['wpcf_msg'] = stripslashes(trim($_POST['wpcf_msg']));

	global $wpcf_strings;
	$ok = true;

	if(empty($_POST['wpcf_your_name']))
	{
		$ok = false; $reason = 'empty';
		$wpcf_strings['name'] = '<div class="contactright"><input type="text" name="wpcf_your_name" id="wpcf_your_name" size="30" maxlength="50" value="' . $_POST['wpcf_your_name'] . '" class="contacterror" /> (required)</div>';
	}

    if(!is_email($_POST['wpcf_email']))
    {
	    $ok = false; $reason = 'empty';
	    $wpcf_strings['email'] = '<div class="contactright"><input type="text" name="wpcf_email" id="wpcf_email" size="30" maxlength="50" value="' . $_POST['wpcf_email'] . '" class="contacterror" /> (required)</div>';
	}

    if(empty($_POST['wpcf_subject']))
    {
        $ok = false; $reason = 'empty';
        $wpcf_strings['subject'] = '<div class="contactright"><input type="text" name="wpcf_subject" id="wpcf_subject" size="30" maxlength="50" value="' . $_POST['wpcf_subject'] . '" class="contacterror" /> (required)</div>';
    }

    if(empty($_POST['wpcf_msg']))
    {
	    $ok = false; $reason = 'empty';
	    $wpcf_strings['msg'] = '<div class="contactright"><textarea name="wpcf_msg" id="wpcf_message" cols="'.get_option('wpcf_textarea_cols').'" rows="'.get_option('wpcf_textarea_rows').'" class="contacterror">' . $_POST['wpcf_msg'] . '</textarea></div>';
	}
    // check for spam crap
	if(wpcf_is_malicious($_POST['wpcf_your_name'])) {
		$ok = false; $reason = 'malicious';
	}
    if(wpcf_is_malicious($_POST['wpcf_email'])) {
        $ok = false; $reason = 'malicious';
    }
    if(wpcf_is_malicious($_POST['wpcf_subject'])) {
        $ok = false; $reason = 'malicious';
    }
    if (get_option('wpcf_allow_URIs') != TRUE) {
        if(wpcf_is_malicious($_POST['wpcf_msg'])) {
            $ok = false; $reason = 'malicious';
        }
    }
    if(stristr($_POST['wpcf_your_name'], "\r")) {
        $ok = false; $reason = 'malicious';
    }
    if(stristr($_POST['wpcf_your_name'], "\n")) {
        $ok = false;
        $reason = 'malicious';
    }
    if(stristr($_POST['wpcf_email'], "\r")) {
        $ok = false;
        $reason = 'malicious';
    }
    if(stristr($_POST['wpcf_email'], "\n")) {
        $ok = false;
        $reason = 'malicious';
    }
    if(stristr($_POST['wpcf_subject'], "\r")) {
        $ok = false;
        $reason = 'malicious';
    }
    if(stristr($_POST['wpcf_subject'], "\n")) {
        $ok = false;
        $reason = 'malicious';
    }


	if($ok == true)
	{
		return true;
	}
	else {
		if($reason == 'malicious') {
			$wpcf_strings['error'] = stripslashes(get_option('wpcf_mal_msg'));
		} elseif($reason == 'empty') {
			$wpcf_strings['error'] = stripslashes(get_option('wpcf_error_msg'));
		}
		return false;
	}
}

/*Wrapper function which calls the form.*/
function wpcf_callback( $content )
{
	global $wpcf_strings;

	/* Run the input check. */

		if(! preg_match('|\[CONTACT-FORM\]|', $content)) {
		return $content;
		}

    if(wpcf_check_input()) // If the input check returns true (ie. there has been a submission & input is ok)
    {
            $recipient   = get_option('wpcf_email');
            $subj_suffix = stripslashes(get_option('wpcf_subject_suffix'));
            $subject     = stripslashes('wpcf_subject');
            $success_msg = get_option('wpcf_success_msg');
            $success_msg = stripslashes($success_msg);

            $name        = $_POST['wpcf_your_name'];
            $email       = $_POST['wpcf_email'];
            $carbon_copy = $_POST['wpcf_carbon_copy'];
            $subject     = $_POST['wpcf_subject'];
            $msg         = $_POST['wpcf_msg'];
            $browser     = $_SERVER['HTTP_USER_AGENT'];

            if ($_POST['carbon_copy'] == 'true') {
                $headers     = "MIME-Version: 1.0\n";
                $headers    .= "From: $name <$email>\n";
                $headers    .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";
                $headers    .= "Bcc: $recipient\n";
                $fullmsg    .= wordwrap($msg, 76, "\n") . "\n\n";
                $fullmsg    .= "\n----------------------------------------------------------------------------\n";
                $fullmsg    .= "Sender info:\n\n";
                $fullmsg    .= "IP: " . getip(). " <http://ws.arin.net/whois/?queryinput=".getip().">\n";
                $fullmsg    .= "Browser/OS: " . wordwrap($browser, 76, "\n\t    ") . "\n";
                $fullmsg    .= "----------------------------------------------------------------------------\n";
                mail($email, $subject ." ". $subj_suffix, $fullmsg, $headers);
            } else {
                $headers     = "MIME-Version: 1.0\n";
                $headers    .= "From: $name <$email>\n";
                $headers    .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";
                $fullmsg    .= wordwrap($msg, 76, "\n") . "\n\n";
                $fullmsg    .= "\n----------------------------------------------------------------------------\n";
                $fullmsg    .= "Sender info:\n\n";
                $fullmsg    .= "IP: " . getip(). " <http://ws.arin.net/whois/?queryinput=".getip().">\n";
                $fullmsg    .= "Browser/OS: " . wordwrap($browser, 76, "\n\t    ") . "\n";
                $fullmsg    .= "----------------------------------------------------------------------------\n";
                mail($recipient, $subject ." ". $subj_suffix, $fullmsg, $headers);
            }
            $results = $success_msg;
            echo $results;
    }
    else // Else show the form. If there are errors the strings will have updated during running the inputcheck.
    {
        if(get_option('wpcf_CC_permitted') == TRUE) {
            if(get_option('wpcf_anchor') == TRUE) {
                $form = '<div class="contactform" id="c_form_2">' . $wpcf_strings['error'].
                '<form action="'. get_permalink() .'#c_form_2" method="post">
                <div class="contactleft"><label for="wpcf_your_name">' . __('Your Name: ', 'wpcf') . '</label></div>' . $wpcf_strings['name']  . '
                <div class="contactleft"><label for="wpcf_email">' . __('Your Email:', 'wpcf') . '</label></div>' . $wpcf_strings['email'] . '
                <div class="contactleft"><label for="wpcf_subject">' . __('Subject:', 'wpcf') . '</label></div>' . $wpcf_strings['subject'] . '
                <div class="contactleft"><label for="wpcf_msg">' . __('Your Message: ', 'wpcf') . '</label></div>' . $wpcf_strings['msg'] . '
                <div class="contactleft"><label for="carbon_copy">' .__('Send a copy to yourself?', 'wpcf') . '</label></div>'. $wpcf_strings['carbon_copy'] . '
                <div class="contactright"><input type="submit" name="Submit" value="Send Message" id="contactsubmit" /><input type="hidden" name="wpcf_stage" value="process" /></div>
                </form>
                </div>
                <div style="clear:both; height:1px;">&nbsp;</div>';
                return str_replace('[CONTACT-FORM]', $form, $content);
            } else {
                $form = '<div class="contactform" id="c_form_2">' . $wpcf_strings['error'].
                '<form action="'. get_permalink() .'" method="post">
                <div class="contactleft"><label for="wpcf_your_name">' . __('Your Name: ', 'wpcf') . '</label></div>' . $wpcf_strings['name'] . '
                <div class="contactleft"><label for="wpcf_email">' . __('Your Email:', 'wpcf') . '</label></div>' . $wpcf_strings['email'] . '
                <div class="contactleft"><label for="wpcf_subject">' . __('Subject:', 'wpcf') . '</label></div>' . $wpcf_strings['subject'] . '
                <div class="contactleft"><label for="wpcf_msg">' . __('Your Message: ', 'wpcf') . '</label></div>' . $wpcf_strings['msg'] . '
                <div class="contactleft"><label for="carbon_copy">' .__('Send a copy to yourself?', 'wpcf') . '</label></div>'. $wpcf_strings['carbon_copy'] . '
                <div class="contactright"><input type="submit" name="Submit" value="Send Message" id="contactsubmit" /><input type="hidden" name="wpcf_stage" value="process" /></div>
                </form>
                </div>
                <div style="clear:both; height:1px;">&nbsp;</div>';
                return str_replace('[CONTACT-FORM]', $form, $content);
            }
        } else {
            if(get_option('wpcf_anchor') == TRUE) {
                $form = '<div class="contactform" id="c_form_2">' . $wpcf_strings['error']. 
                '<form action="'. get_permalink() .'#c_form_2" method="post">
                <div class="contactleft"><label for="wpcf_your_name">' . __('Your Name: ', 'wpcf') . '</label></div>' . $wpcf_strings['name'] . '
                <div class="contactleft"><label for="wpcf_email">' . __('Your Email:', 'wpcf') . '</label></div>' . $wpcf_strings['email'] . '
                <div class="contactleft"><label for="wpcf_subject">' . __('Subject:', 'wpcf') . '</label></div>' . $wpcf_strings['subject'] . '
                <div class="contactleft"><label for="wpcf_msg">' . __('Your Message: ', 'wpcf') . '</label></div>' . $wpcf_strings['msg'] . '
                <div class="contactright"><input type="submit" name="Submit" value="Send Message" id="contactsubmit" /><input type="hidden" name="wpcf_stage" value="process" /></div>
                </form>
                </div>
                <div style="clear:both; height:1px;">&nbsp;</div>';
                return str_replace('[CONTACT-FORM]', $form, $content);
            } else {
                $form = '<div class="contactform" id="c_form_2">' . $wpcf_strings['error']. 
                '<form action="'. get_permalink() .'" method="post">
                <div class="contactleft"><label for="wpcf_your_name">' . __('Your Name: ', 'wpcf') . '</label></div>' . $wpcf_strings['name'] . '
                <div class="contactleft"><label for="wpcf_email">' . __('Your Email:', 'wpcf') . '</label></div>' . $wpcf_strings['email'] . '
                <div class="contactleft"><label for="wpcf_subject">' . __('Subject:', 'wpcf') . '</label></div>' . $wpcf_strings['subject'] . '
                <div class="contactleft"><label for="wpcf_msg">' . __('Your Message: ', 'wpcf') . '</label></div>' . $wpcf_strings['msg'] . '
                <div class="contactright"><input type="submit" name="Submit" value="Send Message" id="contactsubmit" /><input type="hidden" name="wpcf_stage" value="process" /></div>
                </form>
                </div>
                <div style="clear:both; height:1px;">&nbsp;</div>';
                return str_replace('[CONTACT-FORM]', $form, $content);
            }
 
        }
    }
}


/*Can't use WP's function here, so lets use our own*/
function getip()
{
	if (isset($_SERVER))
	{
 	    $ip_addr = $_SERVER["REMOTE_ADDR"];
	}
	else
	{
  	    $ip_addr = getenv('REMOTE_ADDR');
	}
return $ip_addr;
}


/*CSS Styling*/
function wpcf_css()
	{
	?>
<style type="text/css" media="screen">

/* Begin Contact Form ][ CSS */
.contactform {
        font-color : black;
	position: static;
	overflow: hidden;
}

.contactleft {
font-family: Verdana, Helvetica, Sans-Serif;
        font-color : black;
	width: 25%;
	text-align: right;
	clear: both;
	float: left;
	display: inline;
	padding: 4px;
	margin: 5px 0;
    
}

.contactright {
        font-color : black;
	width: 70%;
	text-align: left;
font-family: Verdana, Helvetica, Sans-Serif;
	float: right;
	display: inline;
	padding: 4px;
	margin: 5px 0;
}

.contacterror {
	border: 2px solid #ff0000;
}


p { font-color: black; } 

/* End Contact Form ][ CSS */

	</style>

<?php

	}

function wpcf_add_options_page()
	{
		add_options_page('Contact Form ][ Options', 'Contact Form ][', 9, 'wp-contact-form/options-contactform.php');
	}

/* Action calls for all functions */

//if(get_option('wpcf_show_quicktag') == true) {add_action('admin_footer', 'wpcf_add_quicktag');}

add_action('admin_head', 'wpcf_add_options_page');
if (get_option('wpcf_apply_css') == true) {add_filter('wp_head', 'wpcf_css');}
remove_filter('the_content', 'Markdown', 6);
add_filter('the_content', 'wpcf_callback', 7);

?>
