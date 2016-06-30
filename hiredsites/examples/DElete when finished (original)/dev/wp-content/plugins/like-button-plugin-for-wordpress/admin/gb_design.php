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
###########	       ADMIN-PAGE-DESIGN	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_gb_design')) {
class gxtb_gb_design {
function gxtb_gb_design() {

		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_design', __('FB-Button-Design', gxtb_fb_lB_lang), array(&$this, 'gb_design'), $this->pagehook, 'first', 'core');			
#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<?php gb_admin_header::gb_admin_title(); ?>
<?php include( 'gb_save.php' ); ?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=fb-like-design' ); ?>" name="settingpage" id="settingpage" class="settingpage">

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

function gb_design() {
		$gxtb_fb_lB_design = get_option('gxtb_fb_lB_design');
		#$gxtb_fb_lB = get_option('gxtb_fb_lB');
		global $gb_fb_lB_path;
?>

<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('FB-Button-CSS', 'gb_like_button'); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_css">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#tabs-1" class="ui-state-default ui-corner-top">
						<?php _e('CSS-Design', 'gb_like_button'); ?>
					</a>
				</li>
			</ul>
			<!-- /Tabs-Menue -->
			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1"><table class="form-table">
            <?php
############################################################################### 
#################################### TAB 4 #################################### 
############################################################################### 
?>
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('CSS-Class', 'gb_like_button'); ?></strong></td>
                        <td width="80%" valign="middle">
							<input name="gxtb_fb_lB_css" type="text" value="<?php if ($gxtb_fb_lB_design['css'] != "") {echo $gxtb_fb_lB_design['css'];} else {echo "";} ?>" size="20" maxlength="50"/>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('Now it is possible to design your like-button like you want. If you enter something into this box it will work as a css-class and you can design it like you want in your css-file. You must configurate this css-class in the css-file and not here.', 'gb_like_button'); ?><br />
								<u><?php _e('Example:', 'gb_like_button'); ?></u><br />
								.classname { property:value; }
            				</small>
						</td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('CSS-Design', 'gb_like_button'); ?></strong></td>
                        <td width="80%" valign="middle">
							<textarea name="gxtb_fb_lB_cssbox" rows="3" style="width:60%"><?php if ($gxtb_fb_lB_design['cssbox'] != "") {echo $gxtb_fb_lB_design['cssbox'];} else {echo "";} ?></textarea>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('You can also enter some css-stuff right here.', 'gb_like_button'); ?><br />
								<u><?php _e('Example:', 'gb_like_button'); ?></u><br />
								visabilty:block; border:none; padding-left:15px;
            				</small>
						</td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('breaks before/after Like-Button <small>(&lt;br&gt;)</small>', 'gb_like_button'); ?></strong></td>
                        <td width="80%" valign="middle">
                             <select name="gxtb_fb_lB_br_before" size="1"><?php						 
							 	  for($count = 0; $count <= 5; $count++)
								  { ?>
									<option <?php if($gxtb_fb_lB_design['br_before'] == $count) echo "selected"; ?>><?php echo $count; ?></option>
								  <?php }

							 	?>
   							 </select> <?php _e('before the Like-Button', 'gb_like_button'); ?>
							 <br />
							 <select name="gxtb_fb_lB_br_after" size="1"><?php						 
							 	  for($count = 0; $count <= 5; $count++)
								  { ?>
									<option <?php if($gxtb_fb_lB_design['br_after'] == $count) echo "selected"; ?>><?php echo $count; ?></option>
								  <?php }

							 	?>
   							 </select> <?php _e('after the Like-Button', 'gb_like_button'); ?>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('You can choose how many breaks you wanna have before or after the Like Button. You can choose breaks here or define the margin and padding within the css-file.', 'gb_like_button'); ?>
            				</small>
						</td>
                    </tr>

			</table></div>

			<!-- /Tabs-Content -->
		</div>
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