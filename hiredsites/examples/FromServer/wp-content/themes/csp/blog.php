<?php
/*
Template Name: Blog
*/

// if you are not using this in a child of Twenty Eleven, you need to replicate the html structure of your own theme.

get_header(); ?>

<div class="widget_blog">
	<div id="content" role="main">
		<div id="leftside" class="floatlt">
			<ul id="Blog"><h3 class="title">Blog</h3>
					<?php
						global $post;
						$args = array( 'order'=>'DESC',  'category_name' => 'Blog' );
						$myposts = get_posts( $args );
						foreach( $myposts as $post ) :	setup_postdata($post); ?>
							<li>
							<!-- Title + Date -->
								<strong class="title">
									<span style="ftsize11">
										<?php the_title(); ?>
									</span>
										<br/>
										    <span class="ftsize9">
										    		<?php echo get_the_date(); ?>
										    </span>
									</strong>
								<!-- content-->
										<br/><br/>
										<?php the_content();?>
							<div class="comment_links">
							               <?php comments_popup_link( __( 'Be the first to comment' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>
                <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>
                </div>
</li>
					
					<?php endforeach; ?>
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

