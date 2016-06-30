<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON ACTION-CLASS	 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if (!class_exists('gxtb_fb_lB_Class')) {
include_once( 'gb_generate.php');
class gxtb_fb_lB_Class extends gxtb_fb_lB_GenerateLike {

	var $meta = false; # früher private

function gxtb_fb_lB_Class() {
			
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
		
	// this security-if is new since v4.0 because we got some errors without this if-statement
	if ( !isset($gxtb_fb_lB_settings['addfooter_activate']) || empty($gxtb_fb_lB_settings['addfooter_activate']) )
		$gxtb_fb_lB_settings['addfooter_activate'] = false;			
			
	if ($gxtb_fb_lB_settings['activate'] && !$gxtb_fb_lB_settings['shortcode']) {
		
		// generates the header before the site is loaded
		// add_action('wp_head', array( $this, 'gxtb_fb_lB_flush' )); ## Testweise noch eingebaut!
		add_action('wp_head', array($this, 'gxtb_fb_lB_ajax'));
		
		// adding the like-button before/after the content
		add_action('the_content', array( $this, 'gxtb_fb_lB_add_after_post' ),98);
		
		// adding the java-code for the fb-like-button into the footer
		add_action('wp_footer', array( $this, 'gxtb_fb_lB_java'));
		
		// checking if the user wants to add the like-button after/before the footer
		if($gxtb_fb_lB_settings['addfooter_activate']) {
		
			if ($gxtb_fb_lB_settings['addfooter'] == __('Before the Footer', 'gb_like_button') || $gxtb_fb_lB_settings['addfooter'] == __('Vor dem Footer', 'gb_like_button')) {
				
				add_action('get_footer', array( $this, 'gxtb_fb_lB_footer_function'));
				
			} else {
			
				add_action('wp_footer', array( $this, 'gxtb_fb_lB_footer_function'));
				
			}
		}
		
		## adds the like-button to the rss-feed if the users wants it
		##add_filter('the_excerpt_rss', array( $this, 'gxtb_fb_lB_rss_function'));
		##add_filter('the_content_rss', array( $this, 'gxtb_fb_lB_rss_function'));	
	}
	
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       BETA-Methods			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_rss_function($content) {
	if($content != "")	
	return $content;
} // end function

function gxtb_fb_lB_ajax() {

wp_print_scripts( array( 'sack' ));
global $wp_version;
if ( version_compare( $wp_version, '2.7.999', '>' ) ) {
?>
<script type="text/javascript">
var ajaxurl = ajaxurl;
</script>
<?php
} else {
?>
<script type="text/javascript">
var ajaxurl = "<?php echo get_bloginfo( 'wpurl') . '/wp-admin/admin-ajax.php'; ?>";
</script>
<?php
}

} //end function
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       FLUSH-ADDING			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################


function gxtb_fb_lB_flush() {
	
	ob_start(array( $this, 'gxtb_fb_lB_header_flush_function' ));
	ob_end_flush();
}

## with flush-function since v1.3.7.6 - Beta 2
function gxtb_fb_lB_header_flush_function($content) {


if (!$this -> meta) {
	
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	
	// filter/action adden die folgendes in den <html> tag schreibt:
			 /*xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE"
		xmlns:og="http://opengraphprotocol.org/schema/"
		xmlns:fb="http://www.facebook.com/2008/fbml">
		<head profile="http://gmpg.org/xfn/11"*/
		
		$meta = "";
		$title = false;
			
	foreach($gxtb_fb_lB_meta as $key => $value) {
	
		if($value != "") { 
		
			if(strstr($value, '$')) {
			
				switch ($value) {
					case strstr($value, '$binfo'):
$meta .= '
<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>';
					break;
						
					case strstr($value, '$ptitle'):
					if(is_home()){
$meta .= '
<meta property="og:title" content="' . get_bloginfo ( 'name' ). '"/>';
						$title = true;
					} else if (!is_category()) {
$meta .= '
<meta property="og:title" content="' . get_the_title($post->ID) . '"/>';
						$title = true;
					}
						break;
						
					case strstr($value, '$plink'):

	if(is_single()){
 		$permalink = get_permalink($post->ID);
	}elseif(is_page()){
 		$permalink = get_page_link($post->ID);
	}elseif(is_home()) {
	 	$permalink = get_bloginfo('url');
	}else {
		$permalink = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	}

	if( is_page() || is_single() ) {
$meta .= '
<meta property="og:url" content="' . $permalink .'"/>';
	}
						break;
					default:
						break;
				}
## maybe there'll be some problemes with the app_id and admins-meta tags when both appear. we'll see #
			} elseif ($key == "app_id" ) {
$meta .= '
<meta property="fb:' . $key . '" content="' . $value . '"/>';

		} elseif ($key == "page_id") {
$meta .= '
<meta property="fb:' . $key . '" content="' . $value . '"/>';

		} elseif ($key == "admins") {
$meta .= '
<meta property="fb:' . $key . '" content="' . $value . '"/>';
		
		} elseif ($key == "description") {
			$this -> gxtb_meta_description($key, $value, &$meta);
		} elseif ($key == "title" && !$title) {
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
		} 
		elseif ($key != "post_focus" && $key != "description" && $key != "dusage") {
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
		}
		}
	}
	
	$this-> meta = true;
	return $meta . $this -> gxtb_using_message() . $content;	
	
	} // end if-meta
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    ADDs the DESCRIPTION	 ###########
###########			META-TAG			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_meta_description($key, $value, $meta) {

	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');

	switch($gxtb_fb_lB_meta['dusage']) {
			
			case "blogd":
				$content = get_bloginfo('description');
				$bloginfo = get_bloginfo('description');
				break;
				
			case "bloge":
				$content = get_the_excerpt();
				break;
				
			case "blogn":
				$content = $gxtb_fb_lB_meta['description'];
				$bloginfo = $gxtb_fb_lB_meta['description'];
				break;
		}

	if((is_home() || is_category()) && $bloginfo != "") {
$meta .= '
<meta property="og:' . $key . '" content="' . $bloginfo . '"/>';

	} else if(is_single() || is_page() ) {
$meta .= '
<meta property="og:' . $key . '" content="' . $content . '"/>';	
	}
	
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  ADD THE LIKE-BUTTON		 ###########
###########			AFTER THE CONTENT	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_add_after_post($content) {

if( !is_404() ) {

	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$like_button_shown = false;
	
	global $post, $wp_query;
   	$page_id = $wp_query->post->ID;
    $pic = get_post_meta($page_id, '_fbnone', true);

	if ( $gxtb_fb_lB_settings['activate'] && !$pic ) {
				
		$text = "";
		
		/* PAGE - OPTIONS */
		$gxtb_frontpage = $gxtb_fb_lB_settings['frontpage'];
		$gxtb_page = $gxtb_fb_lB_settings['page'];
		$gxtb_post = $gxtb_fb_lB_settings['post'];
		$gxtb_category = $gxtb_fb_lB_settings['category'];
		$gxtb_archiv = $gxtb_fb_lB_settings['archiv'];
	
		if($gxtb_frontpage) {
			if(is_home()) {
				$text = $this -> gxtb_fb_lB_Generate("", "");
				$like_button_shown = true;
			}
		}
		
		if($gxtb_page) {
			if(is_page()) {
				if($this-> gxtb_fb_lB_exclude_check("page")) {
					$text = $this -> gxtb_fb_lB_Generate("", "");
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_post) {
			if(is_single()){
				if($this-> gxtb_fb_lB_exclude_check("post")) {
					$text = $this -> gxtb_fb_lB_Generate("", "");
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_category) {
			if(is_category()) {
				if($this-> gxtb_fb_lB_exclude_check("category")) {
					$text = $this -> gxtb_fb_lB_Generate("", "");
					$like_button_shown = true;
				}
			}
		}
		
		if($gxtb_archiv) {
			if(is_archive()) {
				if($this-> gxtb_fb_lB_exclude_check("archiv")) {
					$text = $this -> gxtb_fb_lB_Generate("", "");
					$like_button_shown = true;
				}
			}
		}
			
	} else {
	 	return $content;
	 } // end if activate 

if( $like_button_shown && ( isset($gxtb_fb_lB_settings['position_before']) || isset($gxtb_fb_lB_settings['position_after']) ) ) {	### Position im nächsten Update entfernen
	$gxtb_fb_lB_settings_both = false;

	if ( $gxtb_fb_lB_settings['position_before'] && $gxtb_fb_lB_settings['position_after'] ) {
	
		$text = $this -> gxtb_fb_lB_breaks("before") . $text . $this -> gxtb_fb_lB_breaks("after") . $content . $this -> gxtb_fb_lB_breaks("before") . $text;
		$gxtb_fb_lB_settings_both = true;
		
	} else if ( $gxtb_fb_lB_settings['position_before'] && !$gxtb_fb_lB_settings_both ) {

		$text = $this -> gxtb_fb_lB_breaks("before")  . $text . $this -> gxtb_fb_lB_breaks("after") . $content;
		
	} else if ( $gxtb_fb_lB_settings['position_after'] && !$gxtb_fb_lB_settings_both ) {
	
		$text = $content . $this -> gxtb_fb_lB_breaks("before") . $text;

	} 
	
	// returning the content of the post
	return $text;
	
} else {
	$text = $content;
	// returning the content of the post
	return $text;
}

} // end if-404	
} // end function

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  ADDs the <br> BEFORE or	 ###########
###########			AFTER the BUTTON	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_breaks($code) {

$gxtb_fb_lB_design = get_option('gxtb_fb_lB_design');
$br = "";

if ($code == "before") {

	for($count = 1; $count <= $gxtb_fb_lB_design['br_before']; $count++)
	{
		$br .= "<br>";
	}
	
}

if ($code == "after") {

	for($count = 1; $count <= $gxtb_fb_lB_design['br_after']; $count++)
	{
		$br .= "<br>";
	}
}

return $br;

} // end gxtb_fb_lB_breaks

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  CHECKS IF YOU CHOOSE 		 ###########
###########			EXCLUDED IDs	 	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_exclude_check($def) {

	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');

	/* EXCLUDE - OPTIONS */
	$gxtb_page = $gxtb_fb_lB_settings['page_exclude'];
	$gxtb_post = $gxtb_fb_lB_settings['post_exclude'];
	$gxtb_category = $gxtb_fb_lB_settings['category_exclude'];
	$gxtb_archiv = $gxtb_fb_lB_settings['archiv_exclude'];

	$array = array();

	switch ($def) {
	
		case "page":
		
			if ((strpos($gxtb_page, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_page);
				
				if(!is_page($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_page != "") {
				
				if(!is_page($gxtb_page))
					return true;
					
			} else {
				
				return true;
			}
			
		break;
				
		case "post":
		
			if ((strpos($gxtb_post, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_post);
				
				if(!is_single($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_post != "") {
				
				if(!is_single($gxtb_post))
					return true;
					
			} else {
				
				return true;
			}				
		break;
				
		case "category":
			if ((strpos($gxtb_category, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_category);
				
				if(!is_category($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_category != "") {
				
				if(!is_category($gxtb_category))
					return true;
					
			} else {
				
				return true;
			}				
		break;
				
		case "archiv":
			if ((strpos($gxtb_archiv, ",")) > 0) {
				$array = $this -> ArrayTrim($gxtb_archiv);
				
				if(!is_archive($array))
					return true;
				else
					return false;
					
			} elseif ($gxtb_archiv != "") {
				
				if(!is_archive($gxtb_archiv))
					return true;
					
			} else {
				
				return true;
			}				
		break;
								
		default:
			return false;
	}
}

function ArrayTrim($content) {

	if ($content != "") {

		$array = array();
		$i = 0;
	
		##echo "BEFORE: " . $content . "<br>";
		
		while (!$this -> ArrayCheck($content)){
			
			$i += 1;
			
			$pos = strpos($content, ",", 0);
			$array[strval($i)] = substr($content, 0, $pos);
			
			$content = strstr($content, ",");
			##echo "STRSTR: " . $content . "<br>";
			
			$content = trim($content, ",");
			##echo "TRIM: " .  $content  . "<br>";
			
			if(!strpos($content,","))
				$array[strval($i + 1)] = substr($content, 0);
		}
		
			return $array;
	} else {
		return "";
	}
}


function ArrayCheck($content) {

	$find = strpos($content, ",");
	
	if($find > 0) {
		return false;
	} else {
		return true;
	}
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON (SHORTCODE)	 ###########
###########			FOOTER-ACTION		 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_fb_lB_footer_function() {
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	#echo $this -> gxtb_fb_lB_generate();
	echo $this -> gxtb_fb_lB_Generate("", "");
	#$this -> gxtb_fb_lB_java();
	echo $this -> gxtb_using_message();
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_using_message() {

return '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
} // end class
} // end if-class
?>