<?php
/*
Template Name: Info Page
*/

get_header(); ?>

<div id="top-content-wrap"></div>

<div id="content-wrap">	

	<div id="page-wrap" class="container_16 ">
	
	<?php get_sidebar(); ?>
	
		<div id="post-wrap" class="grid_12 push_1 info">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					<div class="post" id="post-<?php the_ID(); ?>">
			
						<div class="entry">
			
							<?php the_content(); ?>
			
							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			
						</div>
			
					</div>
			
			<?php endwhile; endif; ?>
			
		</div><!-- End Post Wrapper -->
		
		<div class="clear"></div><!-- Needs to Clear to fill min-height -->
		
	</div><!-- End Page-Wrapper -->
	
</div><!-- End Content Wrapper -->

<div id="bottom-content-wrap"></div>

<?php get_footer(); ?>