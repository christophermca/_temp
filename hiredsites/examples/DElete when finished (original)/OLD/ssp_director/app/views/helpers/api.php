<?php

class ApiHelper extends AppHelper {
	var $helpers = array('Director');
	
	function album($album, $preview = '', $size = array(), $user_size = array(), $active = true, $controller, $users) {
		if (!empty($preview) && !empty($album['Album']['aTn'])) {
			$s = explode(',', $preview);
			list($src, $path, $x, $y) = explode(':', $album['Album']['aTn']);
			$preview = '<url>' . p($src, $path, $s[0], $s[1], $s[2], $s[3], $s[4], $x, $y) . '</url>';
			if ($s[2] == 1) {
				list($w, $h) = array($s[0], $s[1]);
			} else {
				list($w, $h) = computeSize(ALBUMS . DS . 'album-' . $path . DS . 'lg' . DS . $src, $s[0], $s[1], $s[2]);
			}
			$preview .= "<width>$w</width><height>$h</height>";
		} else {
			$preview = '';
		}
		$audio = '';
		if (!empty($album['Album']['audioFile'])) {
			$audio = DIR_HOST . '/album-audio/' . $album['Album']['audioFile'];
		}
		$creator = $this->user($album['Album']['created_by'], $users, $user_size);
		$updater = $this->user($album['Album']['updated_by'], $users, $user_size);
		
		$album['Album']['name'] = convert_smart_quotes($album['Album']['name']);
		$album['Album']['description'] = convert_smart_quotes($album['Album']['description']);
		$album['Album']['audioCap'] = convert_smart_quotes($album['Album']['audioCap']);
		
		$out = <<<MSG
<album>
	<id>{$album['Album']['id']}</id>
	<name><![CDATA[{$album['Album']['name']}]]></name>
	<description><![CDATA[{$album['Album']['description']}]]></description>
	<audio>{$audio}</audio>
	<audio_caption><![CDATA[{$album['Album']['audioCap']}]]></audio_caption>
	<modified>{$album['Album']['modified_on']}</modified>
	<created>{$album['Album']['created_on']}</created>
	<date_taken>{$album['Album']['date_taken']}</date_taken>
	<place_taken><![CDATA[{$album['Album']['place_taken']}]]></place_taken>
	<smart>{$album['Album']['smart']}</smart>
	<creator>$creator</creator>
	<updater>$updater</updater>
	<preview>$preview</preview>
MSG;
		if (isset($album['Image']) || isset($album['Smart'])) {
			$out .= '<contents>';

			if (isset($album['Smart'])) {
				foreach($album['Smart'] as $image) {
					$out .= $this->image($image['Image'], $image['Album'], $size, $user_size, $active, $controller, $users, $album['Album']);
				}
			} else {
				foreach($album['Image'] as $image) {
					$out .= $this->image($image, $album['Album'], $size, $user_size, $active, $controller, $users);
				}
			}
		
			$out .= '</contents>';
		}
		$out .= "\n" . '</album>';
		return $out;
	}
	
