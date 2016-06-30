<?php

class Gallery extends AppModel {
    var $name = 'Gallery';
	var $useTable = 'dynamic';

	var $hasMany = array('Tag' => 
						array('className'  => 'Tag',
							  'foreignKey' => 'did',
							  'dependent'  => true,
							  'order'      => 'display'
						)
	               );

	function afterFind($result) {
		if (!isset($result[0]['Gallery'])) { return $result; } 
		if (!array_key_exists('description', $result[0]['Gallery'])) { return $result; }
		for($i = 0; $i < count($result); $i++) {
			$description = $result[$i]['Gallery']['description'];
			if (empty($description)) {
				$result[$i]['Gallery']['description_clean'] = __('This gallery does not have a description.', true);
			} else {
				$result[$i]['Gallery']['description_clean'] = $description;
			}
		}
		return $result;
	}
	
	////
	// callbacks to clear the cache
	////
	function afterSave() {
		$this->popCache();
		return true;
	}
	
	function beforeDelete() {
		$this->popCache();
		return true;
	}
	
	function popCache() {
		$id = $this->id;
		$targets = array("images_gid_{$id}", "images_gallery_{$id}");
		$api_targets = array('get_gallery_list', 'get_gallery_' . $id);
		$apis = glob(CACHE . 'api' . DS . 'get_associated_*');
		foreach($apis as $a) {
			if (!is_dir($a)) {
				$api_targets[] = basename($a);
			}
		}
		$this->clearCache($targets, $api_targets);
	}
	
	function isMain($id) {
		$this->id = $id;
		$gallery = $this->read();
		return $gallery['Gallery']['main'];
	}
	
	function members($data) {
		if (!empty($data['Tag'])) {
			$ids = array();
			foreach($data['Tag'] as $t) {
				$ids[] = $t['aid'];
			}
			$id_str = implode(',', $ids);
			$albums = $this->Tag->Album->find('all', array('conditions' => array('id' => $ids), 'order' => "FIELD(Album.id, $id_str)", 'recursive' => -1));
		} else {
			$albums = array();
		}
		return $albums;
	}
	
	////
	// Reorder based on preset
	////
	function reorder($id) {
		// On really large galleries, this might take a while
		if (function_exists('set_time_limit')) {
			set_time_limit(0);
		}
		$this->id = $id;
		$this->recursive = 1;
		$gallery = $this->read();
		$albums = $this->members($gallery);
		$order = $gallery['Gallery']['sort_type'];
		App::import('Model', 'Tag');
		$this->Tag =& new Tag();
		if ($order != 'manual') {
			$ids = array();
			switch($order) {
				case('album title (newest first)'):
				case('album title (oldest first)'):
					$names = array();
					foreach($albums as $i => $a) {
						$names[] = $a['Album']['name'] . '__~~__' . $a['Album']['id'];
					}
					natcasesort($names);
					if (strpos($order, 'newest') !== false) {
						$names = array_reverse($names);
					}
					$names = array_values($names);
					$this->Tag->begin();
					for($i = 0; $i < count($names); $i++) {
						$bits = explode('__~~__', $names[$i]);
						$d = $i+1;
						$this->Tag->query("UPDATE " . DIR_DB_PRE . "dynamic_links SET display = $d WHERE aid = {$bits[1]} AND did = $id");
					}
					$this->Tag->commit();
					break;
				default:
					preg_match('/(date|modified) \((.*)\)/', $order, $matches);
					$data = $matches[1];
					$order = $matches[2];
					if ($data == 'date') {
						$sql = '`Album`.created_on';
					} else {
						$sql = '`Album`.modified_on';
					}
					if ($order == 'newest first') { $sql .= ' DESC'; }
					$aids = array();
					foreach($albums as $a) {
						if (is_numeric($a['Album']['id'])) {
							$aids[] = $a['Album']['id']; 
						}
					}
					$aids = join(',', $aids);
					$conditions = "`Album`.id IN ($aids) AND did = " . $gallery['Gallery']['id'];
					$new_albums = $this->Tag->findAll($conditions, null, $sql);
					$i = 1;
					$this->Tag->begin();
					foreach($new_albums as $album) {
						if ($album['Tag']['display'] != $i) {
							$this->Tag->query("UPDATE " . DIR_DB_PRE . "dynamic_links SET display = $i WHERE id = {$album['Tag']['id']}");
						}
						$i++;
					}
					$this->Tag->commit();
					break;
			}
		}
		return true;
	}
}

?>