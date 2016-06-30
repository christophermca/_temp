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
if (!class_exists('gxtb_gb_meta')) {
class gxtb_gb_meta {
	
	var $metacontent;
	
	function gxtb_gb_meta() {
	
		$this->metacontent = new gxtb_gb_metacontent();

		global $screen_layout_columns;
		$screen_layout_columns = 2;

		add_meta_box('gb_fb_meta', __('FB-Open Graph Protocol', gxtb_fb_lB_lang), array(&$this, 'gb_meta'), $this->pagehook, 'first', 'core');			

#########################################################
		include('gb_admin_sidebar.php');
#########################################################	
	
?>
<div class="wrap"><div id="gxtb_lb_fB_options">
<?php gb_admin_header::gb_admin_title(); ?>
<?php include( 'gb_save.php' ); ?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=fb-like-opengraph' ); ?>" name="settingpage" id="settingpage" class="settingpage">

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

function gb_meta() {
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$gxtb_fb_lB = get_option('gxtb_fb_lB');
	?>
<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('Meta-Tags', gxtb_fb_lB_lang); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_general">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#tabs-10" class="ui-state-default ui-corner-top">
						<?php _e('Administrativ Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#tabs-11" class="ui-state-default ui-corner-top">
						<?php _e('Blog-Specific Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#tabs-12" class="ui-state-default ui-corner-top">
						<?php _e('Image-Tag', gxtb_fb_lB_lang); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#tabs-13" class="ui-state-default ui-corner-top">
						<?php _e('Additional Tags', gxtb_fb_lB_lang); ?>
					</a>
				</li>
			</ul>
			<!-- /Tabs-Menue -->
			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-10"><table class="form-table">
					<?php $this->metacontent -> tab1(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-11"><table class="form-table">
					<?php $this->metacontent -> tab2(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-12"><table class="form-table">
					<?php $this->metacontent -> tab3(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-13"><table class="form-table">
					<?php $this->metacontent -> tab4(); ?>			
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
<?php $this->metacontent -> getJava();
} // end function
} // end class

class gxtb_gb_metacontent {
function tab1() { 
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	global $gb_fb_lB_path;
?>
<tr>
	<td valign="middle" width="20%">							
		<?php _e('Admin-IDs: <small>(required)</small>', gxtb_fb_lB_lang) ?>
	</td>
	<td valign="bottom">				
<input type="text" name="gxtb_fb_lB_meta_admins" id="gxtb_fb_lB_meta_admins" class="{required:true, digits:true, messages:{required:'<?php _e('Enter a valid Admin-ID.', gxtb_fb_lB_lang) ?>', digits:'<?php _e('Only digits pls.', gxtb_fb_lB_lang) ?>'}}" value="<?php if (isset($gxtb_fb_lB_meta['admins'])) {echo $gxtb_fb_lB_meta['admins'];} else {echo "";} ?>" size="15"/> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif" onmouseover="tooltip.show('<?php _e('<b>Important:</b> The AdminID is your Facebook-Profile-ID or the FB-Profile-IDs of the other admins of this Like-Button.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
	</td>
</tr>
<tr>
	<td valign="bottom">							
		<div id="gxtb_fb_lB_meta_appid_div">
		<?php if(!isset($gxtb_fb_lB_settings['JDK'])) { _e('AppID:', gxtb_fb_lB_lang); } else { ?> <b><?php _e('AppID: (required)', gxtb_fb_lB_lang); ?></b>:<?php } ?>
		</div>
	</td>
	<td valign="bottom">
		<input type="text" name="gxtb_fb_lB_meta_appid" value="<?php if (isset($gxtb_fb_lB_meta['app_id'])) {echo $gxtb_fb_lB_meta['app_id'];} else {echo "";} ?>" size="15"/> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('<b>Notice:</b> Visit the Page mentioned below to get a valid AppID if you do not have one.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();"> <a href="#meta_app"style="color:#900;border-bottom:1px dotted #900; text-decoration:none;"><?php _e('More Help?', gxtb_fb_lB_lang); ?></a>
	</td>
</tr>					
<tr>
	<td>
		<?php _e('Page-ID:', gxtb_fb_lB_lang) ?>
	</td>
	<td>
		<input type="text" name="gxtb_fb_lB_meta_pageid" value="<?php if (isset($gxtb_fb_lB_meta['page_id'])) {echo $gxtb_fb_lB_meta['page_id'];} else {echo "";} ?>" size="15"/> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('You can also connect a Facebook-Fanpage with your Like-Buttons on your website. Just enter the Facebook-Fanpage-ID.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
	</td>
</tr>
<tr>
	<td colspan="3" valign="middle" align="left"><small>						
		<?php _e('You only have to enter one of this to Meta-Tags (Admin-ID or AppID) as long as you do not use XFBML (Java-SDK).', gxtb_fb_lB_lang) ?>
		<br />
		<?php _e('If you use more than one Admin-ID you have to seperate them with a <b>comma</b>! For example: 123123,123123 (no free space).', gxtb_fb_lB_lang) ?>
		<br />
        <?php _e('<b>APP-ID:</b> If you want to use XFBML (Java-SDK) you have to enter a valid Facebook-App-ID (<a href="http://developers.facebook.com/setup/" target="_blank">GET an APPID</a>).', gxtb_fb_lB_lang) ?>
		<br />
		<b><span style="color:#FF0000; text-decoration:underline;"><?php _e('Important', gxtb_fb_lB_lang) ?>:</b></span>
		<?php _e('You have to enable your domain as Connect-Domain of your FB-App. Visit the developer-page of your Facebook-App (<a href="http://www.facebook.com/developers" target="_blank">http://www.facebook.com/developers</a>) and then click on your App and then on "Edit Settings". After that Step you have to visit "Web Site" and fill in the "Site Domain"-Option and also the "Site URL". After that your Domain is connected with your App.', gxtb_fb_lB_lang); ?>
		<br />
		 <?php echo sprintf( '<b>%s:</b> %s. (<a href="%s" target="_blank">%s</a>)', __('Admin-ID', gxtb_fb_lB_lang),  __('Facebook-Profile-IDs of all Administrators of this Like-Button', gxtb_fb_lB_lang), "http://apps.facebook.com/whatismyid/", "WhatsMyID" ); ?>
	</small></td>
</tr>
<?php } 


function tab2() {
	global $gb_fb_lB_path;
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$blogtype = array(
		"",
		"blog",
		"website",
		"article",
		"activity",
		"sport",
		"bar",
		"company",
		"cafe",
		"hotel",
		"restaurant",
		"cause",
		"sports_league",
		"sports_team",
		"band",
		"government",
		"non_profit",
		"school",
		"university",
		"actor",
		"athlete",
		"author",
		"director",
		"musician",
		"politician",
		"public_figure",
		"city",
		"country",
		"landmark",
		"state_province",
		"album",
		"book",
		"drink",
		"food",
		"game",
		"product",
		"song",
		"movie",
		"tv_show"
);
?>
							<tr>
								<td valign="bottom" width="20%">							
									<?php _e('Site-Name', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" id="gxtb_fb_lB_meta_site_name" name="gxtb_fb_lB_meta_site_name" value="<?php if (isset($gxtb_fb_lB_meta['site_name'])) {echo $gxtb_fb_lB_meta['site_name'];} else {echo "";} ?>" />
								</td>
							</tr>
							
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Frontpage-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="gxtb_fb_lB_meta_type" id="gxtb_fb_lB_meta_type" onchange="gxtb_blogtype()" onblur="gxtb_blogtype()" onfocus="gxtb_blogtype()">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $gxtb_fb_lB_meta['type']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Page-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="gxtb_fb_lB_pagetype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $gxtb_fb_lB_meta['pagetype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>
							
							<tr>
								<td valign="bottom" onmouseover="gxtb_blogtype()">							
									<?php _e('Post-Type', gxtb_fb_lB_lang) ?>:
 								</td>
								<td valign="bottom" onmouseover="gxtb_blogtype()">                             
                                    <SELECT NAME="gxtb_fb_lB_posttype">
                                    <?php
                                    $i = $blogtype;
                                      foreach($i as $variable) {
                                        if($variable == $gxtb_fb_lB_meta['posttype']) {
                                            echo '<OPTION selected>' . $variable .'</OPTION>';
                                        } else {
                                            echo '<OPTION>' . $variable .'</OPTION>';
                                        }
                                    }
                                    ?>
                                    </SELECT> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif" style="visibility:hidden" id="gxtb_fb_lB_meta_type_img" onmouseover="" onmouseout="tooltip.hide();">
                    			</td>
							</tr>			
											
							<tr>
								<td valign="bottom">							
									<?php _e('Page-Title', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_title" value="<?php if ($gxtb_fb_lB_meta['title'] != "") {echo $gxtb_fb_lB_meta['title'];} else {echo "";} ?>" />
								</td>
							</tr>
							
							<tr>
								<td valign="top">							
									<?php _e('Page-URL', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="top">
									<input type="text" name="gxtb_fb_lB_meta_url" value="<?php if ($gxtb_fb_lB_meta['url'] != "") {echo $gxtb_fb_lB_meta['url'];} else {echo "";} ?>" />
								</td>
							</tr>	

							<tr>
								<td valign="top">
									<?php _e('Page-Description', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom" colspan="4">
									<textarea name="gxtb_fb_lB_meta_description" rows="5"/ style="width:100%"><?php if ($gxtb_fb_lB_meta['description'] != "") {echo $gxtb_fb_lB_meta['description'];} else {echo "";} ?></textarea><br />
                                    <input type='Radio' class="radio" Name='gxtb_fb_lB_meta_description_usage' value='blogd' <?php if($gxtb_fb_lB_meta['dusage'] == "blogd") echo "checked"; ?> >
                                    	<span class="hotspot" onmouseover="tooltip.show('<?php _e('The Blog-Description will be used for this Meta-Tag', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use Blog-Description', gxtb_fb_lB_lang) ?>
                                        </span><br />
									<input type='Radio' class="radio" Name='gxtb_fb_lB_meta_description_usage' value='bloge' <?php if($gxtb_fb_lB_meta['dusage'] == "bloge") echo "checked"; ?>>
										<span class="hotspot" onmouseover="tooltip.show('<?php _e('<u>Example:</u> If a user visits Post A this Meta-Tag will display the Excerpt of Post A.<br><br><small><u>Recommended</u>: because with this option every post has its unique description.</small>', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use the excerpt of the shown page/post', gxtb_fb_lB_lang) ?>
                                        </span><br />
                                    <input type='Radio' class="radio" Name='gxtb_fb_lB_meta_description_usage' value='blogn' <?php if($gxtb_fb_lB_meta['dusage'] == "blogn") echo "checked"; ?>>
										<span class="hotspot" onmouseover="tooltip.show('<?php _e('The text in the textarea above will be displayed', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
											<?php _e('Use this description', gxtb_fb_lB_lang) ?>
                                        </span>
								</td>
							</tr>
<tr><td></td></tr>							
						<tr>
                        <td class="gb-table-tipp" colspan="2">
							<small>
                        		   	<?php _e('You&prime;ll find examples here: <a href="http://developers.facebook.com/docs/opengraph" target="_blank">http://developers.facebook.com/docs/opengraph</a>', gxtb_fb_lB_lang) ?><br />
                        			<?php _e('<b>Important:</b> You can put GB-Shortcodes into this boxes! This Shortcodes will then work as php-Code in the Background.', gxtb_fb_lB_lang) ?><br />
									<?php _e('<b>GB-Meta-Shortcodes:</b>  Site-Name => <b>$binfo</b> || Page-Title => <b>$ptitle</b> || Page-URL => <b>$plink</b>', gxtb_fb_lB_lang) ?><br />
									<?php _e('<b>Example:</b> If you use: Page-Title => $ptitle || If a visitor visits a page or post of your blog the title of this page/post will be the content of this meta-tag dynamically. The same will happen with the $purl-GB-Shortocde.', gxtb_fb_lB_lang) ?>
                        	</small>
						</td>
                    </tr>
<?php } 

function tab3() { 
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	global $gb_fb_lB_path;
?>
	<tr>
		<td valign="top" width="20%">							
									<?php _e('Image', gxtb_fb_lB_lang) ?>:
									<br />							
				<a href="#imageHelp" class="fancylink" style="color:#900;border-bottom:1px dotted #900; text-decoration:none;"><?php _e('Need Help?', gxtb_fb_lB_lang) ?></a>
						
				<div id="imageHelp" style="display:none">
					<h2><?php _e('More Information about the image-Meta-Tag') ?></h2>
					<p><?php _e('The URL to an image that represents the entity. Images must be at least 50 pixels by 50 pixels.') ?><br><?php _e('Square images work best, but you are allowed to use images up to three times as wide as they are tall.') ?><br><br /><i>(<?php _e('Official Facebook-Description') ?>)</i></p>
				</div>
								</td>
								<td valign="top" colspan="5">
									<input type="text" onchange="gxtb_image_src()" onselect="gxtb_image_src()" onfocus="gxtb_image_src()" id="gxtb_fb_lB_meta_image" name="gxtb_fb_lB_meta_image" value="<?php if ($gxtb_fb_lB_meta['image'] != "") {echo $gxtb_fb_lB_meta['image'];} else {echo "";} ?>" size="50"/> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Complete URL of your Blog-Image which will appear on facebook if somebody posts his like-action on his wall.<br><b>Example:</b> if you use an facebook-app and post it on your wall there is always a little image on the left side of this post. And the same will happen with your image.', gxtb_fb_lB_lang); ?>');" onmouseout="tooltip.hide();">
								</td>
							</tr>			

							<tr>
								<td valign="top" colspan="1">							
									<?php _e('Preview', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="top" colspan="4">
                                
                                <table class="gxtb_img_preview">
                                    <tr>
                                   		<td><table><tr><td align="center" valign="middle">
                                             <div id="gxtb_img_preview_div">
												<?php
												echo '<a href="' . $gxtb_fb_lB_meta['image'] . '" class="preview" title="' . $gxtb_fb_lB_meta['image'] . '"><div class="thumb-img"><div class="thumb-inner"><img id="gxtb_fb_lB_meta_image_preview" src="' . $gxtb_fb_lB_meta['image'] . '" class="thumb" alt="' . $gxtb_fb_lB_meta['image'] . '"></div><div class="thumb-strip"></div><div class="thumb-zoom"></div></div></a>';	?>
											</div>
											<?php echo '<br><br><a href="javascript:gxtb_image_src()">Update Preview</a>'; ?>
											</td></tr></table>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td class="gb-table-tipp">
                                    		<center><small>(<?php _e('real image-output may vary because this is only a thumbnail-preview.', gxtb_fb_lB_lang) ?>)</small></center>
                                    	</td>
                                    </tr>
                                </table>
                                    
								</td>
							</tr>	

							<tr>
								<td valign="top" colspan="1">							
									<b><?php _e('Important Information', 'gb_like_button') ?>:</b>
								</td>
								<td valign="top" colspan="5">
									<?php _e('If image is picked in post that image will be taken. Otherwise the post/page will use this picture you set here.', 'gb_like_button') ?>
								</td>
							</tr>
							
							<tr>
								<td valign="top"></td>
								<td valign="top" colspan="3">&nbsp;
								</td>
							</tr>
<?php }


############################################ ADITIONAL CONTENT ############################################

## Aditional Meta-Tags
function tab4() {
	global $gb_fb_lB_path;
	$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
?>
						<!-- Additional-Meta-Tags -->
							<tr>
								<td valign="bottom" width="20%">
									<?php _e('Postal-Code', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_plz" value="<?php if ($gxtb_fb_lB_meta['plz'] != "") {echo $gxtb_fb_lB_meta['plz'];} else {echo "";} ?>" />
								</td>
								
								<td valign="bottom">
									<?php _e('E-Mail', gxtb_fb_lB_lang) ?>:						
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_mail" value="<?php if ($gxtb_fb_lB_meta['mail'] != "") {echo $gxtb_fb_lB_meta['mail'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Street-Address', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_street" value="<?php if ($gxtb_fb_lB_meta['street'] != "") {echo $gxtb_fb_lB_meta['street'];} else {echo "";} ?>" />
								</td>


								<td valign="bottom">
									<?php _e('Phone-Number', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_phone" value="<?php if ($gxtb_fb_lB_meta['phone'] != "") {echo $gxtb_fb_lB_meta['phone'];} else {echo "";} ?>" />
								</td>
							</tr>					
							<tr>
								<td valign="bottom">							
									<?php _e('Locality', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_locality" value="<?php if ($gxtb_fb_lB_meta['locality'] != "") {echo $gxtb_fb_lB_meta['locality'];} else {echo "";} ?>" />
								</td>

								<td valign="bottom">							
									<?php _e('Fax-Number', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_fax" value="<?php if ($gxtb_fb_lB_meta['fax'] != "") {echo $gxtb_fb_lB_meta['fax'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Region', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_region" value="<?php if ($gxtb_fb_lB_meta['region'] != "") {echo $gxtb_fb_lB_meta['region'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Country', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_country" value="<?php if ($gxtb_fb_lB_meta['country'] != "") {echo $gxtb_fb_lB_meta['country'];} else {echo "";} ?>" />
								</td>
							</tr>							
							<tr>
								<td valign="bottom">							
									<?php _e('Latitude', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_latitude" value="<?php if ($gxtb_fb_lB_meta['latitude'] != "") {echo $gxtb_fb_lB_meta['latitude'];} else {echo "";} ?>" />
								</td>
								<td valign="bottom">							
									<?php _e('Longitude', gxtb_fb_lB_lang) ?>:
								</td>
								<td valign="bottom">
									<input type="text" name="gxtb_fb_lB_meta_longitude" value="<?php if ($gxtb_fb_lB_meta['longitude'] != "") {echo $gxtb_fb_lB_meta['longitude'];} else {echo "";} ?>" />
								</td>
							</tr>
<?php
} // end function
function getJava() { ?>			
<script type="text/javascript">
function appID() {
	var div = document.getElementById("gxtb_fb_lB_meta_appid_div");
	var jdk = document.getElementById("gxtb_fb_lB_jdk");
	
	if(jdk.checked == true) {
		div.innerHTML =	"<b><?php _e('AppID: (required)', gxtb_fb_lB_lang) ?></b>";

		gxtb_generator_elements_disable();
	} else {
		div.innerHTML = "<?php _e('AppID', gxtb_fb_lB_lang) ?>:";
		
		gxtb_generator_elements_enable();
	}
}
</script>
<?php
	
} // end function
} // end class
} // end if-class
