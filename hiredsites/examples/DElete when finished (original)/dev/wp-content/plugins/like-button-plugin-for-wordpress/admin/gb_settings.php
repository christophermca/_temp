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
###########	       Plugin-Settings		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
if (!class_exists('gxtb_gb_settings')) {
class gxtb_gb_settings {
	
	var $gxtb_fb_lB_Settings;
	
function gxtb_gb_settings() {
	
		include_once('gb_plugin.php');	
		$this->gxtb_fb_lB_Settings = new gxtb_fb_lB_Settings;

		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_plugin',  __('Plugin-Settings', gxtb_fb_lB_lang), array(&$this, 'gb_plugin'), $this->pagehook, 'first', 'core');
		add_meta_box('gb_fb_editor',  __('Editor-Settings', gxtb_fb_lB_lang), array(&$this, 'gb_editor'), $this->pagehook, 'first', 'core');
		#add_meta_box('gb_fb_help',  __('Support', gxtb_fb_lB_lang), array(&$this, 'gb_support'), $this->pagehook, 'first', 'core');
				
#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<?php gb_admin_header::gb_admin_title(); ?>
<?php include( 'gb_save.php' ); ?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=fb-like-settings' ); ?>" name="settingpage" id="settingpage" class="settingpage">
	<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
	<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
    <?php wp_nonce_field('fb-like-button'); ?>

<?php 
		echo '<div id="message" class="updated fade"><p><strong>';
		_e("Currently there is only the GB-Cleaner available because we had to release this update to fix some bugs! But you can already see what the next bigger update will include.", gxtb_fb_lB_lang);
		echo '</strong></p></div>';
    
?>
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
					?>
				</div>
				<!-- /Sidebar -->
				<!-- Content -->
					<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<?php do_meta_boxes($this->pagehook, 'first', ""); ?>					
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
include('gb_admin_footer.php');
} // end konstruktor
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
function gb_plugin() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_Setting();
	}
function gb_editor() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_EditorSettings();
	}	
function gb_support() {
		$this->gxtb_fb_lB_Settings -> gxtb_fb_lB_help();
	}	
} // end class
} // end if-class
?>