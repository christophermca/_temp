<?php

class AlbumsController extends AppController {
    var $name = 'Albums';
	var $helpers = array('Html', 'Javascript', 'Ajax', 'Cache');
	
	var $non_ajax_actions = array('index', 'edit', 'reorder', 'page_smart');
	var $paginate = array('limit' => 50, 'page' => 1, 'order' => array('name' => 'asc')); 
		
	// Only logged in users should see this controller's actions
 	function beforeFilter() {
		// Protect ajax actions
		if (!in_array($this->action, $this->non_ajax_actions)) {
			$this->verifyAjax();
		}
		// Check session
		$this->checkSession();		
	}
	
	////
	// Albums listing
	////
	function index() {
		$this->set('writable', $this->Director->setPerms(ALBUMS));
		$filters = array();
		$params = $this->params;
		$page = 1;
		
		if ($this->RequestHandler->isAjax()) { 
			$this->set('empty', true);

			if (isset($this->data['Album']['search'])) {
				$search = $this->data['Album']['search'];
			} elseif ($this->Session->check('Album.search')) {
				$search = $this->Session->read('Album.search');
			}

			if (isset($search)) {
				if (empty($search)) {
					$this->Session->del('Album.search');
				} else {
					$filters[] = "(lower(Album.name) like '%" . low($search) . "%' OR lower(Album.description) like '%" . low($search) . "%')"; 
					$this->Session->write('Album.search', $search);
					$this->data['Album']['search'] = $search;
				}
			}

			$active = 2;
			if (isset($this->data['Album']['active'])) {
				if ($this->data['Album']['active'] == 2) {
					$this->Session->del('Album.active');
				}
				$active = $this->data['Album']['active'];
			} elseif ($this->Session->check('Album.active')) {
				$active = $this->Session->read('Album.active');
				$this->data['Album']['active'] = $active;
			}

			if ($active != 2) {
				$filters[] = "Album.active = " . $active;
				$this->Session->write('Album.active', $active);
			}
			
			if (isset($params['named']['page'])) {
				$page = $params['named']['page'];
				$this->Session->write('Album.page', $page);
			} elseif ($this->Session->check('Album.page')) {
				$page = $this->Session->read('Album.page');
			}
		} else {
			$this->Session->del('Album.search');
			$this->Session->del('Album.active');
			$this->Session->del('Album.page');
			$this->set('empty', false);
		}
		
		if (isset($params['named']['sort'])) {
			$sort = $params['named']['sort'];
			$dir = $params['named']['direction'];
			$this->Cookie->write('Album.sort', "$sort $dir", true, 32536000);
		} elseif ($this->Cookie->read('Album.sort')) {
			$val = $this->Cookie->read('Album.sort');
			@list($sort, $dir) = explode(' ', $val);
		}

		if (isset($sort) && in_array($sort, array('name', 'images_count', 'smart', 'created_on', 'modified_on')) && in_array(strtolower($dir), array('desc', 'asc'))) {
			$this->paginate = array_merge($this->paginate, array('order' => array($sort => $dir)));
		}
		
		$this->paginate = array_merge($this->paginate, array('page' => $page));
		$this->Album->recursive = -1;
		$this->set('albums', $this->paginate('Album', $filters));
		if ($this->RequestHandler->isAjax()) { 
			$this->render('list', 'ajax');
		}
	}
	
