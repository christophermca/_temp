<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div class="widget_blog">
	<div id="content" role="main">
		<div id="leftside" class="floatlt">
<?php
	if ( have_posts() )
		the_post();
			the_content()
?>

			<h1>
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: %s', 'starkers' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: %s', 'starkers' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: %s', 'starkers' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'starkers' ); ?>
<?php endif; ?>
			</h1>

<?php
	rewind_posts();

	get_template_part( 'loop', 'archive' );
?>
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

<?php get_footer(); ?>