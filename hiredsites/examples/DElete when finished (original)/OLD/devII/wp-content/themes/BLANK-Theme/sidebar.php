<div id="sidebar">
    
<ul>
			<!--applying the accordion menu to subpages-->
			<li id="subpages" class="widget widget_pages">
				<?php
				if($post->post_parent)
					$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0"); else
					$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
				if ($children) { ?>
					<ul>
						<?php echo $children; ?>
					</ul>
				<?php } ?>
			</li>

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
    	
    	<h2>Subscribe</h2>
    	<ul>
    		<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
    		<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
    	</ul>
	
	<?php endif; ?>

</div>