	function image($image, $album, $size = array(), $user_size = array(), $active = true, $controller, $users, $smart = null) {
		if ($active && !$image['active']) { return ''; }
		$size_str = '';
		
		$arr = unserialize($image['anchor']);
		if (empty($arr)) {
			$x = $y = 50;
		} else {
			$x = $arr['x'];
			$y = $arr['y'];
		}
		
		if (!empty($size)) {
			if (isImage($image['src'])) {
				foreach($size as $s) {
					$s = explode(',', $s);				
					if ($s[3] == 1) {
						list($w, $h) = array($s[1], $s[2]);
					} else {
						list($w, $h) = computeSize(ALBUMS . DS . 'album-' . $image['aid'] . DS . 'lg' . DS . $image['src'], $s[1], $s[2], $s[3]);
					}
					$size_str .= "<{$s[0]}><url><![CDATA[" . p($image['src'], $image['aid'], $s[1], $s[2], $s[3], $s[4], $s[5], $x, $y) . "]]></url>";
					$size_str .= "<width>$w</width><height>$h</height>";
					$size_str .= "</{$s[0]}>";
				}
			} else {
				if (!empty($image['lg_preview'])) {
					foreach($size as $s) {
						$s = explode(',', $s);
						if ($s[3] == 1) {
							list($w, $h) = array($s[1], $s[2]);
						} else {
							list($w, $h) = computeSize(ALBUMS . DS . 'album-' . $image['aid'] . DS . 'lg' . DS . $image['lg_preview'], $s[1], $s[2], $s[3]);
						}
						list($p, $x, $y) = explode(':', $image['lg_preview']);
						$size_str .= "<{$s[0]}><url><![CDATA[" . p($p, $image['aid'], $s[1], $s[2], $s[3], $s[4], $s[5], $x, $y) . "]]></url>";
						$size_str .= "<width>$w</width><height>$h</height>";
						$size_str .= "</{$s[0]}>";
					}
				}
				
				if (!empty($image['tn_preview'])) {
					$size_str .= '<thumb_preview>';
					foreach($size as $s) {
						$s = explode(',', $s);
						if ($s[3] == 1) {
							list($w, $h) = array($s[1], $s[2]);
						} else {
							list($w, $h) = computeSize(ALBUMS . DS . 'album-' . $image['aid'] . DS . 'lg' . DS . $image['tn_preview'], $s[1], $s[2], $s[3]);
						}
						list($p, $x, $y) = explode(':', $image['tn_preview']);
						$size_str .= "<{$s[0]}><url><![CDATA[" . p($p, $image['aid'], $s[1], $s[2], $s[3], $s[4], $s[5], $x, $y) . "]]></url>";
						$size_str .= "<width>$w</width><height>$h</height>";
						$size_str .= "</{$s[0]}>";
					}
					$size_str .= '</thumb_preview>';
				}
			}
		}
		
		if (isImage($image['src'])) {
			list($original_w, $original_h) = getimagesize(ALBUMS . DS . 'album-' . $image['aid'] . DS . 'lg' . DS . $image['src']);
		} else {
			$original_w = $original_h = 0;
		}
		
		$original = DIR_HOST . '/' . ALBUM_DIR . '/album-' . $image['aid'] . '/lg/' . $image['src'];
		if (empty($image['title']) && !empty($album['title_template'])) {
			if (is_null($smart)) {
				$image['title'] = $controller->Director->formTitle($image, $album);
			} else {
				$image['title'] = $controller->Director->formTitle($image, $smart, $album);
			}
		}
		if (empty($image['caption']) && !empty($album['caption_template'])) {
			if (is_null($smart)) {
				$image['caption'] = $controller->Director->formCaption($image, $album);
			} else {
				$image['caption'] = $controller->Director->formCaption($image, $smart, $album);
			}
		}
		if (empty($image['link']) && !empty($album['link_template'])) {
			@list($image['link'], $image['target']) = $controller->Director->formLink($image, $album);
		}
		
		if (!empty($image['start_on']) || !empty($image['end_on'])) {
			$scheduling = '<schedule><begin>' . $image['start_on'] . '</begin><end>' . $image['end_on'] . '</end></schedule>';
		} else {
			$scheduling = '';
		}
		
		$creator = $this->user($image['created_by'], $users, $user_size);
		$updater = $this->user($image['updated_by'], $users, $user_size);
		
		$image['title'] = convert_smart_quotes($image['title']);
		$image['caption'] = convert_smart_quotes($image['caption']);
		
		$out = <<<MSG
<content>
	<id>{$image['id']}</id>
	<src>{$image['src']}</src>
	<album_id>{$image['aid']}</album_id>
	<title><![CDATA[{$image['title']}]]></title>
	<caption><![CDATA[{$image['caption']}]]></caption>
	<tags><![CDATA[{$image['tags']}]]></tags>
	<link><![CDATA[{$image['link']}]]></link>
	<active>{$image['active']}</active>
	$scheduling
	<seq>{$image['seq']}</seq>
	<pause>{$image['pause']}</pause>
	<target>{$image['target']}</target>
	<modified>{$image['modified_on']}</modified>
	<created>{$image['created_on']}</created>
	<captured_on>{$image['captured_on']}</captured_on>
	<creator>$creator</creator>
	<updater>$updater</updater>
	<filesize>{$image['filesize']}</filesize>
	<original><url><![CDATA[$original]]></url><width>$original_w</width><height>$original_h</height></original>
	<focal><x>$x</x><y>$y</y></focal>
	$size_str
MSG;
		
		list($data, $dummy) = $controller->Director->imageMetaData(ALBUMS . DS . 'album-' . $image['aid'] . DS . 'lg' . DS . $image['src']);
		if (!empty($data)) {
			$out .= '<iptc>';
			foreach($controller->Director->iptcTags as $tag) {
				$tag_clean = str_replace(' ', '_', $tag);
				$out .= "<$tag_clean><![CDATA[" . $controller->Director->parseMetaTags("iptc:$tag", $data, 'w') . "]]></$tag_clean>";
			}
			$out .= '</iptc><exif>';
			foreach($controller->Director->exifTags as $tag) {
				$tag_clean = str_replace(' ', '_', $tag);
				$out .= "<$tag_clean><![CDATA[" . $controller->Director->parseMetaTags("exif:$tag", $data, 'w') . "]]></$tag_clean>";
			}
			$out .= '</exif>';
		}
		
		$out .= '</content>';
		return $out;
	}
	
