<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
 
    global $page, $paged;
 
    wp_title( '|', true, 'right' );
 
    bloginfo( 'name' );
 
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie7.css">
<![endif]-->

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
 
<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>









<link rel="stylesheet" href="../fontface/stylesheet.css"/>
<script src="<?php bloginfo('template_directory'); ?>/js/lib/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
 //Insert Jquery below
 

 

 
 
 
 
 
 
 });



</script>

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


</head>
 
<body <?php body_class(); ?>>
<div id="container">
 <div id="headers">
 <div id="header_bkg">
    <div id="header_container">
 
 

 <ul style="margin:0px auto" id="alt_nav" class="iealt_nav menu-nav-container">
 
 <li class="floatlt">
 <div> 
 <a href="http://www.cancerspokenhere.com/home"  onMouseOver="SwapOut()" onMouseOut="SwapBack()">HOME<br/><img name="navhome" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px"/>
 <br/><span class="type_o">kan-ser</span></a>
 </div>

 </li>
 
 
 <li style="margin-left:-10px;"><div><a href="http://www.cancerspokenhere.com/about" onMouseOver="SwapOut_about()" onMouseOut="SwapBack_about()">ABOUT<br/><img name="navabout" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">dahy-uhg-noh-sis</span></a>
 </div>
 </li>
 
 <li style="width:250px;margin-left:-25px;" >
 <div>
 <a href="http://www.cancerspokenhere.com/book" onMouseOver="SwapOut_book()" onMouseOut="SwapBack_book()">THE BOOK<br/><img name="navbook" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">mem-wahr</span></a>
 
 </div>
 </li>
  
 <li style="margin-left:-20px;" >
 <div>
 <a href="http://www.cancerspokenhere.com/products" onMouseOver="SwapOut_prod()" onMouseOut="SwapBack_prod()">PRODUCTS<br/><img name="navproducts" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">uh-par-uhl</span></a>
 </div>
 </li>
 
 
 <li class="ienav floatrt">
 <div>
 <a href="http://www.cancerspokenhere.com/resources" onMouseOver="SwapOut_res()" onMouseOut="SwapBack_res()">RESOURCES<br/><img name="navres" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">pey-shuhnt & kair-giv-er</span></a>
 </div>
 </li>
 

 </ul>

 
 
 
 <!--=====================================================WITH BLOG
 <ul id="alt_nav" class="iealt_nav menu-nav-container">
 
 <li class="floatlt">
 <div> 
 <a href="http://www.cancerspokenhere.com/home"  onMouseOver="SwapOut()" onMouseOut="SwapBack()">HOME<br/><img name="navhome" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px"/>
 <br/><span class="type_o">kan-ser</span></a>
 </div>

 </li>
 
 
 <li style="margin-left:-50px;"><div><a href="http://www.cancerspokenhere.com/about" onMouseOver="SwapOut_about()" onMouseOut="SwapBack_about()">ABOUT<br/><img name="navabout" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">dahy-uhg-noh-sis</span></a>
 </div>
 </li>
 
 <li style="margin-left:-40px;" >
 <div>
 <a href="http://www.cancerspokenhere.com/book" onMouseOver="SwapOut_book()" onMouseOut="SwapBack_book()">THE BOOK<br/><img name="navbook" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">mem-wahr</span></a>
 
 </div>
 </li>
 
   <li style="margin-left:-40px">
 <div>
 <a href="http://www.cancerspokenhere.com/blog" onMouseOver="SwapOut_blog()" onMouseOut="SwapBack_blog()">BLOG<br/><img name="navblog" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">dahy-uh-ree</span></a>
 </div>
 </li>
 
 <li style="margin-left:-40px;" >
 <div>
 <a href="http://www.cancerspokenhere.com/products" onMouseOver="SwapOut_prod()" onMouseOut="SwapBack_prod()">PRODUCTS<br/><img name="navproducts" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">uh-par-uhl</span></a>
 </div>
 </li>
 
 
 <li class="ienav floatrt">
 <div>
 <a href="http://www.cancerspokenhere.com/resources" onMouseOver="SwapOut_res()" onMouseOut="SwapBack_res()">RESOURCES<br/><img name="navres" src="<?php bloginfo( 'template_url' ); ?>/images/nav/ribbons.png" width="64px" height="22px" /><br/><span class="type_o">pey-shuhnt & kair-giv-er</span></a>
 </div>
 </li>
 

 </ul>
 -->
 
        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php. 
         The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <?php /* wp_nav_menu( array( 'container' => 'div', 'after' => '<img src="http://www.cancerspokenhere.com/wp-content/themes/csp/images/nav/ribbons.png" />'   ) ); */?> 
         <!--END header_container -->  </div>
  </div> <!--END header_header_bkg --> 
 <div id="bot_header_bkg">
    <div id="bot_header_container">

        <div class="floatlt" id="logo_con"><span></span>Stronger<br/> <span class="tabcc"></span>Together<br/><span class="tabii"></span>Than<br/><span class="tabkk"></span>Alone</div></li>
  <div class="bordered ie7img"><img src="<?php bloginfo( 'template_url' ); ?>/images/logo.jpg" width="470px" height="117px" vspace="70"/></div>
<!-- <li><span></span>Stronger<br/> <span class="taba"></span>Together<br/><span class="tabb"></span>Then<br/><span class="tabc"></span>Along</li><br/>-->    
   <div class="floatrt"id="logo_conrt">
   <p>Believe<br/>
	<span class="tabdd"></span>Faith<br/>
		<span class="tabgg"></span>Inspire<br/>
			<span class="tabll"></span>Cure</p></div>
   
    
    <!--END bot_header_container -->  </div>
  </div> <!--END bot_header_header_bkg -->
  </div>
  <div class="clear"></div>
  <div id="page-wrap">
