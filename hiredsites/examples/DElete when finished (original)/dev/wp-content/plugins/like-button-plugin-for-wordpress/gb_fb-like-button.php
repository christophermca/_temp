<?php
/*
	Plugin Name: Like-Button-Plugin-For-Wordpress
	Plugin URI: http://www.gb-world.net/like-button-plugin-for-wordpress/
	Description: This Plugin provides the most settings for the Like-Button of Facebook. It's in a steadily development to ensure that everything is up-to-date with all the Web 2.0 Standards and Requirements. Enjoy the Like-Button now with GB-World.net's Like-Button-Plugin-For-Wordpress!
	Version: 4.3.2
	Author: Stefan Natter
	Author URI: http://www.gb-world.net
	Update Server: http://wordpress.org/extend/plugins/like-button-plugin-for-wordpress
	Min WP Version: 2.7.x
	Max WP Version: 3.x
*/

/* Copyright (C) 2010 Stefan Natter (http://www.gb-world.net and http://www.gangxtaboii.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

<http://www.gnu.org/licenses/>.
http://www.gnu.org/licenses/gpl.txt
*/

/* -NOTICE- Some things are still in GERMAN -NOTICE-

-gangxtaboii.com-DEV-NOTICE-
	all our functions are available at all levels in wp - except they are in classes. other plugins could possibly use your functions. but we recommend to do not
	use them because all of them were just written for our own several plugins and they will properly do not work as they should work
	if you use it in combination with your own plugins/themes.
-gangxtaboii.com-DEV-NOTICE-

some important pages for you:
	http://sudarmuthu.com/wordpress/wp-readme
	http://wordpress.org/extend/plugins/about/validator/
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      STOP DIRECT CALL		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      GB-NEWSBOX [v1.5]		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

$gxtb_fb_like_button_active = "off";

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       DEFINITIONS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

$gb_fb_lB_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      MAIN-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if(!class_exists('gxtb_fb_like_Class')) {
class gxtb_fb_like_Class {
function gxtb_fb_like_Class() {
	
########################################################################################################
											## BEGIN DEFINITIONS  ##

	## including another plugin for our plugin ##
	include_once('plugins/changelogger/changelogger.php');

	global $gb_fb_lB_path;
	global $wp_version;
	$gxt_fb_like_button_shortcode = "gxtb_fb_lB";
	
if ( !defined( $gxt_fb_like_button_shortcode . '_shortcode' ) )
	define( $gxt_fb_like_button_shortcode . '_shortcode', "gxtb" );
if ( !defined( $gxt_fb_like_button_shortcode . '_version' ) )
	define( $gxt_fb_like_button_shortcode . '_version', "4.3.2" );
if ( !defined( $gxt_fb_like_button_shortcode . '_name' ) )
	define( $gxt_fb_like_button_shortcode . '_name', "Like-Button-Plugin-For-Wordpress" );
if ( !defined( $gxt_fb_like_button_shortcode . '_page' ) )
	define( $gxt_fb_like_button_shortcode . '_page', "fb-like-button" );
if ( !defined( $gxt_fb_like_button_shortcode . '_lang' ) )
	define( $gxt_fb_like_button_shortcode . '_lang', "gb_like_button" );
if ( !defined( 'gxtb_fb_lB_PLUGIN_FOLDER' ) )
	define( 'gxtb_fb_lB_PLUGIN_FOLDER', $gb_fb_lB_path );
if ( !defined( 'gxtb_fb_lB_FB_BASENAME' ) )
	define( 'gxtb_fb_lB_FB_BASENAME', plugin_basename( __FILE__ ) );
if ( !defined( 'gxtb_fb_lB_FB_BASEFOLDER' ) )
	define( 'gxtb_fb_lB_FB_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
if ( !defined( 'gxtb_fb_lB_FB_FILENAME' ) )
	define( 'gxtb_fb_lB_FB_FILENAME', str_replace( gxtb_fb_lB_FB_BASEFOLDER.'/', '', plugin_basename(__FILE__) ) );
if ( !defined( 'gxtb_fb_lB_ABSPATH' ) )
	define('gxtb_fb_lB_ABSPATH', WP_PLUGIN_DIR.'/'.plugin_basename( dirname(__FILE__) ).'/' );
if ( !defined( 'gxtb_fb_lB_URLPATH' ) )
	define('gxtb_fb_lB_URLPATH', WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' );
	
	// Check for GB_FB-V5.0 installation
if (!defined ('IS_GB_FB_4_0'))
	define('IS_GB_FB_4_0', version_compare(gxtb_fb_lB_version, '5.0', '>=') );

											## END DEFINITIONS  ##
########################################################################################################
											## BEGIN PLUGIN-ACTION  ##

	// initialize the actions (SHORTCODE)
	$this -> gxtb_fb_lB_action();
	// ainitialize the widget
	$this -> gxtb_fb_lB_add_widget();

											## END PLUGIN-ACTION  ##
########################################################################################################
											## BEGIN PLUGIN-PAGE-BUTTONS ##

	// add aditional links to the plugin-page
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
	  	add_filter( 'plugin_row_meta', array( $this, 'gxtb_fb_lB_filter_plugin_meta' ), 10, 2 ); // only 2.8 and higher
		add_filter( 'plugin_action_links', array( $this, 'gxtb_fb_lB_filter_plugin_meta' ), 10, 2 );
		
		// add message to list of plugins, if an update is available / add additional links on Plugins page, but only if page is plugins.php
		if ( is_admin() && 'plugins.php' == $GLOBALS['pagenow'] ) {
			add_action( 'in_plugin_update_message-' . plugin_basename(__FILE__), array( $this, 'gxtb_fb_lB_update_notice' ), 10, 2 );
		}
		
	} else {
		add_filter( 'plugin_action_links', array( $this, 'gxtb_fb_lB_filter_plugin_meta' ), 10, 2 );
	}

											## END PLUGIN-PAGE-BUTTONS ##
########################################################################################################
											## BEGIN OTHER HOOKS ##
											
	register_activation_hook( __FILE__, array(&$this, 'gxtb_fb_lB_activate'));
	register_deactivation_hook( __FILE__, array(&$this, 'gxtb_fb_lB_deactivate'));
	
											## END OTHER HOOKS ##
########################################################################################################
##http://de.selfhtml.org/javascript/objekte/document.htm#get_elements_by_tag_name
########################################################################################################
											## BEGIN SETTING-PAGE  ##

	$this -> gxtb_fb_lB_options();
	$this -> gxtb_fb_lB_info_page();

											## END SETTING-PAGE  ##
########################################################################################################
											## BEGIN INCLUDE ##

	#include_once(dirname(__FILE__) . '/html/gb_warnings.php'); --> currently deactivated until v4.5
	include_once(dirname(__FILE__) . '/include/gb_post.php');
	include_once(dirname(__FILE__) . '/tinymce/gb_button.php');

											## END INCLUDE ##
########################################################################################################
											## BEGIN ACTION ##
	
	// action before the admin-menu is displayed
	#add_action('admin_init', array(&$this,'gxtb_fb_lB_save_settings')); --> currently deactivated until v4.5
	
	// action to add some code into the admin_footer
	#add_action('admin_footer', array(&$this,'gxtb_fb_lB_warning')); --> currently deactivated until v4.5
	
	// controlls the cache of the feed-reader
	add_filter( 'wp_feed_cache_transient_lifetime', array(&$this,'gxtb_fb_lB_feed_controller') );
	
	// generates the header before the site is loaded
	add_action('wp_head', array( $this, 'gxtb_fb_lB_MetaTags' ));

	if ( version_compare( $wp_version, '2.7', '>=' ) )
	// creates a dashboard-widget which contains the blog-recommendations	
	add_action('wp_dashboard_setup', array( $this, 'gbworld_dashboard_widgets' ) );
	
	// Start the tinymce-modul once all other plugins are fully loaded
	add_action( 'plugins_loaded', create_function( '', 'global $gxtb_fb_lB_button; $gxtb_fb_lB_button = new gxtb_fb_lB_button();' ) );

											## END ACTION ##
########################################################################################################
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      DASHBOARD-WIDGET		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gbworld_dashboard_widget_function() {
	// displays the recommendation and activity of current blog
	echo "<table><tr><td>";
	include('admin/gb_fb_activity.php');
	$gxtb_fb_lB_FBActivity = new gxtb_fb_lB_FBActivity();
	?><br />
	<!-- using Like-Button-Plugin-For-Wordpress [<?php echo gxtb_fb_lB_version; ?>] | by http://www.gb-world.net -->
<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2FGBWorldnet&amp;layout=box_count&amp;show_faces=false&amp;width=50x&amp;action=like&amp;colorscheme=light&amp;height=80&amp;ref=fdasf" scrolling="no" frameborder="0" allowTransparency="false" style="border:none; overflow:hidden; width:150px; height:80px"></iframe>
<!-- using Like-Button-Plugin-For-Wordpress [<?php echo gxtb_fb_lB_version; ?>] | by http://www.gb-world.net -->
</td><td align="left" valign="top">
<iframe src="http://www.facebook.com/plugins/recommendations.php?site=<?php echo $_SERVER['HTTP_HOST']; ?>&amp;width=250&amp;height=300&amp;header=true&amp;colorscheme=light" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:300px;" allowTransparency="true"></iframe>
<?php echo "</td></tr></table>";
	if( is_admin()) {
		echo "<hr>";
		echo sprintf( '<div style="padding-left:10px;"><a href="options-general.php?page=%s">%s</a></div>', "fb-like-button", __('Plugin', gxtb_fb_lB_lang) . "-" . __('Settings', gxtb_fb_lB_lang) );
	}
} 
function gbworld_dashboard_widgets() {
	wp_add_dashboard_widget('gbworld_dashboard_widget', 'Your Blog-Activity', array( $this, 'gbworld_dashboard_widget_function' ));	
		
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;
	
	// Get the regular dashboard widgets array 
	// (which has our new widget already but at the end)
	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
	
	// Backup and delete our new dashbaord widget from the end of the array
	$gbworld_dashboard_widget = array('gbworld_dashboard_widget' => $normal_dashboard['gbworld_dashboard_widget']);
	unset($normal_dashboard['gbworld_dashboard_widget']);

	// Merge the two arrays together so our widget is at the beginning
	$sorted_dashboard = array_merge($gbworld_dashboard_widget, $normal_dashboard);

	// Save the sorted array back into the original metaboxes 
	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      INTERNATIONALIZE		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_options_load_textdomain() {
	// Load up the localization file if we're using WordPress in a different language
	// Place it in this plugin's "lang" folder and name it "gb_like_button-[value in wp-config].mo"
	load_plugin_textdomain( 'gb_like_button', FALSE, plugin_basename( dirname(__FILE__) ).'/languages' );
	/* Notice from the gb-dev-team:
	Examples for language-translating:
	(German):  http://www.texto.de/wordpress-theme-lokalisieren-sprachdatei-erstellen-schritt-fuer-schritt-anleitung-553/
	(English): http://weblogtoolscollection.com/archives/2007/08/27/localizing-a-wordpress-plugin-using-poedit/
	(English): http://www.lost-in-code.com/platforms/wordpress/wordpress-translate-a-plugin/	*/
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      OPTION PAGE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_options() {
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	if (strstr($_GET['page'],"fb-like")) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', gxtb_fb_lB_PLUGIN_FOLDER. 'admin/lib/jquery-1.4.3.min.js', false, '1.4.3');
		#wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js', false, '1.4.3');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery');
	}
	$this -> gxtb_fb_lB_options_load_textdomain();
	// initialize the settings-page
	require_once(dirname(__FILE__) . '/admin/admin_page.php');
	require_once(dirname(__FILE__) . "/gbworld/gb_newsbox.php");
	require_once(dirname(__FILE__) . "/gbworld/gb_paypal.php");
	$gxtb_fb_lB_spClass = new gxtb_fb_lB_spClass();
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      INFO PAGE				 ###########
###########		 (since v3.0)	    	 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_info_page() {
	
	$gxtb_fb_lB = get_option('gxtb_fb_lB');

	if ( $gxtb_fb_lB["InfoPage"] ) {

		$gb_infopage = get_option('gb_infopage');

		global $gxtb_fb_like_button_active;
	
		/* these scripts are needed to create the meta-boxes */
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		
		$this -> gxtb_fb_lB_options_load_textdomain();
	
		$gxtb_InfoPageArray = array(
		  "active" => $gxtb_fb_like_button_active,
		  "language" => "gb_like_button",
		  "name" => gxtb_fb_lB_name,
		  "version" => gxtb_fb_lB_version,
		  "def" => "Plugin"
		);

		require_once(dirname(__FILE__) . '/gbworld/gb_infopage.php');
		$gxtb_infoPageClass = new gxtb_infoPageClass($gxtb_InfoPageArray);
	}
	
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      PLUGIN PAGE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
## http://striderweb.com/nerdaphernalia/2008/06/wp-use-action-links/ ##

