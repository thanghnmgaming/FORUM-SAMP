<?php
// FROM HASH: 55d50045a8d69302184f706e9a399b44
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('
	' . 'User name styles' . '
');
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
	<div class="buttonGroup">
		' . $__templater->button('
			' . 'Add style' . '
		', array(
		'icon' => 'add',
		'href' => $__templater->func('link', array('th-unco/add', ), false),
	), '', array(
	)) . '
		' . $__templater->button('
			' . 'Sort' . '
		', array(
		'icon' => 'sort',
		'href' => $__templater->func('link', array('th-unco/sort', ), false),
	), '', array(
	)) . '
	</div>
');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if (!$__templater->test($__vars['styles'], 'empty', array())) {
		$__compilerTemp1 .= '
				';
		$__compilerTemp2 = '';
		if ($__templater->isTraversable($__vars['styles'])) {
			foreach ($__vars['styles'] AS $__vars['style']) {
				$__compilerTemp2 .= '
						';
				$__vars['titleHtml'] = $__templater->preEscaped('
							<span class="th-unco-user-name-style-' . $__templater->escape($__vars['style']['user_name_style_id']) . '">
								<span>' . $__templater->escape($__vars['style']['title']) . '</span>
							</span>
						');
				$__compilerTemp2 .= '
						' . $__templater->dataRow(array(
				), array(array(
					'label' => $__templater->filter($__vars['titleHtml'], array(array('raw', array()),), true),
					'href' => $__templater->func('link', array('th-unco/edit', $__vars['style'], ), false),
					'_type' => 'main',
					'html' => '',
				),
				array(
					'name' => 'active[' . $__vars['style']['user_name_style_id'] . ']',
					'selected' => $__vars['style']['active'],
					'submit' => 'true',
					'tooltip' => 'Enable / disable \'' . $__vars['style']['title'] . '\'',
					'_type' => 'toggle',
					'html' => '',
				),
				array(
					'icon' => 'delete',
					'href' => $__templater->func('link', array('th-unco/delete', $__vars['style'], ), false),
					'_type' => 'delete',
					'html' => '',
				))) . '
					';
			}
		}
		$__compilerTemp1 .= $__templater->dataList('
					' . $__compilerTemp2 . '
				', array(
		)) . '
				';
	} else {
		$__compilerTemp1 .= '
				<div class="block-row">
					' . 'No styles have been created yet.' . '
				</div>
			';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__compilerTemp1 . '
		</div>
	</div>
', array(
		'action' => $__templater->func('link', array('th-unco/toggle', ), false),
		'class' => 'block',
		'ajax' => 'true',
	)) . '

';
	if (!$__templater->test($__vars['styles'], 'empty', array())) {
		$__finalCompiled .= '
	';
		$__templater->includeCss('public:th_unco_user_name_style_cache.less');
		$__finalCompiled .= '
';
	}
	return $__finalCompiled;
});