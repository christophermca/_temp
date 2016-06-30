<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php 
/*
+----------------------------------------------------------------+
+	GB-World-Infopage Setup [v1.0]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	     SETUP the InfoPage		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net  #############
####################################################
?>
<?php
function GB_infoPage_activate($name, $version) {

	if( !get_option('gb_infopage')) {
	
		$gb_InfoPage = array(
		  "FBLike" => "ON",
		  "JumpPage" => "OFF",
		  "iPhoneRe" => "OFF",
		  "InfoPage" => 1,
		);
		add_option('gb_infopage', $gb_InfoPage);
		
	} else {
	
		$gb_InfoPage = get_option('gb_infopage');
		$gb_InfoPage['FBLike'] = "ON";
		update_option('gb_infopage', $gb_InfoPage);
		
	}

	// akiviert dieses Plugin in der GB-World-Plugin-Liste		
	$gb_world_plugins = array( $name => $version );

	if ( !get_option('gb_world_plugins')){
      add_option('gb_world_plugins' , $gb_world_plugins);
    } else {
	  $gb_world_plugins = get_option('gb_world_plugins');
	  $gb_world_plugins[$name] = $version;
      update_option('gb_world_plugins' , $gb_world_plugins);
    }
}


function GB_infoPage_deactivate($name) {

/* echo 'Thanks for using our plugin :) - We show you this message because we wanna show you that there is still a little security bug in the new wordpress version. Because plugins can make some big changes before they are sucessfully deactivated!<br>
your gb-team
<br><br>
<a href="http://www.gb-world.net" target="_blank"><img src="http://www.gb-world.net/images/wp/plugins/banner.gif" class="gb_world"></a><br><br>
<iframe src="http://www.facebook.com/plugins/likebox.php?id=119752364716058&amp;width=500&amp;connections=10&amp;stream=true&amp;header=true&amp;height=587" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:587px;" allowTransparency="true"></iframe>'; */

	$gb_InfoPage['FBLike'] = "OFF";
	update_option('gb_infopage', $gb_InfoPage);
	
	$gb_InfoPage_Nr = 0;
	$gb_InfoPage = get_option('gb_infopage');
	
	foreach($gb_InfoPage as $key => $variable){
	
		if( $variable == "OFF") {
		
			$gb_InfoPage_Nr += 1;
		}
	}
	
	if( $gb_InfoPage_Nr == 3) {
	
		delete_option('gb_infopage', $gb_InfoPage);
		
	} elseif ( $gb_InfoPage_Nr < 3) {
	
		$gb_InfoPageNr = 0;
		
		foreach($gb_InfoPage as $key => $variable){
		
			if( $variable == "ON") {
				$gb_InfoPage_Nr += 1;
			}
		}
		
		$gb_InfoPage_Array = array( 'InfoPage' => $gb_InfoPage_Nr);
		update_option('gb_infopage', $gb_InfoPage_Array);
	}

####################################################################
	## deakiviert dieses Plugin in der GB-World-Plugin-Liste ##
####################################################################

    $gb_world_plugins = get_option('gb_world_plugins');
	unset($gb_world_plugins[$name]);
	
	if(count($gb_world_plugins) <= 0) {
		delete_option('gb_world_plugins');	
	} else {
    	update_option('gb_world_plugins' , $gb_world_plugins);
	}
}
?>