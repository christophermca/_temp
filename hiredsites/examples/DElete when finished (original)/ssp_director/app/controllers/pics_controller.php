<?php

class PicsController extends AppController {
	// Models needed for this controller
    var $name = 'Images';
	var $components = array('RequestHandler');
	var $disableSessions = array('vxml');
	
	// Only logged in users should see this controller's actions
 	function beforeFilter() {
		// Protect ajax actions
		if ($this->action != 'vxml' && $this->action != 'video_full') {
			$this->verifyAjax();
			$this->checkSession();
		}
	}
	
	////
	// Edit an image
	////
	function edit($id) {
		$this->Image->id = $id;
		$this->data = $this->Image->read();
		list($link, $target) = $this->Director->formLink($this->data['Image'], $this->data['Album']);
		if (empty($this->data['Image']['link']) && !empty($link)) {
			$this->data['Image']['link'] = $link;
			$this->data['Image']['target'] = $target;
		}
		
		$caption = urldecode($this->Director->formCaption($this->data['Image'], $this->data['Album']));
		if (empty($this->data['Image']['caption']) && !empty($caption)) {
			$this->data['Image']['caption'] = $caption;
		}
		
		$title = urldecode($this->Director->formTitle($this->data['Image'], $this->data['Album']));
		if (empty($this->data['Image']['title']) && !empty($title)) {
			$this->data['Image']['title'] = $title;
		}
		
		$this->set('i', $this->data['Image']);
		$this->set('a', $this->data['Album']);
		$rel_path = str_replace('/index.php?', '', $this->base) . '/' . ALBUM_DIR . '/album-' . $this->data['Album']['id'] . '/lg/' . $this->data['Image']['src'];
		$full_path = ALBUMS . DS . 'album-' . $this->data['Album']['id'] . DS . 'lg' . DS . $this->data['Image']['src'];
		if (strpos($full_path, 'http://') !== false) {
			$rel_path = $full_path;
		}
		$this->set('is_album_thumb', $this->data['Image']['id'] == $this->data['Album']['preview_id']);
		$this->set('rel_path', $rel_path);
		$this->set('full_path', $full_path);
		$previews = $this->Image->find('all', array('conditions' => array('or' => array('tn_preview_id' => $this->data['Image']['id'], 'lg_preview_id' => $this->data['Image']['id'])), 'recursive' => -1));
		$this->set('previews', $previews);
		$this->render('edit', 'ajax');
	}
	
	function video_full($id) {
		$this->layout = false;
		$this->set('id', $id);
	}
	
	
	function rm_preview() {
		$p = $this->Image->find('first', array('conditions' => array('Image.id' => $this->data['video']), 'recursive' => -1));
		$update_lg = false;
		
		if ($p['Image']['tn_preview_id'] == $p['Image']['lg_preview_id']) {
			$data = array('tn_preview_id' => "NULL", 'lg_preview_id' => "NULL", 'tn_preview' => "NULL", 'lg_preview' => "NULL");
			$update_lg = true;
		} else if ($p['Image']['tn_preview_id'] == $this->data['source']) {
			if (!empty($p['Image']['lg_preview'])) {
				$data = array('tn_preview_id' => $p['Image']['lg_preview_id'], 'tn_preview' => "'{$p['Image']['lg_preview']}'");
			} else {
				$data = array('tn_preview_id' => "NULL", 'tn_preview' => "NULL");
			}
		} else {
			$data = array('lg_preview_id' => "NULL", 'lg_preview' => "NULL");
			$update_lg = true;
		}
		
		$this->Image->updateAll($data, array('Image.id' => $p['Image']['id']));
		
		$p = $this->Image->find('first', array('conditions' => array('Image.id' => $this->data['video']), 'recursive' => -1));
		$source = $this->Image->find('first', array('conditions' => array('Image.id' => $this->data['source'])));
		$this->set('video', $p);
		$this->set('update_lg', $update_lg);
		$previews = $this->Image->find('all', array('conditions' => array('or' => array('tn_preview_id' => $this->data['source'], 'lg_preview_id' => $this->data['source'])), 'recursive' => -1));
		$this->set('previews', $previews);
		$this->set('i', $source['Image']);
	}
	
