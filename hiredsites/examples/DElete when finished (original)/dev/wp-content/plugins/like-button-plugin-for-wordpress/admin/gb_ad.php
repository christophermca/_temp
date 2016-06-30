<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - GB-World-Advertisement [v1.1]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       GB-World-AD-CLASS	 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if (!class_exists('gxtb_fb_lB_Ad')) {
class gxtb_fb_lB_Ad {
## Konstruktor
function gxtb_fb_lB_Ad() {
?>

<?php _e('Do you like our plugin?', gxtb_fb_lB_lang) ?> <?php _e('Do you wanna be listed here as a Fan and Supporter of our plugin?', gxtb_fb_lB_lang) ?>
<span class="hotspot" onmouseover="tooltip.show('<?php _e('Because this is free advertisement for both of us. For you and us. You do not have to pay anything and its just as easy as it could be. Write an article about our plugin/homepage and you will be listed here for free! And over thousends of plugin-users will see your advertising-link!', gxtb_fb_lB_lang) ?>');" onmouseout="tooltip.hide();">
<?php _e('Why should I?', gxtb_fb_lB_lang) ?></span>
<br /><br />
<?php _e('Then just write a little article about our plugin on your homepage (blog, website,...) and post this link and article in our <a href="http://www.gb-world.net/forum/viewforum.php?f=87" target="_blank">Forum</a>', gxtb_fb_lB_lang) ?>.<br /><br />
<?php _e('After that your Homepage or Name - what you like most - will be listed here (Top 5) and at our GB-InfoPage (on the Dasboard)!', gxtb_fb_lB_lang) ?>

<?php 
	// BugTracker-Feed-Reader [v1.0]
	require_once( ABSPATH . WPINC . '/feed.php' ); 
?>
<br /><br />
<u><?php _e("Supporter", gxtb_fb_lB_lang); ?> - <?php _e("Lastest 5", gxtb_fb_lB_lang); ?></u>
<br /><br />
<ul class="bugtracker">

	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://www.gb-world.net/xml/wp_supporter.xml' );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(5);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			echo '<li class="ajax-error">';
				_e('Currently there are no official supporters or you are offline.', gxtb_fb_lB_lang);
			echo '</li>';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) { ?>
		    <li>
				<a target="_blank" class="gxtb_feed" href='<?php echo $item->get_permalink(); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y');
					
					if ($author = $item->get_author())
					{
						echo " - by ";
						echo $author->get_name();
					}
				?>'>
				<?php echo $item->get_title(); ?>
				</a>
		    </li> <?php 
			} 
		}
    } else { 
    	echo '<li class="ajax-error">';
			_e('Currently there are no official supporters.', gxtb_fb_lB_lang);
		echo '</li>';
    } ?>
</ul>
<?php
} // end function
} // end class
} // end if-class ?>