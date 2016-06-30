
<?php
/*
Template Name: success/cancel
*/
get_header(); ?>

<div id="main" class="widget">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div style="margin:0px auto;width:800px;height:50px; text-align:center; margin-top:20%; position:relative;">
	<?php the_content(); ?>
	</div>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>