	function preview() {
		$id = $this->data['id'];
		$preview_id = $this->data['prv_id'];
		$is_large = (bool) $this->data['lg'];
		$val = $this->data['str'];
		$both = false;
		
		if ($preview_id == 0) {
			$val = $preview_id = "NULL";
		}
		
		if ($is_large) {
			$image = $this->Image->find('first', array('conditions' => array('id' => $id), 'recursive' => -1));
			if (!is_numeric($image['Image']['tn_preview_id'])) {
				$both = true;
			}
			$data['lg_preview'] = $val;
			$data['lg_preview_id'] = $preview_id;
		}
		
		if (!$is_large || $both) {
			$data['tn_preview'] = $val;
			$data['tn_preview_id'] = $preview_id;
		}
		
		$this->Image->id = $id;
		$this->Image->save($data);
		
		$image = $this->Image->find('first', array('conditions' => array('id' => $id), 'recursive' => -1));
		$this->set('i', $image['Image']);
		
		$album = $this->Image->Album->find('first', array('conditions' => array('id' => $image['Image']['aid'])));
		$preview_ids = array();
		foreach($album['Image'] as $i) {
			if ($i['is_video']) {
				if (!empty($i['lg_preview_id'])) {
					$preview_ids[] = $i['lg_preview_id'];
				}

				if (!empty($i['tn_preview_id'])) {
					$preview_ids[] = $i['tn_preview_id'];
				}
			}
		}
		$this->set('preview_ids', $preview_ids);
	}
	
	function vid_preview_url($id, $type) {
		$image = $this->Image->find('first', array('conditions' => array('Image.id' => $id), 'recursive' => -1));
		$this->set('image', $image);
		$this->set('type', $type);
	}
	
	function vid_preview_focal($id, $type) {
		$image = $this->Image->find('first', array('conditions' => array('Image.id' => $id), 'recursive' => -1));
		if ($type == 1) {
			$source = $this->Image->find('first', array('conditions' => array('Image.id' => $image['Image']['lg_preview_id']), 'recursive' => -1));
			
			$data['Image']['lg_preview'] = "{$source['Image']['src']}:{$this->data['x']}:{$this->data['y']}";
			if (!is_numeric($image['Image']['tn_preview_id']) || $image['Image']['tn_preview_id'] == $image['Image']['lg_preview_id']) {
				$data['Image']['tn_preview'] = $data['Image']['lg_preview'];
			}
		} else {
			$source = $this->Image->find('first', array('conditions' => array('Image.id' => $image['Image']['tn_preview_id']), 'recursive' => -1));
			$data['Image']['tn_preview'] = "{$source['Image']['src']}:{$this->data['x']}:{$this->data['y']}";
			
		}
		$this->Image->id = $source['Image']['id'];
		$this->Image->saveField('anchor', serialize($this->data));
		
		$this->Image->id = $image['Image']['id'];
		$this->Image->save($data);
		exit;
	}
	
	////
	// Update image properties
	////
	function update($id) {
		$this->Image->id = $id;
		$image = $this->Image->read();
		$is_thumb = $image['Album']['preview_id'] == $image['Image']['id'];
		
		list($link, $target) = $this->Director->formLink($image['Image'], $image['Album']);
		if ($this->data['Image']['link'] == $link) {
			$this->data['Image']['link'] = '';
		}

		$caption = $this->Director->formCaption($image['Image'], $image['Album']);
		if ($this->data['Image']['caption'] == $caption) {
			$this->data['Image']['caption'] = '';
		}
		
		$title = $this->Director->formTitle($image['Image'], $image['Album']);
		if ($this->data['Image']['title'] == $title) {
			$this->data['Image']['title'] = '';
		}
				
		// If they made a change re: album preview
		if ($this->data['album-thumb'] > 0) {
			$thumb = $image['Image']['src'];
			$this->data['Image']['active'] = $active = abs($this->data['album-thumb'] - 2);
			$thumb_id = $image['Image']['id'];
		} elseif ($is_thumb && $this->data['album-thumb'] == 0) {
			$thumb = '';
			$thumb_id = 0;
			$active = $image['Image']['active'];
		} else {
			$active = 1;
			$thumb_id = 0;
		}
		
		if ($this->data['schedule'] < 2) {
			$this->data['Image']['active'] = $active = $this->data['schedule'];
			$this->data['Image']['end_on'] = $this->data['Image']['start_on'] = null;
		} else {
			$start = strtotime($this->data['scheduling']['filter_start']);
			$end = strtotime($this->data['scheduling']['filter_end']);
			switch($this->data['schedule']) {
				case '2':
					$this->data['Image']['start_on'] = $start;
					$this->data['Image']['end_on'] = null;
					break;
				case '3':
					$this->data['Image']['start_on'] = null;
					$this->data['Image']['end_on'] = $start;
					break;
				case '4':
					$this->data['Image']['start_on'] = $start;
					$this->data['Image']['end_on'] = $end;
					break;
			}
			$active = $this->data['Image']['active'] = $this->Director->parseActive($this->data['Image']['start_on'], $this->data['Image']['end_on']);
		}
		
		$this->set('thumb', $thumb_id);
		$this->set('active', $active);
		$this->set('id', $image['Image']['id']);
		
		$this->Image->save($this->data);
		
		if (isset($thumb)) {
			list($x, $y) = parse_anchor($image['Image']['anchor']);
			if (empty($thumb)) {
				$tn = '';
				$preview_id = 0;
			} else {
				$tn = join(':', array($image['Image']['src'], $image['Image']['aid'], $x, $y));
				$preview_id = $image['Image']['id'];
			}
			$this->Image->Album->id = $image['Album']['id'];
			$data['Album']['aTn'] = $tn;
			$data['Album']['preview_id'] = $preview_id;
			$this->Image->Album->save($data);
		}
	}
	
