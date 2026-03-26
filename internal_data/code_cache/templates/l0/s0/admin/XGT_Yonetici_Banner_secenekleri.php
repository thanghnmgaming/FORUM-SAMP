<?php
// FROM HASH: d8ebea259c9c4fac47039f939d56278a
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
		'name' => $__vars['inputName'] . '[yoneticibanneretkin]',
		'label' => 'Yönetici banner özelleştir',
		'selected' => $__vars['option']['option_value']['yoneticibanneretkin'],
		'hint' => $__templater->escape($__vars['option']['explain']),
		'data-hide' => 'true',
		'_dependent' => array('		
			<dfn class="formRow-explain"></dfn>
			<div>' . 'Arka Plan rengi' . '</div>
			<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
				' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[yoneticibannerap]',
		'value' => ($__vars['option']['option_value']['yoneticibannerap'] ? $__vars['option']['option_value']['yoneticibannerap'] : 'rgb(214, 92, 92)'),
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
		'name' => $__vars['inputName'] . '[yoneticibannerrenk]',
		'value' => ($__vars['option']['option_value']['yoneticibannerrenk'] ? $__vars['option']['option_value']['yoneticibannerrenk'] : 'rgb(255, 255, 255)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
				<div class="inputGroup-text">
					<span class="colorPickerBox js-colorPickerTrigger"></span>
				</div>
			</div>
			<dfn class="formRow-explain"></dfn>
			<div>' . 'Fa ikon unicode' . '</div>
			' . $__templater->formTextBox(array(
		'style' => 'width: 220px;',
		'name' => $__vars['inputName'] . '[yoneticibannerikon]',
		'value' => ($__vars['option']['option_value']['yoneticibannerikon'] ? $__vars['option']['option_value']['yoneticibannerikon'] : ''),
	)) . '      
			<dfn class="formRow-explain">
				' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '
			</dfn>				
		'),
		'_type' => 'option',
	)), array(
		'label' => 'Yönetici banner',
		'hint' => $__templater->escape($__vars['hintHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	));
	return $__finalCompiled;
});