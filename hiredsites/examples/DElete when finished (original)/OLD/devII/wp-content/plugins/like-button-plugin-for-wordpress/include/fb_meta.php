<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3.2] - GB-Meta-Generator [v1.3.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       META-OUTPUT-Class	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_MetaAction')) {
class gxtb_fb_lB_MetaAction {

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

function gxtb_fb_lB_MetaAction() {

$settings = get_option('gxtb_fb_lB_settings');
if($settings["activate"]) {
	ob_start(array( $this, 'gxtb_fb_lB_header_flush' ));
	ob_end_flush();
}
}

function gxtb_fb_lB_header_flush($content) {

	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$meta = "";
	$title = false;
			
foreach($gxtb_fb_lB_meta as $key => $value) {
	
if($value != "") { 

switch ($key) {  
	
	case "site_name":
	case "title":
	case "url":
	
## BEGIN GB-Shortcodes ##
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
$meta .= '
<meta property="og:url" content="' . $permalink .'"/>';
						break;
					default:
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
						break;
				} // end switch
## END GB-Shortcodes #
	break;
	
## BEGIN Special Tags ##
	case "app_id":
	case "page_id":
	case "admins":
$meta .= '
<meta property="fb:' . $key . '" content="' . $value . '"/>';
	break;
	
	case "description":
		$this -> gxtb_meta_description($key, $value, &$meta);
	break;
	
	case ( $key == "type" && is_home() ):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	break;
	
	case ( $key == "pagetype" && is_page() ):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	break;
	
	case ( $key == "posttype" && is_single() ):
$meta .= '
<meta property="og:type" content="' . $value . '"/>';
	break;
	
	/* case ( $key == "type" /* && (is_home() || is_archive() || is_category()) /):
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
	break; */
	
	case "image":
	
	if( is_single() || is_page() ) {
	global $post, $wp_query;
   	$page_id = $wp_query->post->ID;
    $pic = get_post_meta($page_id, '_fbpic', true);	
	
	if ( isset($pic) && !empty($pic) && strstr($pic, "http://") )
$meta .= '
<meta property="og:' . $key . '" content="' . $pic . '"/>';		
	else
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';	
	} else {
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';	
	}
	break;
## END Special Tags ##	
## BEGIN Tags ##	
	default:
	if ($key != "dusage" && $key != "pagetype" && $key != "posttype" && $key != "type")
$meta .= '
<meta property="og:' . $key . '" content="' . $value . '"/>';
	break;
## END Tags ##
	} // end switch key

	} // end if-statement
} // end for-each	
	
	return $this -> gxtb_using_message() . $meta . $this -> gxtb_using_message() . "
	". $content;	
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
	$content = "";
	$bloginfo = "";

	switch($gxtb_fb_lB_meta['dusage']) {
			
			case "blogd":
				$content = get_bloginfo('description');
				$bloginfo = get_bloginfo('description');
				break;
				
			case "bloge":
				if ( is_single() || is_page() ) {
					$content = $this -> gxtb_meta_get_description();
				}
				if ( is_category() ) {
					global $wp_query;
					$cat_ID = get_query_var('cat');
					$bloginfo = category_description($cat_ID);
					if ( strpos($bloginfo, "<p>") >= 0 ) {
						$first = strpos($bloginfo, "<p>");
						$last = strrchr($bloginfo, "</p>");
						$bloginfo = substr($bloginfo, $first+3, $last - 5);
					}
				} else { $bloginfo = get_bloginfo('description'); }
				break;
				
			case "blogn":
				$content = $gxtb_fb_lB_meta['description'];
				$bloginfo = $gxtb_fb_lB_meta['description'];
				break;
		}
	
	if($content == "")
		$content = get_bloginfo('description');
	if($bloginfo == "")
		$bloginfo = get_bloginfo('description');
		
	if( !is_single() && !is_page() ) {
		if($bloginfo != "") {
$meta .= '
<meta property="og:' . $key . '" content="' . $bloginfo . '"/>';
		}
	} else if( (is_single() || is_page()) && $content != "" ) {
$meta .= '
<meta property="og:' . $key . '" content="' . $content . '"/>';	
	}
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    CREATES the Description	 ###########
###########			META-TAG			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_meta_get_description() {

	global $post, $wp_query, $wpdb;
	$page_id = $post->ID;
	$max_len = 170; // max length
	$output = "";

if(is_single()) {

	#$page_name = get_the_title($post->ID);
	#$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	#$excerpt = get_the_excerpt($post->ID);
	#$excerpt = strip_tags(get_the_excerpt($post->ID));
	#$excerpt = the_excerpt($post->ID);
	
	# Get the excerpt of the current post #
	$query = "SELECT post_excerpt FROM wp_posts WHERE ID = " . $page_id . " LIMIT 1";
  	$result = $wpdb->get_results($query, ARRAY_A);
  	$excerpt = $result[0]['post_excerpt'];

	if ($excerpt != "") {
		$output = substr($excerpt, 0, $max_len);
		if(strlen($output) < strlen($excerpt)) $output = $output . " [...]"; else $output = $excerpt;
	} else {
		$post = get_post( $page_id, ARRAY_A );
		$output = $this -> gxtb_meta_content($post['post_content'], true);
		$output_ex = substr($output, 0, $max_len);
		if(strlen($output_ex) < strlen($output)) $output = $output_ex  . " [...]"; else $output = $output;
	}
} else { #working#
		#$page_name = get_the_title($post->ID);
		#$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		$page_id = $post->ID;
		
		$post = get_post( $page_id, ARRAY_A );
		$output = $this -> gxtb_meta_content($post['post_content'], true);
		$output_ex = substr($output, 0, $max_len);
		if(strlen($output_ex) < strlen($output)) $output = $output_ex  . " [...]"; else $output = $output;
}
		return $output;
}
## inspired and modified by the Excerpt-Editor (http://www.laptoptips.ca/projects/wordpress-excerpt-editor/) by Andrew Ozz (http://www.laptoptips.ca/)
function gxtb_meta_content($str, $editing = false) {

	$autoopt['pgee_more'] = '';
	$autoopt['more_link'] = '';
	$autoopt['more_link_cc'] = '';
	$autoopt['more_text'] = 'Continue&nbsp;reading';
	$autoopt['pgee_length'] = '170';
	$autoopt['on_site'] = '';
	$autoopt['in_rss'] = '';

	$autoopt['do_shortcodes'] = '';
	$autoopt['pgee_tags'] = !empty($_POST['allowedtags']) ? preg_replace('/[^<>a-zA-Z0-6]+/', '', $_POST['allowedtags']) : '';

	$html_tags = empty($autoopt['pgee_tags']) ? false : $autoopt['pgee_tags'];

	$cut = true;
	if ( strpos($str, '<!--more') && !empty($autoopt['pgee_more']) ) {
		$str = substr( $str, 0, strpos($str, '<!--more') );
		$cut = false;
	}

	$str = preg_replace('|<style[^>]*>.*?</style>|si', '', $str); // remove style
	$str = preg_replace('|<script[^>]*>.*?</script>|si', '', $str); //remove js
	$str = preg_replace('|<![\s\S]*?--[ \t\n\r]*>|', '', $str); // remove CDATA, html comments

	if ( $html_tags )
		$str = strip_tags($str, $html_tags);
	else
		$str = strip_tags($str);

	if ( !empty($autoopt['do_shortcodes']) )
		$str = strip_shortcodes($str);

	if ( $cut ) {
		$words = preg_split('/[ \t\r]+/', $str, $autoopt['pgee_length'] + 1);
		if ( count($words) > $autoopt['pgee_length'] )
			array_pop($words);

		$str = implode(' ', $words);

		if ( $html_tags ) {
			if ( strpos($str, '<') !== false && ( ! strpos($str, '>') || strrpos($str, '<') > strrpos($str, '>') ) )
				$str = substr( $str, 0, strrpos($str, '<') );
		}

		$str = trim($str);
		$str = rtrim($str, '.,:;');
	}

	if ( $html_tags )
		$str = balanceTags($str, true);

	if ( !$editing && empty($autoopt['do_shortcodes']) )
		$str = do_shortcode($str);

	return $str;
}
####################################################
####################################################
##### YOU ARE NOT ALLOWED TO DELETE THIS LINE ######
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_using_message() {

return '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->';
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