	function anchor($id) {
		$this->Image->id = $id;
		$this->Image->saveField('anchor', serialize($this->data));
		$image = $this->Image->read(null, $id);
		$this->Image->clearCaches($image['Image']['src'], ALBUMS . DS . 'album-' . $image['Album']['id']);
		$this->set('image', $image);
		$bit = $image['Image']['src'] . ':' . $image['Image']['aid'];
		list($x, $y) = parse_anchor(serialize($this->data));
		$new = join(':', array($image['Image']['src'], $image['Image']['aid'], $x, $y));
		$new_vid = join(':', array($image['Image']['src'], $x, $y));
		$this->Image->Album->updateAll(array('aTn' => "'$new'"), array('aTn LIKE' => "$bit:%"));
		$this->Image->updateAll(array('lg_preview' => "'$new_vid'"), array('lg_preview_id' => $image['Image']['id']));
		$this->Image->updateAll(array('tn_preview' => "'$new_vid'"), array('tn_preview_id' => $image['Image']['id']));
		$previews = $this->Image->find('all', array('conditions' => array('lg_preview_id' => $image['Image']['id']), 'recursive' => -1));
		$this->set('previews', $previews);
 		$this->render('anchor', 'ajax');	
	}
	
	////
	// Delete an image
	////
	function delete() {
		$ids = explode(',', $this->data['Image']['id']);
		$this->Image->coldSave = true;
		$album_id = null;
		$pids = array();
		$prvs = array();
		
		foreach($ids as $id) {
			$this->Image->id = $id;
			$this->Image->recursive = -1;
			$image = $this->Image->read();
			
			if (is_null($album_id)) {
				$album_id = $image['Image']['aid'];
			}

			// Delete the image from the DB
			$this->Image->del($image['Image']['id']);
		
			$bit = $image['Image']['src'] . ':' . $image['Image']['aid'];
			$this->Image->Album->updateAll(array('aTn' => "NULL", 'preview_id' => 0), array('aTn LIKE' => "$bit:%"));
			
			$previews = $this->Image->find('all', array('conditions' => array('or' => array('lg_preview_id' => $image['Image']['id'], 'tn_preview_id' => $image['Image']['id'])), 'recursive' => -1));
			
			if (is_numeric($image['Image']['lg_preview_id'])) {
				$prvs[] = $image['Image']['lg_preview_id'];
			}
			
			if (is_numeric($image['Image']['tn_preview_id'])) {
				$prvs[] = $image['Image']['tn_preview_id'];
			}
			
			if (!empty($previews)) {
				foreach($previews as $p) {
					if ($p['Image']['tn_preview_id'] == $p['Image']['lg_preview_id']) {
						$data = array('tn_preview_id' => "NULL", 'lg_preview_id' => "NULL", 'tn_preview' => "NULL", 'lg_preview' => "NULL");
						$pids[] = $p['Image']['id'];
					} else if ($p['Image']['tn_preview_id'] == $image['Image']['id']) {
						if (!empty($p['Image']['lg_preview'])) {
							$data = array('tn_preview_id' => $p['Image']['lg_preview_id'], 'tn_preview' => "'{$p['Image']['lg_preview']}'");
						} else {
							$data = array('tn_preview_id' => "NULL", 'tn_preview' => "NULL");
						}
					} else {
						$data = array('lg_preview_id' => "NULL", 'lg_preview' => "NULL");
						$pids[] = $p['Image']['id'];
					}
					$this->Image->updateAll($data, array('Image.id' => $p['Image']['id']));
				}
			}
		}
		$this->Image->Album->id = $album_id;
		$this->Image->recursive = -1;
		$this->Image->cacheQueries = false;
		$data = array();
		$data['Album']['images_count'] = $this->Image->find('count', array('conditions' => aa('aid', $album_id)));  
		$this->Image->Album->save($data);
		$this->Image->Album->reorder($album_id, true);
		$this->Image->Album->refreshSmartCounts();
		if (empty($pids)) {
			$previews = array();
		} else {
			$previews = $this->Image->find('all', array('conditions' => array('Image.id' => $pids), 'recursive' => -1));
		}
		$this->set('previews', $previews);
		$this->set('prvs', $prvs);
		@unlink(CACHE . DS . DIR_CACHE . DS . 'users.cache');
	}
	
