<!-- begin footer -->

</div>

<div style="clear:both;"></div>

<div id="footer">

	<div class="footerleft">
		<h2>Recently Written</h2>
			<ul>
				<?php get_archives('postbypost', 10); ?>
			</ul><br />
			
		<h2>Monthly Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
	</div>
	
	<div class="footermiddle">
	
		
		<h2>Categories</h2>
			<ul>
				<?php wp_list_cats('sort_column=name'); ?>
			</ul><br />
				
		<h2>Blogroll</h2>
			<ul>
				<?php get_links(-1, '<li>', '</li>', ' - '); ?>
			</ul>
	</div>
	
	<div class="footerright">
		<h2>Admin</h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://wordpress.org/">WordPress</a></li>
				<?php wp_meta(); ?>
				<li><a href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
			</ul>
			
		<h2>Credits</h2>
	  <p><a href="http://performancing.com">Performancing</a>'s <a href="http://themes.performancing.com">Photopress theme</a> is a <a href="http://fusilly.com">Funny T-Shirt</a> Production designed by <a href="http://www.briangardner.com">Brian Gardner</a>.
			</p>
	</div>
		
</div>

<?php do_action('wp_footer'); ?>

</body>
</html>