<div id="sidebar" class="grid_4">

		<div id="menu-header">
		
	        <?php
			// Using wp_nav_menu() to display menu
			wp_nav_menu( array(
				'menu' => 'Header', // Select the menu to show by Name
				'class' => '',
				'container' => false, // Remove the navigation container div
				'theme_location' => 'Header'
				)
			);
			?>
			
		</div>

</div>