<?php

	if (!defined('MIGRATE')) {exit;}
	
	$users = $this->_query("SELECT * FROM $utbl");
	$avatars = AVATARS;
	while($row = $this->_array($users)) {
		$path = $avatars . $row['id'];
		if (file_exists($path)) {
			$info = getimagesize($path);
			$mime = $info['mime'];
			switch($mime) {
				case 'image/jpeg':
					$original = 'original.jpg';
					break;
				case 'image/gif':
					$original = 'original.gif';
					break;
				case 'image/png':
					$original = 'original.png';
					break;
			}
			rename($path, $path . '.old');
			if (!is_dir($avatars . $row['id'])) {
				umask(0);
				mkdir($avatars . $row['id'], 0777, true);
			}
			rename($path . '.old', $path . DS . $original);
		}
	}

?>