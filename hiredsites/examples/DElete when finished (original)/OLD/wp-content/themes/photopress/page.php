<?php get_header(); ?>

<div id="contenttop"></div>

<div id="content">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
	<?php the_content(__('Read more'));?><div style="clear:both;"></div><br /><br />
			
	<!--
	<?php trackback_rdf(); ?>
	-->
			
	<?php endwhile; else: ?>
				
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
					
</div>

<div id="contentbottom"></div>

<!-- The main column ends  -->

<?php get_footer(); ?>