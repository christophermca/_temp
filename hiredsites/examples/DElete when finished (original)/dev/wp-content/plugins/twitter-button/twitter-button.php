<?php
/*
Plugin Name: Twitter Button
Plugin URI: http://www.svil4ok.com/wordpress-plugins/twitter-button/
Description: Twitter Button is a WordPress plugin that allows you to easily integrate Tweet Button in your blog. <a href="http://www.svil4ok.com/wordpress-plugins/twitter-button/">More information here</a>.
Version: 0.2.8
Author: Svilen Popov
Author URI: http://www.svil4ok.com/

*/

define('TWITTER_BUTTON_TAG', '[twitter-button]');

if (!defined('ABSPATH')) {
	return ;
}

// Button Style
register_activation_hook(__FILE__,'tb_button_install'); 
register_deactivation_hook( __FILE__, 'tb_button_remove' );
function tb_button_install() {
	add_option("tb-button", 'vertical', '', 'yes');
}
function tb_button_remove() {
	delete_option('tb-button');
}


// Tweet Text
register_activation_hook(__FILE__,'tb_tweet_text_install'); 
register_deactivation_hook( __FILE__, 'tb_tweet_text_remove' );
function tb_tweet_text_install() {
	add_option("tb-tweet-text", '1', '', 'yes');
}
function tb_tweet_text_remove() {
	delete_option('tb-tweet-text');
}
register_activation_hook(__FILE__,'tb_tweet_text_custom_install'); 
register_deactivation_hook( __FILE__, 'tb_tweet_text_custom_remove' );
function tb_tweet_text_custom_install() {
	add_option("tb-tweet-text-custom", '', '', 'yes');
}
function tb_tweet_text_custom_remove() {
	delete_option('tb-tweet-text-custom');
}

// URL
register_activation_hook(__FILE__,'tb_url_install'); 
register_deactivation_hook( __FILE__, 'tb_url_remove' );
function tb_url_install() {
	add_option("tb-url", '1', '', 'yes');
}
function tb_url_remove() {
	delete_option('tb-url');
}
register_activation_hook(__FILE__,'tb_url_custom_install'); 
register_deactivation_hook( __FILE__, 'tb_url_custom_remove' );
function tb_url_custom_install() {
	add_option("tb-url-custom", '', '', 'yes');
}
function tb_url_custom_remove() {
	delete_option('tb-url-custom');
}

// Twitter Language
register_activation_hook(__FILE__,'tb_language_install'); 
register_deactivation_hook( __FILE__, 'tb_language_remove' );
function tb_language_install() {
	add_option("tb-language", 'en', '', 'yes');
}
function tb_language_remove() {
	delete_option('tb-language');
}

// Twitter Account
register_activation_hook(__FILE__,'tb_user_install'); 
register_deactivation_hook( __FILE__, 'tb_user_remove' );
function tb_user_install() {
	add_option("tb-user", '', '', 'yes');
}
function tb_user_remove() {
	delete_option('tb-user');
}

// Admin Language
register_activation_hook(__FILE__,'tb_admin_lang_install'); 
register_deactivation_hook( __FILE__, 'tb_admin_lang_remove' );
function tb_admin_lang_install() {
	add_option("tb-admin-lang", 'en', '', 'yes');
}
function tb_admin_lang_remove() {
	delete_option('tb-admin-lang');
}

// Method
register_activation_hook(__FILE__,'tb_method_install'); 
register_deactivation_hook( __FILE__, 'tb_method_remove' );
function tb_method_install() {
	add_option("tb-method", 'automatic', '', 'yes');
}
function tb_method_remove() {
	delete_option('tb-method');
}

// Exclude
register_activation_hook(__FILE__,'tb_exclude_install'); 
register_deactivation_hook( __FILE__, 'tb_exclude_remove' );
function tb_exclude_install() {
	add_option("tb-exclude", '', '', 'yes');
}
function tb_exclude_remove() {
	delete_option('tb-exclude');
}

// Button position
register_activation_hook(__FILE__,'tb_position_install'); 
register_deactivation_hook( __FILE__, 'tb_position_remove' );
function tb_position_install() {
	add_option("tb-position", '2', '', 'yes');
}
function tb_position_remove() {
	delete_option('tb-position');
}

// Style
register_activation_hook(__FILE__,'tb_style_install'); 
register_deactivation_hook( __FILE__, 'tb_style_remove' );
function tb_style_install() {
	add_option("tb-style", '', '', 'yes');
}
function tb_style_remove() {
	delete_option('tb-style');
}

// Recommend
register_activation_hook(__FILE__,'tb_recommend_install'); 
register_deactivation_hook( __FILE__, 'tb_recommend_remove' );
function tb_recommend_install() {
	add_option("tb-recommend", '', '', 'yes');
}
function tb_recommend_remove() {
	delete_option('tb-recommend');
}

