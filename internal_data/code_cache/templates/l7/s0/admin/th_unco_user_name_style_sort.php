<?php
// FROM HASH: 9bbb87af18ee84c9aad33f15fe8dfa29
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Sort user name styles');
	$__finalCompiled .= '

' . $__templater->callMacro('public:nestable_macros', 'setup', array(), $__vars) . '

';
	$__compilerTemp1 = '';
	$__vars['i'] = 0;
	if ($__templater->isTraversable($__vars['styles'])) {
		foreach ($__vars['styles'] AS $__vars['style']) {
			$__vars['i']++;
			$__compilerTemp1 .= '
						<li class="nestable-item" data-id="' . $__templater->escape($__vars['style']['user_name_style_id']) . '">
							<div class="nestable-handle" aria-label="' . 'Drag handle' . '"><i class="fa fa-bars" aria-hidden="true"></i></div>
							<div class="nestable-content">' . $__templater->escape($__vars['style']['title']) . '</div>
						</li>
					';
		}
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			<div class="nestable-container" data-xf-init="nestable" data-parent-id="">
				<ol class="nestable-list">
					' . $__compilerTemp1 . '
				</ol>
				' . $__templater->formHiddenVal('styles', '', array(
	)) . '
			</div>
			' . $__templater->formSubmitRow(array(
		'icon' => 'save',
	), array(
		'rowtype' => 'simple',
	)) . '
		</div>
	</div>
', array(
		'action' => $__templater->func('link', array('th-unco/sort', ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});