	////
	// Create album
	////
	function create() {
		$this->data['Album']['caption_template'] = $this->account['Account']['caption_template'];
		$this->data['Album']['title_template'] = $this->account['Account']['title_template'];
		$this->data['Album']['link_template'] = $this->account['Account']['link_template'];
		if ($this->Album->save($this->data)) {
			// Make directories and set path
			$this->Album->id = $this->Album->getLastInsertId();
			$path = 'album-' . $this->Album->id;
			if ($this->Director->makeDir(ALBUMS . DS . $path) &&
				$this->Director->createAlbumDirs($this->Album->id))
			{
				
				if (isset($this->data['quick'])) {
					// Find albums for upload dialogue
					$this->set('all_albums', $this->Album->find('all', array('conditions' => array('smart' => 0), 'order' => 'name', 'recursive' => -1)));
				} elseif (isset($this->data['dash'])) {
					$recent = $this->Album->findAll(null, null, 'Album.modified_on DESC', 5, 1, -1);
					$this->set('albums', $recent);
				}
				
				// Render redirect via JS
				$this->set('new_id', $this->Album->id);
				$this->set('tab', 'upload');
				$this->render('after_create', 'ajax');
			} else {
				// Directory creation failed, we have a permission problem. Delete the album and notify user
				$this->Album->delete();
				$this->render('creation_failure', 'ajax');
			}
		}	
	}
	
	function refresh_audio($id) {
		$this->Album->id = $id;
		$this->Album->recursive = 2;
		$this->data = $this->Album->read();
		$this->set('album', $this->data);
		$this->set('mp3s', $this->Director->directory(AUDIO, 'mp3,MP3'));
	}
	
	function delete_audio($id) {
		if ($this->data) {
			foreach($this->data['delete'] as $mp3) {
				$this->Album->updateAll(array('audioFile' => "NULL", 'audioCap' => "NULL"), array('audioFile' => "$mp3"));
				unlink(AUDIO . DS . $mp3);
			}
		}
		$this->redirect("/albums/refresh_audio/$id");
	}
	
