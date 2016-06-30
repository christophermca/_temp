<?php get_header(); ?>

<div id="contenttop"></div>

<div id="content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<p><?php the_time('F j, Y'); ?> | Filed Under <?php the_category(', ') ?>&nbsp;<?php edit_post_link('(Edit Post)', '', ''); ?></p>
			
	<?php the_content(__('Read more'));?><div style="clear:both;"></div>
			
	<!--
	<?php trackback_rdf(); ?>
	-->
			
	<h1>Comments</h1>
	<?php comments_template(); // Get wp-comments.php template ?><div style="clear:both;"></div>
			
	<?php endwhile; else: ?>
				
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
					
</div>

<div id="contentbottom"></div>

<!-- The main column ends  -->

<?php get_footer(); ?>