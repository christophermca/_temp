<?php

class Album extends AppModel {
    var $name = 'Album';
	var $components = array('Director');

	var $hasMany = array('Image' =>
	              		array('className'  => 'Image',
	                      	  'foreignKey' => 'aid',
							  'dependent'  => true,
							  'order' 	   => 'seq, src'	
	                	),
						'Tag' => 
						array('className'  => 'Tag',
							  'foreignKey' => 'aid',
							  'dependent'  => true
						)
	               );

	function bindPreview() {
		$hasOne = array('Preview' =>
							array(	'className' 	=> 'Image',
								  	'foreignKey' => false,
								   	'conditions' 	=> 'Preview.id = Album.preview_id'));
		$this->bindModel(array('hasOne' => $hasOne));
	}
	
	function beforeFind($queryData) {
		if (is_array($queryData['conditions'])) {
			$queryData['conditions'][] = "Album.name <> ''";
		} else {
			if (!empty($queryData['conditions'])) {
				$queryData['conditions'] .= " AND ";
			}
			$queryData['conditions'] .= "Album.name <> ''";
		}
		return $queryData;
	}
	
	function afterFind($result) {
		if (!isset($result[0]['Album'])) { return $result; } 
		if (!array_key_exists('description', $result[0]['Album'])) { return $result; }
		for($i = 0; $i < count($result); $i++) {
			$description = $result[$i]['Album']['description'];
			if (empty($description)) {
				$result[$i]['Album']['description_clean'] = __('This album does not have a description.', true);
			} else {
				$result[$i]['Album']['description_clean'] = $description;
			}
		}
		return $result;
	}
	
	////
	// callbacks to clear the cache
	////
	function afterSave() {
		App::import('Model', 'Tag');
		$this->Tag =& new Tag();
		$tags = $this->Tag->findAll(aa('aid', $this->id));
		if (!empty($tags)) {
			foreach($tags as $tag) {
				$this->Tag->Gallery->reorder($tag['Gallery']['id']);
			}
		}
		$this->popCache();
		return true;
	}
	
	function beforeDelete() {
		$this->popCache();
		return true;
	}
	
	function popCache() {
		$id = $this->id;
		$album = $this->read();
		$targets = array("images_album_{$id}", "images_album_.*,{$id}_");
		$api_targets = array("get_album_{$id}", 'get_album_list', 'get_albums_list');
		if (!empty($album['Tag'])) {	
			$api_targets[] = 'get_gallery_list';
			foreach ($album['Tag'] as $tag) {
				$targets[] = 'images_gid_' . $tag['did'];
				$targets[] = 'images_gallery_' . $tag['did'];
				$api_targets[] = 'get_gallery_' . $tag['did'];
			}
		}
		$this->clearCache($targets, $api_targets);
	}
	
	////
	// Quickly return images in array
	////
	function returnImages($id) {
		$this->id = $id;
		$album = $this->read();
		return $album['Image'];
	}
	
	////
	// Reorder based on preset
	////
	function reorder($id, $manual = false) {
		// On really large albums, this might take a while
		if (function_exists('set_time_limit')) {
			set_time_limit(0);
		}
		$this->id = $id;
		$this->recursive = -1;
		$album = $this->read();
		$order = $album['Album']['sort_type'];
		$this->Image->coldSave = true;
		switch($order) {
			case('manual'):
				if ($manual) {
					$this->Image->recursive = -1;
					$images = $this->Image->find('all', array('conditions' => "aid = $id", 'order' => 'seq'));
					$i = 0;
					$this->Image->begin();
					foreach($images as $image) {
						$d = $i + 1;
						if ($image['Image']['seq'] != $d) {
							$this->Image->query("UPDATE " . DIR_DB_PRE . "images SET seq = $d WHERE id = {$image['Image']['id']}");
						}
						if ($image['Image']['active']) {
							$i++;
						}
					}
					$this->Image->commit();
				}
				break;
			case('file name (oldest first)'):
			case('file name (newest first)'):
				$images = $this->Image->find('all', array('conditions' => array('aid' => $id), 'recursive' => -1));
				$files = array();
				foreach($images as $i) {
					$files[] = $i['Image']['src'] . '__~~__' . $i['Image']['id'] . '__~~__' . $i['Image']['active'] . '__~~__' . $i['Image']['seq'];
				}
				natcasesort($files);
				if (strpos($order, 'newest') !== false) {
					$files = array_reverse($files);
				}
				$files = array_values($files);
				$seq = 0;
				$this->Image->begin();
				for($i = 0; $i < count($files); $i++) {
					$bits = explode('__~~__', $files[$i]);
					$d = $seq + 1;
					if ($bits[3] != $d) {
						$this->Image->query("UPDATE " . DIR_DB_PRE . "images SET seq = $d WHERE id = {$bits[1]}");
					}
					if ($bits[2]) {
						$seq++;
					}
				}
				$this->Image->commit();
				break;
			default:
				preg_match('/(date|captured) \((.*)\)/', $order, $matches);
				$data = $matches[1];
				$order = $matches[2];
				if ($data == 'date') {
					$sql = '`Image`.created_on';
				} else {
					$sql = '`Image`.captured_on';
				}
				if ($order == 'newest first') { $sql .= ' DESC'; }
				$images = $this->Image->find('all', array('conditions' => array('aid' => $id), 'recursive' => -1, 'order' => $sql));
				$seq = 0;
				$this->Image->begin();
				for($i = 0; $i < count($images); $i++) {
					$d = $seq + 1;
					if ($images[$i]['Image']['seq'] != $d) {
						$this->Image->query("UPDATE " . DIR_DB_PRE . "images SET seq = $d WHERE id = {$images[$i]['Image']['id']}");
					}
					if ($images[$i]['Image']['active']) {
						$seq++;
					}
				}
				$this->Image->commit();
				break;
		}
		$this->Image->coldSave = false;
		return true;
	}
	
