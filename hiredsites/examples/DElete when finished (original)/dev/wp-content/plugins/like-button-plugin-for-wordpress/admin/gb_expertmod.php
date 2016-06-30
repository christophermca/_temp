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
###########	       EXPERT-MODE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
if (!class_exists('gxtb_fb_lB_EXMClass')) {
class gxtb_fb_lB_EXMClass {
function gxtb_fb_lB_EXMClass() {

		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_expert', __('FB-Expert Mod', gxtb_fb_lB_lang), array(&$this, 'gb_expert'), $this->pagehook, 'first', 'core');			
#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<?php gb_admin_header::gb_admin_title(); ?>
<?php include( 'gb_save.php' ); ?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=fb-like-beta' ); ?>" name="settingpage" id="settingpage" class="settingpage">

	<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
	<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>

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
						</div>
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

function gb_expert() {
		$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
		$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
		$gxtb_fb_lB = get_option('gxtb_fb_lB');
		global $gb_fb_lB_path;

?>

<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Information', 'gb_like_button'); ?>
				</strong>
			</td>		
            <td width="80%" valign="middle">
             <small>
			<?php _e('This new function will be published completly at version [v5.0]. Until then this will be in beta-mode. We will publish how you can use this new function within the next weeks on our GB-World Facebook Fanpage.', 'gb_like_button'); ?><br /><br />
            <?php _e('You will be able to implement some own functionalities like you can do within wordpress. With some filters/actions and hooks like Wordpress uses them.', 'gb_like_button'); ?>
            </small>
             </td>
        </tr>
        <tr>
            <td class="gb-table-tipp">
			</td>
        </tr>
	</tbody>
</table>

<?php	
} // end function
} // end class
} // end if-class
?>