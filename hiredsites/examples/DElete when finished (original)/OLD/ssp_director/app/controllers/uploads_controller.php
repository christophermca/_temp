<?php

class UploadsController extends AppController {
	// Models needed for this controller
    var $name = 'Uploads';
	var $uses = array();
	
	////
	// Accepts file uploads
 	////
	function image($user_id, $id, $upload_type, $tags = '') {	
		$this->loadModel('Image');
		$this->loadModel('Account');
		// Make sure this is coming from the flash player and is a POST request
		if (strpos(strtolower(env('HTTP_USER_AGENT')), 'flash') === false || !$this->RequestHandler->isPost()) {
			exit;
		}
		
		$tags = str_replace(' ', ',', urldecode($tags));
		$tags = ereg_replace("[^,A-Za-z0-9._-]", "", $tags);
		if ($tags == 'null' || $tags == 'undefined') {
			$tags = '';
		}
		
		define('CUR_USER_ID', $user_id);
		
		// Make sure permissions are set correctly
		$old_mask = umask(0);
			
		// Get album
		if ($upload_type > 4) {
			$image = $this->Image->find('first', array('conditions' => array('Image.id' => $id), 'recursive' => -1));
			$id = $image['Image']['aid'];
		}
		
		$this->Image->Album->id = $id;
		$album = $this->Image->Album->read();
		$account = $this->Account->find('first');
		$top = $this->Image->find('first', array('conditions' => "aid = $id", 'order' => 'seq DESC', 'recursive' => -1));
		$next = $top['Image']['seq'] + 1;
		// Flash uploads crap out when spaces are in the name
		$file = str_replace(" ", "_", $this->params['form']['Filedata']['name']);
		$file = ereg_replace("[^A-Za-z0-9._-]", "_", $file);

		$this->data['Image']['is_video'] = isVideo($file);
		// Get image extensions so we make sure
		// a safe file is uploaded
		$ext = $this->Director->returnExt($file);
		
		// Paths
		$the_temp = $this->params['form']['Filedata']['tmp_name'];
		$path = ALBUMS . DS . 'album-' . $album['Album']['id'];
		
		$lg_path = $path . DS . 'lg' . DS . $file;
		$lg_temp = $lg_path . '.tmp';
		
		$tn_path = $path . DS . 'tn' . DS . $file;
		$tn_temp = $tn_path . '.tmp';
		
		$thumb_path = THUMBS . DS . 'album-' . $id . '.' . $ext;
		$thumb_temp = $thumb_path . '.tmp';
		
		$int_path = $path . DS . 'director' . DS . $file;
				
		settype($upload_type, 'integer');
		
		$this->Director->setAlbumPerms($id);
		
		if (in_array($ext, a('jpg', 'jpeg', 'gif', 'png', 'mp3')) || isNotImg($file)) {
			switch($upload_type) {
				// Audio	
				case(4):
					if (is_uploaded_file($the_temp) && $this->Director->setPerms(AUDIO)) {
						$a_tmp = AUDIO . DS . $file . '.tmp';
						move_uploaded_file($the_temp, $a_tmp);
						copy($a_tmp, AUDIO . DS . $file);
						unlink($a_tmp);
						$this->Image->Album->saveField('audioFile', $file);
					}
					break;
				// Standard image or custom thumb
				default:
					if (is_uploaded_file($the_temp) && move_uploaded_file($the_temp, $lg_temp)) {
						copy($lg_temp, $lg_path);
						unlink($lg_temp);
						
						list($meta, $captured_on) = $this->Director->imageMetadata($lg_path);
						$keywords = $this->Director->parseMetaTags('iptc:keywords', $meta);
						$keywords = str_replace(' ', ',', urldecode($keywords));
						$keywords = ereg_replace("[^,A-Za-z0-9._-]", "", $keywords);
						if (!empty($tags)) {
							$keywords = ' ' . trim($keywords);
						}
						$check = $this->Image->find("aid = $id AND src = '$file'");
						
						if (empty($check)) {
							$this->data['Image']['src'] = $file;
							$this->data['Image']['aid'] = $id;
							$this->data['Image']['seq'] = $next;
							$this->data['Image']['filesize'] = filesize($lg_path);
							$this->data['Image']['captured_on'] = $captured_on;
							$this->data['Image']['tags'] = $tags . $keywords;
							
							if (in_array($upload_type, array(3,5,6))) {
								$this->data['Image']['active'] = 0;
							}
							$this->Image->save($this->data);
							$image_id = $this->Image->getLastInsertId();
						} else {
							$image_id = $check['Image']['id'];
							$caches = glob(ALBUMS . DS . 'album-' . $check['Album']['id'] . DS . 'cache' . DS . $check['Image']['src'] . '*');
							if (!empty($caches)) {
								foreach($caches as $cache) {
									@unlink($cache);
								}
							}
							$this->Image->id = $image_id;
							$this->data['Image']['captured_on'] = $captured_on;
							$this->data['Image']['filesize'] = filesize($lg_path);
							$this->data['Image']['tags'] = $tags;
							$this->Image->save($this->data);
						}
						if ($upload_type == 3) {
							$album['Album']['aTn'] = "$file:$id:50:50";
							$album['Album']['preview_id'] = $image_id;
							$this->Image->Album->save($album);
						} else if ($upload_type > 4) {
							if ($upload_type == 5) {
								if (!is_numeric($image['Image']['tn_preview_id'])) {
									$data = array('lg_preview' => "'$file:50:50'", 'lg_preview_id' => $image_id, 'tn_preview' => "'$file:50:50'", 'tn_preview_id' => $image_id);
								} else {
									$data = array('lg_preview' => "'$file:50:50'", 'lg_preview_id' => $image_id);
								}
							} else {
								$data = array('tn_preview' => "'$file:50:50'", 'tn_preview_id' => $image_id);
							}
							$this->Image->updateAll($data, array('Image.id' => $image['Image']['id']));
						}
						
						if (is_numeric($account['Account']['archive_w'])) {
							$this->Kodak->develop($lg_path, $lg_path, $account['Account']['archive_w'], $account['Account']['archive_w'], 100);
						}
					}
					break;
			}
		}
		
		// Reset umask
		umask($old_mask);
		@unlink(CACHE . DS . DIR_CACHE . DS . 'users.cache');
		// Exit with some empty space so onComplete always fires in flash/Mac
		exit(' ');
	}
	
	function avatar($user_id) {
		if (!is_dir(AVATARS . DS . $user_id)) {
			$this->Director->makeDir(AVATARS . DS . $user_id);
		}
		if (strpos(strtolower(env('HTTP_USER_AGENT')), 'flash') === false || !$this->RequestHandler->isPost()) {
			exit;
		}
		$oldies = glob(AVATARS . DS . $user_id . DS . 'original.*');
		foreach($oldies as $o) {
			unlink($o);
		}
		$oldies = glob(AVATARS . DS . $user_id . DS . 'cache' . DS . '*');
		foreach($oldies as $o) {
			unlink($o);
		}
		$ext = $this->Director->returnExt($this->params['form']['Filedata']['name']);
		$the_temp = $this->params['form']['Filedata']['tmp_name'];
		$path = AVATARS . DS . $user_id . DS . 'original.' . $ext;
		if (!is_dir(dirname($path))) {
			umask(0);
			mkdir(dirname($path), 0777);
		}
		if (in_array($ext, a('jpg', 'jpeg', 'gif', 'png'))) {
			if (is_uploaded_file($the_temp)) {
				move_uploaded_file($the_temp, $path);
			}
		}
		exit(' ');
	}
}

?>