<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3.2]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-Settings	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_fb_lB_Settings')) {
class gxtb_fb_lB_Settings {
function gxtb_fb_lB_Setting() {
## General-Settings ##
$gxtb_fb_lB = get_option('gxtb_fb_lB');
$gxtb_fb_lB_warning = get_option('gxtb_fb_lB_warning');
 if ( isset( $_POST['gxtb_run_cleaner'] ) ) {
	// cleanes all the senseless variables for this new update
	include( dirname(dirname(__FILE__)) . '/include/gb_cleaner.php' );
	$gxtb_fb_lB_Cleaner = new gxtb_fb_lB_Cleaner();
}
$settings_options = array (
	array(	"type" => "open"),
	array(	"content" => "GB-Cleaner",
			"tooltip" =>  __('Delete and update options which became senseless because of an plugin-update or anything else!', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_run_cleaner" id="gxtb_run_cleaner" /> ',	
			"content" => __('With this GB-Cleaner App you can delete, unset and clear old options from older versions of this Plugin.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => "User-Level",
			"tooltip" =>  __('required Userlevel to change any settings', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<SELECT NAME="gxtb_fb_lB_lvl" id="gxtb_fb_lB_lvl" disabled="disabled"><OPTION selected>Administrator</OPTION></SELECT>',	
			"content" => __('Currently this Option is not available but it will be available again soon.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => "GB-Warnings",
			"tooltip" =>  __('You can activate or deactivate the GB-Warning System.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_fb_lB_warning_aktiv" id="gxtb_fb_lB_warning_aktiv" disabled="disabled"/> ',	
			"content" => __('Currently this Option is not available but it will be available again soon.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => "Google-jQuery",
			"tooltip" =>  __('This Plugin activates the jQuery with the Google-JS-Files.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_fb_lB_jquery" id="gxtb_fb_lB_jquery" disabled="disabled" /> ',	
			"content" => __('The Plugin deactivates the jQuery of the current Wordpress-Installation and activate the provided jQuery-File from Google. If you deactivate this option Wordpress will use the own jQuery-File.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"content" => __('Infomessage Reset', gxtb_fb_lB_lang),
			"tooltip" =>  __('If you activate this option all the Infomessages will be displayed again!', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_fb_lB_message" id="gxtb_fb_lB_message" disabled="disabled" /> ',	
			"content" => __('If you activate this option all the Infomessages will be displayed again! For example the new Update-Message.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
	array(	"type" => "close")		

);
$this -> gxtb_fb_lB_Output($settings_options);
} // end function
function gxtb_fb_lB_EditorSettings() {
$editor_settings = array (
	array(	"type" => "open"),
	
	array(	"content" => "Post-Button",
			"tooltip" =>  __('You can activate or deactivate the Post-Button on the TinyMCE-Menu.', gxtb_fb_lB_lang),
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_post_button" id="gxtb_post_button" disabled="disabled" /> ',	
			"content" => __('You can either choose if you want to have a Shortbutton on the Post/Page Editor TinyMCE menu or not.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
	
	array(	"content" => "Individual Post/Page",
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_individual_button" id="gxtb_individual_button" disabled="disabled" /> ',	
			"content" => __('If you deactivate this option it is not possible to define individual images for post and pages or even disable the button easily from the Editor Page.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),	
			
	array(	"type" => "close")		
);
$this -> gxtb_fb_lB_Output($editor_settings);
} // end function
function gxtb_fb_lB_help() {
$editor_settings = array (
	array(	"type" => "open"),
	
	array(	"content" => "Support",
			"type" => "title"),	
	array(	"input" => '<input type="checkbox" class="checkbox" name="gxtb_support" id="gxtb_support" disabled="disabled" /> ',	
			"content" => __('If you already supported our work (if you sent us some money via PayPal) please activate this option.', gxtb_fb_lB_lang),
			"smalltip" => "",
            "type" => "content"),
			
	array(	"type" => "close")		
);
$this -> gxtb_fb_lB_Output($editor_settings);
} // end function
## Generates the Output ##
function gxtb_fb_lB_Output($option) {
	foreach ($option as $value) { 
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table class="form-table" width="100%">
		<?php break;
		case "title":
		?>
		<tr>
        <td width="20%" rowspan="2" valign="top" class="gb-table-header"><strong><?php if($value['tooltip'] != "") { ?> <span class="hotspot" onmouseover="tooltip.show('<?php echo $value['tooltip']; ?>');" onmouseout="tooltip.hide();">
            <?php echo $value['content']; ?></span> <?php }else{ echo $value['content']; } ?>
        </strong></td>
		<?php break;
			case 'content':
		?>                        
        <td width="80%" valign="middle">
			<?php echo $value['input']; ?>
            <br />
            <?php echo $value['content']; ?>
        </td>
        </tr>          
        <tr>
           <td class="gb-table-tipp"><small>
		   		<?php echo $value['smalltip']; ?>
            </small></td>
        </tr>
		<?php 
		break;
			case 'tooltip':
		?>
        	<span class="hotspot" onmouseover="tooltip.show('<?php echo $value['content']; ?>');" onmouseout="tooltip.hide();">
            <?php _e('Run GB-Cleaner:', gxtb_fb_lB_lang) ?></span> <input type="checkbox" class="checkbox" name="gxtb_run_cleaner" id="gxtb_run_cleaner" /> 
		<?php 
		break;
		case "close":
		?>
			</table>
		<?php break;		
} 
}	
} // end function
} // end class
} // end if-class
?>