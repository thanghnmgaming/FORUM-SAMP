<?php
// FROM HASH: d0ac787def64230d84e9691c4a481353
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->callMacro('xgt_forumistatik_miniheader_macros', 'Mesajlar', array(
		'mesaj' => '!',
	), $__vars) . '
';
	if (!$__templater->test($__vars['threads'], 'empty', array())) {
		$__finalCompiled .= '
	<ul class="xgtIstatistikListe">
		';
		if ($__templater->isTraversable($__vars['threads'])) {
			foreach ($__vars['threads'] AS $__vars['thread']) {
				$__finalCompiled .= '
			<li class="xgtIstatistikVerileri">
				<div class="IstatistikHucre IstatistikSirasi"></div>
				
				<div class="IstatistikHucre KonuBaglantisi ' . (($__templater->method($__vars['thread'], 'isUnread', array()) AND (!$__vars['forceRead'])) ? ' OkunmamisVeri' : '') . '" 
				 	data-author="' . ($__templater->escape($__vars['thread']['User']['username']) ?: $__templater->escape($__vars['thread']['username'])) . '">
					';
				if ($__vars['xf']['options']['xgtForumistatikOzellikler']['googlebutonu']) {
					$__finalCompiled .= '
						<a href="http://www.google.com/search?hl=tr&amp;q=' . $__templater->escape($__vars['thread']['title']) . '"title="' . $__templater->escape($__vars['thread']['title']) . '" target="_blank">
							<div class="GoogleButon" title="' . 'Google arama yap' . '"><i class="fab fa-google"></i></div>
						</a>
					';
				}
				$__finalCompiled .= '
					';
				$__vars['canPreview'] = $__templater->method($__vars['thread'], 'canPreview', array());
				$__finalCompiled .= '
					';
				if ($__vars['thread']['prefix_id']) {
					$__finalCompiled .= '
						';
					if ($__vars['forum']) {
						$__finalCompiled .= '
							<a href="' . $__templater->func('link', array('forums', $__vars['forum'], array('prefix_id' => $__vars['thread']['prefix_id'], ), ), true) . '" class="labelLink" rel="nofollow">' . $__templater->func('prefix', array('thread', $__vars['thread'], 'html', '', ), true) . '</a>
						';
					} else {
						$__finalCompiled .= '
							' . $__templater->func('prefix', array('thread', $__vars['thread'], 'html', '', ), true) . '
						';
					}
					$__finalCompiled .= '
					';
				}
				$__finalCompiled .= '
					<a href="' . $__templater->func('link', array('threads' . (($__templater->method($__vars['thread'], 'isUnread', array()) AND (!$__vars['forceRead'])) ? '/unread' : ''), $__vars['thread'], ), true) . '" class="" data-tp-primary="on" data-xf-init="' . ($__vars['canPreview'] ? 'preview-tooltip' : '') . '" data-preview-url="' . ($__vars['canPreview'] ? $__templater->func('link', array('threads/preview', $__vars['thread'], ), true) : '') . '">' . $__templater->escape($__vars['thread']['title']) . '</a>
				</div>
				';
				if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
					$__finalCompiled .= '
					<div class="IstatistikHucre IstatistikForum">
						<a href="' . $__templater->func('link', array('forums', $__vars['thread']['Forum'], ), true) . '" title="' . $__templater->escape($__vars['thread']['Forum']['title']) . '">' . $__templater->escape($__vars['thread']['Forum']['title']) . '</a>
					</div>
				';
				}
				$__finalCompiled .= '
				';
				if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
					$__finalCompiled .= '
					<div class="IstatistikHucre IstatistikCevap">
						' . (($__vars['thread']['discussion_type'] == 'redirect') ? '&ndash;' : $__templater->filter($__vars['thread']['reply_count'], array(array('number', array()),), true)) . '
					</div>	
					<div class="IstatistikHucre IstatistikGoruntuleme">
						' . (($__vars['thread']['discussion_type'] == 'redirect') ? '&ndash;' : (($__vars['thread']['view_count'] > $__vars['thread']['reply_count']) ? $__templater->filter($__vars['thread']['view_count'], array(array('number_short', array(1, )),), true) : $__templater->func('number', array($__templater->filter($__vars['thread']['reply_count'], array(array('number_short', array(1, )),), false), ), true))) . '
					</div>	
				';
				}
				$__finalCompiled .= '
		
				';
				if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
					$__finalCompiled .= '
					<div class="IstatistikHucre IstatistikZaman">
						';
					if ($__vars['thread']['discussion_type'] == 'redirect') {
						$__finalCompiled .= '
							' . 'N/A' . '
						';
					} else {
						$__finalCompiled .= '
							<a href="' . $__templater->func('link', array('threads/latest', $__vars['thread'], ), true) . '" rel="nofollow">' . $__templater->func('date_dynamic', array($__vars['thread']['last_post_date'], array(
							'class' => 'structItem-latestDate',
						))) . '</a>
						';
					}
					$__finalCompiled .= '
					</div>	
				';
				}
				$__finalCompiled .= '
				';
				if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
					$__finalCompiled .= '
					<div class="IstatistikHucre IstatistikSonCevap">
						';
					if ($__vars['thread']['discussion_type'] == 'redirect') {
						$__finalCompiled .= '
							' . 'N/A' . '
						';
					} else {
						$__finalCompiled .= '
							';
						if ($__templater->method($__vars['xf']['visitor'], 'isIgnoring', array($__vars['thread']['last_post_user_id'], ))) {
							$__finalCompiled .= '
								' . 'Ignored member' . '
							';
						} else {
							$__finalCompiled .= '
								' . $__templater->func('username_link', array($__vars['thread']['last_post_cache'], true, array(
							))) . '
							';
						}
						$__finalCompiled .= '
						';
					}
					$__finalCompiled .= '
					</div>
				';
				}
				$__finalCompiled .= '
			</li>
		';
			}
		}
		$__finalCompiled .= '
	</ul>
';
	} else {
		$__finalCompiled .= '
	 <div class="block-row">
		  ' . 'No results found.' . '
	 </div>
';
	}
	return $__finalCompiled;
});