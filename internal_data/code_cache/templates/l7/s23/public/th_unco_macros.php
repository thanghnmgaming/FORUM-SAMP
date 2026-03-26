<?php
// FROM HASH: d5edd140baef7ec913a520a774929607
return array('macros' => array('selector' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'user' => '!',
		'styles' => array(),
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	if ($__templater->method($__vars['user'], 'hasPermission', array('th_unco', 'use', ))) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = array(array(
			'value' => '0',
			'label' => '
				<span class="th-unco-preview">
					' . 'Default (none)' . '
				</span>
			',
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['styles'])) {
			foreach ($__vars['styles'] AS $__vars['style']) {
				$__compilerTemp1[] = array(
					'value' => $__vars['style']['user_name_style_id'],
					'label' => '
					<span class="th-unco-preview th-unco-user-name-style-' . $__templater->escape($__vars['style']['user_name_style_id']) . '">
						<span>' . $__templater->escape($__vars['style']['title']) . '</span>
					</span>
				',
					'_type' => 'option',
				);
			}
		}
		if ($__templater->method($__vars['user'], 'hasPermission', array('th_unco', 'useCustom', ))) {
			$__compilerTemp1[] = array(
				'value' => '-1',
				'label' => 'Custom color' . $__vars['xf']['language']['label_separator'],
				'_dependent' => array($__templater->callMacro('color_picker_macros', 'color_picker', array(
				'value' => $__vars['user']['th_unco_user_name_data']['color'],
				'name' => 'th_unco_custom_color',
				'row' => false,
			), $__vars)),
				'_type' => 'option',
			);
		}
		$__finalCompiled .= $__templater->formRadioRow(array(
			'name' => 'th_unco_style_id',
			'value' => ($__vars['user']['th_unco_user_name_data']['style'] ? $__vars['user']['th_unco_user_name_data']['style'] : ($__vars['user']['th_unco_user_name_data']['color'] ? -1 : 0)),
		), $__compilerTemp1, array(
			'label' => 'User name styling',
		)) . '
	';
	}
	$__finalCompiled .= '

	';
	$__templater->includeCss('th_unco_user_name_style_cache.less');
	$__finalCompiled .= '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});