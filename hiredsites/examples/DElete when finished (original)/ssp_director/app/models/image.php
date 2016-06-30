<?php

class Image extends AppModel {
    var $name = 'Image';
	var $coldSave = false;
	var $belongsTo = array('Album' =>
                           array('className'  => 'Album',
                                 'foreignKey' => 'aid'
                           )
                     );

	function beforeSave() {
		if (isset($this->data['Image']['tags'])) {
			$this->data['Image']['tags'] = rtrim(preg_replace('/,+/', ',', r(' ', ',', trim($this->data['Image']['tags']))), ',') . ',';
			if ($this->data['Image']['tags'] == ',') {
				$this->data['Image']['tags'] = '';
			}
		}
		return parent::beforeSave();
	}
	
	////
	// callbacks to clear the cache
	////
	function afterSave() {
		if (!$this->coldSave) {
			$this->popCache();
			$this->Album->refreshSmartCounts();
		} else {
			$this->popApi();
		}
		return true;
	}
	
	function afterFind($results) {
		if (isset($results[0]['Image']['tags'])) {
			for($i = 0; $i < count($results); $i++) {
				$results[$i]['Image']['tags'] = trim(r(',', ' ', $results[$i]['Image']['tags']));
			}
		}
		return $results;
	}
	
	function beforeDelete() {
		if (!$this->coldSave) {
			@$this->popCache(false);
		} else {
			$this->popApi();
		}
		$this->clearFiles($this->data);
		return true;
	}
	
	function clearFiles($image) {
		$album_path = 'album-' . $image['Image']['aid'];
		// Delete it from the filesystem if no other albums use this path
		$path = ALBUMS . DS . $album_path . DS;
		@unlink($path . 'lg' . DS . $image['Image']['src']);
		$this->clearCaches($image['Image']['src'], $path);
	}
	
	function clearCaches($str, $path) {
		$caches = glob($path . DS . 'cache' . DS . $str . '*');
		if (!empty($caches)) {
			foreach($caches as $cache) {
				@unlink($cache);
			}
		}
	}
	
	function popApi() {
		$id = $this->id;
		$api_targets = array('get_content_' . $id, 'get_users', 'get_content_list');
		$this->clearCache(array(), $api_targets);
	}
	
	function popCache($save = true) {
		$id = $this->id;
		$image = $this->read();
		$this->popApi();
		$album_id = $image['Album']['id'];
		$this->cacheQueries = false;
		$count = $this->findCount(aa('aid', $album_id));
		if (!$save) { $count -= 1; }
		$this->Album->id = $album_id;
		$album = $this->Album->read();
		if ($album && !$album['Album']['smart']) {
			$data['Album']['images_count'] = $count;
			$data['Album']['modified_on'] = $this->Album->gm();
			$this->Album->save($data);
		}
	}
}

?>