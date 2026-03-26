<?php
// FROM HASH: 11f6e3f97ffe9bb94caade67e91d01dd
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = array();
	if ($__templater->isTraversable($__vars['data']['thUncoStyles'])) {
		foreach ($__vars['data']['thUncoStyles'] AS $__vars['style']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['style']['user_name_style_id'],
				'label' => $__templater->escape($__vars['style']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = array();
	if ($__templater->isTraversable($__vars['data']['thUncoStyles'])) {
		foreach ($__vars['data']['thUncoStyles'] AS $__vars['style']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['style']['user_name_style_id'],
				'label' => $__templater->escape($__vars['style']['title']),
				'_type' => 'option',
			);
		}
	}
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => 'user_criteria[th_unco_user_name_color][rule]',
		'value' => 'th_unco_user_name_color',
		'selected' => $__vars['criteria']['th_unco_user_name_color'],
		'label' => 'User has a name color',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_not_user_name_color][rule]',
		'value' => 'th_unco_not_user_name_color',
		'selected' => $__vars['criteria']['th_unco_not_user_name_color'],
		'label' => 'User does NOT have a name color',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_color_preset][rule]',
		'value' => 'th_unco_color_preset',
		'selected' => $__vars['criteria']['th_unco_color_preset'],
		'label' => 'User has a name style',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_color][rule]',
		'value' => 'th_unco_custom_color',
		'selected' => $__vars['criteria']['th_unco_custom_color'],
		'label' => 'User has a custom name color',
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_style_one_of][rule]',
		'value' => 'th_unco_style_one_of',
		'selected' => $__vars['criteria']['th_unco_style_one_of'],
		'label' => 'User name style is one of the following' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[th_unco_style_one_of][data][style_ids]',
		'multiple' => 'true',
		'value' => $__vars['criteria']['th_unco_style_one_of']['style_ids'],
	), $__compilerTemp1)),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_style_not_one_of][rule]',
		'value' => 'th_unco_style_not_one_of',
		'selected' => $__vars['criteria']['th_unco_style_not_one_of'],
		'label' => 'User name style is NOT one of the following' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formSelect(array(
		'name' => 'user_criteria[th_unco_style_not_one_of][data][style_ids]',
		'multiple' => 'true',
		'value' => $__vars['criteria']['th_unco_style_not_one_of']['style_ids'],
	), $__compilerTemp2)),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_red][rule]',
		'value' => 'th_unco_custom_red',
		'selected' => $__vars['criteria']['th_unco_custom_red'],
		'label' => 'User name custom color red share is at least X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_red][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_red']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_max_red][rule]',
		'value' => 'th_unco_custom_red',
		'selected' => $__vars['criteria']['th_unco_custom_max_red'],
		'label' => 'User name custom color red share is no more than X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_max_red][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_max_red']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_green][rule]',
		'value' => 'th_unco_custom_green',
		'selected' => $__vars['criteria']['th_unco_custom_green'],
		'label' => 'User name custom color green share is at least X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_green][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_green']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_max_green][rule]',
		'value' => 'th_unco_custom_max_green',
		'selected' => $__vars['criteria']['th_unco_custom_max_green'],
		'label' => 'User name custom color green share is no more than X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_max_green][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_max_green']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_blue][rule]',
		'value' => 'th_unco_custom_blue',
		'selected' => $__vars['criteria']['th_unco_custom_blue'],
		'label' => 'User name custom color blue share is at least X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_blue][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_blue']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	),
	array(
		'name' => 'user_criteria[th_unco_custom_max_blue][rule]',
		'value' => 'th_unco_custom_max_blue',
		'selected' => $__vars['criteria']['th_unco_custom_max_blue'],
		'label' => 'User name custom color blue share is no more than X' . $__vars['xf']['language']['label_separator'],
		'_dependent' => array($__templater->formNumberBox(array(
		'name' => 'user_criteria[th_unco_custom_max_blue][data][value]',
		'value' => $__vars['criteria']['th_unco_custom_max_blue']['value'],
		'size' => '5',
		'min' => '0',
		'max' => '255',
		'step' => '1',
	))),
		'_type' => 'option',
	)), array(
		'label' => 'User name color',
	));
	return $__finalCompiled;
});