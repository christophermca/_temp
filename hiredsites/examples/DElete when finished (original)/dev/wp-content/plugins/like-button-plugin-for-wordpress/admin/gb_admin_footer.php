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
###########	       GB-World-Footer  	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################
?>
<div style="display: none;">
<div id="plugininfo">
	<h2><?php _e('Plugin-Information', gxtb_fb_lB_lang) ?></h2>
		<p><?php echo sprintf( '%s <b>%s.</b> (<a href="#">%s</a>)', __('This Plugin was created by', gxtb_fb_lB_lang),  __(' Stefan N', gxtb_fb_lB_lang), __('GB-World.net', gxtb_fb_lB_lang)); ?></p>
		<p><?php _e('I use a lot of different (jQuery-)Plugins to make this page as easy as it could be for you. For example i use jQuery to make the Option-Page even smaller and better.', gxtb_fb_lB_lang);
		echo " ";
		echo sprintf( '%s <a href="#">%s</a>. %s <a href="#">%s</a> %s.', __('I hope you like my plugin and you', gxtb_fb_lB_lang), __('report any bugs', gxtb_fb_lB_lang), __('I have invested a lot of time to get this plugin as good as it is now. I would appreciate it if you would ', gxtb_fb_lB_lang), __('support', gxtb_fb_lB_lang), __('my work', gxtb_fb_lB_lang)); ?>
		<br /><br />
		<?php _e('yours', gxtb_fb_lB_lang) ?><br /><em>Stefan N.</em></p>
		<br />
		<p><em><?php _e('Notice', gxtb_fb_lB_lang) ?>: <?php _e('Some of my impressions and ideas I got from other sites, plugins and tutorials. They are all listed beside the code snippets I got from their work or tutorials.', gxtb_fb_lB_lang) ?></em></p>
</div></div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-11334432-8";
urchinTracker();
</script>
<?php  ### Update-Notice ### 
$Version = get_option('gxtb_fb_lB');
if($Version["cVersion"] != $Version["lVersion"] && $Version["message"] ) {?>
<div id="message" class="updated fade"><p><?php echo sprintf( "%s - <b>%s:</b> %s", __('After this Update/Reactivation please check your FB-Like Settings if they are all the same! Because since [v4.3] there are many new things in the Backend. Thanks.', gxtb_fb_lB_lang), __('Especially', gxtb_fb_lB_lang), __('Dynamic Button Setting, Meta-Tags and Design-Options. And do also update your header.php-file if you use XFBML (see more information below the XFBML-Checkbox).', gxtb_fb_lB_lang));?></p></div>
<?php 
	$gxtb_fb_lB = array('message' => false);
	update_option('gxtb_fb_lB', $gxtb_fb_lB);
/* 
<div id="message" class="updated fade"  style="background:#09F;"><p><strong><?php echo sprintf( "%s", __('After this Update please check your FB-Like Settings if they are all the same! Because since [v4.3] there are many new things in the Backend. Thanks.', gxtb_fb_lB_lang), gxtb_fb_lB_name); ?></strong></p></div> */
 } ?>