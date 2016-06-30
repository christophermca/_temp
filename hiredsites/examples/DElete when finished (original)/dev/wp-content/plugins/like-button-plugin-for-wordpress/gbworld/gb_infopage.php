<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	GB-World-INFOPAGE [v1.5] - Edition: For Like-Button-Plugin-For-Wordpress
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-Wordpress-Plugins 2.7.x or higher
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       gb-INFOPAGE			 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

if (!class_exists('gxtb_infoPageClass')) {
class gxtb_infoPageClass {

########################################################################################################
											## CONSTRUCTOR  ##
// Newsbox-Array
var $gxtb_infoPageClassArray;
// Newsbox-Array

function gxtb_infoPageClass($gxtb_InfoPageArray) {

	global $gxtb_infoPageClassArray;

	add_action('admin_menu', array(&$this, 'on_admin_menu'));

	$optionpagename[0] = 'gb-world';
	$optionpagename[1] = 'gb-news';
	
	if ($_GET['page'] == $optionpagename[0] || $_GET['page'] == $optionpagename[1]) { $ismypluginoptionpage = 'true'; } else { $ismypluginoptionpage = 'false'; }
		 
	if ( $ismypluginoptionpage == 'true' )
		add_action('admin_head', array(&$this, 'gxtb_world_header'));

	foreach($gxtb_InfoPageArray as $key => $value) { 
		$this -> gxtb_infoPageClassArray[$key] = $value;
	}
	
}

function gxtb_world_header() {

$gxtb_info_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
echo '<link rel="stylesheet" href="'. $gxtb_info_path . 'css/gbworld.css" type="text/css" media="screen" />';
wp_print_scripts( array( 'sack' ));
if( version_compare($GLOBALS['wp_version'], '2.7.999', '>') ) {
?>
<script type="text/javascript">
var clos_ajaxurl = ajaxurl;
</script>
<?php
} else {
?>
<script type="text/javascript">
var clos_ajaxurl = "<?php echo $this->_esc_js( get_bloginfo( 'wpurl' ) . '/wp-admin/admin-ajax.php' ); ?>";
</script>
<?php
}
if ($_GET['page'] == 'gb-world') { echo '<script type="text/javascript" src="'. $gxtb_info_path . 'gbworld.js"></script>'; } 

}

function on_admin_menu() {

$gxtb_info_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

	## ADD gxtb-Infopage ##
	global $wp_version;
		
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
		$this->pagehook = add_menu_page('GB-World', "GB-World", 'read', 'gb-world', array(&$this, 'gxtb_info'), $gxtb_info_path .'images/admin.png');
	} elseif ( version_compare( $wp_version, '2.8', '<' ) ) {
		$this->pagehook = add_menu_page('GB-World', "GB-World", 0, 'gb-world', array(&$this, 'gxtb_info'), $gxtb_info_path .'images/admin.png');
	}

	## Add SubMenu-Pages in version 4.5 at this point!
	#$this->pagehook = add_submenu_page("fb-like-button2", 'General', 'General', 0, 'fb-like-button2', array(&$this, 'gxtb_news'));
	## ADD gxtb-Infopage ##
	
}

########################################################################################################
											## gxtb-WORLD INFOPAGE 0.5 ##


function gxtb_info() {

	## Like-Box
  	add_meta_box('gxtb_world_like_box', 'GB-World on Facebook', array(&$this, 'gxtb_initialize_fb_box'), $this->pagehook, 'like', 'core');

	## Supporter-Box
  	add_meta_box('gxtb_world_supporter', 'GB-World-Supporter', array(&$this, 'gxtb_initialize_supporter'), $this->pagehook, 'feed_supporter', 'core');

	## Feed-Reader
  	add_meta_box('gxtb_world_feed_news', 'GB-World-Wordpress-News', array(&$this, 'gxtb_initialize_feed_news'), $this->pagehook, 'feed_news', 'core');
  	add_meta_box('gxtb_world_feed_wp', 'GB-World.net', array(&$this, 'gxtb_initialize_feed_wp'), $this->pagehook, 'feed_wp', 'core');	

	## Installed Plugins
  	add_meta_box('gxtb_world_plugin_box', 'installed GB-World-Plugins', array(&$this, 'gxtb_initialize_plugins'), $this->pagehook, 'plugins', 'core');

	## Paypal-Box
	add_meta_box('gxtb_world_paypalbox', 'Please support GB-World.net', array(&$this, 'gxtb_initialize_infobox'), $this->pagehook, 'additional', 'core');
	
	// NewsBox
	add_meta_box('gxtb_world_newsbox', 'GB-News', array(&$this, 'gxtb_initialize_newsbox'), $this->pagehook, 'additional', 'core');

	// liest die Feeds der GB-World.net aus
	require_once( dirname(__FILE__) .'/gb_feedreader.php' );
?>

<div class="wrap"><div id="gb_world">

<h2><a class="gb_world_header" href="http://www.gb-world.net" target="_blank">GB-World.net</a></h2>

    <div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                
            <div id="poststuff" class="metabox-holder" style="width: 100%;">
            
                    <!-- Content -->
                        <div id="post-body" class="has-sidebar">
                            <div id="post-body-content" class="has-sidebar-content" style="width:80%">
                                 
                                 <table>
                                 <tr>
								 	<td valign="top" colspan="2" align="center">
									
										<table>
										<tr>
											<td>
												<?php  $this -> gxtb_initialize_fb_box(); ?>
												<br /><br />
												<?php $gxtb_info_path = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); ?>
												<a href="http://www.gb-world.net" target="_blank"><img src="<?php echo $gxtb_info_path; ?>images/banner.gif" class="gb_world"/></a>
											</td>
										</tr>
										<tr>
										<td height="30px"></td>
										</tr>
										<tr>
											<td>
											<?php do_meta_boxes($this->pagehook, 'feed_supporter', ""); ?>
											</td>
										</tr>
										</table>
										
                                 	</td>
									
									<td width="25px">
									
									</td>
								 
								 <td valign="top" rowspan="3">
                                 <?php //do_meta_boxes($this->pagehook, 'like', ""); ?>
                                 
								 
                                 <table width="100%">
                                 <tr>								 
									 <td valign="top">
										<?php do_meta_boxes($this->pagehook, 'feed_news', ""); ?>
									 </td>
									 
									 <td valign="top">
										<?php do_meta_boxes($this->pagehook, 'feed_wp', ""); ?>
									 </td>
                                 </tr>
                                 </table>
								 
                                 <?php do_meta_boxes($this->pagehook, 'plugins', ""); ?>
								 <?php do_meta_boxes($this->pagehook, 'additional', ""); ?> 
                                 </td>
								 
                                 </tr>
                                 </table>                 
                                 
                            </div>
                        </div>
                    <!-- /Content -->
                    <div class="gxtb-clearer"/>	</div>
            </div>
    </div>

</div></div>
	
<?php $this -> gxtb_infopage_java();

} 

