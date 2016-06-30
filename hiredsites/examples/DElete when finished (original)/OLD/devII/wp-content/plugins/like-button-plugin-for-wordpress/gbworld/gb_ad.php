<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	GB-World-INFOPAGE [v1.5] - GB-World-Advertisement [v1.0] - Edition: For Like-Button-Plugin-For-Wordpress
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

if (!class_exists('gxtb_AD')) {
class gxtb_AD {

## Konstruktor
public static function gxtb_addAD() {

	// BugTracker-Feed-Reader [v1.0]
	require_once( ABSPATH . WPINC . '/feed.php' ); 
	
?>
	<?php $max_items = 0; ?>
	<?php if ( function_exists( 'fetch_feed' ) ) { 
		
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( 'http://www.gb-world.net/xml/wp_supporter.xml' );
		if ( !is_wp_error( $rss ) ) { // Checks that the object is created correctly 
		    // Figure out how many total items there are, but limit it to 5. 
		    $max_items = $rss->get_item_quantity(300);
		    $rss_items = $rss->get_items( 0, $max_items ); 
		}
	
	    if ( $max_items == 0 ) {
			echo 'Currently there are no official supporters.';
	    } else {
		    // Loop through each feed item and display each item as a hyperlink.
		    foreach ( $rss_items as $item ) { ?>
				<a target="_blank" class="gxtb_feed" href='<?php echo $item->get_permalink(); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y');
					
					if ($author = $item->get_author())
					{
						echo " - by ";
						echo $author->get_name();
					}
				?>'>
				<?php echo $item->get_title(); ?></a>&nbsp;&nbsp;&nbsp;
		    <?php 
			} 
		}
    } else { 
    	echo 'Currently there are no official supporters.';
    } ?>
</ul>	


<?php
} // end konstruktor
} // end class
} // end if-class

?>