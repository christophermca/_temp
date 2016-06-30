<?php

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * twentyten_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
	
?>

<!--this is the png thing -->
<style type="text/css">
img, div { behavior: url(iepngfix.htc) }
</style>

<style type="text/css">
img, div, a, input { behavior: url(/iepngfix.htc) }
</style>
<script type="text/javascript" src="iepngfix_tilebg.js"></script>
<!-- END OF THE PNG THING  -->

</script>


<link href='http://fonts.googleapis.com/css?family=Philosopher' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lekton' rel='stylesheet' type='text/css'>

</head>

<body>

<div id="page-wrap">
	<div class="header">
	<div id='menu'>
				<ul id="nav">
					<li ><a  class='bttn'href="<?php echo home_url( '/' ); ?>">Home</a></li>
					<li ><a  class='bttn'href="/portfolio/">Portfolio</a></li>
					<li ><a  class='bttn'href="/resume/">Resume</a></li>
					<li ><a  class='bttn'href="/contact/">Contact</a></li>
					<li ><a  class='bttn'href="/blog/">Blog</a></li>
				</ul>
		<div class="name">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
	</div>		
	</div>

	
				

	