	function gallery($gallery, $albums = array(), $preview = '', $size = array(), $user_size = array(), $active = true, $controller = null, $users) {
		$out = <<<MSG
<gallery>
	<id>{$gallery['Gallery']['id']}</id>
	<name><![CDATA[{$gallery['Gallery']['name']}]]></name>
	<description><![CDATA[{$gallery['Gallery']['description']}]]></description>
	<created>{$gallery['Gallery']['created_on']}</created>
	<modified>{$gallery['Gallery']['modified_on']}</modified>
MSG;
		if (!empty($albums)) {		
			$out .= '<albums>';
			foreach($albums as $album) {
				$out .= $this->album($album, $preview, $size, $user_size, $active, $controller, $users);
			}
		
			$out .= '</albums>';
		}
		$out .= '</gallery>';
		return $out;
	}
	
	function _parseUser($id, $field, $u) {
		return $u[$id][$field];
	}
	
	function user($id, $users, $size = array()) {
		if (is_array($id)) {
			$user_id = $id['id'];
			$u = $users[$user_id];
			if (isset($id['count'])) {
				$count = $id['count'];
			} else {
				$count = $u['image_count'];
			}
		} else {
			$user_id = $id;
			$u = $users[$user_id];
		}
		
		$externals = unserialize($u['externals']);
		$ex_str = '';
		if (!empty($externals)) {
			foreach($externals as $a) {
				$ex_str .= "<external><name><![CDATA[{$a['name']}]]></name><url><![CDATA[{$a['url']}]]></url></external>";
			}
		}
		
		$originals = glob(AVATARS . DS . $user_id . DS . 'original.*');
		$size_str = '';
		if (!empty($size) && (count($originals) != 0)) {
			foreach($size as $s) {
				$s = explode(',', $s);
				$arr = unserialize($u['anchor']);
				if (empty($arr)) {
					$x = $y = 50;
				} else {
					$x = $arr['x'];
					$y = $arr['y'];
				}
				if ($s[3] == 1) {
					list($w, $h) = array($s[1], $s[2]);
				} else {
					list($w, $h) = computeSize($originals[0], $s[1], $s[2], $s[3]);
				}
				$size_str .= "<{$s[0]}><url><![CDATA[" . p(basename($originals[0]), "avatar-$user_id", $s[1], $s[2], $s[3], $s[4], $s[5], $x, $y) . "]]></url>";
				$size_str .= "<width>$w</width><height>$h</height>";
				$size_str .= "</{$s[0]}>";
			}
		}
		$out = <<<MSG
<id>{$user_id}</id>
<username><![CDATA[{$u['usr']}]]></username>
<first><![CDATA[{$u['first_name']}]]></first>
<last><![CDATA[{$u['last_name']}]]></last>
<display_name><![CDATA[{$u['display_name']}]]></display_name>
<profile><![CDATA[{$u['profile']}]]></profile>
<externals>$ex_str</externals>
<content_count>{$id['count']}</content_count>
<photos>$size_str</photos>
MSG;
		return $out;
	}
}

?>