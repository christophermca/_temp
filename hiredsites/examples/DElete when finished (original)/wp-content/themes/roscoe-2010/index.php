<?php get_header(); ?>
<div id="top-content-wrap"></div>	
<div id="content-wrap">	
	
	
	<div id="posts-wrap" class="container_16">

	
	
	
			<?php get_sidebar(); ?>
			
		<div id="badges" class="grid_4">
		<ul>
		<li><img src="http://www.dawnephoto.com/wp-content/themes/roscoe-2010/style/images/as-seen-on-design.jpg" />
		</li>
		<li><img src="http://www.dawnephoto.com/wp-content/themes/roscoe-2010/style/images/As-seen-SMP.jpg" />
		</li>
		</ui>
		</div>
				
			<div id="post-wrap" class="grid_11 pull_2">
			
			
				
					<div id="kimili-home">[kml_flashembed publishmethod="static" fversion="8.0.0" movie="http://dawnephoto.com/dev/wp-content/themes/roscoe-2010/SSP/home" width="750" height="530" targetclass="flashmovie" quality="high" wmode="transparent"]

<a href="http://adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>

[/kml_flashembed]</div>


				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div class="hide"<?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				</div>
			</div>
		<?php endwhile; ?>
	
		<?php include (TEMPLATEPATH . '/inc/nav.php' ); ?>
	
		<?php else : ?>
	
			<h2>Not Found</h2>
	
		<?php endif; ?>
	</div><!-- END POSTS-WRAP -->
</div> <!-- END CONTENT-WRAP -->
<div id="bottom-content-wrap"></div>	


<?php get_footer(); ?>
