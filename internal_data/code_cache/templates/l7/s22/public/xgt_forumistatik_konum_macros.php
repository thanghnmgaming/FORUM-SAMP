<?php
// FROM HASH: 12a56df3eb8a1c45216ecb18110da4d5
return array('macros' => array('xgtForumIstatistikleri' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'template' => '!',
		'position' => '!',
		'location' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '	
		' . ($__vars['xf']['xengentrForumIstatistikleriForumIstatistikRepo'] ? $__templater->filter($__templater->method($__vars['xf']['xengentrForumIstatistikleriForumIstatistikRepo'], 'renderForumIstatistikleri', array()), array(array('raw', array()),), true) : null) . '
	';
	return $__finalCompiled;
},
'xgt_istatistik_konum' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'template' => '!',
		'position' => '!',
		'location' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['templateName'] = $__vars['template'];
	$__finalCompiled .= '
	';
	$__vars['position'] = $__vars['position'];
	$__finalCompiled .= '
	';
	$__vars['location'] = $__vars['location'];
	$__finalCompiled .= ' 
	';
	if (($__vars['xf']['options']['xgtForumistatik_konumu'] == 'iceriklerustu') AND ($__vars['location'] == 'iceriklerustu')) {
		$__finalCompiled .= '	
		';
		if ($__vars['xf']['options']['xgtForumistatik_konumu_tumsayfalarda']) {
			$__finalCompiled .= '
			' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
				'template' => $__vars['templateName'],
				'position' => $__vars['position'],
				'location' => $__vars['location'],
			), $__vars) . '
		';
		} else if ($__vars['template'] == 'forum_list') {
			$__finalCompiled .= '
			' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
				'template' => $__vars['templateName'],
				'position' => $__vars['position'],
				'location' => $__vars['location'],
			), $__vars) . '
		';
		}
		$__finalCompiled .= '	
	';
	}
	$__finalCompiled .= ' 
	';
	if (($__vars['xf']['options']['xgtForumistatik_konumu'] == 'forumlarustu') AND ($__vars['location'] == 'forumlarustu')) {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
			'template' => $__vars['templateName'],
			'position' => $__vars['position'],
			'location' => $__vars['location'],
		), $__vars) . '
	';
	}
	$__finalCompiled .= ' 
	';
	if (($__vars['xf']['options']['xgtForumistatik_konumu'] == 'forumlaralti') AND ($__vars['location'] == 'forumlaralti')) {
		$__finalCompiled .= '
		' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
			'template' => $__vars['templateName'],
			'position' => $__vars['position'],
			'location' => $__vars['location'],
		), $__vars) . '
	';
	}
	$__finalCompiled .= '
	';
	if (($__vars['xf']['options']['xgtForumistatik_konumu'] == 'kendikonumum') AND ($__vars['location'] == 'kendikonumum')) {
		$__finalCompiled .= '
		';
		if ($__vars['xf']['options']['xgtForumistatik_konumu_tumsayfalarda']) {
			$__finalCompiled .= '
			' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
				'template' => $__vars['templateName'],
				'position' => $__vars['position'],
				'location' => $__vars['location'],
			), $__vars) . '
		';
		} else if ($__vars['template'] == 'forum_list') {
			$__finalCompiled .= '
			' . $__templater->callMacro(null, 'xgtForumIstatistikleri', array(
				'template' => $__vars['templateName'],
				'position' => $__vars['position'],
				'location' => $__vars['location'],
			), $__vars) . '
		';
		}
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '
	' . '	
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});