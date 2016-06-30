<?php
	
	$force = false;
	if (isset($_GET['all']) && $_GET['all'] == 1) { $force = true; }
	
	if (!defined('ALBUM_DIR')) {
		define('ALBUM_DIR', 'albums');
	}
	$ds = DIRECTORY_SEPARATOR;
	$albums = dirname(dirname(dirname(__FILE__))) . $ds . ALBUM_DIR;
	
	$files = glob($albums . $ds . '*' . $ds . 'cache' . $ds . '*');
	
	foreach ($files as $file) {
		if ((fileatime($file) < strtotime('-1 week')) || $force) {
			@unlink($file);
		}
	}

?>