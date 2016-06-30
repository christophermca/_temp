<?php

class AccountsController extends AppController {
    var $name = 'Accounts';
	var $helpers = array('Html', 'Javascript', 'Ajax');
	
	var $non_ajax_actions = array('settings', 'info', '_data', 'theme', 'language', 'activate', 'news');
	
	// Only logged in users should see this controller's actions
 	function beforeFilter() {
		// Protect ajax actions
		if (!in_array($this->action, $this->non_ajax_actions)) {
			$this->verifyAjax();
		}
		// Check session
		$this->checkSession();
		$this->verifyRight(3);
	}
	
	////
	// Manage account preferences
	////
	function info() {
		$this->pageTitle = __('System info', true);
		$account = $this->Account->find();
		$this->set('account', $account);
		DIR_GD_VERSION > 0 ? $gd = true : $gd = false;
		$this->set('gd', $gd);
		$this->set('curl', extension_loaded('curl'));
		
		if (DIR_GD_VERSION >= 3) {
			$image_lib = 'ImageMagick';
		} elseif (DIR_GD_VERSION == 2) {
			$image_lib = 'GD2';
		} else {
			$image_lib = 'GD1';
		}
		
		list($max, $post_max_broken) = $this->Director->uploadLimit();
				
		$info = array(
					'php' => phpversion(),
					'memory' => ini_get('memory_limit'),
					'processing' => $image_lib,
					'max_upload' => $max,
					'post_max_broken' => $post_max_broken,
					'exif' => is_callable('exif_read_data'),
					'iptc' => is_callable('iptcparse')
				);
				
		$this->set('info', $info);
	}
	
	function settings() {
		@$account = $this->data = $this->account;
		$this->set('account', $account);
		uses('Folder');
		$themes_folder = new Folder(THEMES);
		$themes = $themes_folder->ls(true, false);
		$this->set('themes', $themes[0]);
		$custom_themes_folder = new Folder(USER_THEMES);
		$custom_themes_templates = $custom_themes_folder->ls(true, array('sample', '.', '..', '.svn'));
		$this->set('custom_themes', $custom_themes_templates[0]);
		$lang_folder = new Folder(APP . DS . 'locale');
		$langs = $lang_folder->ls(true, false);
		$this->set('langs', $langs[0]);
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
		natsort($dirs);
		$this->set('iptcs', $iptcs);
		$this->set('exifs', $exifs);
		$this->set('dirs', $dirs);
	}
	
	////
	// Set captions on all images in an album
	////
	function defaults($id) {
		$this->Account->id = $id;
		$this->Account->save($this->data);
		exit();
	}
	
	////
	// Update accoumt
	////
	function update($id) {
		$this->Account->id = $id;
		$this->Account->save($this->data);
		exit;
	}
	
	function theme($new_theme) {
		$account = $this->account;
		$this->Account->id = $account['Account']['id'];
		$theme = r('--', '/', strtolower($new_theme));
		$this->Account->recursive = -1;
		$this->Account->saveField('theme', '/' . $theme . '.css');
		$this->redirect('/accounts/settings');
		exit;
	}
	
	function language($new_lang) {
		$account = $this->account;
		$this->Account->id = $account['Account']['id'];
		$this->Account->recursive = -1;
		$this->Account->saveField('lang', $new_lang);
		Configure::write('Config.language', $new_lang);
		App::import('Model', 'User');
		$this->User =& new User();
		$u = $this->User->find('id=' . CUR_USER_ID);
		$this->Session->write('User', $u['User']);
		$this->redirect('/accounts/settings');
	}
	
	function news($value = 0) {
		$account = $this->account;
		$this->Account->id = $account['Account']['id'];
		$this->Account->recursive = -1;
		$this->Account->saveField('externals', $value);
		$this->redirect('/accounts/settings');
	}
	
	function activate() {
		$this->layout = "simple";
		
		if (isset($this->data['transfer'])) {
			list($code, $result) = $this->Pigeon->activate($this->data['Account']['activation_key'], true);
			if ($code == 0) {
				$this->Account->id = $this->account['Account']['id'];
				$this->data['Account']['last_check'] = date('Y-m-d H:i:s', strtotime('+2 weeks'));
				$this->Account->save($this->data['Account']);
				$this->set('success', true);
			} else {
				$this->set('error', $result);
			}
		} else if ($this->data['Account']) {
			list($code, $result) = $this->Pigeon->activate($this->data['Account']['activation_key']);
			if ($code == 0) {
				$this->Account->id = $this->account['Account']['id'];
				$this->data['Account']['last_check'] = date('Y-m-d H:i:s', strtotime('+2 weeks'));
				$this->Account->save($this->data);
				$this->set('success', true);
			} else {
				$this->set('error', $result);
				
			}
		} else {
			$this->data = $this->account;
		}
	}
}

?>