<?php
/*
Template Name: Static
*/
get_header(); ?>

<div id="main" class="widget">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h3 class="title"><?php the_title();?></h3>
<?php the_content(); ?>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>


