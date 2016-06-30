<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php 
/*
+----------------------------------------------------------------+
+	GB-World-Newsbox [v3.2]
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for GB-World-WP-Plugins
+----------------------------------------------------------------+
*/

class gxtb_NewsClass {

function gxtb_NewsClass($gxtb_NewsClass_iArray) {

	if($gxtb_NewsClass_iArray['name'] != "") {
		$gxtb_newsbox_active = $gxtb_NewsClass_iArray['active'];
		$gxtb_newsbox_langdef = $gxtb_NewsClass_iArray['language'];
		$gxtb_newsbox_Array["name"] = $gxtb_NewsClass_iArray['name'];
		$gxtb_newsbox_Array["version"] = $gxtb_NewsClass_iArray['version'];
		$gxtb_newsbox_art = $gxtb_NewsClass_iArray['def'];
	}
	
?>
	<ul type="circle">
			<li>	
<?php
$gxtb_newsbox_lang = __('en', $gxtb_newsbox_langdef);

if($_GET['page'] != 'gb-world') {
	$news = @file_get_contents("http://www.gb-world.net/downloads/wp/news.php?p=wpp&language=". $gxtb_newsbox_lang . "&db=on&log=" . $gxtb_newsbox_active . "&pfad=" . get_option('siteurl') . "&plugin=". $gxtb_newsbox_Array["name"] ."&version=". $gxtb_newsbox_Array["version"]);
} else {
	$news = @file_get_contents("http://www.gb-world.net/downloads/wp/news.php?p=wpp&db=off&language=". $gxtb_newsbox_lang."&plugin=". $gxtb_newsbox_Array["name"] ."&pfad=" . get_option('siteurl') ."&page=GB-World");
}

if (strpos($http_response_header[0], "200")) { 
   echo $news;
} else { 
	_e('Currently there are no new updates or news available.', gxtb_fb_lB_lang );
}

?>		
			</li>
		</ul>

<!-- 										## GB-Newsbox 3.1  ##											  -->
<!-- ######################################################################################################## -->

<?php 
	} // end function
	
} // end class
?>