<div class="wrap">
<h2>Twitter Button</h2><br />
<?php
$siteurl = get_option('siteurl');
$plug_url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '';
if (!defined('ABSPATH')) {
	return ;
}

$tb_plugin = dirname(__FILE__);
$tb_option_lang = get_settings('tb-admin-lang');
if (empty($tb_option_lang)) $tb_option_lang = 'en';
require_once("$tb_plugin/langs/$tb_option_lang.php");
$tb_lang = $GLOBALS['tb_lang'];

if($_POST['tb_hidden'] == 'Y') {  
	$dbpwd = $_POST['tb_button'];  
	update_option('tb-button', $dbpwd); 
		
	$dbpwd = $_POST['tb_tweet_text'];  
	update_option('tb-tweet-text', $dbpwd); 
	$dbpwd = $_POST['tb_tweet_text_custom'];  
	update_option('tb-tweet-text-custom', $dbpwd); 
		
	$dbpwd = $_POST['tb_url'];  
	update_option('tb-url', $dbpwd);
	$dbpwd = $_POST['tb_url_custom'];  
	update_option('tb-url-custom', $dbpwd);
	
	$dbpwd = $_POST['tb_language'];  
	update_option('tb-language', $dbpwd);
	
	$dbpwd = $_POST['tb_user'];  
	update_option('tb-user', $dbpwd);
	
	$dbpwd = $_POST['tb_style'];
	update_option('tb-style', $dbpwd);
	
	$dbpwd = $_POST['tb_recommend'];
	update_option('tb-recommend', $dbpwd);
	
	$dbpwd = $_POST['tb_recommend_desc'];
	update_option('tb-recommend-desc', $dbpwd);
	
	$dbpwd = $_POST['tb_position'];
	update_option('tb-position', $dbpwd);
	
	$dbpwd = $_POST['tb_style'];
	update_option('tb-style', $dbpwd);
	
	print "<div class=\"updated\"><p><strong>".$tb_lang['saved']."</strong></p></div>";
}

if($_POST['tb_plugin'] == 'Y') {  
	$dbpwd = $_POST['tb_admin_lang'];  
	update_option('tb-admin-lang', $dbpwd); 
		
	$dbpwd = $_POST['method'];  
	update_option('tb-method', $dbpwd);
	
	$exclude = $_POST['tb_exclude'];  
	$count = count($exclude);
	$tb_exclude = "";
	for($i=0; $i<$count; $i++) {
		$tb_exclude = "$tb_exclude$exclude[$i], ";
	} 
	update_option('tb-exclude',$tb_exclude); 
		
	print "<div class=\"updated\"><p><strong>".$tb_lang['saved']."</strong></p></div>";
}
if($_POST['tb_restore'] == 'Y') {  
	update_option('tb-button', 'vertical-count'); 
	update_option('tb-tweet-text', '1'); 
	update_option('tb-tweet-text-custom', ''); 
	update_option('tb-url', '1');
	update_option('tb-url-custom', '');
	update_option('tb-language', 'en');
	update_option('tb-user', '');
	update_option('tb-recommend', '');
	update_option('tb-recommend-desc', '');
	update_option('tb-position', '2');
	update_option('tb-style', '');
	
	update_option('tb-admin-lang', 'en');
	update_option('tb-method', 'automatic');
	update_option('tb-exclude', '');
	
	print "<div class=\"updated\"><p><strong>".$tb_lang['saved']."</strong></p></div>";
}
?>
<ul class="navi">
	<li><a href="javascript:;" title="#tab_content_1"><?php echo $tb_lang['button']; ?></a></li>
	<li><a href="javascript:;" title="#tab_content_2"><?php echo $tb_lang['plugin']; ?></a></li>
	<li><a href="javascript:;" title="#tab_content_3"><?php echo $tb_lang['restore']; ?></a></li>
	<li><a href="javascript:;" title="#tab_content_4">FYI</a></li>
