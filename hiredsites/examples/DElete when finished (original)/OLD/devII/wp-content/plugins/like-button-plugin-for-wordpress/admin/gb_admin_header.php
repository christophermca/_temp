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
###########	       GB-World-Header  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
if (!class_exists('gb_admin_header')) {
class gb_admin_header {
public static function gb_admin_head() {
echo '

<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/lib/jquery.preview.script.js"></script>
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/lib/jquery.thumbs.js"></script>
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/lib/jquery.mousewheel-3.0.4.pack.js"></script>
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/lib/jquery.fancybox-1.3.4.pack.js"></script>
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/js/gb_generator.js"></script>
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/jquery.fancybox-1.3.4.css" />
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/jquery-ui-1.8.4.custom.css" />
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/tooltips.css" />
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER. 'admin/css/admin.css" />
';
echo '<script type="text/javascript" src="'. gxtb_fb_lB_PLUGIN_FOLDER .'admin/js/gb_js.php?page=fb-like-button"></script>
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/js/gb_js.js"></script>
';
/*if($gxtb_fb_lB["jQuery"]) {
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'admin/js/gb_jquery.js"></script>
';
}*/
if($_GET['page'] == "fb-like-gbworld") {
echo '<link rel="stylesheet" href="'. gxtb_fb_lB_PLUGIN_FOLDER . '/gbworld/css/gbworld.css" type="text/css" media="screen" />
';
wp_print_scripts( array( 'sack' ));
echo '
';
}
echo '<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';
?>
<script type="text/javascript">
jQuery.noConflict();jQuery(document).ready(function(){jQuery("a.fancylink").fancybox();jQuery("a.fancylink_iframe").fancybox({'width':'75%','height':'75%','autoScale':false,'transitionIn':'none','transitionOut':'none','type':'iframe'});jQuery('#tabs_general').tabs();jQuery('#tabs_generator').tabs();jQuery('#tabs_css').tabs();jQuery('#tabs_expert').tabs();jQuery('#dialog_link, ul#icons li').hover(function(){$(this).addClass('ui-state-hover')},function(){$(this).removeClass('ui-state-hover')});<?php if($_GET['page']=="fb-like-button")echo'post_focus();'?>});<?php if($_GET['page']=="fb-like-button"){?>function post_focus(){var elem1=document.getElementById("xfbml_mod1");var elem2=document.getElementById("xfbml_mod2");if(document.settingpage.gxtb_fb_lB_jdk.checked==true){elem1.style.display="table-cell";elem2.style.display="table-cell"}else{elem1.style.display="none";elem2.style.display="none"}}
<?php } ?>
</script>
<?php
} // end function
public static function gb_admin_title() { ?>
<h2><?php echo gxtb_fb_lB_name; /* ?> - Version <?php echo gxtb_fb_lB_version; */ ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER; ?>images/fb_like_4.png" onmouseover="tooltip.show('<?php _e('Facebook-Button: all rights reserved by Facebook.com - this is only a modified variant of the button for this plugin.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"/></h2>
<?php }
} // end class
} // end if-class
?>