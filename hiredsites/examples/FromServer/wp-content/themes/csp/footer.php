<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>

	
	<div id="footer"><hr noshade="noshade"/>
	
<table class="footcon">
<td style="text-align:left;">
<div style=" float:left;"><?php  dynamic_sidebar('first-footer-widget-area'); ?></div>
<div style="float:right;"><?php dynamic_sidebar( 'second-footer-widget-area' );?></div>
</td>
<td class="contact" style="text-align:right;">
<?php dynamic_sidebar( 'third-footer-widget-area' );?>
</td>

</table>
		
		

		<?php //do_action( 'starkers_credits' ); ?>
		
		<!-- <a href="<?php //echo esc_url( __('http://wordpress.org/', 'starkers') ); ?>" title="<?php// esc_attr_e('Semantic Personal Publishing Platform', 'starkers'); ?>" rel="generator"> </a> -->

	</div><!-- end footer -->
	</div><!-- end page-wrap -->
	</div><!-- end container -->
	<div id="sticky">
		<div id="sticky_txt"><?php dynamic_sidebar('fourth-footer-widget-area')?></div>
	</div><!-- end sticky -->
<script src="<?php bloginfo('template_directory'); ?>/js/lib/jquery-1.4.2.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/lib/jcarousel/lib/jquery.jcarousel.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>



	<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>


</body>
</html>