	////
	// Album edit pane
	////
	function edit($id, $tab = 'settings', $part_id = 0) {
		$this->cacheAction = 30000;
		$this->pageTitle = __('Albums', true);
		$this->Album->id = $id;
		$this->data = $this->Album->find('first', array('conditions' => array('Album.id' => $id)));
		
		if (empty($this->data)) {
			$this->redirect('/albums');
		}
		
		switch($tab) {
			case('summary'):
				$this->redirect('/albums/edit/' . $id);
				break;
			case('settings'):
				$this->set('galleries', $this->Album->Tag->Gallery->find('all', array('fields' => 'Gallery.id, Gallery.name, Gallery.description', 'order' => 'Gallery.name', 'conditions' => 'Gallery.smart = 0', 'recursive' => -1)));
				$templates_folder = new Folder(PLUGS . DS . 'links');
				$link_templates = $templates_folder->ls(true, false);
				$this->set('link_templates', $link_templates[1]);
				$custom_templates_folder = new Folder(CUSTOM_PLUGS . DS . 'links');
				$custom_link_templates = $custom_templates_folder->ls(true, array('sample', '.', '..', '.svn'));
				$this->set('custom_link_templates', $custom_link_templates[0]);
				$iptcs = $this->Director->iptcTags;
				natsort($iptcs);
				$exifs = $this->Director->exifTags;
				natsort($exifs);
				$dirs = $this->Director->dirTags;
				if ($this->data['Album']['smart']) {
					$dirs = array_merge($dirs, $this->Director->smartTags);
				}
				natsort($dirs);
				$this->set('iptcs', $iptcs);
				$this->set('exifs', $exifs);
				$this->set('dirs', $dirs);
				if ($this->data['Album']['smart']) {
					list($images,) = $this->_smart_content(unserialize($this->data['Album']['smart_query']));
					$this->set('images', $images);
				} else {
					$this->set('images', $this->data['Image']);
				}
				break;
				
			case('content'):
				$this->set('mp3s', $this->Director->directory(AUDIO, 'mp3,MP3'));
				if ($this->data['Album']['smart']) {
					list($images,) = $this->_smart_content(unserialize($this->data['Album']['smart_query']));
					$this->set('images', $images);
					$this->set('options', unserialize($this->data['Album']['smart_query']));
					$this->set('active_dummies', $this->Album->find('all', array('conditions' => array('smart' => 0, 'active' => '1'), 'order' => 'name', 'recursive' => -1)));
				} else {
					$this->set('images', $this->data['Image']);
					$this->set('other_albums', $this->Album->find('all', array('conditions' => array('not' => array('Album.id' => $id)), 'recursive' => -1, 'fields' => 'Album.id, Album.name', 'order' => 'name')));
					$preview_ids = array();
					foreach($this->data['Image'] as $i) {
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
				$this->set('selected_id', $part_id);
				if (function_exists('imagerotate') || $this->Kodak->gdVersion() >= 3) {
					$rotate = true;
				} else {
					$rotate = false;
				}
				$this->set('rotate', $rotate);
				break;
				
			case('upload'):
				if ($this->data['Album']['smart']) {
					$this->redirect('/albums/edit/' . $this->data['Album']['id'] . '/content');
				}
				$this->set('writable', $this->Director->setAlbumPerms($this->data['Album']['id']));
				$this->set('other_writable', $this->Director->setOtherPerms());
				// Check if any new files have been uploaded via FTP
				$files = $this->Director->directory(ALBUMS . DS . 'album-' . $this->data['Album']['id'] . DS . 'lg', 'accepted');
				$count = count($this->data['Image']);
				if (count($files) > $count) {
					set_time_limit(0);
					$noobs = array();
					$n = 1;
					foreach($files as $file) {
						if (strpos($file, '___tn___') === false) {
							$this->Album->Image->recursive = -1;
							$this->Album->Image->coldSave = true;
							$img = $this->Album->Image->find(aa('src', $file, 'aid', $id));
							if (empty($img)) {
								$clean = str_replace(" ", "_", $file);
								$clean = ereg_replace("[^A-Za-z0-9._-]", "_", $clean);
								$path = ALBUMS . DS . 'album-' . $this->data['Album']['id'] . DS . 'lg' . DS . $file;
								$clean_path = ALBUMS . DS . 'album-' . $this->data['Album']['id'] . DS . 'lg' . DS . $clean;
								if (rename($path, $clean_path)) {
									$path = $clean_path;
									$file = $clean;
								}
								list($meta, $captured_on) = $this->Director->imageMetadata($path);
								$new['Image']['aid'] = $id;
								$new['Image']['src'] = $file;
								$new['Image']['seq'] = $count + $n;
								$new['Image']['filesize'] = filesize($path);
								$new['Image']['captured_on'] = $captured_on;
								$new['Image']['is_video'] = isVideo($file);
								$this->Album->Image->create();
								if ($this->Album->Image->save($new)) {
									$noobs[] = $file;
								}
								if (is_numeric($this->account['Account']['archive_w'])) {
									$this->Kodak->develop($path, $path, $this->account['Account']['archive_w'], $this->account['Account']['archive_w'], 100);
								}
								$n++;
							}
							$this->Album->Image->coldSave = false;
						}
					}
					if (count($noobs) > 0) {
						$this->Album->id = $this->data['Album']['id'];
						$this->Album->reorder($id);
						$this->Album->cacheQueries = false;
						$this->data = $this->Album->read();
						$this->Album->saveField('images_count', $count + count($noobs));
						$this->Album->refreshSmartCounts();
						$this->set('noobs', $noobs);
					}
				}
				break;
		}
		
		$this->set('all_albums', $this->Album->find('all', array('order' => 'name', 'recursive' => -1, 'fields' => 'Album.id, Album.name')));
		$this->set('all_count', $this->Album->find('count', array('conditions' => array('not' => array('Album.id' => $id)), 'recursive' => -1)));
		$this->set('album', $this->data);
		$this->set('tab', $tab);
	}
	
	////
	// Update album
	////
	function update($id, $refer = '') {
		$this->Album->id = $id;
		if ($this->Album->save($this->data)) {
			$album = $this->Album->read();
			$this->set('album', $album);
		}
	}
	
	function add_smart_rule() {
		$this->cacheAction = 30000;
		$this->set('active_dummies', $this->Album->find('all', array('conditions' => array('smart' => 0, 'active' => 1), 'order' => 'name', 'recursive' => -1, 'fields' => 'Album.id, Album.name')));
	}
	
	function smart($id) {
		if (isset($this->data['conditions'])) {
			$conditions = array();
			$switch = '';
			foreach($this->data['conditions'] as $key => $c) {
				if (isset($c['switch'])) {
					$switch = $c['switch'];
					$bool = $c['bool'];
					list(,$random) = explode('_', $key);
					if (in_array($switch, array('captured', 'uploaded'))) {
						$sw_str = 'date';
					} else {
						$sw_str = $switch;
					}
					$target = $this->data['conditions']["{$sw_str}_{$random}"];
					switch($switch) {
						case 'tag':
							if (isset($target['tag']) && !empty($target['tag'])) {
								$conditions[] = array('type' => 'tag', 'input' => $target['tag'], 'filter' => $target['filter'], 'bool' => $bool);
							}
							break;
						case 'album':
							if (isset($target['filter'])) {
								$conditions[] = array('type' => 'album', 'filter' => $target['filter'], 'bool' => $bool);
							}
							break;
						case 'captured':
						case 'uploaded':
							$go = false;
							if ($switch == 'captured') {
								$column = 'captured_on';
							} else {
								$column = 'created_on';
							}
							if ($target['modifier'] == 'within') {
								$target['filter_start'] = $target['filter_end'] = '';
								if (!empty($target['filter_within']) && is_numeric($target['filter_within'])) {
									$go = true;
								}
							} elseif (isset($target['filter_start']) && !empty($target['filter_start'])) {
								$go = true;
								$target['filter_within'] = $target['modifier_within'] = '';
							}
							
							if ($go) {
									$conditions[] = array('type' => 'date', 'column' => $column, 'start' => $target['filter_start'], 'end' => $target['filter_end'], 'modifier' => $target['modifier'], 'within' => $target['filter_within'], 'within_modifier' => $target['modifier_within'], 'bool' => $bool);
							}
							break;
					}
				}
			}
			if (isset($this->data['limit_on']) && $this->data['limit_on'] && is_numeric($this->data['limit'])) {
				$limit = $this->data['limit'];
			} else {
				$limit = '';
			}
			
			if (isset($this->data['limit_to']) && $this->data['limit_to'] && is_numeric($this->data['limit_to_filter'])) {
				$limit_to = $this->data['limit_to_filter'];
			} else {
				$limit_to = '';
			}
			
			@$conditions_array = array('limit' => $limit, 'limit_to' => $limit_to, 'any_all' => $this->data['any_all'], 'order' => $this->data['order'], 'order_direction' => $this->data['order_direction'], 'conditions' => $conditions);
			list($images, $count) = $this->_smart_content($conditions_array);
		} else {
			$images = $conditions_array = array();
			$count = 0;
		}
		$data['Album']['smart_query'] = serialize($conditions_array);
		if (is_numeric($count)) {
			$data['Album']['images_count'] = $count;
		}
		$this->Album->id = $id;
		$this->Album->save($data);
		$this->set('options', $conditions_array);
		$this->set('album', $this->Album->read(null, $id));
		$this->set('images', $images);
	}
	
	////
	// Delete an album
	////
	function delete() {
		$album = $this->Album->read(null, $this->data['Album']['id']);
		
		// Delete the album from the DB
		if ($this->Album->del($album['Album']['id'], true)) {
			$dir = ALBUMS . DS . 'album-' . $album['Album']['id'];
			$this->Director->rmdirr($dir);
			$this->redirect('/albums/index');
		}
	}
	
	function preview($id) {
		if ($this->data) {
			$this->Album->id = $id;
			$this->Album->save($this->data);
		}	
		$album = $this->Album->read(null, $id);
		if ($album['Album']['smart']) {
			$this->Album->Image->deleteAll("aid = {$album['Album']['id']} AND Image.id <> {$album['Album']['preview_id']}", true, true);
		}
		$this->set('album', $album);
	}
	
	function preview_url($id) {
		if ($this->data) {
			$this->Album->bindPreview();
			$album = $this->Album->read(null, $id);
			$this->Album->Image->id = $album['Preview']['id'];
			$this->Album->Image->saveField('anchor', serialize($this->data));
			$this->Album->id = $id;
			$this->Album->saveField('aTn', join(':', array($album['Preview']['src'], $album['Album']['id'], join(':', $this->data))));
			$this->redirect('/albums/preview/' . $id);
			exit;
		} else {
			$this->data['x'] = $this->data['y'] = 50;
		}
		$this->Album->cacheQueries = false;
		$this->set('album', $this->Album->read(null, $id));
	}
	
	////
	// Toggles albums active and inactive
	////
	function toggle($id) {
		$this->Album->id = $id;
		$album = $this->Album->read();
		if ($this->Album->save($this->data)) {
			if ($this->data['Album']['active']) {
				if (!$album['Album']['active']) {
					$main = $this->Album->Tag->Gallery->find(aa('main', 1));
					$tag['Tag']['did'] = $main['Gallery']['id'];
					$tag['Tag']['aid'] = $id;
					$this->Album->Tag->save($tag);
				}	
			} else {
				$this->Album->Tag->deleteAll("WHERE aid = $id", false, true);
			}
		}
		$this->Album->recursive = 2;
		$album = $this->data = $this->Album->read();
		$this->set('album', $album);
		$this->set('galleries', $this->Album->Tag->Gallery->find('all', array('fields' => 'Gallery.id, Gallery.name, Gallery.description', 'order' => 'Gallery.name', 'conditions' => 'Gallery.smart = 0')));
	}
	
	////
	// Reset order type and refresh the image order as needed
	////
	function order_type($id) {
		$this->Album->id = $id;
		$this->Album->save($this->data);
		$this->Album->cacheQueries = false;
		if ($this->Album->reorder($id)) {
			$this->Album->recursive = 1;
			$this->data = $this->Album->read();
			$this->set('images', $this->data['Image']);
			$this->set('album', $this->data);
			$this->set('tab', 'images');
			if (function_exists('imagerotate') || $this->Kodak->gdVersion() >= 3) {
				$rotate = true;
			} else {
				$rotate = false;
			}
			$this->set('rotate', $rotate);
			$preview_ids = array();
			foreach($this->data['Image'] as $i) {
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
			$this->render('order_type', 'ajax');
		}
	}
	
	////
	// Reorder album after image upload
	////
	function reorder($id) {
		if ($this->Album->reorder($id)) {
			$this->redirect("/albums/edit/$id/content");
			exit;
		}
	}
	
	function page_smart($id) {
		$this->cacheAction = 30000;
		$this->data = $this->Album->read(null, $id);
		list($images,) = $this->_smart_content(unserialize($this->data['Album']['smart_query']));
		$this->set('images', $images);
		$this->set('album', $this->data);
		$this->set('options', unserialize($this->data['Album']['smart_query']));
		$this->render('smart', 'ajax');
	}
	
	function _smart_content($array) {	
		if (empty($array) || empty($array['conditions'])) {
			$images = array();
			$count = 0;
		} else {
			list($conditions, $order, $limit) = $this->Album->smartConditions($array);
			if (is_null($limit)) {
				$this->paginate = array_merge($this->paginate, array('limit' => 20, 'order' => $order));
				$images = $this->paginate('Image', $conditions);
				$count = $this->params['paging']['Image']['count'];
			} else {
				$images = $this->Album->Image->find('all', array('conditions' => $conditions, 'limit' => $limit, 'order' => $order));	
				if (count($images) < $limit) {
					$count = count($images);
				} else {
					$count = $limit;
				}
			}
		}
		return array($images, $count);
	}
}

?>