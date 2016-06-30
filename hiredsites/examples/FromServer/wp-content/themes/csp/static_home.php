<?php
/*
Template Name: Home
*/
get_header(); ?>
<!-- main box widget -->
<div id="main_home" class="widget">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>
<?php endwhile; ?>
</div>



<ul class="home">
<?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'home' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><div <?php post_class('widget_home'); ?>><?php $format = get_post_format( $category_name ); ?><h3 class=" title"><a onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';"  style="color:inherit; text-decoration:none;" href="http://cancerspokenhere.com/the_book">The Book</a></h3>
<span style="font-size:11pt;"><?php the_content();?></span></div></li>
<?php endforeach; ?>
</ul>


<!-- anything content -->

<ul <?php post_class('widget_news'); ?>><h3 class=" title"><a onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';"  style="color:inherit; text-decoration:none;" href="http://cancerspokenhere.com/news">News</a></h3><?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'news' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><strong class=" title"><?php the_title(); ?></strong><br/><span style="font-size:9pt;"><?php echo get_the_date(); ?><br/><br/></span><br/><?php the_excerpt();?><a href="<?php echo get_permalink(); ?>"><br/><br/> <span style="font-size:9pt;">Read More…</span></a>
</li><hr/>
<?php endforeach; ?>
</ul>



<div class="clear"></div>
<div>
<?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'events' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<ul <?php post_class('widget_events'); ?>><h3 class="title">Events</h3><?php $format = get_post_format( $category_name ); ?><li><strong class=" title"><?php the_title(); ?></strong><br/><br/><?php the_content();?></li></ul>
<?php endforeach; ?>
</div>


<?php get_footer('home'); ?>