	function tag() {
		$ids = explode(',', $this->data['tag']['id']);
		foreach($ids as $id) {
			if (empty($this->data['tags'])) {
				$this->Image->id = $id;
				$this->Image->saveField('tags', null);
			} else {
				$this->Image->recursive = -1;
				$image = $this->Image->read(null, $id);
				$this->Image->id = $id;
				$this->Image->saveField('tags', $image['Image']['tags'] . ' ' . $this->data['tags']);
			}
		}
		exit;
	}
	
 	////
	// Copies an image from one album to the other
	////
	function copy() {
		$ids = explode(',', $this->data['copy']['id']);
		$album = $this->Image->Album->read(null, $this->data['target']['id']);
		$host = $this->Image->Album->read(null, $this->data['album_id']);
		$target_count = $album['Album']['images_count'];
		foreach($ids as $id) {
			$this->Image->recursive = -1;
			$image = $this->Image->read(null, $id);
			$path = ALBUMS . DS . 'album-' . $host['Album']['id'];
			$lg = $path . DS . 'lg' . DS . $image['Image']['src'];
			$source = ensureOriginal($lg, $host['Album']['id']);
		
			$target_path = ALBUMS . DS . 'album-' . $album['Album']['id'] . DS . 'lg';
			copy($source, $target_path . DS . $image['Image']['src']);
			
			if (isNotImg($image['Image']['src'])) {
				$customs = glob($path . DS . 'lg' . DS . '___tn___' . r($this->Director->returnExt($image['Image']['src']), '', $image['Image']['src']) . '*');
				if (!empty($customs)) {
					copy($customs[0], $target_path . DS . basename($customs[0]));
				}
			}
			$this->Image->recursive = -1;
			$check = $this->Image->findAll("aid = {$album['Album']['id']} AND src = '{$image['Image']['src']}'");

			if (empty($check)) {
				$noob['Image']['src'] = $image['Image']['src'];
				$noob['Image']['aid'] = $album['Album']['id'];
				$noob['Image']['title'] = $image['Image']['title'];
				$noob['Image']['caption'] = $image['Image']['caption'];
				$noob['Image']['img_info'] = $image['Image']['img_info'];
				$noob['Image']['ext_info'] = $image['Image']['ext_info'];
				$noob['Image']['filesize'] = $image['Image']['filesize'];
				$noob['Image']['anchor'] = $image['Image']['anchor'];
				$noob['Image']['captured_on'] = $image['Image']['captured_on'];
				$noob['Image']['is_video'] = $image['Image']['is_video'];
				$noob['Image']['seq'] = $target_count;
				$target_count++;
				$this->Image->create();
				$this->Image->save($noob);
				$image_id = $this->Image->getLastInsertId();
			} else {
				$image_id = $check['Image']['id'];
			}
		}
		$this->Image->Album->reorder($album['Album']['id']);
		$this->Image->Album->id = $album['Album']['id'];
		$this->Image->recursive = -1;
		$data['Album']['images_count'] = $this->Image->findCount(aa('aid', $album['Album']['id']));  
		$this->Image->Album->save($data);
		@unlink(CACHE . DS . DIR_CACHE . DS . 'users.cache');
		exit;
	}
	
