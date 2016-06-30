<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php 
/*
+----------------------------------------------------------------+
+	GB-World-PayPalBox [v1.3]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     PayPal-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################
if(!class_exists('gxtb_NewsPClass')) {
class gxtb_NewsPClass {
function gxtb_NewsPClass($gxtb_NewsClass_iArray) {
	
	if($gxtb_NewsClass_iArray['name'] != "" || $gxtb_NewsClass_iArray['Infopage'] > 0 ) {
		$gxtb_newsbox_active = $gxtb_NewsClass_iArray['active'];
		$gxtb_newsbox_langdef = $gxtb_NewsClass_iArray['language'];
		$gxtb_newsbox_Array["name"] = $gxtb_NewsClass_iArray['name'];
		$gxtb_newsbox_Array["version"] = $gxtb_NewsClass_iArray['version'];
		$gxtb_newsbox_art = $gxtb_NewsClass_iArray['def'];
		
		$gxtb_newsbox_infopage = $gxtb_NewsClass_iArray['Infopage'];
	}
?>

<!-- ######################################################################################################## -->
<!-- 										## GB-Newsbox 3.0  ##											  -->

	                <p><?php if ($gxtb_newsbox_infopage != 1) { ?> '<?php echo $gxtb_newsbox_Array["name"]; ?>' <?php _e('was', $gxtb_newsbox_langdef) ?> <?php } else { echo "The GB-World-Plugins were"; } ?> 
					<?php _e('created by', $gxtb_newsbox_langdef) ?> <a href="http://wiki.gb-world.net/wiki/User:GangXtaBoii" target="_blank">Stefan Natter</a>. 
           			<?php _e('The development of this plugin(s) took a lot of time and effort, so please don&rsquo;t forget to donate if you found this plugin(s) useful.', $gxtb_newsbox_langdef) ?></p>
                    
                    <p><?php _e('There are also other ways of supporting this plugin(s) to ensure it is maintained and well supported in the future!', $gxtb_newsbox_langdef) ?>
                    <?php _e('Rating the plugin(s) on wordpress.org (if you like it), linking/spreading the word, and submitting code contributions will all help.', $gxtb_newsbox_langdef) ?> </p>
                    
					<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SB94MEM9ATTBG"><img src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" /></a>
<?php

	}
} // end class
} // end if-class
?>