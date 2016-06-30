<?php get_header(); ?>
	
<div id="top-content-wrap"></div>	
<div id="content-wrap">	
	<div id="page-wrap" class="container_16">
	
		<?php get_sidebar(); ?>
		
		<div id="post-wrap" class="grid_11 push_1">
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<div class="post" id="post-<?php the_ID(); ?>">
		
					<div class="entry">
		
						<?php the_content(); ?>
		
						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		
					</div>
		

		
				</div>
		
				<?php endwhile; endif; ?>

		</div><!-- END Post-WRAP -->
		<div id="clear"></div>
	</div><!-- END Page-WRAP -->
	
</div><!-- END Content-WRAP -->

<div id="bottom-content-wrap"></div>

<?php get_footer(); ?>
