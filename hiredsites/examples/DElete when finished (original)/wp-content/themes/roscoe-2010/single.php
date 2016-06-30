<?php get_header(); ?>
	<div id="top-content-wrap"></div>
	<div id="content-wrap">
		<div id="page-wrap" class="container_16">
		<?php get_sidebar(); ?>
		
			<div id="post-wrap" class="push_1 grid_10 diary">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
					<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
						
						<h2><?php the_title(); ?></h2>
						
						<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
			
						<div class="entry">
			
							<?php the_content(); ?>
			
							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
							
							<?php the_tags( 'Tags: ', ', ', ''); ?>

						</div>
						
						<?php edit_post_link('Edit this entry'); ?>
					</div>
			
				<?php endwhile; endif; ?>
				<?php comments_template( '', true ); ?>	
			</div><!-- End Post Wrapper -->
			
			<div class="clear"></div>
		</div><!-- End Page-Wrapper -->
	</div><!-- End Content Wrapper -->
	<div id="bottom-content-wrap"></div>
<?php get_footer(); ?>