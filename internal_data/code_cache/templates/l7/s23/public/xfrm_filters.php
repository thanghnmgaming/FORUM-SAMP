<?php
// FROM HASH: 9e9e474ae7ee4f312c98edb2ac3d79ec
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	if ($__vars['showTypeFilters']) {
		$__compilerTemp1 .= '
		<div class="menu-row menu-row--separated">
			' . 'Kiểu' . $__vars['xf']['language']['label_separator'] . '
			<div class="u-inputSpacer">
				' . $__templater->formSelect(array(
			'name' => 'type',
			'value' => $__vars['filters']['type'],
		), array(array(
			'value' => '',
			'label' => 'Tất cả',
			'_type' => 'option',
		),
		array(
			'value' => 'free',
			'label' => 'Free',
			'_type' => 'option',
		),
		array(
			'value' => 'paid',
			'label' => 'Paid',
			'_type' => 'option',
		))) . '
			</div>
		</div>
	';
	}
	$__compilerTemp2 = '';
	if (!$__templater->test($__vars['prefixesGrouped'], 'empty', array())) {
		$__compilerTemp2 .= '
		<div class="menu-row menu-row--separated">
			' . 'Tiền tố' . $__vars['xf']['language']['label_separator'] . '
			<div class="u-inputSpacer">
				' . $__templater->callMacro('prefix_macros', 'select', array(
			'prefixes' => $__vars['prefixesGrouped'],
			'type' => 'resource',
			'multiple' => true,
			'selected' => ($__vars['filters']['prefix_id'] ?: 0),
			'name' => 'prefix_id',
			'noneLabel' => $__vars['xf']['language']['parenthesis_open'] . 'Tất cả' . $__vars['xf']['language']['parenthesis_close'],
		), $__vars) . '
			</div>
		</div>
	';
	}
	$__finalCompiled .= $__templater->form('
	' . '
	' . $__compilerTemp1 . '

	' . '
	' . $__compilerTemp2 . '

	' . '
	<div class="menu-row menu-row--separated">
		' . 'Tạo bởi' . $__vars['xf']['language']['label_separator'] . '
		<div class="u-inputSpacer">
			' . $__templater->formTextBox(array(
		'name' => 'creator',
		'value' => ($__vars['creatorFilter'] ? $__vars['creatorFilter']['username'] : ''),
		'ac' => 'single',
	)) . '
		</div>
	</div>

	' . '
	<div class="menu-row menu-row--separated">
		' . 'Phân loại' . $__vars['xf']['language']['label_separator'] . '
		<div class="inputGroup u-inputSpacer">
			' . $__templater->formSelect(array(
		'name' => 'order',
		'value' => ($__vars['filters']['order'] ?: $__vars['xf']['options']['xfrmListDefaultOrder']),
	), array(array(
		'value' => 'last_update',
		'label' => 'Last update',
		'_type' => 'option',
	),
	array(
		'value' => 'resource_date',
		'label' => 'Submission date',
		'_type' => 'option',
	),
	array(
		'value' => 'rating_weighted',
		'label' => 'Bình chọn',
		'_type' => 'option',
	),
	array(
		'value' => 'download_count',
		'label' => 'Downloads',
		'_type' => 'option',
	),
	array(
		'value' => 'title',
		'label' => 'Tiêu đề',
		'_type' => 'option',
	))) . '
			<span class="inputGroup-splitter"></span>
			' . $__templater->formSelect(array(
		'name' => 'direction',
		'value' => ($__vars['filters']['direction'] ?: 'desc'),
	), array(array(
		'value' => 'desc',
		'label' => 'Giảm dần',
		'_type' => 'option',
	),
	array(
		'value' => 'asc',
		'label' => 'Tăng dần',
		'_type' => 'option',
	))) . '
		</div>
	</div>

	<div class="menu-footer">
		<span class="menu-footer-controls">
			' . $__templater->button('Lọc', array(
		'type' => 'submit',
		'class' => 'button--primary',
	), '', array(
	)) . '
		</span>
	</div>
	' . $__templater->formHiddenVal('apply', '1', array(
	)) . '
', array(
		'action' => $__templater->func('link', array(($__vars['category'] ? 'resources/categories/filters' : 'resources/filters'), $__vars['category'], ), false),
	));
	return $__finalCompiled;
});