<?php
// FROM HASH: e50915ba300c283d467bc3047b4bdbbb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('public:color_picker.less');
	$__finalCompiled .= '
';
	$__templater->includeJs(array(
		'src' => 'xf/color_picker.js',
		'min' => '1',
	));
	$__finalCompiled .= '				
' . $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => $__vars['inputName'] . '[basliketkin]',
		'label' => 'Başlık banner özelleştir',
		'selected' => $__vars['option']['option_value']['basliketkin'],
		'hint' => $__templater->escape($__vars['option']['explain']),
		'data-hide' => 'true',
		'_dependent' => array('		
			<dfn class="formRow-explain"></dfn>
			<div>' . 'Arka Plan rengi' . '</div>
			<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
				' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[baslikap]',
		'value' => ($__vars['option']['option_value']['baslikap'] ? $__vars['option']['option_value']['baslikap'] : 'rgb(165, 202, 228)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
				<div class="inputGroup-text">
					<span class="colorPickerBox js-colorPickerTrigger"></span>
				</div>
			</div>	
			<dfn class="formRow-explain"></dfn>
			<div>' . 'Metin rengi' . '</div>
			<div class="inputGroup inputGroup--joined inputGroup--colorSmall"	data-xf-init="color-picker" style="width: 220px;">
				' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[baslikrenk]',
		'value' => ($__vars['option']['option_value']['baslikrenk'] ? $__vars['option']['option_value']['baslikrenk'] : 'rgb(51, 143, 204)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
				<div class="inputGroup-text">
					<span class="colorPickerBox js-colorPickerTrigger"></span>
				</div>
			</div>				
		'),
		'_type' => 'option',
	)), array(
		'label' => 'Başlık banner özelleştir',
		'hint' => $__templater->escape($__vars['hintHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	));
	return $__finalCompiled;
});