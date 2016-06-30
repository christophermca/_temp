<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

<div class="widget_blog">

	<div id="content" role="main">
		<div id="leftside" class="floatlt">

<?php if ( have_posts() ) : ?>
		<h1><?php printf( __( 'Search Results for: %s', 'starkers' ), '' . get_search_query() . '' ); ?></h1>
			<?php
				get_template_part( 'loop', 'search' );
			?>
<?php else : ?>
		<h2 style="margin-bottom:25px;"><?php _e( 'Nothing Found', 'starkers' ); ?></h2>
			<p style="margin-bottom:40px;"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'starkers' ); ?></p>
			<?php get_search_form(); ?>
<?php endif; ?>

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

</div>
<div class="clear"></div>

	</div><!-- end content -->
</div><!-- end widget -->

<?php get_footer(); ?>