</ul>
<div class="tweetbutton_content">
	<div id="tab_content_1" class="single_content">
		<p></p>
		<form name="tb_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="tb_hidden" value="Y">
			<table width="500" cellpadding="5">
				<tr>
					<td><input type="radio" name="tb_button" value="vertical"<?php if (get_option('tb-button') == 'vertical') echo ' checked="checked"'; ?>> <?php echo $tb_lang['vertical']; ?></td>
					<td><input type="radio" name="tb_button" value="horizontal"<?php if (get_option('tb-button') == 'horizontal') echo ' checked="checked"'; ?>> <?php echo $tb_lang['horizontal']; ?></td>
					<td><input type="radio" name="tb_button" value="none"<?php if (get_option('tb-button') == 'none') echo ' checked="checked"'; ?>> <?php echo $tb_lang['none']; ?></td>
				</tr>
				<tr>
					<td><img src="<?php echo $plug_url.'/images/tweetbutton-vertical-count.png'; ?>" border="0" alt="vertical-count" id="vertical-count" /></td>
					<td><img src="<?php echo $plug_url.'/images/tweetbutton-horizontal-count.png'; ?>" border="0" alt="horizontal-count" id="horizontal-count" /></td>
					<td><img src="<?php echo $plug_url.'/images/tweetbutton-no-count.png'; ?>" border="0" alt="no-count" id="no-count"/></td>
				</tr>
			</table>
			
			<h3><?php echo $tb_lang['tweet-text']; ?></h3>
			<p>
				<?php echo $tb_lang['tweet-text-desc']; ?><br /><br />
				<input type="radio" name="tb_tweet_text" value="1" <?php if (get_option('tb-tweet-text') == '1') echo 'checked="checked"'; ?>> <?php echo $tb_lang['tweet-text-1']; ?><br /><br />
				<input type="radio" name="tb_tweet_text" value="2" <?php if (get_option('tb-tweet-text') == '2') echo 'checked="checked"'; ?>> <?php echo $tb_lang['tweet-text-2']; ?><br /><br />
				<input type="radio" name="tb_tweet_text" value="3" <?php if (get_option('tb-tweet-text') == '3') echo 'checked="checked"'; ?>> <?php echo $tb_lang['tweet-text-3']; ?><br /><br />
				<input type="radio" name="tb_tweet_text" value="4" <?php if (get_option('tb-tweet-text') == '4') echo 'checked="checked"'; ?>> 
				<input type="text" value="<?php echo get_option('tb-tweet-text-custom'); ?>" name="tb_tweet_text_custom" class="text-input medium-input" /> <?php echo $tb_lang['tweet-text-4']; ?>
			</p>
			
			<h3>URL</h3>
			<p>
				<?php echo $tb_lang['url-desc']; ?><br /><br />
				<input type="radio" name="tb_url" value="1" <?php if (get_option('tb-url') == '1') echo 'checked="checked"'; ?>> <?php echo $tb_lang['url-1']; ?><br /><br />
				<input type="radio" name="tb_url" value="2" <?php if (get_option('tb-url') == '2') echo 'checked="checked"'; ?>> 
				<input type="text" value="<?php echo get_option('tb-url-custom'); ?>" name="tb_url_custom" class="text-input medium-input" />
			</p>
			
			<h3><?php echo $tb_lang['language']; ?></h3>
			<p>
				<?php echo $tb_lang['language-desc']; ?><br /><br />
				<select name="tb_language">
					<option value="en"<?php if (get_option('tb-language') == 'en') echo ' selected="selected"'; ?>>English</option> 
					<option value="fr"<?php if (get_option('tb-language') == 'fr') echo ' selected="selected"'; ?>>French</option> 
					<option value="de"<?php if (get_option('tb-language') == 'de') echo ' selected="selected"'; ?>>German</option> 
					<option value="es"<?php if (get_option('tb-language') == 'es') echo ' selected="selected"'; ?>>Spanish</option> 
					<option value="ja"<?php if (get_option('tb-language') == 'ja') echo ' selected="selected"'; ?>>Japanese</option>
				</select> 
			</p>
			
			<h3><?php echo $tb_lang['user']; ?></h3>
			<p>
				<input type="text" value="<?php echo get_option('tb-user'); ?>" name="tb_user" class="text-input medium-input" /> <?php echo $tb_lang['user-1']; ?>
			</p>
			
			<h3><?php echo $tb_lang['recommend']; ?></h3>
			<p><?php echo $tb_lang['recommend-desc']; ?></p>
			<p>
				<input type="text" value="<?php echo get_option('tb-recommend'); ?>" name="tb_recommend" class="text-input medium-input" /> 
			</p>
			<p><?php echo $tb_lang['recommend-desc-1']; ?></p>
			<p><input type="text" value="<?php echo get_option('tb-recommend-desc'); ?>" name="tb_recommend_desc" class="text-input medium-input" /></p>
			
			<h3><?php echo $tb_lang['position']; ?></h3>
			<p><?php echo $tb_lang['position-desc']; ?></p>
			<p>
				<input type="radio" name="tb_position" value="1" <?php if (get_option('tb-position') == '1') echo 'checked="checked"'; ?>> <?php echo $tb_lang['position-1']; ?> 
			</p>
			<p>
				<input type="radio" name="tb_position" value="2" <?php if (get_option('tb-position') == '2') echo 'checked="checked"'; ?>> <?php echo $tb_lang['position-2']; ?>
			</p>
			<p>
				<input type="radio" name="tb_position" value="3" <?php if (get_option('tb-position') == '3') echo 'checked="checked"'; ?>> <?php echo $tb_lang['position-3']; ?>
			</p>
			
			<h3><?php echo $tb_lang['style']; ?></h3>
			<p>
				<?php echo $tb_lang['style-desc']; ?>
			</p>
			<p>
				<input type="text" name="tb_style" value="<?php echo get_option('tb-style'); ?>" class="text-input long-input">
			</p>
			<p>
				<em><?php echo $tb_lang['style-example']; ?></em>
			</p>
			<p></p>
			<p class="submit">
				<input type="submit" name="submit" value="<?php echo $tb_lang['update']; ?>" />
			</p>
		</form>
	</div>
	<div id="tab_content_2" class="single_content">
	<p></p>
	<form name="tb_plugin_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="tb_plugin" value="Y">
		<h3><?php echo $tb_lang['admin-lang']; ?></h3>
		<table width="100%" cellpadding="5" cellspacing="10">
		<tr>
			<td><input type="radio" name="tb_admin_lang" value="en" <?php if (get_option('tb-admin-lang') == "en") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-uk.png'; ?>" border="0" alt="en"/> English</td>
			<td><input type="radio" name="tb_admin_lang" value="de" <?php if (get_option('tb-admin-lang') == "de") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-de.png'; ?>" border="0" alt="de"/> Deutsch</td>
			<td><input type="radio" name="tb_admin_lang" value="es" <?php if (get_option('tb-admin-lang') == "es") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-es.png'; ?>" border="0" alt="es"/> Spanish</td>
			<td><input type="radio" name="tb_admin_lang" value="fr" <?php if (get_option('tb-admin-lang') == "fr") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-fr.png'; ?>" border="0" alt="fr"/> French</td>
		</tr>
		<tr>
			<td><input type="radio" name="tb_admin_lang" value="it" <?php if (get_option('tb-admin-lang') == "it") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-it.png'; ?>" border="0" alt="it"/> Italian</td>
			<td><input type="radio" name="tb_admin_lang" value="bg" <?php if (get_option('tb-admin-lang') == "bg") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-bg.png'; ?>" border="0" alt="bg"/> Български</td>
			<td><input type="radio" name="tb_admin_lang" value="mk" <?php if (get_option('tb-admin-lang') == "mk") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-mk.png'; ?>" border="0" alt="mk"/> Македонски</td>
			<td><input type="radio" name="tb_admin_lang" value="ro" <?php if (get_option('tb-admin-lang') == "ro") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-ro.png'; ?>" border="0" alt="ro"/> Romanian</td>
		</tr>
		<tr>
			<td><input type="radio" name="tb_admin_lang" value="hr" <?php if (get_option('tb-admin-lang') == "hr") echo 'checked="yes"'; ?> /> <img src="<?php echo $plug_url.'/images/langs/flag-hr.png'; ?>" border="0" alt="hr"/> Croation</td>
			<td colspan="3"></td>
		</tr>
		</table>
		<h3><?php echo $tb_lang['method']; ?></h3>
		<p><input type="radio" name="method" value="automatic" <?php if (get_option('tb-method') == "automatic") echo 'checked="yes"'; ?>/> <?php echo $tb_lang['automatic']; ?></p>
		<p><input type="radio" name="method" value="manual" <?php if (get_option('tb-method') == "manual") echo 'checked="yes"'; ?>/> <?php echo $tb_lang['manual']; ?></p>
		<p><?php echo $tb_lang['manual_desc']; ?></p>
		<p><em><?php echo $tb_lang['example']; ?></em>
		<blockquote>
			<pre style="background:#BFDFFF; padding: 10px;">&lt;div class=&quot;entry&quot;&gt;
	&lt;?php the_content(''); ?&gt;
	&lt;?php the_tags( '&lt;p&gt;Tags: ', ', ', '&lt;/p&gt;'); ?&gt;

	&lt;p class="postmetadata"&gt;

		<b>&lt;?php echo twitter_button(); ?&gt;</b>
		
	&lt;/p&gt;
