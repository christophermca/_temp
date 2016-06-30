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
###########	       Like-Button-General	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_gb_general')) {
class gxtb_gb_general {
	
	var $metacontent;	
	
function gxtb_gb_general() {
	$this->metacontent = new metacontent(); 
}

function gxtb_gb_settings() {
?>
<table class="form-table" border="0" id="gb-table">
	<tbody>
		<tr>
            <td width="20%" rowspan="2" valign="top" class="gb-table-header">
				<strong>
					<?php _e('FB-Button-Settings', 'gb_like_button'); ?>
				</strong>
			</td>		
            <td width="80%" valign="bottom">
			<!-- Tabs-Menue -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_general">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus">
					<a href="#tabs-1" class="ui-state-default ui-corner-top">
						<?php _e('General Settings', 'gb_like_button'); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#tabs-2" class="ui-state-default ui-corner-top">
						<?php _e('Positon Settings', 'gb_like_button'); ?>
					</a>
				</li>
				<li class="ui-state-default ui-corner-top">
					<a href="#tabs-3" class="ui-state-default ui-corner-top">
						<?php _e('Special Settings', 'gb_like_button'); ?>
					</a>
				</li>
			</ul>
			<!-- /Tabs-Menue -->
			
			<!-- Tabs-Content -->
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1"><table class="form-table">
					<?php $this->metacontent -> tab1(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-2"><table class="form-table">
					<?php $this->metacontent -> tab2(); ?>
			</table></div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-3"><table class="form-table">
					<?php $this->metacontent -> tab3(); ?>
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

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      GENERATOR-FUNC		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

function gxtb_gb_generator() {
		$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
		$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
		$gxtb_fb_lB = get_option('gxtb_fb_lB');
		global $gb_fb_lB_path;
?>
<table class="form-table" border="0" id="gb-table-generator">
		        <tbody>
<?php //if( $gxtb_fb_lB['jQuery'] ) { ?>
           			<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Generator', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
								<!-- Tabs -->
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs ui-widget ui-corner-all" id="tabs_generator">
			<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
				<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-focus"><a href="#tabs-5" class="ui-state-default ui-corner-top"><?php _e('General Settings', 'gb_like_button'); ?></a></li>
				<li class="ui-state-default ui-corner-top"><a href="#tabs-6" class="ui-state-default ui-corner-top"><?php _e('Design', 'gb_like_button'); ?></a></li>
				<li class="ui-state-default ui-corner-top"><a href="#tabs-7" class="ui-state-default ui-corner-top"><?php _e('iFrame Settings', 'gb_like_button'); ?></a></li>
			</ul>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-5">
			<table class="form-table">
			 <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Wordpress-Domain-URL', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
							<input name="gxtb_fb_lB_generator_url" type="text" onchange="gxtb_generator()" value="<?php if ($gxtb_fb_lB_generator['url'] != "") {echo $gxtb_fb_lB_generator['url'];} else {echo home_url();} ?>" size="30"/><br />
							<small>
								<?php _e('(Example: http://www.gb-world.net)', 'gb_like_button'); ?>
								<br /><br /><b><?php _e('Changes since 10th of September 2010:', 'gb_like_button'); ?></b><br />
								<?php _e('You can now also like your Facebook Pages and Application. Just enter the URL to your Facebook Page or Application (for example: <a href="http://www.facebook.com/gbworldnet" target="_blank">http://www.facebook.com/gbworldnet</a>)', 'gb_like_button'); ?><br />
                                <?php _e('If you like to add <b>dynamic Like-Buttons</b> you have to enter your <b>domain-url</b> if you would like to use this URL as the Like-Button source for <b>every Button</b> you can enter every URL you want.', 'gb_like_button'); ?>
							</small>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>

					<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Layout Style', 'gb_like_button'); ?>
								<br /><br />
								<?php _e('Show Faces?', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="bottom">
							<SELECT NAME="gxtb_fb_lB_generator_layout" onchange="gxtb_generator()">
								<?php
								$i = array( "standard", "button_count", "box_count" );
								  foreach($i as $variable) {
									if($variable == $gxtb_fb_lB_generator['layout']) {
										echo '<OPTION selected>' . $variable .'</OPTION>';
									} else {
										echo '<OPTION>' . $variable .'</OPTION>';
									}
								}
								?>
							</SELECT>
							<br /><br />
						<input name="gxtb_fb_lB_generator_faces" type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ($gxtb_fb_lB_generator['faces']) echo("checked"); ?>  value="13"/>
							
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Verb to display', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
					<SELECT NAME="gxtb_fb_lB_generator_verb" onchange="gxtb_generator()">
					<?php
					$i = array( "like", "recommend" );
					  foreach($i as $variable) {
						if($variable == $gxtb_fb_lB_generator['verb']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
			</table>
			
			</div>
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-6"><table class="form-table">
			 <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Width', 'gb_like_button'); ?>
								<br />
								<?php _e('Height', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
						<input name="gxtb_fb_lB_generator_width" type="text" onchange="gxtb_generator()" value="<?php if ($gxtb_fb_lB_generator['width'] != "") {echo $gxtb_fb_lB_generator['width'];} else {echo "";} ?>" size="4" maxlength="4"/> px
							<br />
							<input name="gxtb_fb_lB_generator_heigth" type="text" onchange="gxtb_generator()" value="<?php echo $gxtb_fb_lB_generator['height']; ?>" size="4" maxlength="4"/> px
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					 <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Like-Button-Design', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
					<p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
					<SELECT NAME="gxtb_fb_lB_generator_color" onchange="gxtb_generator()">
					<?php
					$i = array( "light", "dark", "evil" );
					  foreach($i as $variable) {
						if($variable == $gxtb_fb_lB_generator['color']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
			</label></p>
            
			<p><label><?php _e('Font', 'gb_like_button'); ?><br />
					<SELECT NAME="gxtb_fb_lB_generator_font" onchange="gxtb_generator()">
					<?php
					$i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
					  foreach($i as $variable) {
						if($variable == $gxtb_fb_lB_generator['font']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</SELECT>
			</label></p>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
			</table></div>
			
			<div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-7">				
				<table class="form-table">
				<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header">
							<strong>
								<?php _e('Like-Button-Design', 'gb_like_button'); ?>
							</strong>
						</td>
                        <td width="80%" valign="top">
<!-- BEGIN generator-settings for the iframe -->
<div id="xtraIframe" style="visibility:visible">          
          <p><label><?php _e('Scrolling', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_generator_scrolling" <?php if($gxtb_fb_lB_settings['JDK'] == true) { echo "disabled"; }?> type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ($gxtb_fb_lB_generator['scrolling']) echo("checked"); ?>  value="14"/>
			</label></p>

          <p><label><?php _e('Frameborder', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_generator_frameborder" <?php if($gxtb_fb_lB_settings['JDK'] == true) { echo "disabled"; }?>  type="text" onchange="gxtb_generator()" value="<?php if ($gxtb_fb_lB_generator['frameborder'] != "") {echo $gxtb_fb_lB_generator['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

          <p><label><?php _e('Style (of the Border)', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_generator_borderstyle" <?php if($gxtb_fb_lB_settings['JDK'] == true) { echo "disabled"; }?>  type="text" onchange="gxtb_generator()" value="<?php if ($gxtb_fb_lB_generator['borderstyle'] != "") {echo $gxtb_fb_lB_generator['borderstyle'];} else {echo "";} ?>" size="20" maxlength="20"/><br />
					<?php _e('Example: none or solid', 'gb_like_button'); ?>
			</label></p>

          <p><label><?php _e('Overflow', 'gb_like_button'); ?></label><br />
					<select name="gxtb_fb_lB_generator_overflow" <?php if($gxtb_fb_lB_settings['JDK'] == true) { echo "disabled"; }?>  onchange="gxtb_generator()">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $gxtb_fb_lB_generator['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

          <p><label><?php _e('Allow Transparency', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_generator_trans" <?php if($gxtb_fb_lB_settings['JDK'] == true) { echo "disabled"; }?>  type="checkbox" class="checkbox" onchange="gxtb_generator()" <?php if ($gxtb_fb_lB_generator['trans']) echo("checked"); ?> value="15" />
			</label></p>
</div>

<div id="iframe_info" style="visibility:visible"><small>
	<?php if ($gxtb_fb_lB_settings['JDK']) { _e('You do not need this disabled options if you use the XFBML (Java-SDK).', 'gb_like_button'); } ?></small>
</div>
<!-- END generator-settings for the iframe -->
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
					
			</table>
				
			</div>

		</div>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr>
<?php //} ?>
					<tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header-preview"><br />
							<strong>
<p><b><?php _e('Preview', 'gb_like_button'); ?></b> <img src="<?php echo $gb_fb_lB_path; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('It will show a preview of a iFrame-FB-Like-Button. If XFBML (Java-SDK) is enabled it will act a little bit different like this preview. Because the preview is always without XFBML (Java-SDK).', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"></p>
							</strong>
						</td>
                        <td width="80%" valign="bottom"><br />
							<div id="gxtb_fb_lB_preview"></div>
							<script type="text/javascript"> gxtb_generator(""); </script>
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

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	      SETTINGS-CONTENT		 ###########
###########								 ###########
###########								 ###########
####################################################
###################### by gb-world.net #############
####################################################

class metacontent {
############################################################################### 
#################################### TAB 1 #################################### 
############################################################################### 
function tab1() {
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
	$gxtb_fb_lB = get_option('gxtb_fb_lB');
?>
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Activate the Like-Button', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="checkbox" class="checkbox" name="gxtb_fb_lB_activate" 
							<?php 
							global $gxtb_fb_like_button_active;
							if ($gxtb_fb_lB_settings['activate']) {
								echo("checked");
								$gxtb_fb_like_button_active = "on";
							} else {
								$gxtb_fb_like_button_active = "off";
							} ?> value="1" /> 
                            <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Activate this checkbox if you want that your Like-Button appears on your blog.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Activate this option if you want to activate the Like-Button for your Blog', 'gb_like_button') ?></small></td>
                    </tr>
                   <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Activate XFBML (JavaScript SDK)', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="checkbox" onchange="post_focus();" class="checkbox" name="gxtb_fb_lB_jdk" id="gxtb_fb_lB_jdk" value="2" <?php if ($gxtb_fb_lB_settings['JDK']) {echo("checked"); } ?> /> 
                             <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('For some additional functions of the Like-Button you need this Java-Enviroment. Read more at the FAQ.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small>
								<?php _e('Activate this option if you want to enable all the FB-Like-Button-Functions which are available.', 'gb_like_button') ?><br />
								<?php _e('<b>Notice:</b> You must have a valid AppID if you want to use XFBML (JavaScript SDK).', 'gb_like_button') ?><br />
                                <?php _e('<b>Important:</b> If you do not activate the XFBML your Like-Button will be inside of a iFrame (see FAQ).', 'gb_like_button') ?>
							</small>
						</td>
                    </tr>
					<tr>
						 <td width="20%" rowspan="2" valign="top" id="xfbml_mod1" class="gb-table-header" style="display:table-cell;"><strong><?php _e('XFBML-Modification', 'gb_like_button') ?></strong></td>
						 <td width="80%" valign="bottom" id="xfbml_mod2" style="display:table-cell;">
								<?php
								echo "<img class='gxtb_image' src=". get_bloginfo('wpurl') ."/wp-content/plugins/like-button-plugin-for-wordpress/screenshot-2.png width='400px'></img><br><br>";
								_e('You have to enter this two attributes to the &lt;head&gt;-tag in your &quot;Template-header.php&quot;-file.', 'gb_like_button');
								echo " (<b><small>" . __('your file', 'gb_like_button') . ": <u><a href='" .  get_bloginfo('template_url') . "/header.php" . "'>" . get_bloginfo('template_url') . "/header.php</a>)</u></small></b>";
								echo "<br><br><b>";
								echo "xmlns:og=&quot;http://ogp.me/ns#&quot;";
								echo "<br>";
								echo "xmlns:fb=&quot;http://www.facebook.com/2008/fbml&quot;";
								echo "</b><br><br>";
								_e('If you do not do this the Open-Graph-Protocol will not work with all its functions.', 'gb_like_button'); 
								?>
						</td>
					</tr>
					<tr>
                        <td class="gb-table-tipp">
						</td>
                    </tr><tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Post-Specific Button <small>(Dynamic Buttons)</small>', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="middle">
					<input name="gxtb_fb_lB_dynamic" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_settings['dynamic']) echo("checked"); ?> value="12"/> 
                    <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Read the instructions below please. This is an important option.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						<small>
			<u><?php _e('Activated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has its own Like-Button. Which means for every page on your side there will be a unique Like-Button.', 'gb_like_button'); ?> <?php _e('(recommended)', 'gb_like_button'); ?><br />
				<u><?php _e('Deactivated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has the same Like-Button. Which means if you click on it, it looks like you like/recommend every post even if you have not read it before.', 'gb_like_button'); ?>
            		</small>
						</td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
                    <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Language', 'gb_like_button'); ?></strong></td>
                        <td width="80%" valign="middle">
					<input name="gxtb_fb_lB_language" type="text" value="<?php if ($gxtb_fb_lB_settings['language'] != "") {echo $gxtb_fb_lB_settings['language'];} else {echo "en_US";} ?>" size="6" maxlength="6"/> 
                    <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('You only need this if you activate XFBML (Java-SDK)', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
						<small><?php _e('You only have to choose this option if you activate <b>XFBML (Java-SDK)</b> and if you have a valid AppID. Otherwise the FB-Like-Button chooses its language by itself.', 'gb_like_button'); ?><br />
                <?php _e('<b>Examples:</b> All available languages could be looked up here: <a href="http://www.facebook.com/translations/FacebookLocales.xml" target="_blank">FacebookLocales</a>', 'gb_like_button'); ?><br />
                <?php _e('<b>Default:</b> en_US', 'gb_like_button'); ?>
            		</small>
						</td>
                    </tr>	
<?php }
############################################################################### 
#################################### TAB 2 #################################### 
############################################################################### 
function tab2() {
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
	$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
?>
                    <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Like-Button-Position', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="middle">
						<input type="checkbox" class="checkbox" name="gxtb_fb_lB_position_before" <?php if ($gxtb_fb_lB_settings['position_before']) echo("checked"); ?>  value="4" /> <?php _e('Before the Content', 'gb_like_button')?><br />
						<input type="checkbox" class="checkbox" name="gxtb_fb_lB_position_after" <?php if ($gxtb_fb_lB_settings['position_after']) echo("checked"); ?>  value="5" /> <?php _e('After the Content', 'gb_like_button')?><br />
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Choose the position of your Like-Button.', 'gb_like_button') ?></small></td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
					<tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Add the Like-Button in the Footer', 'gb_like_button') ?></strong> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('This may not work with all themes. Report any bugs with your themes in our forum or bugtracker please. thanks.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"></td>
                        <td width="80%" valign="bottom">
                         <input type="checkbox" class="checkbox" name="gxtb_fb_lB_addfooter_activate" <?php if ($gxtb_fb_lB_settings['addfooter_activate']) echo("checked"); ?>  value="6" />
                             <select name="gxtb_fb_lB_addfooter">
                                  <option <?php if($gxtb_fb_lB_settings['addfooter'] == __('Before the Footer', 'gb_like_button')) echo "selected"; ?> ><?php _e('Before the Footer', 'gb_like_button') ?></option>
                                  <option <?php if($gxtb_fb_lB_settings['addfooter'] == __('After the Footer', 'gb_like_button')) echo "selected"; ?> ><?php _e('After the Footer', 'gb_like_button') ?></option>
   							 </select>
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Activate this option if you want to activate the Like-Button for your Blog', 'gb_like_button') ?></small></td>
                    </tr>
					
					<!--<tr><td colspan="2"><HR SIZE=1></td></tr>-->
					
					 <tr>
                    	<td width="20%" rowspan="2" valign="middle" class="gb-table-header"><strong><?php _e('Show the Like-Button on every', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="bottom">
						
						<table border="1" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="bottom">
									<input type="checkbox" class="checkbox" name="gxtb_fb_lB_frontpage" <?php if ($gxtb_fb_lB_settings['frontpage']) echo("checked"); ?>  value="7" /> <?php _e('Front-Page', 'gb_like_button') ?>
								</td>
							</tr>                         
							<tr>
								<td valign="bottom">							
                        			<input type="checkbox" class="checkbox" name="gxtb_fb_lB_page" <?php if ($gxtb_fb_lB_settings['page']) echo("checked"); ?>  value="8" /> <?php _e('Page', 'gb_like_button') ?>
								</td>
								<td valign="bottom">
								<?php _e('Exclude IDs', 'gb_like_button') ?>: <input name="gxtb_fb_lB_page_exclude" type="text" value="<?php if ($gxtb_fb_lB_settings['page_exclude'] != "") { echo stripslashes($gxtb_fb_lB_settings['page_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', 'gb_like_button') ?>: <?php _e('1,84', 'gb_like_button') ?></small>
								</td>
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="gxtb_fb_lB_post" <?php if ($gxtb_fb_lB_settings['post']) echo("checked"); ?> value="9"  /> <?php _e('Post', 'gb_like_button') ?>
								</td>
								<td valign="bottom">
								<?php _e('Exclude IDs', 'gb_like_button') ?>: <input name="gxtb_fb_lB_post_exclude" type="text" value="<?php if ($gxtb_fb_lB_settings['post_exclude'] != "") { echo stripslashes($gxtb_fb_lB_settings['post_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', 'gb_like_button') ?>: <?php _e('55,56', 'gb_like_button') ?></small>
								</td>
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="gxtb_fb_lB_category" <?php if ($gxtb_fb_lB_settings['category']) echo("checked"); ?> value="10" /> <?php _e('Category', 'gb_like_button') ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Some themes have problems to display our generated Like-Button on this kind of Site. Please report this in our Forum if you have a problem with your current theme. We will then try to help you to fix that problem.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
								</td>
								<td valign="bottom">
								<?php _e('Exclude IDs', 'gb_like_button') ?>: <input name="gxtb_fb_lB_category_exclude" type="text" value="<?php if ($gxtb_fb_lB_settings['category_exclude'] != "") { echo stripslashes($gxtb_fb_lB_settings['category_exclude']); } else {echo "";} ?>" size="10" /> <small><?php _e('Example', 'gb_like_button') ?>: <?php _e('22,36', 'gb_like_button') ?></small>
								</td>
							</tr>
							<tr>
								<td valign="bottom">							
									<input type="checkbox" class="checkbox" name="gxtb_fb_lB_archiv" <?php if ($gxtb_fb_lB_settings['archiv']) echo("checked"); ?>  value="11" /> <?php _e('Archive', 'gb_like_button') ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Some themes have problems to display our generated Like-Button on this kind of Site. Please report this in our Forum if you have a problem with your current theme. We will then try to help you to fix that problem.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
								</td>
								<td valign="bottom">
								<?php _e('Exclude IDs', 'gb_like_button') ?>: <input name="gxtb_fb_lB_archiv_exclude" type="text" value="<?php if ($gxtb_fb_lB_settings['archiv_exclude'] != "") { echo stripslashes($gxtb_fb_lB_settings['archiv_exclude']); } else {echo "";} ?>" size="10"/> <small><?php _e('Example', 'gb_like_button') ?>: <?php _e('3,83', 'gb_like_button') ?></small>
								</td>
							</tr>
						</table>	
							
                         </td>
                    </tr>
					 
                    <tr>
                        <td class="gb-table-tipp"><small><?php _e('Activate this option if you want to activate the Like-Button on every selected post, page...', 'gb_like_button') ?></small></td>
                    </tr>
<?php }

############################################################################### 
#################################### TAB 3 #################################### 
############################################################################### 

function tab3() {
	$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
?>
                   <tr>
                    	<td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php _e('Shortcode-Only', 'gb_like_button') ?></strong></td>
                        <td width="80%" valign="bottom">
                        	<input type="checkbox" class="checkbox" name="gxtb_fb_lB_shortcode" id="gxtb_fb_lB_shortcode" <?php if ($gxtb_fb_lB_settings['shortcode']) {echo("checked"); } ?> value="3"/> 
                             <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('If you activate this option it is possible to use the Shortcode only and you do not have to set a position of the like button because no like button will appear except you use the shortcode.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
                         </td>
                    </tr>
                    <tr>
                        <td class="gb-table-tipp">
							<small><b>
								<?php _e('only the Shortcode will work if you activate this option (ShortCode-Only-Modus)! Notice: The SideBar-Widget will work beside the Shortcode-Only-Modus!', 'gb_like_button') ?><br />
							</b></small>
						</td>
                    </tr>	
<?php
} // end function
} // end class
} // end if-class
?>