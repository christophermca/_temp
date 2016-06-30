<?php
/*
Plugin Name: Delicious Bookmark Button
Plugin URI: http://deepubalan.com/blog/2010/07/17/my-first-wordpress-plugin-delicious-bookmark-button-with-realtime-bookmark-count/
Description: A cool delicious bookmarking button/badge with total bookmark count. It adds a delicious badge or button to your post or page which allows you to bookmark the post. It also reflect a real-time count of how many times your page has been bookmarked in delicious, just like tweetmeme button does for twitter. Both standard and compact version of the badge to choose from. 
Version: 1.0	
Author: Deepu Balan
Author URI: http://www.deepubalan.com
Wordpress version supported: 2.3 and above
*/

/*  Copyright (c) 2010  Deepu Balan  (www.deepubalan.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Version check */
global $wp_version;	
$exit_msg='Delit This requires WordPress 2.3 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
$plugin_url=defined('WP_PLUGIN_URL') ? (WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__))) : trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)); 
if (version_compare($wp_version,"2.3","<"))
{
	exit ($exit_msg);
}

function Delit_ScriptsAction()
{
	if (!is_admin())
	{
		global $plugin_url;
	  	wp_enqueue_script('jquery');
	  	wp_enqueue_script('delit_script', $plugin_url.'/delit.js', array('jquery')); 
	}
}
add_action('wp_print_scripts', 'Delit_ScriptsAction');

function Delit_HeadAction()
{
	global $plugin_url;
	echo '<link rel="stylesheet" href="'.$plugin_url.'/delit.css" type="text/css" />'; 
}

add_action('wp_head', 'Delit_HeadAction' );

function delit_normal() { ?>
<div class='deli-wrap-a'>
   <span class='md5hash'><?php echo md5(get_permalink()); ?></span><a onclick="popitup('http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','',FALSE)) ?>');" href="javascript:pageTracker._trackPageview('/outbound/article/delicious.com');"></a>
</div>
<?php
}

function delit_compact() {
?>
<div class='deli-wrap-b'>
 <div class="deli-wrap-in-b">
 <span class='md5hash'><?php echo md5(get_permalink()); ?></span><a onclick="javascript:popitup('http://del.icio.us/post?v=4&amp;noui&amp;jump=close&amp;url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','',FALSE)) ?>');" href="javascript:pageTracker._trackPageview('/outbound/article/delicious.com');">delicious</a>
 </div>
</div>
<?php
}

function delit_admin() {  
    include('delit_admin.php');  
}  
function delit_admin_actions() {  
     add_options_page("Delicious Badge", "Delicious Badge", 1, "DeliciousBadge", "delit_admin");  
}  
add_action('admin_menu', 'delit_admin_actions');  
?>