	////
	// Rotate image
	////
	function rotate() {
		$ids = explode(',', $this->data['rotate']['id']);
		$degree = $this->data['rotate']['deg'];
		$images = $this->Image->findAll(aa('Image.id', $ids));
		foreach($images as $image) {
			// Paths
			$path = ALBUMS . DS . 'album-' . $image['Album']['id'];

			$lg_local = $path . DS . 'lg' . DS . $image['Image']['src'];
		
			$lg_original = ensureOriginal($lg_local, $image['Album']['id']);
			
			$this->Kodak->rotate($lg_original, $lg_local, $degree);
			
			$this->Image->clearCaches($image['Image']['src'], $path);
		}
		$this->set('images', $images);		
	}
	
	////
	// Updates image order
	////
	function order() {
		// On really large albums, this might take a while
		if (function_exists('set_time_limit')) {
			set_time_limit(0);
		}
		$order = $this->params['form']['image-view'];		
		$this->Image->coldSave = true;
		$album_id = null;
		$seq = 1;
		while (list($key, $val) = each($order)) {
			if (is_null($album_id)) {
				$img = $this->Image->read(null, $val);
				$album_id = $img['Album']['id'];
				$images = $this->Image->find('all', array('conditions' => "aid = $album_id", 'recursive' => -1));
				$active_arr = array();
				foreach($images as $i) {
					$active_arr[$i['Image']['id']] = $i['Image']['active'];
				}
			}
			$this->Image->id = $val;
			$this->Image->saveField('seq', $seq);
			if ($active_arr[$val] == 1) {
				$seq++;
			}
		}
		$this->Image->coldSave = false;
		$this->Image->Album->id = $album_id;
		$data['Album']['modified_on'] = $this->Image->Album->gm();
		$this->Image->Album->save($data);
	}
	
	////
	// Set titles on all images in an album
	////
	function titles($id) {
		$this->Image->Album->id = $id;
		$this->Image->Album->save($this->data);
		$this->Image->updateAll(array('title' => null), aa("aid", $id));
		exit();
	}
	
	////
	// Set captions on all images in an album
	////
	function captions($id) {
		$this->Image->Album->id = $id;
		$this->Image->Album->save($this->data);
		$this->Image->updateAll(array('caption' => null), aa("aid", $id));
		exit();
	}
	
	////
	// Set links on all images in an album
	////
	function links($id)	{
		$action = urldecode($this->data['Album']['link_template']);
		$this->Image->Album->id = $id;
		$this->Image->Album->save($this->data);
		$this->Image->updateAll(array('link' => null), aa("aid", $id));
		exit();
	}
	
	function toggle() {
		$new_val = $this->data['value'];
		$ids = $this->data['ids'];
		$ids = explode(',', $ids);
		foreach($ids as $id) {
			$this->Image->id = $id;
			$data['Image']['active'] = $new_val;
			$this->Image->save($data);
		}
		exit;
	}
	
	function vxml($id) {
		$this->RequestHandler->respondAs('xml');
		$this->layout = 'xml';
		$this->Image->recursive = -1;
		$image = $this->Image->read(null, $id);
		$path = DIR_HOST . '/' . ALBUM_DIR . '/album-' . $image['Image']['aid'] . '/lg/' . $image['Image']['src'];
		$this->set('path', $path);
	}
	
	function assign_thumb($id) {
		$source = $this->Image->read(null, $this->data['source']);
		$tgt = $this->Image->read(null, $id);
		$path = ALBUMS . DS . 'album-' . $source['Album']['id'] . DS . 'lg';
		$path_glob = ALBUMS . DS . 'album-' . $source['Album']['id'] . DS . '*';
		$base = $this->Director->returnExt($tgt['Image']['src'],  true);
		$ext = $this->Director->returnExt($source['Image']['src'], true);
		$new = '___tn___' . r('.' . $base, '.' . $ext, $tgt['Image']['src']);
		$old = '___tn___' . r('.' . $base, '.', $tgt['Image']['src']) . '*';
		$leaving = glob($path_glob . DS . $old );
		foreach($leaving as $l) {
			unlink($l);
		}
		copy($path . DS . $source['Image']['src'], $path . DS . $new);
		exit;
	}
}

?>