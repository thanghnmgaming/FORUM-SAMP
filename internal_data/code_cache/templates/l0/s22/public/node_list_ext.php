<?php
// FROM HASH: f314654659b0e099b81a01498890b717
return array('macros' => array('node-icon' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'node' => '!',
		'extras' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	
	';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['node'], 'isCustomNode', array())) {
		$__compilerTemp1 .= '
			';
		if ($__vars['node']['node_icon_type'] == 'fa') {
			$__compilerTemp1 .= '
				';
			if ($__vars['xf']['versionId'] < 2010000) {
				$__compilerTemp1 .= '
					<i class="fa ' . $__templater->escape($__vars['node']['node_icon']) . '"></i>
				';
			} else {
				$__compilerTemp1 .= '
					' . $__templater->fontAwesome($__templater->escape($__vars['node']['node_icon']), array(
				)) . '
				';
			}
			$__compilerTemp1 .= '
			';
		} else if ($__vars['node']['node_icon_type'] == 'img') {
			$__compilerTemp1 .= '
				<img src="' . $__templater->escape($__vars['node']['node_icon']) . '" alt="' . $__templater->escape($__vars['node']['title']) . '"/>
			';
		} else if ($__vars['node']['node_icon_type'] == 'custom') {
			$__compilerTemp1 .= '
				' . $__templater->filter($__vars['node']['node_icon'], array(array('raw', array()),), true) . '
			';
		}
		$__compilerTemp1 .= '
		';
	} else {
		$__compilerTemp1 .= '
			<span class="node-icon" aria-hidden="true"><i></i></span>
		';
	}
	$__vars['nodeIconRead'] = $__templater->preEscaped('
		' . $__compilerTemp1 . '
	');
	$__finalCompiled .= '
	
	';
	$__compilerTemp2 = '';
	if ($__templater->method($__vars['node'], 'isCustomUnreadNode', array())) {
		$__compilerTemp2 .= '
			';
		if ($__vars['node']['node_icon_type'] == 'fa') {
			$__compilerTemp2 .= '
				';
			if ($__vars['xf']['versionId'] < 2010000) {
				$__compilerTemp2 .= '
					<i class="fa ' . $__templater->escape($__vars['node']['node_icon_unread']) . '"></i>
				';
			} else {
				$__compilerTemp2 .= '
					' . $__templater->fontAwesome($__templater->escape($__vars['node']['node_icon_unread']), array(
				)) . '
				';
			}
			$__compilerTemp2 .= '
			';
		} else if ($__vars['node']['node_icon_type'] == 'img') {
			$__compilerTemp2 .= '
				<img src="' . $__templater->escape($__vars['node']['node_icon_unread']) . '" alt="' . $__templater->escape($__vars['node']['title']) . '"/>
			';
		} else if ($__vars['node']['node_icon_type'] == 'custom') {
			$__compilerTemp2 .= '
				' . $__templater->filter($__vars['node']['node_icon_unread'], array(array('raw', array()),), true) . '
			';
		}
		$__compilerTemp2 .= '
		';
	} else {
		$__compilerTemp2 .= '
			' . $__templater->filter($__vars['nodeIconRead'], array(array('raw', array()),), true) . '
		';
	}
	$__vars['nodeIconUnread'] = $__templater->preEscaped('
		' . $__compilerTemp2 . '
	');
	$__finalCompiled .= '
	
	<span class="node-icon-ext" aria-hidden="true">
		';
	if ($__vars['extras'] AND $__vars['extras']['hasNew']) {
		$__finalCompiled .= '
			' . $__templater->filter($__vars['nodeIconUnread'], array(array('raw', array()),), true) . '
		';
	} else {
		$__finalCompiled .= '
			' . $__templater->filter($__vars['nodeIconRead'], array(array('raw', array()),), true) . '
		';
	}
	$__finalCompiled .= '
	</span>

';
	return $__finalCompiled;
},
'node-icon-submenu' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'node' => '!',
		'link' => '!',
		'extras' => '',
		'subNodeLinkClass' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	
	';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['node'], 'isCustomNode', array())) {
		$__compilerTemp1 .= '
			';
		if ($__vars['node']['node_icon_type'] == 'fa') {
			$__compilerTemp1 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext fa--xf ' . $__templater->escape($__vars['node']['node_icon']) . ' ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">' . $__templater->escape($__vars['node']['title']) . '</a>
			';
		} else if ($__vars['node']['node_icon_type'] == 'img') {
			$__compilerTemp1 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">
					<img src="' . $__templater->escape($__vars['node']['node_icon']) . '" alt="' . $__templater->escape($__vars['node']['title']) . '"/>
					' . $__templater->escape($__vars['node']['title']) . '
				</a>
			';
		} else if ($__vars['node']['node_icon_type'] == 'custom') {
			$__compilerTemp1 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext ' . (($__vars['extras'] AND $__vars['extras']['hasNew']) ? 'subNodeLink--unread' : '') . '">
					' . $__templater->filter($__vars['node']['node_icon'], array(array('raw', array()),), true) . $__templater->escape($__vars['node']['title']) . '
				</a>
			';
		}
		$__compilerTemp1 .= '
		';
	} else {
		$__compilerTemp1 .= '
			<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink ' . $__templater->escape($__vars['subNodeLinkClass']) . ' ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">' . $__templater->escape($__vars['node']['title']) . '</a>
		';
	}
	$__vars['nodeIconRead'] = $__templater->preEscaped('
		' . $__compilerTemp1 . '
	');
	$__finalCompiled .= '
	
	';
	$__compilerTemp2 = '';
	if ($__templater->method($__vars['node'], 'isCustomUnreadNode', array())) {
		$__compilerTemp2 .= '
			';
		if ($__vars['node']['node_icon_type'] == 'fa') {
			$__compilerTemp2 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext fa--xf ' . $__templater->escape($__vars['node']['node_icon_unread']) . ' ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">' . $__templater->escape($__vars['node']['title']) . '</a>
			';
		} else if ($__vars['node']['node_icon_type'] == 'img') {
			$__compilerTemp2 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">
					<img src="' . $__templater->escape($__vars['node']['node_icon']) . '" alt="' . $__templater->escape($__vars['node']['title']) . '"/>
					' . $__templater->escape($__vars['node']['title']) . '
				</a>
			';
		} else if ($__vars['node']['node_icon_type'] == 'custom') {
			$__compilerTemp2 .= '
				<a href="' . $__templater->escape($__vars['link']) . '" class="subNodeLink-ext ' . ($__vars['extras'] AND ($__vars['extras']['hasNew'] ? 'subNodeLink--unread' : '')) . '">
					' . $__templater->filter($__vars['node']['node_icon_unread'], array(array('raw', array()),), true) . $__templater->escape($__vars['node']['title']) . '
				</a>
			';
		}
		$__compilerTemp2 .= '
		';
	} else {
		$__compilerTemp2 .= '
			' . $__templater->filter($__vars['nodeIconRead'], array(array('raw', array()),), true) . '
		';
	}
	$__vars['nodeIconUnread'] = $__templater->preEscaped('
		' . $__compilerTemp2 . '
	');
	$__finalCompiled .= '
	
	';
	if ($__vars['extras'] AND $__vars['extras']['hasNew']) {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['nodeIconUnread'], array(array('raw', array()),), true) . '
	';
	} else {
		$__finalCompiled .= '
		' . $__templater->filter($__vars['nodeIconRead'], array(array('raw', array()),), true) . '
	';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});