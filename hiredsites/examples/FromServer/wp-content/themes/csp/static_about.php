<?php
/*
Template Name: About
*/
get_header(); ?>

<div id="main" class="widget">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h3 class="title"><?php the_title();?></h3>
<?php the_content(); ?>
<?php endwhile; ?>
</div>
<?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'about' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li style="list-style-type:none;"><div <?php post_class('widget'); ?>><?php $format = get_post_format( $category_name ); ?><h3 class="title"><?php the_title(); ?></h3><?php the_content();?></div></li>
<?php endforeach; ?>
</ul>




<?php get_footer(); ?>