## Facebook-Like-Box
function gxtb_initialize_fb_box() {
	
	if (!class_exists('gxtb_FBClass')) {
		// dies ist die Facebook-Like-Box
		require_once( dirname(__FILE__) .'/gb_fb_box.php' ); 
		$gxtb_FBClass = new gxtb_FBClass();
		$gxtb_FBClass -> gxtb_get_box();
	}
	
}
## PayPal-Box
function gxtb_initialize_infobox() {
	
	// initialize the newsbox now in the main-plugin-file (since v3.0)
	//require_once(dirname(__FILE__) .'/gb_paypal.php');
	
	$this -> gxtb_infoPageClassArray['Infopage'] = 1;
	$gxtb_NewsPClass = new gxtb_NewsPClass($this -> gxtb_infoPageClassArray);
	
}
## News-Box
function gxtb_initialize_newsbox() {
	
		// global gxtb-Variable
		global $gxtb_fb_like_button_active;
		global $gxtb_fb_lB_path;

		//require_once(dirname(__FILE__) .'\gb_newsbox.php');
		
		// Newsbox-Array
		$gxtb_NewsClass_iArray = array(
			"active" => $gxtb_fb_like_button_active,
			"language" => "gb_like_button",
			"name" => gxtb_fb_lB_name,
			"version" => gxtb_fb_lB_version,
			"def" => "Plugin"
		);
		
		$gxtb_NewsClass = new gxtb_NewsClass($gxtb_NewsClass_iArray);
}
## Feed-Reader
function gxtb_initialize_feed_news() {

	// dies ist die Feed-Reader-Klasse - Teil I
	$gxtb_FRClass = new gxtb_FRClass();
	$gxtb_FRClass -> gxtb_reader(0);
}

