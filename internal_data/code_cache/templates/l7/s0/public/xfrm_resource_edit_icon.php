<?php
// FROM HASH: 2b9430f45fd6417c69a460703e04f9c5
return array('macros' => array('icon_edit' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'resource' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="contentRow">
		<div class="contentRow-figure">
			<span class="contentRow-figureIcon">' . $__templater->func('resource_icon', array($__vars['resource'], 'm', ), true) . '</span>
		</div>
		<div class="contentRow-main">
			';
	if ($__vars['resource']['icon_date']) {
		$__finalCompiled .= '
				';
		$__compilerTemp1 = array(array(
			'value' => 'custom',
			'label' => 'Upload a custom icon' . $__vars['xf']['language']['label_separator'],
			'_dependent' => array($__templater->callMacro(null, 'custom_dependent', array(), $__vars)),
			'_type' => 'option',
		));
		if ($__vars['resource']['icon_date']) {
			$__compilerTemp1[] = array(
				'value' => 'delete',
				'label' => 'Delete the current icon',
				'_type' => 'option',
			);
		}
		$__finalCompiled .= $__templater->formRadio(array(
			'name' => 'icon_action',
			'value' => 'custom',
		), $__compilerTemp1) . '
				';
	} else {
		$__finalCompiled .= '
				<span>' . 'Upload a new icon' . $__vars['xf']['language']['label_separator'] . '</span>
				' . $__templater->callMacro(null, 'custom_dependent', array(), $__vars) . '
				' . $__templater->formHiddenVal('icon_action', 'custom', array(
		)) . '
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
';
	return $__finalCompiled;
},
'custom_dependent' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->formUpload(array(
		'name' => 'upload',
		'accept' => '.gif,.jpeg,.jpg,.jpe,.png',
	)) . '
	<dfn class="inputChoices-explain">
		' . 'Bạn nên sử dụng hình ảnh có kích thước tối thiểu ' . 100 . 'x' . 100 . ' pixels.' . '
	</dfn>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Resource icon');
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__templater->method($__vars['resource'], 'getBreadcrumbs', array()));
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body block-row">
			' . $__templater->callMacro(null, 'icon_edit', array(
		'resource' => $__vars['resource'],
	), $__vars) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
	), array(
		'rowtype' => 'simple',
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('resources/edit-icon', $__vars['resource'], ), false),
		'upload' => 'true',
		'ajax' => 'true',
		'class' => 'block',
	)) . '

' . '

';
	return $__finalCompiled;
});