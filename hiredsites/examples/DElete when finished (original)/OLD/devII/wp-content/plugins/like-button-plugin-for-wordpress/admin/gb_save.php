<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/
####################################################
####################################################
###########								 ###########
###########								 ###########
###########	       SAVE-METHOD			 ###########
###########								 ###########
###########								 ###########
####################################################
####################### by gb-world.net ############
####################################################

if ( isset($_POST['fbsubmit']) && check_admin_referer('fb-like-button') && $_POST['fb_like_hidden'] && $_POST['fb_like_hidden'] == 'update' ) {
	
########################################################################################################
											## SETTINGS  ##
if($_GET['page'] == "fb-like-button") {

			$settings = array();
			#$settings = get_option('gxtb_fb_lB_settings');
			
		## INFO: alle Optionen anderst speichern! Damit auch die Checkboxen wieder gespeichert werden!
		## http://aktuell.de.selfhtml.org/artikel/php/checkboxen/	
					
		#if(isset($_POST['gxtb_fb_lB_activate'])){ $settings['activate']=$_POST['gxtb_fb_lB_activate']; }
		if(	isset($_POST['gxtb_fb_lB_activate']) && ($_POST['gxtb_fb_lB_activate']>0) ){ $settings['activate']=$_POST['gxtb_fb_lB_activate']; }
					
		if ( isset( $_POST['gxtb_fb_lB_jdk'] ) )
			$settings['JDK'] = $_POST['gxtb_fb_lB_jdk'];
			
		if ( isset( $_POST['gxtb_fb_lB_shortcode'] ) )
			$settings['shortcode'] = $_POST['gxtb_fb_lB_shortcode'];

		if ( isset( $_POST['gxtb_fb_lB_position_before'] ) )
			$settings['position_before'] = $_POST['gxtb_fb_lB_position_before'];

		if ( isset( $_POST['gxtb_fb_lB_position_after'] ) )
			$settings['position_after'] = $_POST['gxtb_fb_lB_position_after'];
	
		if ( isset( $_POST['gxtb_fb_lB_addfooter_activate'] ) )
			$settings['addfooter_activate'] = $_POST['gxtb_fb_lB_addfooter_activate'];

		if ( isset( $_POST['gxtb_fb_lB_addfooter'] ) )
			$settings['addfooter'] = $_POST['gxtb_fb_lB_addfooter'];

		if ( isset( $_POST['gxtb_fb_lB_frontpage'] ) );
			$settings['frontpage'] = $_POST['gxtb_fb_lB_frontpage'];
			
		if ( isset( $_POST['gxtb_fb_lB_page'] ) )
			$settings['page'] = $_POST['gxtb_fb_lB_page'];

		if ( isset( $_POST['gxtb_fb_lB_page_exclude'] ) )
			$settings['page_exclude'] = $_POST['gxtb_fb_lB_page_exclude'];

		if ( isset( $_POST['gxtb_fb_lB_post'] ) )
			$settings['post'] = $_POST['gxtb_fb_lB_post'];

		if ( isset( $_POST['gxtb_fb_lB_post_exclude'] ) )
			$settings['post_exclude'] = $_POST['gxtb_fb_lB_post_exclude'];

		if ( isset( $_POST['gxtb_fb_lB_category'] ) )
			$settings['category'] = $_POST['gxtb_fb_lB_category'];

		if ( isset( $_POST['gxtb_fb_lB_category_exclude'] ) )
			$settings['category_exclude'] = $_POST['gxtb_fb_lB_category_exclude'];

		if ( isset( $_POST['gxtb_fb_lB_archiv'] ) )
			$settings['archiv'] = $_POST['gxtb_fb_lB_archiv'];

		if ( isset( $_POST['gxtb_fb_lB_archiv_exclude'] ) )
			$settings['archiv_exclude'] = $_POST['gxtb_fb_lB_archiv_exclude'];

		if ( isset( $_POST['gxtb_fb_lB_language'] ) )
			$settings['language'] = $_POST['gxtb_fb_lB_language'];
			
		if ( isset($_POST['gxtb_fb_lB_dynamic']) && ($_POST['gxtb_fb_lB_dynamic']>0) )
			$settings['dynamic'] = $_POST['gxtb_fb_lB_dynamic'];
			
		// updates all options
		update_option('gxtb_fb_lB_settings', $settings);	
} 

########################################################################################################
											## DESIGN  ##

if($_GET['page'] == "fb-like-design") {		

		#$design = get_option('gxtb_fb_lB_design');	
		$design = array();
			
		if ( isset( $_POST['gxtb_fb_lB_css'] ) )
			$design['css'] = $_POST['gxtb_fb_lB_css'];

		if ( isset( $_POST['gxtb_fb_lB_cssbox'] ) )
			$design['cssbox'] = $_POST['gxtb_fb_lB_cssbox'];
			
		if ( isset( $_POST['gxtb_fb_lB_br_before'] ) )
			$design['br_before'] = $_POST['gxtb_fb_lB_br_before'];

		if ( isset( $_POST['gxtb_fb_lB_br_after'] ) )
			$design['br_after'] = $_POST['gxtb_fb_lB_br_after'];

		// updates all options
		update_option('gxtb_fb_lB_design', $design);
}

########################################################################################################
											## META-TAGS  ##

if($_GET['page'] == "fb-like-opengraph") {	

		$meta = get_option('gxtb_fb_lB_meta');
			
		if ( isset( $_POST['gxtb_fb_lB_meta_site_name'] ) )
			$meta['site_name'] = $_POST['gxtb_fb_lB_meta_site_name'];

		if ( isset( $_POST['gxtb_fb_lB_meta_type'] ) )
			$meta['type'] = $_POST['gxtb_fb_lB_meta_type'];

		if ( isset( $_POST['gxtb_fb_lB_posttype'] ) )
			$meta['posttype'] = $_POST['gxtb_fb_lB_posttype'];

		if ( isset( $_POST['gxtb_fb_lB_pagetype'] ) )
			$meta['pagetype'] = $_POST['gxtb_fb_lB_pagetype'];	

		if ( isset( $_POST['gxtb_fb_lB_meta_admins'] ) )
			$meta['admins'] = $_POST['gxtb_fb_lB_meta_admins'];

		if ( isset( $_POST['gxtb_fb_lB_meta_appid'] ) )
			$meta['app_id'] = $_POST['gxtb_fb_lB_meta_appid'];

		if ( isset( $_POST['gxtb_fb_lB_meta_pageid'] ) )
			$meta['page_id'] = $_POST['gxtb_fb_lB_meta_pageid'];

		if ( isset( $_POST['gxtb_fb_lB_meta_title'] ) )
			$meta['title'] = $_POST['gxtb_fb_lB_meta_title'];

		if ( isset( $_POST['gxtb_fb_lB_meta_url'] ) )
			$meta['url'] = $_POST['gxtb_fb_lB_meta_url'];

		if ( isset( $_POST['gxtb_fb_lB_meta_description'] ) )
			$meta['description'] = $_POST['gxtb_fb_lB_meta_description'];

		if ( isset( $_POST['gxtb_fb_lB_meta_description_usage'] ) )
			$meta['dusage'] = $_POST['gxtb_fb_lB_meta_description_usage'];

		if ( isset( $_POST['gxtb_fb_lB_meta_image'] ) )
			$meta['image'] = $_POST['gxtb_fb_lB_meta_image'];
			
		// additional tags
		if ( isset( $_POST['gxtb_fb_lB_meta_site_name'] ) )
			$meta['plz'] = $_POST['gxtb_fb_lB_meta_plz'];

		if ( isset( $_POST['gxtb_fb_lB_meta_description'] ) )
			$meta['mail'] = $_POST['gxtb_fb_lB_meta_mail'];
			
		if ( isset( $_POST['gxtb_fb_lB_meta_type'] ) )
			$meta['street'] = $_POST['gxtb_fb_lB_meta_street'];

		if ( isset( $_POST['gxtb_fb_lB_meta_image'] ) )
			$meta['phone'] = $_POST['gxtb_fb_lB_meta_phone'];
			
		if ( isset( $_POST['gxtb_fb_lB_meta_admins'] ) )
			$meta['locality'] = $_POST['gxtb_fb_lB_meta_locality'];

		if ( isset( $_POST['gxtb_fb_lB_meta_image'] ) )
			$meta['fax'] = $_POST['gxtb_fb_lB_meta_fax'];
			
		if ( isset( $_POST['gxtb_fb_lB_meta_appid'] ) )
			$meta['region'] = $_POST['gxtb_fb_lB_meta_region'];

		if ( isset( $_POST['gxtb_fb_lB_meta_title'] ) )
			$meta['country'] = $_POST['gxtb_fb_lB_meta_country'];

		if ( isset( $_POST['gxtb_fb_lB_meta_url'] ) )
			$meta['latitude'] = $_POST['gxtb_fb_lB_meta_latitude'];
			
		if ( isset( $_POST['gxtb_fb_lB_meta_image'] ) )
			$meta['longitude'] = $_POST['gxtb_fb_lB_meta_longitude'];

		// updates all options
		update_option('gxtb_fb_lB_meta', $meta);
}

########################################################################################################
											## GENERATOR  ##
			
if($_GET['page'] == "fb-like-button") {	

			#$generator = get_option('gxtb_fb_lB_generator');	
			$generator = array();		
	
		if ( isset( $_POST['gxtb_fb_lB_generator_url'] ) )
			$generator['url'] = $_POST['gxtb_fb_lB_generator_url'];

		if ( isset( $_POST['gxtb_fb_lB_generator_layout'] ) )
			$generator['layout'] = $_POST['gxtb_fb_lB_generator_layout'];

		if ( isset( $_POST['gxtb_fb_lB_generator_faces'] ) )
			$generator['faces'] = $_POST['gxtb_fb_lB_generator_faces'];

		if ( isset( $_POST['gxtb_fb_lB_generator_width'] ) )
			$generator['width'] = $_POST['gxtb_fb_lB_generator_width'];

		if ( isset( $_POST['gxtb_fb_lB_generator_heigth'] ) )
			$generator['height'] = $_POST['gxtb_fb_lB_generator_heigth'];

		if ( isset( $_POST['gxtb_fb_lB_generator_verb'] ) )
			$generator['verb'] = $_POST['gxtb_fb_lB_generator_verb'];

		if ( isset( $_POST['gxtb_fb_lB_generator_color'] ) )
			$generator['color'] = $_POST['gxtb_fb_lB_generator_color'];

		if ( isset( $_POST['gxtb_fb_lB_generator_font'] ) )
			$generator['font'] = $_POST['gxtb_fb_lB_generator_font'];
		
		## iframe-settings
		
		if ( isset( $_POST['gxtb_fb_lB_generator_scrolling'] ) )
			$generator['scrolling'] = $_POST['gxtb_fb_lB_generator_scrolling'];

		if ( isset( $_POST['gxtb_fb_lB_generator_frameborder'] ) )
			$generator['frameborder'] = $_POST['gxtb_fb_lB_generator_frameborder'];

		if ( isset( $_POST['gxtb_fb_lB_generator_borderstyle'] ) )
			$generator['borderstyle'] = $_POST['gxtb_fb_lB_generator_borderstyle'];

		if ( isset( $_POST['gxtb_fb_lB_generator_overflow'] ) )
			$generator['overflow'] = $_POST['gxtb_fb_lB_generator_overflow'];

		if ( isset( $_POST['gxtb_fb_lB_generator_trans'] ) )
			$generator['trans'] = $_POST['gxtb_fb_lB_generator_trans'];
						
		// updates all options
		update_option('gxtb_fb_lB_generator', $generator);
}

########################################################################################################
											## FB-Analytics-Tools ##
											
if($_GET['page'] == "fb-like-insights") {	

			#$fb_analytics = get_option('gxtb_fb_lB_analytics');
			$fb_analytics = array();
			
		if ( isset($_POST['gxtb_fb_lB_analytics_on']) && ($_POST['gxtb_fb_lB_analytics_on']>0) )
			$fb_analytics['on'] = $_POST['gxtb_fb_lB_analytics_on'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_frontpage'] ) )
			$fb_analytics['frontpage'] = $_POST['gxtb_fb_lB_analytics_frontpage'];

		if ( isset($_POST['gxtb_fb_lB_analytics_frontpage_activ']) && ($_POST['gxtb_fb_lB_analytics_frontpage_activ']>0) )
			$fb_analytics['frontpage_activ'] = $_POST['gxtb_fb_lB_analytics_frontpage_activ'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_page'] ) )
			$fb_analytics['page'] = $_POST['gxtb_fb_lB_analytics_page'];
							
		if ( isset( $_POST['gxtb_fb_lB_analytics_page_activ'] ) )
			$fb_analytics['page_activ'] = $_POST['gxtb_fb_lB_analytics_page_activ'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_post'] ) )
			$fb_analytics['post'] = $_POST['gxtb_fb_lB_analytics_post'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_post_activ'] ) )
			$fb_analytics['post_activ'] = $_POST['gxtb_fb_lB_analytics_post_activ'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_category'] ) )
			$fb_analytics['category'] = $_POST['gxtb_fb_lB_analytics_category'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_category_activ'] ) )
			$fb_analytics['category_activ'] = $_POST['gxtb_fb_lB_analytics_category_activ'];
			
		if ( isset( $_POST['gxtb_fb_lB_analytics_archiv'] ) )
			$fb_analytics['archiv'] = $_POST['gxtb_fb_lB_analytics_archiv'];

		if ( isset( $_POST['gxtb_fb_lB_analytics_archiv_activ'] ) )
			$fb_analytics['archiv_activ'] = $_POST['gxtb_fb_lB_analytics_archiv_activ'];

		// updates all options
		update_option('gxtb_fb_lB_analytics', $fb_analytics);
}
		
########################################################################################################
											## GB-General-Settings ## - deprecated until v5.0##
							
		/* $gxtb_fb_lB = array();	
		$gxtb_fb_lB_jQuery = get_option('gxtb_fb_lB');		
											
		if ( isset( $_POST['gxtb_fb_lB_infopage'] ) )
			$gxtb_fb_lB["InfoPage"] = $_POST['gxtb_fb_lB_infopage'];

		if ( isset( $_POST['gxtb_fb_lB_favicon'] ) )
			$gxtb_fb_lB["FavIcon"] = $_POST['gxtb_fb_lB_favicon'];

		if ( isset( $_POST['gxtb_fb_lB_jquery'] ) )
			$gxtb_fb_lB["jQuery"] = $_POST['gxtb_fb_lB_jquery'];
		else 
			$gxtb_fb_lB["jQuery"] = false;

		// updates all options
		update_option('gxtb_fb_lB', $gxtb_fb_lB);	 */										


########################################################################################################
											## GB-WARNING-SYSTEM - deprecated until v5.0##
		
		#if ( isset( $_POST['gxtb_fb_lB_warning_aktiv'] ) )
		#	$gxtb_fb_lB_warning["warning_aktiv"] = $_POST['gxtb_fb_lB_warning_aktiv'];

		// updates all options
		#update_option('gxtb_fb_lB_warning', $gxtb_fb_lB_warning);										

########################################################################################################

		// Show the User the Settings-saved-Message
		echo '<div id="message" class="updated fade"><p><strong>';
		_e("Settings saved.", gxtb_fb_lB_lang);
		if( isset($gxtb_fb_lB["jQuery"]) && ( $gxtb_fb_lB['jQuery'] != $gxtb_fb_lB_jQuery['jQuery'] ) ) { echo "<br><br>"; _e("Please reload the Option-Page to load / unload the jQuery-Settings:", gxtb_fb_lB_lang); echo sprintf( ' <a href="admin.php?page=%s">%s</a>', gxtb_fb_lB_page , __('FB-Like Button', gxtb_fb_lB_lang) ); }
		echo '</strong></p></div>';
		
		// unset the Submit-Action
		unset( $_POST['fbsubmit'] );
  }


########################################################################################################
											## RESET-ACTION  ##

 if ( isset( $_POST['reset'] ) ) {
 
		 $gxtb_fb_lB_generator = array(
			'width' => '450',
			'faces' => false,
			'height' => '',
			'url' => '',
			'trans' => true
			);
		$gxtb_fb_lB = array ( "InfoPage" => true );
  
 		update_option('gxtb_fb_lB_settings', '');
 		update_option( 'gxtb_fb_lB_meta', '' );
		update_option('gxtb_fb_lB_generator', §gxtb_fb_lB_generator);
		update_option('gxtb_fb_lB_analytics', '');
		update_option('gxtb_fb_lB', $gxtb_fb_lB);
		
		echo '<div id="message" class="updated fade"><p><strong>';
		_e("Defaults restored", gxtb_fb_lB_lang);
		echo '.</strong></p></div>';
 }
?>