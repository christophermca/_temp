<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<?php
/*
+----------------------------------------------------------------+
+	Like-Button-Plugin-For-Wordpress [v4.3] - GB-FB-Widget [v1.1] - OFFEN: 1x
+	by Stefan Natter (http://www.gangxtaboii.com and http://www.gb-world.net)
+   required for Like-Button-Plugin-For-Wordpress and WordPress 2.7.x or higher
+----------------------------------------------------------------+
*/

if (!class_exists('class gxtb_fb_lB_WidgetClass')) {
class gxtb_fb_lB_WidgetClass {

function gxtb_fb_lB_WidgetClass() {
	
	add_action('plugins_loaded', array( $this, 'gxtb_fb_lB_widget_sidebar_init' ));
	
	$mypluginoptionpageslug = 'widgets.php';
	if (strpos($_SERVER['REQUEST_URI'],$mypluginoptionpageslug)) { $ismypluginoptionpage = 'true'; } else { $ismypluginoptionpage = 'false'; }
		 
	if ( $ismypluginoptionpage == 'true' )
		add_action('admin_head', array(&$this, 'gxtb_fb_lB_widget_header'));
}

function gxtb_fb_lB_widget_header() {

echo '
<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';
echo '<script type="text/javascript" src="' . gxtb_fb_lB_PLUGIN_FOLDER . 'js/gb_generator.js"></script>
';
echo '<link rel="stylesheet" type="text/css" href="' . gxtb_fb_lB_PLUGIN_FOLDER . 'css/tooltips.css" />
';
echo '<!-- using ' . gxtb_fb_lB_name . ' [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->
';

}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    LIKE WIDGET (Output)	 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget($args) {
	
	$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');
	extract($args);
	echo $before_widget;
	echo $before_title; 
	
	if ($gxtb_fb_lB_data['title'] != "")
		echo $gxtb_fb_lB_data['title'];
	else
		echo "Facebook-Like-Button";
	
	echo $after_title;
	$this -> gxtb_fb_lB_Content();
	echo $after_widget;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########		    LIKE Widget			 ###########
###########				CONTENT			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_Content() {
	
$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');

	if($gxtb_fb_lB_data['dynamic']) {
		if(is_single()){
			$permalink = get_permalink($post->ID);
		}elseif(is_page()){
			$permalink = get_page_link($post->ID);
		}elseif(is_home()) {
			$permalink = get_bloginfo('url');
		}else {
			$permalink = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
	} else {
		$permalink = $gxtb_fb_lB_data['url'];
	}

	if ($gxtb_fb_lB_data['width'] == "") {
		$width = "450";
	} else{
		$width = $gxtb_fb_lB_data['width'];
	}
	
	if ($gxtb_fb_lB_data['height'] == "") {
		$height = "150";
	} else{
		$height = $gxtb_fb_lB_data['height'];
	}

	if ($gxtb_fb_lB_data['frameborder'] == "") {
		$frameborder = "0";
	} else{
		$frameborder = $gxtb_fb_lB_data['frameborder'];
	}
	
	if ($gxtb_fb_lB_data['borderstyle'] == "") {
		$borderstyle = "none";
	} else{
		$borderstyle = $gxtb_fb_lB_data['borderstyle'];
	}
		
	if ($gxtb_fb_lB_data['trans']) {
		$trans = "true";
	} else{
		$trans = "false";
	}	
	
	if ($gxtb_fb_lB_data['scrolling']) {
		$scrolling = "yes";
	} else{
		$scrolling = "no";
	}		
	
	 if($gxtb_fb_lB_data['font'] != "") {
		 
		 switch ($gxtb_fb_lB_data['font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $gxtb_fb_lB_data['font'];
			 break;
		 }
		 
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}

	################################################
	### FB-Analytics (v4.0) ### development-mode ###
	################################################
		// generiert die FB-Insights-Analyse (REF)
		
		$ref = "";
		
		if( isset( $gxtb_fb_lB_data['ref_activ'] ) && isset( $gxtb_fb_lB_data['ref'] ) && !empty( $gxtb_fb_lB_data['ref'] ) ) {
			$ref = '&amp;ref='. $gxtb_fb_lB_data['ref'];
		}

	################################################
	### FB-Analytics (v4.0) ### development-mode ###
	################################################

?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->'; ?>
<?php if( isset( $gxtb_fb_lB_data['css'] ) && !empty( $gxtb_fb_lB_data['css'] ) ) {
			echo '<div class="'. $gxtb_fb_lB_data['css'] . '">';
		}
?><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode($permalink); ?>&layout=<?php echo $gxtb_fb_lB_data['layout']; ?>&amp;show_faces=<?php echo $gxtb_fb_lB_data['faces']; ?>&amp;width=<?php echo $width; ?>&amp;action=<?php echo $gxtb_fb_lB_data['verb']; ?>&amp;<?php echo $font; ?>colorscheme=<?php echo $gxtb_fb_lB_data['color']; ?><?php echo "&amp;height=" . $height; ?><?php echo $ref; ?>" scrolling="<?php echo $scrolling; ?>" frameborder="<?php echo $frameborder; ?>" allowTransparency="<?php echo $trans; ?>" style="border:<?php echo $borderstyle; ?>; overflow:<?php echo $gxtb_fb_lB_data['overflow']; ?>; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px"></iframe>
<?php if( isset( $gxtb_fb_lB_data['css'] ) && !empty( $gxtb_fb_lB_data['css'] ) ) {
			echo '</div>';
		}
?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->';
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########		    LIKE-Widget			 ###########
###########				CONTROL			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_control() {

global $gb_fb_lB_path;
$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');

?>

    <p><label><?php _e('Title', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_title" type="text" value="<?php echo $gxtb_fb_lB_data['title']; ?>" />
    </label></p>

    <p><label><?php _e('URL', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_url" type="text" value="<?php echo $gxtb_fb_lB_data['url']; ?>" />
    </label></p>
	
	<p><b><?php _e('Changes since 10th of September 2010:', 'gb_like_button'); ?></b><br />
	<?php _e('You can now also like your Facebook Pages and Application. Just enter the URL to your Facebook Page or Application (for example: <a href="http://www.facebook.com/gbworldnet" target="_blank">http://www.facebook.com/gbworldnet</a>)', 'gb_like_button'); ?></p>

<p><label><?php _e('Dynamic Links', 'gb_like_button'); ?><br />
<input name="gxtb_fb_lB_widget_dynamic" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['dynamic']) echo("checked"); ?>/>  <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/rot17a.gif"  onmouseover="tooltip.show('<u><?php _e('Activated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has its own Like-Button. Which means for every page on your side there will be a unique Like-Button.', 'gb_like_button'); ?> <?php _e('(recommended)', 'gb_like_button'); ?><br /><u><?php _e('Deactivated', 'gb_like_button'); ?>:</u> <?php _e('Every Post/Page has the same Like-Button. Which means if you click on it, it looks like you like/recommend every post even if you have not read it before.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();">
</label></p>

    <p><label><?php _e('Layout Style', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_layout">
    <?php
    $i = array( "standard", "button_count", "box_count" );
      foreach($i as $variable) {
        if($variable == $gxtb_fb_lB_data['layout']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

    <p><label><?php _e('Show Faces?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_faces" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['faces']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Width', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_width" type="text" value="<?php echo $gxtb_fb_lB_data['width']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Height', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_height" type="text" value="<?php echo $gxtb_fb_lB_data['height']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Verb to display', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_verb">
    <?php
    $i = array( "Like", "Recommend" );
      foreach($i as $variable) {
        if($variable == $gxtb_fb_lB_data['verb']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>
    
    <p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_color">
    <?php
    $i = array( "light", "dark", "evil" );
      foreach($i as $variable) {
        if($variable == $gxtb_fb_lB_data['color']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

      <p><label><?php _e('Font', 'gb_like_button'); ?><br />
              <SELECT NAME="gxtb_fb_lB_widget_font">
              <?php
              $i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
                foreach($i as $variable) {
                  if($variable == $gxtb_fb_lB_data['font']) {
                      echo '<OPTION selected>' . $variable .'</OPTION>';
                  } else {
                      echo '<OPTION>' . $variable .'</OPTION>';
                  }
              }
              ?>
      </SELECT>
	</label></p>

          <p><label><?php _e('Scrolling', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_scrolling" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['scrolling']) echo("checked"); ?>  />
			</label></p>

          <p><label><?php _e('Frameborder', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_frameborder" type="text" value="<?php if ($gxtb_fb_lB_data['frameborder'] != "") {echo $gxtb_fb_lB_data['frameborder'];} else {echo "";} ?>" size="4" maxlength="4"/>px
			</label></p>

          <p><label><?php _e('Style (of the Border)', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_borderstyle" type="text" value="<?php if ($gxtb_fb_lB_data['borderstyle'] != "") {echo $gxtb_fb_lB_data['borderstyle'];} else {echo "";} ?>" size="20" maxlength="20"/><br />
					<?php _e('Example: none or solid', 'gb_like_button'); ?>
			</label></p>

          <p><label><?php _e('Overflow', 'gb_like_button'); ?></label><br />
					<select name="gxtb_fb_lB_widget_overflow">
					<?php
					$i = array( "hidden", "scroll");
					  foreach($i as $variable) {
						if($variable == $gxtb_fb_lB_data['overflow']) {
							echo '<OPTION selected>' . $variable .'</OPTION>';
						} else {
							echo '<OPTION>' . $variable .'</OPTION>';
						}
					}
					?>
					</select>
             </p>

          <p><label><?php _e('Allow Transparency', 'gb_like_button'); ?><br />
					<input name="gxtb_fb_lB_widget_trans" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['trans']) echo("checked"); ?>  />
		  </label></p>
		  
		 <p><label><?php _e('CSS-Design', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('Add some CSS-Styling into this textbox like: visability:block;border:none;', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
					<input name="gxtb_fb_lB_widget_css" type="text" value="<?php if ($gxtb_fb_lB_data['css'] != "") {echo $gxtb_fb_lB_data['css'];} else {echo "";} ?>" />
		</label></p>
		
		<p><label><?php _e('Use Facebook-Insights (REF-Attribute)', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('If you activate this Option you have to enter sth. into the textbox on the right. This new Attribute will then give you some new kind of information about the effectiveness of your like-button. Read more in the Plugin-FAQ.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_ref_activ" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['ref_activ']) echo("checked"); ?>  />
		<input name="gxtb_fb_lB_widget_ref" type="text" value="<?php if ($gxtb_fb_lB_data['ref'] != "") {echo $gxtb_fb_lB_data['ref'];} else {echo "";} ?>" size="4" maxlength="4"/>
		</label></p>

<?php
	
   // Saves the Widget-Options
   if (isset($_POST['gxtb_fb_lB_widget_url'])){
    $gxtb_fb_lB_data['title'] = attribute_escape($_POST['gxtb_fb_lB_widget_title']);
	$gxtb_fb_lB_data['url'] = attribute_escape($_POST['gxtb_fb_lB_widget_url']);
	$gxtb_fb_lB_data['dynamic'] = attribute_escape($_POST['gxtb_fb_lB_widget_dynamic']);
	$gxtb_fb_lB_data['layout'] = attribute_escape($_POST['gxtb_fb_lB_widget_layout']);
	$gxtb_fb_lB_data['faces'] = attribute_escape($_POST['gxtb_fb_lB_widget_faces']);
	$gxtb_fb_lB_data['width'] = attribute_escape($_POST['gxtb_fb_lB_widget_width']);
	$gxtb_fb_lB_data['height'] = attribute_escape($_POST['gxtb_fb_lB_widget_height']);
	$gxtb_fb_lB_data['verb'] = attribute_escape($_POST['gxtb_fb_lB_widget_verb']);
	$gxtb_fb_lB_data['color'] = attribute_escape($_POST['gxtb_fb_lB_widget_color']);
	$gxtb_fb_lB_data['font'] = attribute_escape($_POST['gxtb_fb_lB_widget_font']);
	
	$gxtb_fb_lB_data['scrolling'] = attribute_escape($_POST['gxtb_fb_lB_widget_scrolling']);
	$gxtb_fb_lB_data['frameborder'] = attribute_escape($_POST['gxtb_fb_lB_widget_frameborder']);
	$gxtb_fb_lB_data['borderstyle'] = attribute_escape($_POST['gxtb_fb_lB_widget_borderstyle']);
	$gxtb_fb_lB_data['overflow'] = attribute_escape($_POST['gxtb_fb_lB_widget_overflow']);
	$gxtb_fb_lB_data['trans'] = attribute_escape($_POST['gxtb_fb_lB_widget_trans']);
	$gxtb_fb_lB_data['css'] = attribute_escape($_POST['gxtb_fb_lB_widget_css']);
	
	$gxtb_fb_lB_data['ref_activ'] = attribute_escape($_POST['gxtb_fb_lB_widget_ref_activ']);
	$gxtb_fb_lB_data['ref'] = attribute_escape($_POST['gxtb_fb_lB_widget_ref']);
	
    update_option('gxtb_fb_lB_data', $gxtb_fb_lB_data);
  }

}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    RECOMMENDATION WIDGET    ###########
###########			Output				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_rec($args) {
	
	$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');
	extract($args);
	echo $before_widget;
	echo $before_title; 
	
	if ($gxtb_fb_lB_data['rec_title'] != "")
		echo $gxtb_fb_lB_data['rec_title'];
	else
		echo "Facebook-Recommendations";
	
	echo $after_title;
	$this -> gxtb_fb_lB_widget_rec1();
	echo $after_widget;
}

####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    RECOMMENDATION			 ###########
###########			WIDGET				 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_rec1() {
$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');

	if ($gxtb_fb_lB_data['rec_domain'] == "") {
		$domain = "http://www.gb-world.net";
	} else{
		$domain = $gxtb_fb_lB_data['rec_domain'];
	}
	
	if ($gxtb_fb_lB_data['rec_width'] == "") {
		$width = "450";
	} else{
		$width = $gxtb_fb_lB_data['rec_width'];
	}
	
	if ($gxtb_fb_lB_data['rec_height'] == "") {
		$height = "150";
	} else{
		$height = $gxtb_fb_lB_data['rec_height'];
	}
	
	if ($gxtb_fb_lB_data['rec_header']) {
		$header = "true";
	} else{
		$header = "false";
	}

	if ($gxtb_fb_lB_data['rec_border'] == "") {
		$borderstyle = "none";
	} else{
		$borderstyle = $gxtb_fb_lB_data['rec_border'];
	}
		
	if($gxtb_fb_lB_data['rec_font'] != "") {
		 
		 switch ($gxtb_fb_lB_data['rec_font']) {
			 case "luciada grande":
			 	$font = "lucida+grande";
			 break;
			 
			 case "segoe ui":
			 	$font = "segoe+ui";
			 break;
			 
			 case "trebuchet ms":
			 	$font = "trebuchet+ms";
			 break;
			 
			 default:
			 	$font = $gxtb_fb_lB_data['rec_font'];
			 break;
		 }
		 
		$font = 'font=' . $font . '&amp;';
	} else {
		$font = '';	
	}

?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->'; ?>
<?php if( isset( $gxtb_fb_lB_data['rec_css'] ) && !empty( $gxtb_fb_lB_data['rec_css'] ) ) {
			echo '<div class="'. $gxtb_fb_lB_data['rec_css'] . '">';
		}
?><iframe src="http://www.facebook.com/plugins/recommendations.php?site=<?php echo urlencode($domain); ?>&amp;width=<?php echo $width; ?>&amp;height=<?php echo $height; ?>&amp;header=<?php echo $header; ?>&amp;colorscheme=<?php echo $gxtb_fb_lB_data['rec_color']; ?>" scrolling="no" frameborder="0" style="border:<?php echo $borderstyle; ?>; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
<?php if( isset( $gxtb_fb_lB_data['rec_css'] ) && !empty( $gxtb_fb_lB_data['rec_css'] ) ) {
			echo '</div>';
		}
?>
<?php echo '<!-- using ' . gxtb_fb_lB_name . '-Sidebar-Widget [v' . gxtb_fb_lB_version . '] | by http://www.gb-world.net -->';	
}
####################################################
####################################################
###########								 ###########
###########								 ###########
###########		RECOMMENDATION-Widget	 ###########
###########				CONTROL			 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_control_rec() {
global $gb_fb_lB_path;
$gxtb_fb_lB_data = get_option('gxtb_fb_lB_data');
## OFFEN: Expand all the availabe settings ##
?>
    <p><label><?php _e('Title', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_rec_title" type="text" value="<?php echo $gxtb_fb_lB_data['rec_title']; ?>" />
    </label></p>

    <p><label><?php _e('Domain', 'gb_like_button'); ?> <b>(<?php _e('required', 'gb_like_button'); ?>)</b><br />
    <input name="gxtb_fb_lB_widget_rec_domain" type="text" value="<?php echo $gxtb_fb_lB_data['rec_domain']; ?>" />
    </label></p>

    <p><label><?php _e('Show Header?', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_header" type="checkbox" class="checkbox" <?php if ($gxtb_fb_lB_data['rec_header']) echo("checked"); ?>  />
    </label></p>

    <p><label><?php _e('Width', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_width" type="text" value="<?php echo $gxtb_fb_lB_data['rec_width']; ?>" size="4" maxlength="4"/>px
    </label></p>

    <p><label><?php _e('Height', 'gb_like_button'); ?><br />
    <input name="gxtb_fb_lB_widget_rec_height" type="text" value="<?php echo $gxtb_fb_lB_data['rec_height']; ?>" size="4" maxlength="4"/>px
    </label></p>
    
    <p><label><?php _e('Color Scheme', 'gb_like_button'); ?><br />
    <SELECT NAME="gxtb_fb_lB_widget_rec_color">
    <?php
    $i = array( "light", "dark", "evil" );
      foreach($i as $variable) {
        if($variable == $gxtb_fb_lB_data['rec_color']) {
            echo '<OPTION selected>' . $variable .'</OPTION>';
        } else {
            echo '<OPTION>' . $variable .'</OPTION>';
        }
    }
    ?>
    </SELECT>
    </label></p>

      <p><label><?php _e('Font', 'gb_like_button'); ?><br />
              <SELECT NAME="gxtb_fb_lB_widget_rec_font">
              <?php
              $i = array( "" ,"arial", "luciada grande", "segoe ui", "tahoma", "trebuchet ms", "verdana" );
                foreach($i as $variable) {
                  if($variable == $gxtb_fb_lB_data['rec_font']) {
                      echo '<OPTION selected>' . $variable .'</OPTION>';
                  } else {
                      echo '<OPTION>' . $variable .'</OPTION>';
                  }
              }
              ?>
      </SELECT>
	</label></p>

    <p><label><?php _e('Border-Color', 'gb_like_button'); ?><br />
		 <input name="gxtb_fb_lB_widget_rec_border" type="text" value="<?php echo $gxtb_fb_lB_data['rec_border']; ?>"/>
	</label></p>

	<p><label><?php _e('CSS-Design', 'gb_like_button'); ?> <img src="<?php echo gxtb_fb_lB_PLUGIN_FOLDER ?>/images/rot17a.gif"  onmouseover="tooltip.show('<?php _e('If you activate this Option you have to enter sth. into the textbox on the right. This new Attribute will then give you some new kind of information about the effectiveness of your like-button. Read more in the Plugin-FAQ.', 'gb_like_button'); ?>');" onmouseout="tooltip.hide();"><br />
		<input name="gxtb_fb_lB_widget_rec_css" type="text" value="<?php if ($gxtb_fb_lB_data['rec_css'] != "") {echo $gxtb_fb_lB_data['rec_css'];} else {echo "";} ?>" />
	</label></p>

<?php
	
   // Saves the Widget-Options
   if (isset($_POST['gxtb_fb_lB_widget_rec_title'])){
    $gxtb_fb_lB_data['rec_title'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_title']);
	$gxtb_fb_lB_data['rec_domain'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_domain']);
	$gxtb_fb_lB_data['rec_header'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_header']);
	$gxtb_fb_lB_data['rec_width'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_width']);
	$gxtb_fb_lB_data['rec_height'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_height']);
	$gxtb_fb_lB_data['rec_color'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_color']);
	$gxtb_fb_lB_data['rec_font'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_font']);
	
	$gxtb_fb_lB_data['rec_border'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_border']);
	$gxtb_fb_lB_data['rec_css'] = attribute_escape($_POST['gxtb_fb_lB_widget_rec_css']);
	
    update_option('gxtb_fb_lB_data', $gxtb_fb_lB_data);
  }

}


####################################################
####################################################
###########								 ###########
###########								 ###########
###########	    REGISTER WIDGET 		 ###########
###########								 ###########
###########								 ###########
####################################################
##################### by gb-world.net   ############
####################################################

function gxtb_fb_lB_widget_sidebar_init()
{
	// get the Plugin-Version
	global $wp_version;
	
	if ( version_compare( $wp_version, '2.8', '>=' ) ) {
	
		## Like-Button ##
		$widget_ops = array("classname" => "Facebook-Like-Button-Generator", "description" => __( "This Widget adds the Like-Button to your Sidebar.", 'gb_like_button') );
		wp_register_sidebar_widget(__('Facebook-Like-Button-Generator', 'gb_like_button'), __("Facebook-Like-Button-Generator", 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget' ), $widget_ops, 300, 400);
		wp_register_widget_control(__('Facebook-Like-Button-Generator', 'gb_like_button'), __('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control' ), 300, 440);
		
		## Recommendations ##
		$widget_ops = array("classname" => "Facebook-Recommendations", "description" => __( "This Widget adds the Recommendation-Box to your Sidebar.", 'gb_like_button') );
		wp_register_sidebar_widget(__('Facebook-Recommendations', 'gb_like_button'), __("Facebook-Recommendations", 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_rec' ), $widget_ops, 300, 400);
		wp_register_widget_control(__('Facebook-Recommendations', 'gb_like_button'), __('Facebook-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control_rec' ), 300, 440);
			
	} elseif ( version_compare( $wp_version, '2.8', '<' ) ) {
	
		## Like-Button ##
		register_sidebar_widget(__('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget' ) );
		register_widget_control(__('Facebook-Like-Button-Generator', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control' ), 300, 440);

		## Recommendations ##
		register_sidebar_widget(__('Facebook-Like-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget' ) );
		register_widget_control(__('Facebook-Like-Recommendations', 'gb_like_button'), array( $this, 'gxtb_fb_lB_widget_control' ), 300, 440);
		
	}
  
} // end function

} // end class 
} // end if-class ?>