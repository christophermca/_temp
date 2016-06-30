<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<div class="widget_blog"n style="absolute">
	<div id="content" role="main">
		<div id="leftside" class="floatlt">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<!-- 
						<nav>
							<?php //previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
							<?php// next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
						</nav>
				  -->
						

						<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

							<div id="header">
								<strong><?php the_title(); ?></strong>
								
								<?php// starkers_posted_on(); ?>
							</div>
							<br/>
							<?php the_content(); ?>
						</div>
		</div><!-- end Leftside -->
<!-- 
===============================================

Used for Blog Archiving

===============================================
-->


						<div id="rightside" class="floatrt">
						<ul>
						
						    <li><?php get_search_form();?></li>
						    
						<li><?php get_sidebar('primary_widget_area'); ?></li>
						
						</ul>
						
						</div><!-- END rightside-->
<div class="clear"></div>
	</div><!-- END content -->


			<?php comments_template( '', true ); ?>
					
			<?php// wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
		
			<?php //if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<?php //echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 60 ) ); ?>
				<h2><?php// printf( esc_attr__( 'About %s', 'starkers' ), get_the_author() ); ?></h2>
				<?php// the_author_meta( 'description' ); ?>
				<!--	<a href="<?php //echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<?php// printf( __( 'View all posts by %s &rarr;', 'starkers' ), get_the_author() ); ?>
					</a>-->
			<?php //endif; ?>
			
		<!-- 	<div id="footer">
				<?php //starkers_posted_in(); ?>
				<?php edit_post_link( __( 'Edit', 'starkers' ), '', '' ); ?>
			</div>
				
		</article>
 
		<nav>
			<?php //previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
			<?php// next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
		</nav>
-->
		<?php// comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>