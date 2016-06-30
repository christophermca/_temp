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
###########	       SUBMIT-METHOD		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net ##############
####################################################
?>
<table><tr><td>
<input type="hidden" name="fb_like_hidden" value="update" />
<input name="fbsubmit" type="submit" class="button-primary" id="button" value="<?php _e('Save Changes', gxtb_fb_lB_lang) ?>" />	
</form>
<?php /* <form method="post" action="<?php echo  admin_url( 'admin.php?page=fb-like-button' ); ?>">
<input type="submit" onclick="return confirm('<?php _e('Restore default Like-Button settings?', 'gb_like_button' ); ?>');" name="reset" value="<?php _e('Restore Defaults', gxtb_fb_lB_lang ); ?>" class="button-highlighted" id="button-reset"/>
</form> */ ?>
</td></tr></table>