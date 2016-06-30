<?php
/*
Template Name: Resources
*/
get_header(); ?>

<div id="main" class="widget">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<h3 class="title"><?php the_title();?></h3>
<?php the_content(); ?>
<?php endwhile; ?>
</div>

<?php $args = array(
    'category_name'    => 'websites',
    'categorize'	   => 1,
    'title_before'     => '<h3>',
    'title_after'      => '</h3',
    'order_by'  	   => 'rand',
    'class'            => 'linkcat',
    'category_before'  => '<h3>',
    'category_after'   => '</h3>' ); ?>

	<div <?php post_class('widget linkcat'); ?> <?php wp_list_bookmarks( $args ); ?> 
	
	</div>

<ul>
<?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'resources' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><div <?php post_class('widget'); ?>><?php $format = get_post_format( $category_name ); ?><h3 class="title"><?php the_title(); ?></h3><?php the_content();?></div></li>
<?php endforeach; ?>
</ul>

<?php get_footer(); ?>

