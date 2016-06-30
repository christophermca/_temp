<?php
/*
Template Name: Page Of Posts
*/

// if you are not using this in a child of Twenty Eleven, you need to replicate the html structure of your own theme.

get_header(); ?>
<div class="widget">
<div id="content" role="main">

<ul id="news"><h3 class="title">News</h3>
<?php
global $post;
$args = array( 'order'=>'DESC',  'category_name' => 'news' );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
	<li><strong class=" title"><span style="font-size:11pt;"><?php the_title(); ?></span><br/><span style="font-size:9pt;"><?php echo get_the_date(); ?></span>
</strong><br/><br/><?php the_content();?>
</li><span style="font-size:9pt;"><?php edit_post_link(); ?></span><hr/>

<?php endforeach; ?>
</ul>

</div>
</div>

<?php get_footer();


