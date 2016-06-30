<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.2.3] - GB-TinyMCE-Button-Window-Design [v0.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	  		TINYMCE-BUTTON		 ###########
###########		    			         ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

// look up for the path
require_once('tinymce-config.php');

global $wpdb;

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here", 'gp-jump-page'));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo gxtb_fb_lB_name; echo " [v"; echo gxtb_fb_lB_version; echo "]"; ?> - Button-Beta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript">
	function init() {
		tinyMCEPopup.resizeToInnerSize();
	}
	
	function insert_gbLinks() {
		
		var tagtext;
		var rss = document.getElementById('rss_panel');
		var rss2 = document.getElementById('rss_panel2');
		
		// who is active ?
		if (rss.className.indexOf('current') != -1 || rss2.className.indexOf('current') != -1) {
			var gb_url_txt = document.getElementById('gb_url').value;
				
			if (gb_url_txt != '')
				tagtext = "[like url=" + gb_url_txt + "]";
			else
				tagtext = "[like]";
				// tinyMCEPopup.close();
		}
	
		
		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
			//Peforms a clean up of the current editor HTML. 
			//tinyMCEPopup.editor.execCommand('mceCleanup');
			//Repaints the editor. Sometimes the browser has graphic glitches. 
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
	<base target="_self" />
    
<?php load_plugin_textdomain( 'gb_like_button', FALSE, gxtb_fb_lB_URLPATH .'/languages' ); ?>
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('gb_url').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="gb_jump_page_form" action="#">
	<div class="tabs">
		<ul>
			<li id="rss_tab" class="current"><span><a href="javascript:mcTabs.displayTab('rss_tab','rss_panel');" onmousedown="return false;"><?php _e("Generator", gxtb_fb_lB_lang); ?></a></span></li>
			<li id="rss_tab2"><span><a href="javascript:mcTabs.displayTab('rss_tab2','rss_panel2');" onmousedown="return false;"><?php _e("Preview", gxtb_fb_lB_lang); ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper">
		<!-- rss panel -->
		<div id="rss_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="rsstag"><?php _e("Enter the Like-URL here:", gxtb_fb_lB_lang); ?></label></td>
            <td><input type="text" id="gb_url" name="gb_url" style="width: 190px" onchange="javascript:generate();" /></td>
          </tr>
            <td nowrap="nowrap" colspan="3">
				<label for="rsstag">
					<?php _e("Example", gxtb_fb_lB_lang); ?>:
						<br />
					<?php _e("url = http://www.gb-world.net", gxtb_fb_lB_lang); ?>
						<br />
					<?php _e("If you keep the textbox emtpy it will only insert [like].", gxtb_fb_lB_lang); ?>
						<br />
					<?php _e("The Button will use the Like-Button-Settings you defined the Option Page.", gxtb_fb_lB_lang); ?>
				</label>
			</td>
          </tr>
        </table>
		</div>
		<!-- end rss panel -->
		
		<!-- rss panel -->
		<div id="rss_panel2" class="panel">
		<br />
		<b><?php _e("Notice", gxtb_fb_lB_lang); ?>:</b> <?php _e("Currently this Preview only helps you to see how many likes this post allready has. The final design can variaty from this preview! Will be availabe within the next updates.", gxtb_fb_lB_lang); ?>
		<br /><br />
			<div id="gb_like">
				<iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/GBWorldnet&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
			</div>
		</div>
		
		<script type="text/javascript">
			function generate() {
			var gb_url_txt = document.getElementById('gb_url').value;
			var like = document.getElementById('gb_like');
			
			if(gb_url_txt != "") {
				like.innerHTML = '<iframe src="http://www.facebook.com/plugins/like.php?href='+ gb_url_txt +'&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>';
			}
			
			}
		</script>
		<!-- end rss panel -->
		
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", gxtb_fb_lB_lang); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="<?php _e("Insert", gxtb_fb_lB_lang); ?>" onclick="insert_gbLinks();" />
		</div>
	</div>
</form>
</body>
</html>
<?php

?>
