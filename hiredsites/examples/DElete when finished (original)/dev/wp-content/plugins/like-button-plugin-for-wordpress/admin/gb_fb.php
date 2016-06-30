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
###########	       GB-World-Facebook	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_FB')) {
class gxtb_fb_lB_FB {

## Konstruktor
function gxtb_fb_lB_FB() {
?><table><tr><td align="center" valign="middle">
<iframe src="http://www.facebook.com/plugins/likebox.php?id=119752364716058&amp;width=292&amp;connections=0&amp;stream=false&amp;header=false&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe>
</td></tr>
<tr><td align="left" valign="middle">
<a name="fb_share" type="button_count" share_url="http://www.gb-world.net/like-button-plugin-for-wordpress" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
</td></tr>
</table>
<?php
} // end konstruktor
} // end class
} // end if-class
?>