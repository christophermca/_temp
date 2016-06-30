<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<div class="widget_blog">
	<div id="content" role="main">
		<div id="leftside" class="floatlt">
			<ul id="Blog"><h3 class="title">
			<?php printf( __( 'Archives', 'Starkers' ), '<span>' . single_cat_title( '', false ) . '</span>' );?></h3>


		<div id="container">
			<div id="content" role="main">

				
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->

		</ul>
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


<!-- 
===============================================

Footer is below

===============================================
-->


<?php get_footer(); ?>


<?php get_footer(); ?>
