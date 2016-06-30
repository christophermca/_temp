<?php
/*
Template Name: Archives
*/

get_header(); ?>

<div id="top-content-wrap"></div>

<div id="content-wrap">	

	<div id="page-wrap" class="container_16">
	
		<?php include ('sidebar-blog.php'); ?>
		
		<div id="post-wrap" class="push_1 grid_10 diary">
			
					<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2>Archive for <?php the_time('F, Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="pagetitle">Author Archive</h2>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle">Blog Archives</h2>
			
			<?php } ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>


			<?php query_posts('cat=Blog&posts_per_page=3'); while (have_posts()) : the_post(); ?>
    
		    <div <?php post_class() ?>>
		    
		        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						        
		        <p class="date"><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></p>
		        
		        <div class="entry">
					<?php the_excerpt() ?>
		        </div>
					<p class="postmetadata"><?php comments_popup_link('No Comments �', '1 Comment �', '% Comments �'); ?></p>      
			</div>
			
			<?php endwhile; ?>

			<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
			
			<?php else : ?>
		
				<h2>Nothing found</h2>
		
			<?php endif; ?>
			
		</div><!-- End Post Wrapper -->
		<div class="clear"></div><!-- Needs to Clear to fill min-height -->
	</div><!-- End Page-Wrapper -->
</div><!-- End Content Wrapper -->

<div id="bottom-content-wrap"></div>

<?php get_footer(); ?>