// Recommend - Desc
register_activation_hook(__FILE__,'tb_recommend_desc_install'); 
register_deactivation_hook( __FILE__, 'tb_recommend_desc_remove' );
function tb_recommend_desc_install() {
	add_option("tb-recommend-desc", '', '', 'yes');
}
function tb_recommend_desc_remove() {
	delete_option('tb-recommend-desc');
}


function twitter_button() {
	global $post;
	$tb_button = (get_settings('tb-button') == "") ? 'vertical' : get_settings('tb-button');
	if (get_settings('tb-tweet-text') == "1") {
		$tb_tweet_text = $post->post_title;
	}
	else if (get_settings('tb-tweet-text') == "2") {
		$tb_tweet_text = $post->post_title .' - '. get_bloginfo('name');
	}
	else if (get_settings('tb-tweet-text') == "3") {
		$tb_tweet_text = get_bloginfo('name');
	}
	else {
		$tb_tweet_text = get_settings('tb-url-custom');
	}
	if ((get_settings('tb-url') == "1") && (get_post_status($post->ID) == 'publish')) {
		$tb_url = get_permalink();
	}
	else {
		$tb_url = get_settings('tb-url-custom');
	}
	$tb_lang = (get_settings('tb-language') == "en") ? '' : ' data-lang="'. get_settings('tb-language') .'"';
	$tb_user = (get_settings('tb-user') == "") ? '' : ' data-via="'. get_settings('tb-user') .'"';
	$tb_recommend = (get_settings('tb-recommend') == "") ? '' : ' data-related="'. get_settings('tb-recommend') .':'. get_settings('tb-recommend-desc') .'"';
	$tb_style = (get_settings('tb-style') == "") ? '' : get_settings('tb-style');
	$exclude_array = explode(", ", get_settings('tb-exclude')); 
	
	$tweet_button = '
	<div style="'. $tb_style .'">
		<a href="http://twitter.com/share" class="twitter-share-button" data-count="'. $tb_button .'" data-text="'. $tb_tweet_text .'" data-url="'. $tb_url .'" '.$tb_user.$tb_lang.$tb_recommend.'>Tweet</a>
	</div>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	if (in_array("1", $exclude_array) && is_home()) { 
		$tweet_button = "";
	}
	else if (in_array("2", $exclude_array) && (is_single() OR is_front_page())) { 
		$tweet_button = "";
	}
	else if (in_array("3", $exclude_array) && is_page()) { 
		$tweet_button = "";
	}
	else if (in_array("4", $exclude_array) && is_tag()) { 
		$tweet_button = "";
	}
	else if (in_array("5", $exclude_array) && is_category()) { 
		$tweet_button = "";
	}
	else if (in_array("6", $exclude_array) && is_date()) { 
		$tweet_button = "";
	}
	else if (in_array("7", $exclude_array) && is_year()) { 
		$tweet_button = "";
	}
	else if (in_array("8", $exclude_array) && is_month()) { 
		$tweet_button = "";
	}
	else if (in_array("9", $exclude_array) && is_day()) { 
		$tweet_button = "";
	}
	else if (in_array("10", $exclude_array) && is_time()) { 
		$tweet_button = "";
	}
	else if (in_array("11", $exclude_array) && is_search()) { 
		$tweet_button = "";
	}
	else if (in_array("12", $exclude_array) && is_feed()) { 
		$tweet_button = "";
	}
	return $tweet_button;
}

function tweet_button($content) {
	$button = twitter_button();
	if (get_option('tb-method') == "shortcode") {
		return str_replace(TWITTER_BUTTON_TAG, $button, $content);
	}
	else if (get_option('tb-method') == "manual") {
		return $content;
	}
	else { 
		if (get_option('tb-position') == "1") {
			$content = $button . $content;
		}
		else if (get_option('tb-position') == "3") {
			$content = $button . $content . $button;
		}
		else {
			$content .= $button;
		}
		return $content;
	}
}
add_filter('the_content', 'tweet_button');

function tb_include_admin() {  
	include('twitter-button-admin.php');  
}  
function tb_admin() {
	add_options_page("Twitter Button", "Twitter Button", 1, "twitter-button", "tb_include_admin");
}
add_action('admin_menu', 'tb_admin');

function tb_admin_register_head() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '';
	echo "<!-- WordPress Twitter Button -->\n";
	echo "<link rel='stylesheet' type='text/css' href='$url/css/tb-admin.css' />\n";
	echo "<script type='text/javascript' src='$url/controllers/tb-tabs.js'></script>\n";
	echo "<!-- WordPress Twitter Button -->\n";
}
add_action('admin_head', 'tb_admin_register_head');

?>