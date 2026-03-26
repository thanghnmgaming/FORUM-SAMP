<?php
// FROM HASH: b63a96a96c4f8631a46d7ffda1ddf7db
return array('macros' => array('jump_to_menu_global' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'interfaceGroups' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="menu" data-menu="menu" aria-hidden="true">
		<div class="menu-content">
			<h3 class="menu-header">' . 'Jump to' . $__vars['xf']['language']['ellipsis'] . '</h3>
			';
	if ($__templater->isTraversable($__vars['interfaceGroups'])) {
		foreach ($__vars['interfaceGroups'] AS $__vars['interfaceGroupId'] => $__vars['interfaceGroup']) {
			$__finalCompiled .= '
				<a class="menu-linkRow" href="' . $__templater->escape($__templater->method($__vars['xf']['request'], 'getRequestUri', array())) . '#permGroup-' . $__templater->escape($__vars['interfaceGroupId']) . '" tabindex="0" data-menu-closer="true">
					' . $__templater->escape($__vars['interfaceGroup']['title']) . '
				</a>
			';
		}
	}
	$__finalCompiled .= '
		</div>
	</div>
';
	return $__finalCompiled;
},
'jump_to_menu_content' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'interfaceGroups' => '!',
		'interfaceGroupId' => '!',
		'permissionsGrouped' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="menu" data-menu="menu" aria-hidden="true">
		<div class="menu-content">
			';
	if (!$__templater->test($__vars['permissionsGrouped'][$__vars['interfaceGroupId']], 'empty', array())) {
		$__finalCompiled .= '
				<h3 class="menu-header">' . 'Jump to' . $__vars['xf']['language']['ellipsis'] . '</h3>
				';
		if ($__templater->isTraversable($__vars['interfaceGroups'])) {
			foreach ($__vars['interfaceGroups'] AS $__vars['_interfaceGroupId'] => $__vars['interfaceGroup']) {
				$__finalCompiled .= '
					';
				if (!$__templater->test($__vars['permissionsGrouped'][$__vars['_interfaceGroupId']], 'empty', array())) {
					$__finalCompiled .= '
						<a class="menu-linkRow" href="' . $__templater->escape($__templater->method($__vars['xf']['request'], 'getRequestUri', array())) . '#permGroup-' . $__templater->escape($__vars['_interfaceGroupId']) . '" tabindex="0" data-menu-closer="true">
							' . $__templater->escape($__vars['interfaceGroup']['title']) . '
						</a>
					';
				}
				$__finalCompiled .= '
				';
			}
		}
		$__finalCompiled .= '
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

';
	return $__finalCompiled;
});