// Additional Plugin-Buttons
function gxtb_fb_lB_filter_plugin_meta($links, $file) {

	/* donate-link */
	    if ( $file == gxtb_fb_lB_FB_BASENAME ) {
		$links[] =  sprintf( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG" target="_blank">'. __('Donate', gxtb_fb_lB_lang) . '</a>'); // ... or after other links
    }

    /* settings-link */
    if ( $file == gxtb_fb_lB_FB_BASENAME ) {
	    array_unshift(
            $links,
            sprintf( '<a href="options-general.php?page=%s">%s</a>', "fb-like-button", __('Settings', gxtb_fb_lB_lang) )
        );		
    }
	
    return $links;
}

function gxtb_fb_lB_update_notice() {
	$info = __( 'Notice: Changelog-Preview is provided with <a href="http://wordpress.org/extend/plugins/changelogger/" target="_blank">Changelogger</a>', gxtb_fb_lB_lang );
	echo ' (<small><span class="spam">' . strip_tags( $info, '<br><a><b><i><span>' ) . '</span></small>)';
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    	PLUGIN ACTION		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_action() {

	require_once( 'include/fb_likeButton.php' );
	require_once( 'include/gb_shortcode.php' );
	
	// call the action-classes:
	$gxtb_fb_lB_Class = new gxtb_fb_lB_Class();
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      WIDGET 	 ACTION		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_add_widget() {

	require_once( 'include/fb_widget.php');
	$gxtb_fb_lB_WidgetClass = new gxtb_fb_lB_WidgetClass();
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      META-TAGS-OUTPUT		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_MetaTags() {
	require_once( 'include/fb_meta.php');
	$gxtb_fb_lB_MetaAction = new gxtb_fb_lB_MetaAction();
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    REGISTER THIS PLUGIN	 ###########
###########								 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################

function gxtb_fb_lB_activate(){

	if( !get_option('gxtb_fb_lB') ) {
		$gxtb_fb_lB = array();
		#$gxtb_fb_lB["InfoPage"] = false;
		#$gxtb_fb_lB["FavIcon"] = false;
		#$gxtb_fb_lB["jQuery"] = true;
		$gxtb_fb_lB = array('cVersion' => gxtb_fb_lB_version, 'message' => true);
		update_option('gxtb_fb_lB', $gxtb_fb_lB);
	} else {
		## Update for Version 4.3 ##
		$gxtb_fb_lB = get_option('gxtb_fb_lB');
		$gxtb_fb_lB["InfoPage"] = false;
		$gxtb_fb_lB = array('cVersion' => gxtb_fb_lB_version, 'message' => true);
		update_option('gxtb_fb_lB', $gxtb_fb_lB);
		#if( !isset($gxtb_fb_lB["jQuery"]) || empty($gxtb_fb_lB["jQuery"]) ) { $gxtb_fb_lB["jQuery"] = true; update_option('gxtb_fb_lB', $gxtb_fb_lB); }
	}

	############ GB-World Infopage Setup ############
	require_once( 'gbworld/gb_infopage_setup.php');
	GB_infoPage_activate(gxtb_fb_lB_name, gxtb_fb_lB_version);
	############ GB-World Infopage Setup ############
	
	## Plugin-Settings ##
	if(!get_option('gxtb_fb_lB_settings')) {
	
	$gxtb_fb_lB_settings = array(
		'activate' => false,
		'addfooter_activate' => false,
		'addfooter' => false,
		'position' => false,
		'frontpage' => false,
		'page' => false,
		'page_exclude' => "",
		'post' => false,
		'post_exclude' => "",
		'category' => false,
		'category_exclude' => "",
		'archiv' => false,
		'archiv_exclude' => "",		
		'JDK' => false,
		'language' => "en_US",
		'dynamic' => false
		);
		add_option('gxtb_fb_lB_settings', $gxtb_fb_lB_settings);
	}

	## Design-Settings - For Update from older versions to 4.3##
	if(!get_option('gxtb_fb_lB_design')) {
		
		$gxtb_fb_lB_design = array(
			'css' => "",
			'cssbox' => "",
			'br_before' => 0,
			'br_after' => 0	
		);
		
		add_option('gxtb_fb_lB_design', $gxtb_fb_lB_design);			
		
	} else {	# Update-Procedure
	
		$gxtb_fb_lB_design = get_option('gxtb_fb_lB_design');
		$settings = get_option('gxtb_fb_lB_settings');
		
		if(isset($settings['css']) && $settings['css']!= "" && $gxtb_fb_lB_design['css'] != "" ) $gxtb_fb_lB_design['css'] = $settings['css'];
		if(isset($settings['cssbox']) && $settings['cssbox']!= "" && $gxtb_fb_lB_design['cssbox'] != ""  ) $gxtb_fb_lB_design['cssbox'] = $settings['cssbox'];
		if(isset($settings['br_before']) && $settings['br_before']!= "" && $gxtb_fb_lB_design['br_before'] != ""  ) $gxtb_fb_lB_design['br_before'] = $settings['br_before'];
		if(isset($settings['br_after']) && $settings['br_after']!= "" && $gxtb_fb_lB_design['br_after'] != ""  ) $gxtb_fb_lB_design['br_after'] = $settings['br_after'];
		
		update_option('gxtb_fb_lB_design', $gxtb_fb_lB_design);
	}

	## FB-Analytics-Tools ##
	if(!get_option('gxtb_fb_lB_analytics')) {
	
	$gxtb_fb_lB_analytics = array(
		'on' => false,
		'frontpage' => "",
		'frontpage_activ' => false,
		'category' => "",
		'category_activ' => false,
		'page' => "",
		'page_activ' => false,
		'post' => "",
		'post_activ' => false
		);
		add_option('gxtb_fb_lB_settings', $gxtb_fb_lB_analytics);
	}

	## Like-Button-Generator ##
	if(!get_option('gxtb_fb_lB_generator')) {
	$gxtb_fb_lB_generator = array(
		'url' => "",
		'layout' => "",
		'faces' => false,
		'width' => "",
		'height' => "250",
		'verb' => "like",
		'color' => "light",
		'font' => "",
		'scrolling' => false,
		'frameborder' => "",
		'borderstyle' => "none",
		'overflow' => "hidden",
		'trans' => true
		);
		add_option('gxtb_fb_lB_generator', $gxtb_fb_lB_generator);
	} else { # Update for v4.3
		$generator = get_option('gxtb_fb_lB_generator');
		$settings = get_option('gxtb_fb_lB_settings');
		if(isset($generator['language']) && $generator['language']!= "" ) $settings['language'] = $generator['language'];
		if(isset($generator['dynamic']) && $generator['dynamic'] ) $settings['dynamic'] = true;	
		update_option('gxtb_fb_lB_settings', $settings);
	}

	## Open Graph Protocol - Meta Tags ##
	if(!get_option('gxtb_fb_lB_meta')) {

	$gxtb_fb_lB_meta = array(
		'site_name' => "",
		'type' => "",
		'admins' => "",
		'app_id' => "",
		'page_id' => "",
		'title' => "",
		'url' => "",
		'description' => "",
		'dusage' => "blogd",
		'image' => "",
		'plz' => "",
		'mail' => "",
		'street' => "",
		'phone' => "",
		'locality' => "",
		'fax' => "",
		'region' => "",
		'country' => "",
		'latitude' => "",
		'longitude' => ""
		);
		add_option('gxtb_fb_lB_meta', $gxtb_fb_lB_meta);
	}
}
  
function gxtb_fb_lB_deactivate(){

	############ GB-World Infopage Setup ############	
  	require_once( 'gbworld/gb_infopage_setup.php');
	GB_infoPage_deactivate(gxtb_fb_lB_name);
	############ GB-World Infopage Setup ############
	
	// this must be done because after an update or temporary deactivation it would display all errors ;)
	delete_option('gxtb_fb_lB_warning');
	
##########################################################	
	## General Information about this Plugin
	if( !get_option('gxtb_fb_lB') ) {
		$gxtb_fb_lB = array('lVersion' => gxtb_fb_lB_version);
		add_option('gxtb_fb_lB', $gxtb_fb_lB);
	} else {
		$gxtb_fb_lB = get_option('gxtb_fb_lB');
		$gxtb_fb_lB['lVersion'] = gxtb_fb_lB_version;
		update_option('gxtb_fb_lB', $gxtb_fb_lB);
	}
##########################################################	
}
####################################################
####### since v4.0 #################################
###########								 ###########
###########								 ###########
###########	    	ADMIN-ACTION	     ###########
###########				WARNINGs		 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################

// checks if there are some mistakes and also outputs the warning
function gxtb_fb_lB_warning() {

	// Option laden
	$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');
	
	// Abfrage ob die Option true ist
	if($gxtb_fb_lB_warning['warning_aktiv']) {
		
		// Warnungen checken
		gxtb_fb_lB_WAClass::gxtb_fb_warnings_check();

		// Warnungen ausgeben (falls vorhanden)
		gxtb_fb_lB_WAClass::gxtb_fb_warnings_output();
	}
}

function gxtb_fb_lB_save_settings() {

	// einmaliges erstellen der Option falls sie nicht vorhanden ist
	if( !get_option('gxtb_fb_lB_warning') ) {
		$gxtb_fb_lB_warning = array( 'warning' => false, 'warning_aktiv' => true );
		add_option('gxtb_fb_lB_warning', $gxtb_fb_lB_warning);
	} else {
		$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');
		if( !isset($gxtb_fb_lB_warning["warning_aktiv"]) || empty($gxtb_fb_lB_warning["warning_aktiv"]) ) {
			$gxtb_fb_lB_warning["warning_aktiv"] = true; 
			update_option('gxtb_fb_lB_warning', $gxtb_fb_lB_warning); 
		}
	}
	
	// Option laden
	#$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');
	
	// Überprüfen wann die Fehlermeldung angezeigt wird - die Option wird auf wahr oder falsch gestellt		
		if (isset($_POST['submit']) && isset($_REQUEST['page']) && $_REQUEST['page'] == 'fb-like-button') {
			$gxtb_fb_lB_warning['warning'] = true;
		} elseif ( $gxtb_fb_lB_warnings['warning'] > 0 ) {
			$gxtb_fb_lB_warning['warning'] = true;
		} else {
			$gxtb_fb_lB_warning['warning'] = false;
		}

	// Option speichern
	update_option('gxtb_fb_lB_warning', $gxtb_fb_lB_warning);
}
####################################################
####### since v4.0 #################################
###########								 ###########
###########								 ###########
###########	    	ADMIN-ACTION	     ###########
###########				FEED-Controller	 ###########
###########								 ###########
####################################################
#####################   by gb-world.net  ###########
####################################################
## inspired by this article: http://wpengineer.com/feed-cache-in-wordpress/ (Englisch ##
## http://bueltge.de/feed-cache-von-wordpress/1039/ (German) ##
## http://simplepie.org/wiki/reference/start#simplepie_item ##
function gxtb_fb_lB_feed_controller() {

if( $_REQUEST['page'] == 'fb-like-button' || $_REQUEST['page'] == 'gb-world' )
	#return 1800; ## 15 min
	#return 600; ## 5 min
	return 0;
else
	return 43200;
}
} // end class
} // end if-class
	// Let's start the plugin by gb-world.net
	global $gxtb_fb_like_Class;
	$gxtb_fb_like_Class = new gxtb_fb_like_Class();
?>