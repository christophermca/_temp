<?php

class GalleriesController extends AppController {
	// Helpers
	var $helpers = array('Html', 'Javascript', 'Ajax');
    var $name = 'Galleries';

	var $non_ajax_actions = array('index', 'edit', '_memberData', 'refresh');
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
	// Galleries listing
	////
	function index() {
		$filters = array();
		$params = $this->params;
		$page = 1;
		
		if ($this->RequestHandler->isAjax()) { 
			$this->set('empty', true);

			if (isset($this->data['Gallery']['search'])) {
				$search = $this->data['Gallery']['search'];
			} elseif ($this->Session->check('Gallery.search')) {
				$search = $this->Session->read('Gallery.search');
			}

			if (isset($search)) {
				if (empty($search)) {
					$this->Session->del('Gallery.search');
				} else {
					$filters[] = "(lower(Gallery.name) like '%" . low($search) . "%' OR lower(Gallery.description) like '%" . low($search) . "%')"; 
					$this->Session->write('Gallery.search', $search);
					$this->data['Gallery']['search'] = $search;
				}
			}
			
			if (isset($params['named']['page'])) {
				$page = $params['named']['page'];
				$this->Session->write('Gallery.page', $page);
			} elseif ($this->Session->check('Gallery.page')) {
				$page = $this->Session->read('Gallery.page');
			}
		} else {
			// Available imports?
			$imports = $this->Director->checkImports();
			if (empty($imports) || !$imports) {
				$this->set('imports', false);
			} else {
				$this->set('imports', $imports);
			}
			$this->Session->del('Gallery.search');
			$this->Session->del('Gallery.page');
		}
		
		if (isset($params['named']['sort'])) {
			$sort = $params['named']['sort'];
			$dir = $params['named']['direction'];
			$this->Cookie->write('Gallery.sort', "$sort $dir", true, 32536000);
		} elseif ($this->Cookie->read('Gallery.sort')) {
			$val = $this->Cookie->read('Gallery.sort');
			@list($sort, $dir) = explode(' ', $val);
		}
		
		if (isset($sort) && in_array($sort, array('name', 'tag_count', 'created_on', 'modified_on')) && in_array(strtolower($dir), array('desc', 'asc'))) {
			$this->paginate = array_merge($this->paginate, array('order' => array($sort => $dir)));
		}
		
		$this->paginate = array_merge($this->paginate, array('page' => $page));
		$this->Gallery->recursive = -1;
		$this->set('galleries', $this->paginate('Gallery', $filters));
		if ($this->RequestHandler->isAjax()) { 
			$this->render('list', 'ajax');
		}
	}
	
	////
	// Create a new gallery
	////	
	function create() {
		if ($this->Gallery->save($this->data)) {
			if ($this->data['redirect'] == 2) {
				$this->set('galleries', $this->Gallery->findAll(null, null, 'Gallery.modified_on DESC', 5));
			} else {
				$this->set('id', $this->Gallery->getLastInsertID());
			} 
		}
	}
	
	////
	// Update Gallery
	////
	function update($id) {
		$this->Gallery->id = $id;
		if ($this->Gallery->save($this->data)) {
			$this->set('gallery', $this->Gallery->read());
		}
	}
	
	////
	// Delete gallery
	////
	function delete() {
		$this->Gallery->del($this->params['form']['id']);
		$this->redirect('/galleries/index');
	}
	
	////
	// Edit gallery
	////
	function edit($id, $tab = 'settings') {
		$this->pageTitle = __('Galleries', true);
		$this->set('tab', $tab);
		
		switch($tab) {
			case('settings'):
				$this->data = $this->Gallery->find('first', array('conditions' => array('Gallery.id' => $id), 'recursive' => 1));
				$albums = $this->Gallery->members($this->data);				
				$this->set('gallery', $this->data);
				$this->set('albums', $albums);
				if ($this->data['Gallery']['main']) {
					$is_main = true;
				} else {
					$is_main = false;
				}
				$this->set('is_main', $is_main);
				break;
			case('albums'):
				$this->_memberData($id);
				break;
		}
		$this->set('all_gals', $this->Gallery->find('all', array('order' => 'name', 'recursive' => -1)));
	}
	
	////
	// Link and delink albums to galleries
	////
	function link() {
		$this->Gallery->Tag->save($this->data);
		
		if ($this->Gallery->isMain($this->data['Tag']['did'])) {
			$this->Gallery->Tag->Album->id = $this->data['Tag']['aid'];
			$this->Gallery->Tag->Album->saveField('active', 1);
		}
		$this->_memberData($this->data['Tag']['did']);
		$this->render('refresh_edit_pane', 'ajax');
	}
	
	function delink() {
		$link = $this->Gallery->Tag->find('first', array('conditions' => array('id' => $this->data['Tag']['id']), 'recursive' => -1));
		$id = $link['Tag']['did'];
		$aid = $link['Tag']['aid'];
		$this->Gallery->Tag->delete($this->data);
		
		if ($this->Gallery->isMain($id)) {
			$this->Gallery->Tag->Album->id = $aid;
			$this->Gallery->Tag->Album->saveField('active', 0);
		}
		
		$this->_memberData($id);
		$this->render('refresh_edit_pane', 'ajax');
	}
	
	function toggle() {
		if (isset($this->data['active'])) {
			if ($this->data['active']) {
				$this->Gallery->Tag->save($this->data);
			} else {
				$this->Gallery->Tag->deleteAll(sprintf('did = %d AND aid = %d', $this->data['Tag']['did'], $this->data['Tag']['aid']));
			}
		}
		$count = $this->Gallery->Tag->find('count', array('conditions' => 'aid = ' . $this->data['Tag']['aid']));
		printf(__('Active in %s.', true), '<strong>' . $count . '</strong> ' . ife($count > 1, __('galleries', true), __('gallery', true)));
		exit;
	}
	
	////
	// Reset order type and refresh the album order as needed
	////
	function order_type($id) {
		$this->Gallery->id = $id;
		$this->Gallery->save($this->data);
		$this->Gallery->cacheQueries = false;
		$this->Gallery->reorder($id);
		$this->_memberData($id);
		$this->render('order_type', 'ajax');
	}
	
	////
	// Private function to refresh gallery members
	////
	function _memberData($id) {
		$this->data = $this->Gallery->find('first', array('conditions' => array('id' => $id), 'recursive' => 2));
		$this->set('gallery', $this->data);
		
		if (!$this->data['Gallery']['main']) {
			$this->set('is_main', false);
			$member_ids_arr = array();
			foreach ($this->data['Tag'] as $l) { 
				$member_ids_arr[] = $l['aid'];
			}
		
			// Find active albums, gallery members, and the diff
			$all_albums = $this->Gallery->Tag->Album->find('all', array('conditions' => array('active' => 1), 'order' => 'name', 'recursive' => -1));
			$non_member_ids_arr = array();
			foreach ($all_albums as $a) { 
				$aid = $a['Album']['id'];
				if (!in_array($aid, $member_ids_arr)) {
					$non_member_ids_arr[] = $aid;
				}
			}
			if (empty($non_member_ids_arr)) {
				$non_members = array();
			} else {
				$non_member_ids = join(',', $non_member_ids_arr);
				$non_members = $this->Gallery->Tag->Album->findAll("id IN ($non_member_ids)", null, 'name', null, 1, -1);
			}
		
			$this->set('non_members', $non_members);
		} else {
			$this->set('is_main', true);
		} 
	}
}

?>