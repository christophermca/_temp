<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - Like-Button-Generator [v0.3]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	   LIKE-Generate-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_GenerateLike')) {
class gxtb_fb_lB_GenerateLike {

	var $java = false; # früher private
	var $meta = false; # früher private

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  GENERATES THE LIKE-BUTTON	 ###########
###########		FB-LIKE-BUT-GENERATOR	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_Generate($url, $style) {

	# deactivate the like-button if the option 'fbnone' is true
	global $post, $wp_query;
   	$page_id = $wp_query->post->ID;
    $fbnone = get_post_meta($page_id, '_fbnone', true);
	
	if ($fbnone)
		return "";
	# end deactivate the like-button

	// get all the needed options
	$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$gxtb_fb_lB_design = get_option('gxtb_fb_lB_design');
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$gxtb_fb_lB_analytics = get_option('gxtb_fb_lB_analytics');
		
	/* GENERATOR-CONTENT */
	$gxtb_generator_content = array();
			
	#generates the link
	if ($url == "") {
		if( ( is_single() || is_page() || is_category() || is_home() || is_archive() ) && $gxtb_fb_lB_settings['dynamic']) {
			$gxtb_generator_content['url'] = get_permalink($post->ID);
		} else {
			$gxtb_generator_content['url'] = $gxtb_fb_lB_generator['url'];
		}
	} else {
		$gxtb_generator_content['url'] = $url;
	}
	#generates the link

	#generates the faces
	$gxtb_generator_content['faces'] = $gxtb_fb_lB_generator['faces'];
	
	if($gxtb_generator_content['faces'] == "")
		$gxtb_generator_content['faces'] = "false";
	else
		$gxtb_generator_content['faces'] = "true";
	#generates the faces

	$gxtb_generator_content['layout'] = $gxtb_fb_lB_generator['layout'];
	$gxtb_generator_content['width'] = $gxtb_fb_lB_generator['width'];
	$gxtb_generator_content['height'] = $gxtb_fb_lB_generator['height'];
	$gxtb_generator_content['verb'] = $gxtb_fb_lB_generator['verb'];
	$gxtb_generator_content['color'] = $gxtb_fb_lB_generator['color'];
	$gxtb_generator_content['font'] = $gxtb_fb_lB_generator['font'];
	
	// setting defaults if sth. is empty
	if ($gxtb_generator_content['width'] == "") {
		$width = "450";
	} else {
		$width = $gxtb_generator_content['width'];
	}	

	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################
	
