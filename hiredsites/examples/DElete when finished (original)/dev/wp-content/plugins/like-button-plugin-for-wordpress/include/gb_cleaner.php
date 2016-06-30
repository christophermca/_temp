<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - GB-Cleaner [v1.0.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       CLEANER-CLASS		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gxtb_fb_lB_Cleaner')) {
class gxtb_fb_lB_Cleaner {
function gxtb_fb_lB_Cleaner() {

$gxtb_fb_lB = get_option('gxtb_fb_lB');

if ( isset($gxtb_fb_lB['lVersion']) ) {

	if ( version_compare($gxtb_fb_lB['lVersion'], '4.0', '<=') ){
		if(get_option('gxtb_fb_lB_settings')) {
			$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
			unset( $gxtb_fb_lB_settings['position'] );
			update_option('gxtb_fb_lB_settings', $gxtb_fb_lB_settings);
		}
	}
	if ( version_compare($gxtb_fb_lB['lVersion'], '4.2', '<=') ){
		if(get_option('gxtb_fb_lB_meta')) {
			$gxtb_fb_lB_meta = get_option('gxtb_fb_lB_meta');
			unset( $gxtb_fb_lB_meta['post_focus'] );
			update_option('gxtb_fb_lB_meta', $gxtb_fb_lB_meta);
		}
	}
	if ( version_compare($gxtb_fb_lB['lVersion'], '4.2.5.1', '<=') || version_compare($gxtb_fb_lB['lVersion'], '4.3', '<=') || version_compare($gxtb_fb_lB['lVersion'], '4.3.1', '<=') ){
		if(get_option('gxtb_fb_lB_generator')) {
			
			$gxtb_fb_lB_generator = get_option('gxtb_fb_lB_generator');
			$gxtb_fb_lB_settings = get_option('gxtb_fb_lB_settings');
			$gxtb_fb_lB = get_option('gxtb_fb_lB');
			
			unset( $gxtb_fb_lB_generator['language'] );
			unset( $gxtb_fb_lB_generator['dynamic'] );
			
			unset( $gxtb_fb_lB_settings['css'] );
			unset( $gxtb_fb_lB_settings['cssbox'] );	
			unset( $gxtb_fb_lB_settings['br_before'] );	
			unset( $gxtb_fb_lB_settings['br_after'] );	
			
			$gxtb_fb_lB["InfoPage"] = false;	
				
			update_option('gxtb_fb_lB_generator', $gxtb_fb_lB_generator);
			update_option('gxtb_fb_lB_settings', $gxtb_fb_lB_settings);
			update_option('gxtb_fb_lB', $gxtb_fb_lB);
		}
	}

}
?>
<div id="message" class="updated fade"><p><strong><?php echo sprintf( "%s '%s' [v%s] %s.", __('Successfully cleaned up all the', gxtb_fb_lB_lang), gxtb_fb_lB_name,  gxtb_fb_lB_version, __('Settings', gxtb_fb_lB_lang)); ?></strong></p></div>
<?php
} // end konstruktor
} // end class
} // end if-class
?>