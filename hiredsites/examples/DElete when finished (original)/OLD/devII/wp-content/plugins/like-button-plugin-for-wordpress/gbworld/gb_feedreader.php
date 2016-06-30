<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php 
/*
+----------------------------------------------------------------+
+	GB-World-FeedReader [v1.2]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

/* notice: http://www.noupe.com/jquery/the-power-of-wordpress-and-jquery-30-useful-plugins-tutorials.html */

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     SUPPORT-CLASS			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if (!class_exists('gxtb_FRClass')) {

class gxtb_FRClass {

function gxtb_FRClass () {}


function gxtb_reader($i) {

require_once( ABSPATH . WPINC . '/feed.php' ); 

if($i == 0) {?>

<ul>
	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://www.gb-world.net/topic/wordpress/feed/' );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(5);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			echo '<li class="ajax-error">No feed items found to display or you are offline.</li>';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) { ?>
		    <li class="gxtb_feed_li">
				<a target="_blank" class="gxtb_feed" href='<?php echo $item->get_permalink(); ?>?ref=likebuttonplugin' title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
				<?php echo $item->get_title(); ?>
				</a>
		    </li> <?php 
			} 
		}
    } else { 
    	echo '<li class="ajax-error">No feed items found to display.</li>';
    } ?>
</ul>

<?php
} else if($i == 1) {?>

<ul>
	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://www.gb-world.net/feed/' );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(5);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			echo '<li class="ajax-error">No feed items found to display.</li>';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) { ?>
		    <li class="gxtb_feed_li">
				<a target="_blank" class="gxtb_feed" href='<?php echo $item->get_permalink(); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
				<?php echo $item->get_title(); ?>
				</a>
		    </li> <?php 
			} 
		}
    } else { 
    	echo '<li class="ajax-error">No feed items found to display.</li>';
    } ?>
</ul>

<?php
}

}

} // end class
} // end if-class
?>