function gxtb_initialize_feed_wp() {

	// dies ist die Feed-Reader-Klasse - Teil II
	$gxtb_FRClass = new gxtb_FRClass();
	$gxtb_FRClass -> gxtb_reader(1);
}

## Installed Plugins
function gxtb_initialize_plugins() {

// Variable die die Page-Identity ausgibt
$gxtb_world_plugins_page = array(
	"Like-Button-Plugin-For-Wordpress" => "fb-like-button",
	"Jump-Page" => "jump-page-settings",
	"iPhone-WebApp-Redirection" => "webapp_gb"
	);

	$gb_world_plugins = get_option('gb_world_plugins');
	$blogurl = get_bloginfo('url');

if($gb_world_plugins != "") {

  echo "<ul class='gb_world_plugins' id='gb_world_plugins'>";
	foreach($gb_world_plugins as $key => $value) {
	
		if ($value != "" && $value != 0 && $value != 1) {
			echo "<li>";
			echo "<a href='options-general.php?page=";
			echo $gxtb_world_plugins_page[$key];
			echo "'>";
			echo $key . " - ";
			echo "[v" . $value . "]</a>";
			echo "</li>";
		}
	}
  echo "</ul>";
  
} else {

  echo "<ul class='gb_world_plugins' id='gb_world_plugins'>";
		echo "<li>";
		_e('You have no GB-World-Plugins installed yet', 'gb_like_button');
		echo ".";
 		echo "</li>"; 
  echo "</ul>";
}

}

function gxtb_initialize_supporter () {

	require_once( dirname(__FILE__) .'/gb_ad.php' );
	gxtb_AD::gxtb_addAD();
}

											## gxtb-WORLD INFOPAGE 1.5 ##
########################################################################################################


########################################################################################################
											## gxtb-NEWS-BOX 2.5  ##
// currently out of work - löschen?

function gxtb_news() {
	
  	add_meta_box('gxtb_world_newsbox', 'GB-News', array(&$this, 'gxtb_initialize_newsbox'), $this->pagehook, 'additional', 'core');
	
?>

<div class="wrap"><div id="gb_world">
		<h2>GB-News</h2>

	<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
	<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>

<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
            
<!-- <form method="post"> -->
		<div id="poststuff" class="metabox-holder" style="width: 100%;">

				<!-- Sidebar -->
				<div id="side-info-column" class="inner-sidebar">
				
					<?php do_meta_boxes($this->pagehook, 'side', ""); ?>
					
				</div>
				<!-- /Sidebar -->
				
				<!-- Content -->
					<div id="post-body" class="has-sidebar">
						<div id="post-body-content" class="has-sidebar-content">
							<?php do_meta_boxes($this->pagehook, 'additional', ""); ?>
						</div>
					</div>
				<!-- /Content -->
					
				<br class="clear"/>	
		</div>
</div>

</div></div>
	
<?php $this -> gxtb_infopage_java();
} 


											## gxtb-NEWS-BOX 2.5  ##
########################################################################################################


function gxtb_infopage_java() {
?>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		<?php
		global $wp_version;
		if(version_compare($wp_version,"2.7-alpha", "<")){
			echo "add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.6 and below
		}
		else{
			echo "postboxes.add_postbox_toggles('" . $this->pagehook . "');"; //For WP2.7 and above
		}
		?>
	
			});
			//]]>
	</script>

<?php
}

} // end class
} // end if-class ?>