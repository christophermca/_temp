<?php

class SiteController extends AppController {
	// Models needed for this controller
	var $uses = array();
	// Helpers
	var $helpers = array('Html', 'Javascript', 'Ajax');
    var $name = 'Site';	
	// Data action does not need sessions
	var $disableSessions = array('data', 'old_index', 'translate_js');
	
	////
	// Application Snapshot
	////
	function index() {
		$this->checkSession();
		$this->pageTitle = __('Snapshot', true);
		
		// Load gallery model, everything else will work off of this
		$this->loadModel('Gallery');
		
		// Find albums for upload dialogue
		$this->set('all_albums', $this->Gallery->Tag->Album->find('all', array('conditions' => array('smart' => 0), 'order' => 'name', 'recursive' => -1, 'fields' => 'Album.id, Album.name')));
		
		// Recent modified albums
		$recent =  $this->Gallery->Tag->Album->find('all', array('order' => 'Album.modified_on DESC', 'limit' => 5, 'recursive' => -1, 'fields' => 'Album.id, Album.name, Album.smart'));
		$this->set('albums', $recent);
		
		// Recent modified galleries
		$recent = $this->Gallery->find('all', array('order' => 'Gallery.modified_on DESC', 'limit' => 5, 'recursive' => -1, 'fields' => 'Gallery.id, Gallery.name, Gallery.smart'));
		$this->set('galleries', $recent);
		
		// User stats
		$this->set('image_count',  $this->Gallery->Tag->Album->Image->find('count', array('conditions' => array('Image.created_by' => $this->Session->read('User.id')), 'recursive' => -1)));
		$last_visit = $this->Cookie->read('LastVisit');
		if ($last_visit) {
			if ((time() - $last_visit) > 86400) {
				$this->set('last_visit', intval($last_visit));
			}
		}
		$this->Cookie->write('LastVisit', time(), true, '+1 year');
		$this->set('writable', ($this->Director->setPerms(ALBUMS) && $this->Director->setPerms(AUDIO)));
		$root = env('DOCUMENT_ROOT_MANUAL');
		if (!empty($root) && XDOM_CHECK) {
			$this->set('xdom', file_exists(rtrim($root, DS) . DS . 'crossdomain.xml'));
		} else {
			$this->set('xdom', true);
		}
		
		if ($this->account['Account']['externals'] && $this->Session->read('User.news')) {
			// Get the latest 6 news bits from ssp.net, cache it for 1 hour
        	$news = $this->Pigeon->news();
			$cur_version = trim($this->Pigeon->version());
			if ($cur_version != substr(DIR_VERSION, 0, 6) && !empty($cur_version) && strpos(DIR_VERSION, 'b') === false && strpos(DIR_VERSION, 'rc') === false) {
				$this->set('version_link', 'http://slideshowpro.net/usersys/member.php');
			}
			$this->set('news', $news);
		}
		if ($this->Session->read('User.help')) {
			$quicks = $this->Pigeon->quick_start();
			$this->set('quicks', $quicks);
		}
		
		if (!isset($news) || empty($news)) {
			$limit = 24;
		} else {
			$limit = 16;
		}
		$this->set('recent_images',  $this->Gallery->Tag->Album->Image->find('all', array('conditions' => array('not' => array('Image.src' => 'NULL'), array('Image.active' => 1)), 'fields' => 'Album.name, Image.id, Image.src, Image.created_on, Image.anchor, Image.aid, Image.lg_preview, Image.is_video', 'order' => 'Image.created_on DESC', 'limit' => $limit)));
		
		$this->set('first_time', $this->account['Account']['first_time']);
		if (!$this->account['Account']['first_time']) {
			$this->loadModel('Account');
			$this->Account->id = $this->account['Account']['id'];
			$this->Account->saveField('first_time', 1);
		}
		
	}
	
	// DB Failure page
	////
	function db_error() {
		$this->render('db_error', 'simple');
	}
	
	////
	// XML output
	////
	function data($gid = 'no', $album = 0, $specs = null) {
		// Load gallery model, everything else will work off of this
		$this->loadModel('Gallery');
		list($account, $users) = $this->Director->fetchAccount();
		if (date('mdY', $account['Account']['last_schedule_check']) != date('mdY', time())) {
			$this->Director->scheduling();
			App::import('Model', 'Account');
			$this->Account =& new Account();
			$this->Account->id = $account['Account']['id'];
			$this->Account->saveField('last_schedule_check', time());
		}
		$this->set('controller', $this);
		if (is_null($specs) || empty($specs)) {
			$this->pageTitle = __('Error', true);
			$this->set('account', $account);
			$this->render('xml_error', 'simple');
		} else {
			if (function_exists('set_time_limit')) {
				set_time_limit(0);
			}

			// Start building path to cache file
			$path_to_cache = XML_CACHE . DS . 'images';
		
			// Decide whether to serve a gallery, individual album, or full feed
			if ($album != 0) {
				$id = $album;
				$path_to_cache .= '_album_' . $id;
				$albums = $this->Gallery->Tag->Album->findAll(aa("Album.id", explode(',', $id)), null, "FIELD(Album.id, $id)");
				if (count($albums) == 1) {
					$gallery['Gallery']['name'] = $albums[0]['Album']['name'];
					$gallery['Gallery']['description'] = $albums[0]['Album']['description'];
				} else {
					$gallery = array();
				}
			} else if (is_numeric($gid)) {
				$id = $gid;
				$path_to_cache .= '_gallery_' . $id;
				$albums = $this->Gallery->Tag->findAll("did = $id", null, 'display');
				$this->Gallery->recursive = -1;
				$gallery = $this->Gallery->read(null, $id);
			}
		
			$sp = explode('_', $specs);
			$w = $sp[0]; $h = $sp[1]; $s = $sp[2]; $q = $sp[3]; $sh = $sp[4];
			$tw = $sp[5]; $th = $sp[6]; $ts = $sp[7]; $tq = $sp[8]; $tsh = $sp[9];
			$pw = $sp[10]; $ph = $sp[11]; $ps = $sp[12];
			$path_to_cache .= "_{$w}_{$h}_{$s}_{$q}_{$sh}_{$tw}_{$th}_{$ts}_{$tq}_{$tsh}_{$pw}_{$ph}_{$ps}";
			
			if (isset($sp[13])) {
				$tlw = $sp[13];
				$tlh = $sp[14];
				$path_to_cache .= "_{$tlw}_{$tlh}";
			}
			
			$this->set('specs', $sp);
			$this->set('albums', $albums);
			$this->set('gallery', $gallery);
			// Finish up xml_cache path
			$path_to_cache .= '.xml';
			$this->set('path_to_cache', $path_to_cache);

			// Render w/o layout
			$this->render('data', 'ajax');
		}
	}
}

?>