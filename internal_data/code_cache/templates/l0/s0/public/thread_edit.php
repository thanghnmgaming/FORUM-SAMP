<?php
// FROM HASH: a68637257ee5e14fbca420c27d0c0319
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Edit thread');
	$__finalCompiled .= '

';
	$__templater->includeJs(array(
		'src' => 'xf/thread.js',
		'min' => '1',
	));
	$__finalCompiled .= '

';
	$__templater->breadcrumbs($__templater->method($__vars['thread'], 'getBreadcrumbs', array()));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	$__compilerTemp2 = '';
	$__compilerTemp2 .= '
					' . $__templater->callMacro('custom_fields_macros', 'custom_fields_edit', array(
		'type' => 'threads',
		'set' => $__vars['thread']['custom_fields'],
		'editMode' => $__templater->method($__vars['thread'], 'getFieldEditMode', array()),
		'onlyInclude' => $__vars['forum']['field_cache'],
	), $__vars) . '
				';
	if (strlen(trim($__compilerTemp2)) > 0) {
		$__compilerTemp1 .= '
				<hr class="formRowSep" />
				' . $__compilerTemp2 . '
				<hr class="formRowSep" />
			';
	}
	$__compilerTemp3 = '';
	if ($__templater->method($__vars['thread'], 'canDelete', array())) {
		$__compilerTemp3 .= '
					' . $__templater->button('Delete' . $__vars['xf']['language']['ellipsis'], array(
			'href' => $__templater->func('link', array('threads/delete', $__vars['thread'], ), false),
			'icon' => 'delete',
			'overlay' => 'true',
		), '', array(
		)) . '
				';
	}
	$__compilerTemp4 = '';
	if ($__vars['noInlineMod']) {
		$__compilerTemp4 .= '
		' . $__templater->formHiddenVal('_xfNoInlineMod', '1', array(
		)) . '
	';
	}
	$__compilerTemp5 = '';
	if ($__vars['forumName']) {
		$__compilerTemp5 .= '
		' . $__templater->formHiddenVal('_xfForumName', '1', array(
		)) . '
	';
	}
	$__finalCompiled .= $__templater->form('

	<div class="block-container">
		<div class="block-body">
			' . $__templater->formPrefixInputRow(($__templater->method($__vars['thread'], 'isPrefixEditable', array()) ? $__vars['prefixes'] : array()), array(
		'type' => 'thread',
		'prefix-value' => $__vars['thread']['prefix_id'],
		'multi-prefix-value' => $__vars['thread']['sv_prefix_ids'],
		'multi-prefix-content-parent' => $__vars['thread']['Forum'],
		'multi-prefix-content' => $__vars['thread'],
		'full-row' => true,
		'textbox-value' => $__vars['thread']['title'],
		'placeholder' => 'Title' . $__vars['xf']['language']['ellipsis'],
		'autofocus' => 'autofocus',
		'maxlength' => $__templater->func('max_length', array($__vars['thread'], 'title', ), false),
	), array(
		'label' => 'Title',
	)) . '

			' . $__compilerTemp1 . '

			' . $__templater->callMacro('helper_thread_options', 'thread_status', array(
		'thread' => $__vars['thread'],
	), $__vars) . '
		</div>

		' . $__templater->formSubmitRow(array(
		'icon' => 'save',
		'sticky' => 'true',
	), array(
		'html' => '
				' . $__compilerTemp3 . '
			',
	)) . '
	</div>

	' . $__compilerTemp4 . '
	' . $__compilerTemp5 . '
', array(
		'action' => $__templater->func('link', array('threads/edit', $__vars['thread'], ), false),
		'class' => 'block',
		'ajax' => 'true',
		'data-xf-init' => 'thread-edit-form',
		'data-item-selector' => '.js-threadListItem-' . $__vars['thread']['thread_id'],
	));
	return $__finalCompiled;
});