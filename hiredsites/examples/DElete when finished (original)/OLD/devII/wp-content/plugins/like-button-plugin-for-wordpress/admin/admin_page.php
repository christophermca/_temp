<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - GB-AdminPage [v1.0.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
########################################################################################################
											## FAQ  ##
##	http://www.code-styling.de/downloads/howto-metabox-plugin.zip
##  register_activation_hook( dirname(__FILE__) . '/nggallery.php', array(&$this, 'activate') );
##	http://andrewferguson.net/2008/09/26/using-add_meta_box/
##	http://wordpress.org/support/topic/356788 (EDITOR)
##  http://wefunction.com/2009/10/revisited-creating-custom-write-panels-in-wordpress/ (GOOD)
											## FAQ  ##
########################################################################################################

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       OPTION-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

if(!class_exists('gxtb_fb_lB_spClass')) {
class gxtb_fb_lB_spClass {

########################################################################################################
											## CONSTRUCTOR  ##
function gxtb_fb_lB_spClass() {
	
		add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
		add_action('admin_menu', array(&$this, 'on_admin_menu'));
		
		$mypluginoptionpageslug = "fb-like";
		if (strstr($_GET['page'],$mypluginoptionpageslug)) { $ismypluginoptionpage = 'true'; } else { $ismypluginoptionpage = 'false'; }
		 
		if ( $ismypluginoptionpage == 'true' )
			 add_action('admin_head', array(&$this, 'gb_admin_header'));
			 
		// including the gb_metaboxes
		include_once('gb_general.php');
		include_once('gb_design.php');
		include_once('gb_meta.php');
		include_once('gb_admin_header.php');
		include_once('gb_faq.php');
		include_once('gb_insights.php');
		include_once('gb_expertmod.php');
		include_once('gb_settings.php');
		}

########################################################################################################
											## ADDING THE JS-File  ##

function gb_admin_header() {	
	gb_admin_header::gb_admin_head();
}
########################################################################################################
											## ADDING THE COLUMNS  ##

	function on_screen_layout_columns($columns, $screen) {
		//for WordPress 2.8 we have to tell, that we support 2 columns !
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
	}

########################################################################################################
											## ADMIN-FUNCTION  ##
	function on_admin_menu() {
		global $wp_version;
		$pagelevel = "administrator";
		
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
		$this->pagehook = add_menu_page('FB-Like', "FB-Like", $pagelevel, 'fb-like-button', array(&$this, 'on_show_page'),  gxtb_fb_lB_PLUGIN_FOLDER .'images/admin.png');
	} elseif ( version_compare( $wp_version, '2.8', '<' ) ) {
		$this->pagehook = add_menu_page('FB-Like', "FB-Like", $pagelevel, 'fb-like-button', array(&$this, 'on_show_page'), gxtb_fb_lB_PLUGIN_FOLDER .'images/admin.png');
	}

	//register callback gets call prior your own page gets rendered
	add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	
	## Add SubMenu-Pages in version 4.5 at this point!
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-General', 'General', $pagelevel, 'fb-like-button');
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Design', 'Design', $pagelevel, 'fb-like-design', array(&$this, 'gb_design'));
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-OpenGraph', 'OpenGraph', $pagelevel, 'fb-like-opengraph', array(&$this, 'gb_meta'));
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Insights', 'FB-Insights', $pagelevel, 'fb-like-insights', array(&$this, 'gb_insights'));
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Settings', 'Settings', $pagelevel, 'fb-like-settings', array(&$this, 'gb_settings'));
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-FAQ', 'FAQ', $pagelevel, 'fb-like-faq', array(&$this, 'gb_faq'));
	$this->pagehook = add_submenu_page("fb-like-button", 'GB-World', 'GB-World', $pagelevel, 'fb-like-gbworld', array(&$this, 'gb_infopage'));
	$this->pagehook = add_submenu_page("fb-like-button", 'FB-Expert-Mode', 'Expert-Mode', 'administrator', 'fb-like-beta', array(&$this, 'gb_expert'));
	
	}
	function on_load_page() {		
		// MAIN-BOXES
		add_meta_box('gb_fb_settings', __('FB-Button-Settings', gxtb_fb_lB_lang), array(&$this, 'gb_fb_settings'), $this->pagehook, 'first', 'core');
		add_meta_box('gb_fb_generator', __('Like-Button-Generator', gxtb_fb_lB_lang), array(&$this, 'gb_fb_generator'), $this->pagehook, 'normal', 'core');
	}
	function on_show_page() {
	global $screen_layout_columns;
	$screen_layout_columns = 2;

#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
			
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     CONTENT-OPTION-PAGE	 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<?php gb_admin_header::gb_admin_title(); ?>
<?php include( 'gb_save.php' ); ?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=fb-like-button' ); ?>" name="settingpage" id="settingpage" class="settingpage">
	<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
	<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
    <?php wp_nonce_field('fb-like-button'); ?>
<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
		<div id="poststuff" class="metabox-holder" style="width: 100%;">
				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
					<?php
					    do_meta_boxes($this->pagehook, 'additional_fb', "");
						do_meta_boxes($this->pagehook, 'additional_support', "");
						do_meta_boxes($this->pagehook, 'additional_fb_activity', "");
						do_meta_boxes($this->pagehook, 'additional_bugs', "");
						do_meta_boxes($this->pagehook, 'additional_fans', "");
						do_meta_boxes($this->pagehook, 'additional_settings', "");
					?>
				</div>
				<!-- /Sidebar -->
				<!-- Content -->
					<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<?php do_meta_boxes($this->pagehook, 'first', ""); ?>
							<?php do_meta_boxes($this->pagehook, 'normal', ""); ?>					
						</div><?php 
									include('gb_submit.php');
								?>
					</div>
				<!-- /Content -->
				<br class="clear"/>
		</div>
<div class="plugin-version">
	<a href="#plugininfo" class="fancylink" title="Created by Stefan N."><?php echo gxtb_fb_lB_name; ?> - v<?php echo gxtb_fb_lB_version; ?></a>
</div>
</div>
		</div>
	</div>
<?php 
	#include('gb_submit.php');
?>
</div>
<?php
	include('gb_admin_footer.php');
?>
<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		<?php
		global $wp_version;
		if(version_compare($wp_version,"2.7-alpha", "<")){
			echo "add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.6 and below
		}
		else{
			echo "postboxes.add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.7 and above
		}
		?>
			});
			//]]>
</script>
<?php
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      CALLBACK METHODS		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################
	function gb_fb_settings() {
		$gxtb_gb_general = new gxtb_gb_general;
		$gxtb_gb_general -> gxtb_gb_settings();
	}
	function gb_fb_generator() {
		$gxtb_gb_general = new gxtb_gb_general;
		$gxtb_gb_general -> gxtb_gb_generator();
	}
	function gb_design() {
		$gxtb_gb_design = new gxtb_gb_design;
	}
	function gb_meta() {
		$gxtb_gb_meta = new gxtb_gb_meta;
	}
	function gb_insights() {
		$gxbt_gb_insights = new gxbt_gb_insights;
	}
	function gb_settings() {
		$gxtb_gb_settings = new gxtb_gb_settings;
	}
	function gb_faq() {
		$gxtb_fb_lB_FAQClass = new gxtb_fb_lB_FAQClass;
	}
	function gb_infopage() {
		include_once(dirname(dirname(__FILE__)) . '/gbworld/gbworld.php');
		$gbworld = new gbworld;		
	}
	function gb_expert() {
		$gxtb_fb_lB_EXMClass = new gxtb_fb_lB_EXMClass;
	}
} // end class
} // end if-class
?>