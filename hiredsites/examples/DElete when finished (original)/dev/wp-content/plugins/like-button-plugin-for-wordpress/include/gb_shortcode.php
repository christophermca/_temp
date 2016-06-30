<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - Like-Button-Shortcode [v0.2] - OFFEN: 1x style
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      ShortCode-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_Shortcode')) {
class gxtb_fb_lB_Shortcode extends gxtb_fb_lB_GenerateLike {

	var $java = false; # früher private
	var $meta = false; # früher private

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON (SHORTCODE)	 ###########
###########				ADDING			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_fb_lB_Shortcode() {

	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');

	if ( $gxtb_fb_lB_settings['activate'] )
		add_shortcode('like', array( &$this, 'gxtb_fb_lB_function' ) );
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  LIKE-BUTTON (SHORTCODE)	 ###########
###########				ACTION			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
function gxtb_fb_lB_function($atts) {

	extract(shortcode_atts(array(
			'url' 		=> "",
			'style'		=> ""
		), $atts ));

	if (esc_attr($style) != "")
		#return "<div style='" . esc_attr($style) . "'>" . $this -> gxtb_fb_lB_Generate(esc_attr($url), esc_attr($style)) . "</div>";
		return $this -> gxtb_fb_lB_Generate(esc_attr($url), esc_attr($style)); # OFFEN
	else
		return $this -> gxtb_fb_lB_Generate(esc_attr($url), "");
}
} // end class
} // end if-class

if (class_exists('gxtb_fb_lB_Shortcode'))
	$gxtb_fb_lB_Shortcode = new gxtb_fb_lB_Shortcode();
?>