<?php
/*
Template Name: PageOfPosts
*/

get_header(); ?>

<div id="top-content-wrap"></div>

<div id="content-wrap">	

	<div id="page-wrap" class="container_16">
	
		<?php include ('sidebar-blog.php'); ?>
		
		<div id="post-wrap" class="push_1 grid_10 diary">
			
			<!-- Searches for Applicable Category -->
			<?php
			if (is_page() ) {
			$category = get_post_meta($posts[0]->ID, 'category', true);
			}
			if ($category) {
			  $cat = get_cat_ID($category);
			  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			  $post_per_page = 3; // -1 shows all posts
			  $do_not_show_stickies = 1; // 0 to show stickies
			  $args=array(
			    'category__in' => array($cat),
			    'orderby' => 'date',
			    'order' => 'DESC',
			    'paged' => $paged,
			    'posts_per_page' => $post_per_page,
			    'caller_get_posts' => $do_not_show_stickies
			  );
			  $temp = $wp_query;  // assign orginal query to temp variable for later use   
			  $wp_query = null;
			  $wp_query = new WP_Query($args); 
			  
			  if( have_posts() ) : 
					while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				    
				    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			        
				        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				        
				        <p class="date"><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></p>
				        
				        <div class="entry">
				        
				          <?php the_content('Read the rest of this entry'); ?>
				        
				        </div>
				        
				        <!--<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?></p>-->
			      
			      </div>
			    
			    <?php endwhile; ?>
			    
			    <!-- Multi Page Navigation -->
			    <div class="navigation">
			      <div class="alignleft"><?php next_posts_link('Older Entries') ?></div>
			      <div class="alignright"><?php previous_posts_link('Newer Entries') ?></div>
			    </div>
			    
			  <?php else : ?>
					<!-- 404 Error -->
					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php get_search_form(); ?>
			
				<?php endif; 
				
				$wp_query = $temp;  //reset back to original query
				
			}  // if ($category)
			?>
			
		</div><!-- End Post Wrapper -->
		<div class="clear"></div><!-- Needs to Clear to fill min-height -->
	</div><!-- End Page-Wrapper -->
</div><!-- End Content Wrapper -->

<div id="bottom-content-wrap"></div>

<?php get_footer(); ?>