&lt;/div&gt;</pre>
		</blockquote></p>
		<p><input type="radio" name="method" value="shortcode" <?php if (get_option('tb-method') == "shortcode") echo 'checked="yes"'; ?>/> <?php echo $tb_lang['shortcode']; ?></p>
		<p><?php echo $tb_lang['shortcode_desc']; ?></p>
		<p><em><?php echo $tb_lang['example']; ?></em>
		<blockquote>
			<pre style="background:#BFDFFF; padding: 10px;">Hi everyone!
So, this is my new blog and here I'm gonna posting stuff about me, what I do and ect....

<strong>[twitter-button]</strong>
		
Hope you enjoy it... </pre>
		</blockquote></p>
		<h3><?php echo $tb_lang['exclude']; ?></h3>
		<p><?php echo $tb_lang['exclude-desc']; ?></p>
		<p><?php $exclude_array = explode(", ", get_option('tb-exclude')); ?>
		<table width="500" cellpadding="10" cellspacing="5">
		<tr>
			<td><input type="checkbox" name="tb_exclude[]" value="1" <?php if (in_array("1", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-1']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="2" <?php if (in_array("2", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-2']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="3" <?php if (in_array("3", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-3']; ?></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="tb_exclude[]" value="4" <?php if (in_array("4", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-4']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="5" <?php if (in_array("5", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-5']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="6" <?php if (in_array("6", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-6']; ?></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="tb_exclude[]" value="7" <?php if (in_array("7", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-7']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="8" <?php if (in_array("8", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-8']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="9" <?php if (in_array("9", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-9']; ?></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="tb_exclude[]" value="10" <?php if (in_array("10", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-10']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="11" <?php if (in_array("11", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-11']; ?></td>
			<td><input type="checkbox" name="tb_exclude[]" value="12" <?php if (in_array("12", $exclude_array)) echo 'checked="checked" '; ?>/> <?php echo $tb_lang['exclude-12']; ?></td>
		</tr>
		</table></p>
		<p class="submit">
			<input type="submit" name="submit" value="<?php echo $tb_lang['update']; ?>" />
		</p>
	</form>
	</div>
	<div id="tab_content_3" class="single_content">
	<p><?php echo $tb_lang['restore-desc']; ?></p>
	<form name="tb_restore" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="tb_restore" value="Y">
	<p class="submit">
		<input class="button-primary" type="submit" value="<?php echo $tb_lang['restore']; ?>" />
	</p>
	</form>
	</div>
	<div id="tab_content_4" class="single_content">
		<h2>FYI</h2>
		<p></p>
		<ul>
			<li><strong><a href="http://twitter.com/goodies/tweetbutton" target="_blank">Official Tweet Button</a></strong><br /><br /></li>
			<li><b><?php echo $tb_lang['author']; ?>:</b> <a href="http://www.svil4ok.com/" target="_blank">Svilen Popov</a></li>
			<li><b><?php echo $tb_lang['url']; ?>:</b> <a href="http://www.svil4ok.com/wordpress-plugins/twitter-button/" target="_blank">http://www.svil4ok.com/wordpress-plugins/twitter-button/</a></li>
			<li><b><?php echo $tb_lang['version']; ?>:</b> 0.2.8<br /><br /></li>
			<li><b><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=svil4ok%40gmail%2ecom&item_name=WordPress+Twitter+Button&item_number=Support+Open+Source+Project&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP+DonationsBF&charset=UTF%2d8"><?php echo $tb_lang['donate']; ?></a></b></li>
		</ul>
	</div>
</div>
</div>