<?php
// FROM HASH: 3ac98058f76558e8e3e7a9f8c2476cd4
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['style'], 'isInsert', array())) {
		$__compilerTemp1 .= '
		' . 'Add user name style' . '
		';
	} else {
		$__compilerTemp1 .= '
		' . 'Edit user name style' . $__vars['xf']['language']['label_separator'] . ' ' . $__templater->escape($__vars['style']['title']) . '
	';
	}
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('
	' . $__compilerTemp1 . '
');
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<h2 class="block-tabHeader tabs hScroller" data-xf-init="h-scroller tabs" role="tablist">
			<span class="hScroller-scroll">
				<a class="tabs-tab is-active" role="tab" tabindex="0" aria-controls="user-name-style-options">
					' . 'User name style options' . '
				</a>
				' . $__templater->callMacro('helper_criteria', 'user_tabs', array(
		'userTabTitle' => 'Available if' . $__vars['xf']['language']['ellipsis'],
	), $__vars) . '
			</span>
		</h2>

		<ul class="block-body tabPanes">
			<li class="is-active" role="tabpanel" id="user-name-style-option">
				' . $__templater->formTextBoxRow(array(
		'name' => 'title',
		'value' => ($__templater->method($__vars['style'], 'isInsert', array()) ? '' : $__vars['style']['MasterTitle']['phrase_text']),
	), array(
		'label' => 'Tiêu đề',
	)) . '
				
				' . $__templater->formNumberBoxRow(array(
		'min' => '0',
		'step' => '1',
		'name' => 'display_order',
		'value' => $__vars['style']['display_order'],
	), array(
		'label' => 'Thứ tự hiển thị',
	)) . '

				' . $__templater->formCheckBoxRow(array(
	), array(array(
		'value' => '1',
		'name' => 'active',
		'selected' => $__vars['style']['active'],
		'label' => 'Đã bật',
		'_type' => 'option',
	)), array(
	)) . '

				<hr class="formRowSep" />

				' . $__templater->formCodeEditorRow(array(
		'name' => 'styling',
		'mode' => 'css',
		'value' => $__vars['style']['styling'],
	), array(
		'label' => 'Styling',
		'explain' => 'Bạn có thể sử dụng cú pháp mẫu XenForo ở đây',
	)) . '
			</li>

			' . $__templater->callMacro('helper_criteria', 'user_panes', array(
		'criteria' => $__templater->method($__vars['userCriteria'], 'getCriteriaForTemplate', array()),
		'data' => $__templater->method($__vars['userCriteria'], 'getExtraTemplateData', array()),
	), $__vars) . '
		</ul>

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('th-unco/save', $__vars['style'], ), false),
		'class' => 'block',
	));
	return $__finalCompiled;
});