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
###########	       Like-Button-Sidebar	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

	include_once('gb_bugs.php');
	include_once('gb_wp.php');
	include_once('gb_ad.php');
	#include_once('gb_plugin.php');
	include_once('gb_fb.php');
	include_once('gb_fb_activity.php');
	
	add_meta_box('gb_fb_fanbox',  __('Become a Fan', gxtb_fb_lB_lang), 'gb_fb', $this->pagehook, 'additional_fb', 'core');
	add_meta_box('gb_fb_paypal-box',  __('Please Support me', gxtb_fb_lB_lang), 'gb_paypal', $this->pagehook, 'additional_support', 'core');
	add_meta_box('gb_fb_activity',  __('Analyse your Blog', gxtb_fb_lB_lang), 'gb_fbactivity', $this->pagehook, 'additional_fb_activity', 'core');
	add_meta_box('gb_fb_bugs',  __('BugTracker', gxtb_fb_lB_lang), 'gb_bug', $this->pagehook, 'additional_bugs', 'core');
	add_meta_box('gb_fb_wp',  __('Wordpress-Posts', gxtb_fb_lB_lang), 'gb_wp', $this->pagehook, 'additional_bugs', 'core');
	add_meta_box('gb_fb_supporter',  __('Plugin-Supporter and Fans', gxtb_fb_lB_lang), 'gb_ad', $this->pagehook, 'additional_fans', 'core');
	#add_meta_box('gb_fb_plugin',  __('Plugin-Settings', gxtb_fb_lB_lang), 'gb_plugin', $this->pagehook, 'additional_settings', 'core');

	function gb_bug() {
		$gxtb_fb_lB_BuGClass = new gxtb_fb_lB_BuGClass;
	}
	function gb_wp() {
		$gxtb_fb_lB_WPClass = new gxtb_fb_lB_WPClass;
	}
	function gb_fb() {
		$gxtb_fb_lB_FB = new gxtb_fb_lB_FB;
	}
	function gb_fbactivity() {
		$gxtb_fb_lB_FBActivity = new gxtb_fb_lB_FBActivity;
	}	
	function gb_ad() {
		$gxtb_fb_lB_Ad = new gxtb_fb_lB_Ad;
	}	
	function gb_paypal() {
		global $gxtb_fb_like_button_active;
		global $gb_fb_lB_path;
		
		$gxtb_NewsClass_iArray = array(
			"active" => $gxtb_fb_like_button_active,
			"language" => "gb_like_button",
			"name" => gxtb_fb_lB_name,
			"version" => gxtb_fb_lB_version,
			"def" => "Plugin"
		);
		
		$gxtb_NewsPClass = new gxtb_NewsPClass($gxtb_NewsClass_iArray);
	}	
	function gb_plugin() {
		$gxtb_fb_lB_Settings = new gxtb_fb_lB_Settings;
	}

?>