	// checks if the ref-definitons are activated
	if($gxtb_fb_lB_analytics['on']) {
	
		$ref = "";
	
		// generates the ref-definiton
		if ( is_home() && $gxtb_fb_lB_analytics['frontpage_activ'] && $gxtb_fb_lB_analytics['frontpage'] != "" ) {
			$ref = $gxtb_fb_lB_analytics['frontpage'];
		}
		if ( is_page() && $gxtb_fb_lB_analytics['page_activ'] && $gxtb_fb_lB_analytics['page'] != "" ) {
			$ref = $gxtb_fb_lB_analytics['page'];
		}	
		if ( is_single() && $gxtb_fb_lB_analytics['post_activ'] && $gxtb_fb_lB_analytics['post'] != "" ) {
			$ref = $gxtb_fb_lB_analytics['post'];
		}
		if ( is_category() && $gxtb_fb_lB_analytics['category_activ'] && $gxtb_fb_lB_analytics['category'] != "" ) {
			$ref = $gxtb_fb_lB_analytics['category'];
		}	
		if ( is_archive() && $gxtb_fb_lB_analytics['archiv_activ'] && $gxtb_fb_lB_analytics['archiv'] != "" ) {
			$ref = $gxtb_fb_lB_analytics['archiv'];
		}
	
	} // end ref-def-if

	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################
	// Abfrage ob JDK aktiviert ist und die App-ID vorhanden ist!
	if($gxtb_fb_lB_settings['JDK'] && $gxtb_fb_lB_meta['app_id'] != "" ) { 
	
		// generiert die Schriften für die JDK-Variante
		 if($gxtb_generator_content['font'] != "") {
			 	$font = ' font="' . $gxtb_generator_content['font'] . '" ';
			} else {
				 $font = '';
			}
			
	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################	
		// generiert die FB-Insights-Analyse (REL)
		if(isset($ref) && $ref != "") {
			$ref = 'ref="'. $ref .'"';
		} else {
			$ref = "";
		}
	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################
	
	$lang = $gxtb_fb_lB_settings['language'];
	if ($lang == "") { $lang = "en_US"; }
	
	// Zusammenbau des fb:like-Outputs
	$text = '<script src="http://connect.facebook.net/' . $lang . '/all.js#xfbml=1"></script><fb:like href="'. urlencode($gxtb_generator_content['url']) .'" layout="'. $gxtb_generator_content['layout'] .'" show_faces="'. $gxtb_generator_content['faces'] .'" width="'. $width .'" action="'. $gxtb_generator_content['verb'] .'"' . $font .'colorscheme="'. $gxtb_generator_content['color'] .'" '. $ref .'></fb:like>';
	
	$text .=  gxtb_fb_lB_GenerateLike::gxtb_fb_lB_java();

	} else {
	
	################################################
	##### i-Frame ##### if JDK is not activated ####
	################################################	
	
	// security-if-statement if some array-variables are empty
	if ( isset($gxtb_fb_lB_generator['scrolling']) || empty($gxtb_fb_lB_generator['scrolling']) )
		$gxtb_fb_lB_generator['scrolling'] = false;
		
	if ( isset($gxtb_fb_lB_generator['trans']) || empty($gxtb_fb_lB_generator['trans']) )
		$gxtb_fb_lB_generator['trans'] = false;
	
	## iframe-settings ##
	$gxtb_generator_content['scrolling'] = $gxtb_fb_lB_generator['scrolling'];
	$gxtb_generator_content['frameborder'] = $gxtb_fb_lB_generator['frameborder'];
	$gxtb_generator_content['trans']  = $gxtb_fb_lB_generator['trans'];
	$gxtb_generator_content['borderstyle'] = $gxtb_fb_lB_generator['borderstyle'];
	$gxtb_generator_content['overflow'] = $gxtb_fb_lB_generator['overflow'];
		
	## enable fonts
	 if($gxtb_generator_content['font'] != "") {
		 
		 switch ($gxtb_generator_content['font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $gxtb_generator_content['font'];
			 break;
		 }
		 
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}
	
	// setting defaults if sth. is empty	
	if ($gxtb_generator_content['height'] == "") {
		$gxtb_generator_content['height'] = "150";
	}

	// setting defaults if sth. is empty
	if ($gxtb_generator_content['frameborder'] == "") {
		$frameborder = "0";
	} else{
		$frameborder = $gxtb_generator_content['frameborder'];
	}
	
	// setting defaults if sth. is empty	
	if ($gxtb_generator_content['borderstyle'] == "") {
		$borderstyle = "none";
	} else{
		$borderstyle = $gxtb_generator_content['borderstyle'];
	}
	
	if ($gxtb_generator_content['trans']) {
		$trans = "true";
	} else{
		$trans = "false";
	}	
	
	if ($gxtb_generator_content['scrolling']) {
		$scrolling = "yes";
	} else{
		$scrolling = "no";
	}		

	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################	
		// generiert die FB-Insights-Analyse (REF)
		if(isset($ref) && $ref != "") {
			$ref = '&amp;ref='. $ref;
		}
		else {
			$ref = "";
		}
	################################################
	### FB-Analytics [v4.0] ### release-mode ###
	################################################
	
	$text = '<iframe src="http://www.facebook.com/plugins/like.php?href='. urlencode($gxtb_generator_content['url']) .'&amp;layout='. $gxtb_generator_content['layout'] .'&amp;show_faces='. $gxtb_generator_content['faces'] .'&amp;width='. $width .'&amp;action='. $gxtb_generator_content['verb'] .'&amp;' . $font . 'colorscheme='. $gxtb_generator_content['color'] .'&amp;height='. $gxtb_generator_content['height'] .''.$ref.'" scrolling="'. $scrolling .'" frameborder="'. $frameborder .'" allowTransparency="'. $trans .'" style="border:'. $borderstyle .'; overflow:'. $gxtb_generator_content['overflow'] .'; width:'. $width .'px; height:'. $gxtb_generator_content['height'] .'px"></iframe>';

	}
	
	# creates the css-elements (class and style)
	$div_before = "<div ";
	$div_after = "</div>";
	
	if ( isset($gxtb_fb_lB_design['css']) && $gxtb_fb_lB_design['css'] != "" && !$div) {
		$div_before .= ' class="' . $gxtb_fb_lB_design['css'] . '"';
	}
	if ( isset($gxtb_fb_lB_design['cssbox']) && $gxtb_fb_lB_design['cssbox'] != "" && !$div) {
		$div_before .= ' style="' . $gxtb_fb_lB_design['cssbox'] . '"';
	}
	
	if ( strstr($div_before, "class") || strstr($div_before, "style") )
		$div_before .= ">";
	else {
		$div_before = "";
		$div_after = "";
	}
		/* returns the generated code and generates the final output*/
		return $this -> gxtb_using_message() . $div_before . $text . $div_after . $this -> gxtb_using_message();
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  GENERATES THE JAVA-CODE	 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_fb_lB_java() {

if(!$this->java) {

	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	
	## second if-statement since [v.1.3.7.2] ##
if($gxtb_fb_lB_settings['JDK'] && $gxtb_fb_lB_meta['app_id'] != "" || $gxtb_fb_lB_meta['app_id'] != "") {

	$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
	$lang = $gxtb_fb_lB_generator['language'];
?>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({appId: '<?php echo $gxtb_fb_lB_meta['app_id']; ?>', status: true, cookie: true,
             xfbml: true});
  };
  (function() {
    var e = document.createElement('script');
	e.type = 'text/javascript';
    e.src = document.location.protocol +
      '//connect.facebook.net/<?php ## the user can choose the language since [v.1.4.5]
	  if ($lang != "") { echo $lang; } else { echo "en_US"; }  ?>/all.js';
	  e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>

<?php
	}
	$this-> java = true;
	## fixes the bug of multiple java-codes (v3.0)##
}
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