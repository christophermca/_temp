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
###########	       LIKE-ACTIVITY		 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_FBActivity')) {
class gxtb_fb_lB_FBActivity {
## Konstruktor
function gxtb_fb_lB_FBActivity() {
?><table width="100%"><tr><td>
<iframe src="http://www.facebook.com/plugins/activity.php?site=<?php echo $_SERVER['HTTP_HOST']; ?>&amp;width=250&amp;height=300&amp;header=true&amp;colorscheme=light&amp;recommendations=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:300px;" allowTransparency="true"></iframe>
</td></tr>
</table>
<?php
} // end konstruktor
} // end class
} // end if-class
?>