	function smartConditions($array) {
		$conditions = $array['conditions'];
		if (empty($conditions)) {
			return array();
		} else {
			if ($array['any_all']) {
				$sep = ' AND ';
			} else {
				$sep = ' OR ';
			}
			$q = array();
			foreach($conditions as $c) {
				$bool = '';
				if (isset($c['bool']) && !$c['bool']) {
					$bool = 'NOT ';
				}
				switch($c['type']) {
					case 'tag':
						if (!empty($c['input'])) {
							$_q = "(Image.tags {$bool}LIKE '%{$c['input']},%'";
							if (!$c['bool']) {
								$_q .= ' OR Image.tags IS NULL)';
							} else {
								$_q .= ')';
							}
							if ($c['filter'] == 0) {
								$_q = $_q . ' AND Album.active = 1';
							} else {
								$_q = $_q . ' AND Album.id = ' . $c['filter'];
							}
							$q[] = $_q;
						}
						break;
					case 'album':
						if (!empty($c['filter'])) {
							$q[] = $bool . 'Image.aid = ' . $c['filter'];
						}
						break;
					case 'date':
						$column = 'Image.' . $c['column'];
						@$offset = $_COOKIE['dir_time_zone'];
						switch($c['modifier']) {	
							case 'on':
								$start = strtotime($c['start'] . ' 00:00:00') - $offset;
								$end = strtotime($c['start'] . ' 23:59:59') - $offset;
								$q[] = "$column {$bool}BETWEEN $start AND $end";
								break;
							case 'before':
								$start = strtotime($c['start'] . ' 00:00:00') - $offset;
								$q[] = "{$bool}$column < $start AND $column IS NOT NULL AND $column <> 0";
								break;
							case 'after':
								$start = strtotime($c['start'] . ' 23:59:59') - $offset;
								$q[] = "{$bool}$column > $start";
								break;
							case 'between':
								$start = strtotime($c['start'] . ' 00:00:00') - $offset;
								$end = strtotime($c['end'] . ' 23:59:59') - $offset;
								$q[] = "$column {$bool}BETWEEN $start AND $end";
								break;
							case 'within':
								$end_str = date('Y-m-d') . ' 23:59:59';
								$end = strtotime($end_str);
								$start = strtotime($end_str . ' -' . $c['within'] . ' ' . $c['within_modifier'] . 's');
								$q[] = "{$bool}$column > $start";
								break;
						}
						break;
				}
			}
		}	
		if (empty($q)) {
			$images = array();
		} else {
			$condition_for_query = '(' . join($sep, $q) . ') AND Image.active = 1';

			if (isset($array['limit_to']) && is_numeric($array['limit_to'])) {
				$condition_for_query .= ' AND is_video = ' . $array['limit_to'];
			}
			
			if (is_numeric($array['limit'])) {
				$limit = $array['limit'];
			} else {
				$limit = null;
			}
			
			$order = $array['order'];
			$no_results = false;
			switch($order) {
				case 'file':
					$images = $this->Image->find('all', array('conditions' => $condition_for_query, 'fields' => 'Image.id, Image.src, Album.active', 'recursive' => 1));
					if (empty($images)) {
						return array();
					}
					$files = array();
					foreach($images as $i) {
						$files[] = $i['Image']['src'] . '__~~__' . $i['Image']['id'];
					}
					natcasesort($files);
					$ids = array();
					foreach ($files as $f) {
						$bits = explode('__~~__', $f);
						$ids[] = $bits[1];
					}
					if ($array['order_direction'] == 'DESC') {
						$ids = array_reverse($ids);
					}
					$ids = join(',', $ids);
					$order_sql = "FIELD(Image.id, $ids)";
					break;
				default:
					if ($order == 'date') {
						$col = 'created_on';
					} else {
						$col = 'captured_on';
					}
					$order_sql = "Image.$col {$array['order_direction']}";
					break;
			}
			return array($condition_for_query, $order_sql, $limit);
		}
	}
	
	function refreshSmartCounts() {
		$smarties = $this->find('all', array('conditions' => array('Album.smart' => 1), 'fields' => 'Album.smart_query, Album.id', 'recursive' => -1));
		if (!empty($smarties)) {
			$this->begin();
			foreach($smarties as $s) {
				$id = $s['Album']['id'];
				$q = $s['Album']['smart_query'];
				@list($conditions, $order, $limit) = $this->smartConditions(unserialize($q));
				$count = $this->Image->find('count', array('conditions' => $conditions, 'limit' => $limit, 'order' => $order, 'recursive' => 2));	
				if (is_numeric($limit) && $count > $limit) {
					$count = $limit;
				}
				$this->id = $id;
				$this->saveField('images_count', $count);
			}
			$this->commit();
		}
	}
}

?>