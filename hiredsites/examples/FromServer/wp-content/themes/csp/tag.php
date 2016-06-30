<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

<div class="widget_blog">
	<div id="content" role="main">
		<div id="leftside" class="floatlt">
			<ul id="Blog"><h3 class="title">
			<?php printf( __( 'Tag Archives: %s', 'starkers' ), '' . single_tag_title( '', false ) . '' );
		?></h3>

<?php
 get_template_part( 'loop', 'tag' );
?>

	
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
<div class="clearrt"></div>

	</div><!-- end content -->
</div><!-- end widget -->


<!-- 
===============================================

Footer is below

===============================================
-->


<?php get_footer(); ?>

