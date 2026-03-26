<?php
// FROM HASH: 7f5c0ca4109ab8fa8b5e02c317f25713
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
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '1. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner1ap]',
		'value' => ($__vars['option']['option_value']['banner1ap'] ? $__vars['option']['option_value']['banner1ap'] : 'rgb(228, 13, 13)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
			<div class="inputGroup-text">
				<span class="colorPickerBox js-colorPickerTrigger"></span>
			</div>
		</div>
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner1renk]',
		'value' => ($__vars['option']['option_value']['banner1renk'] ? $__vars['option']['option_value']['banner1renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner1ikon]',
		'value' => ($__vars['option']['option_value']['banner1ikon'] ? $__vars['option']['option_value']['banner1ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>

<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '2. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner2ap]',
		'value' => ($__vars['option']['option_value']['banner2ap'] ? $__vars['option']['option_value']['banner2ap'] : 'rgb(15, 132, 23)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner2renk]',
		'value' => ($__vars['option']['option_value']['banner2renk'] ? $__vars['option']['option_value']['banner2renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner2ikon]',
		'value' => ($__vars['option']['option_value']['banner2ikon'] ? $__vars['option']['option_value']['banner2ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '
</div>


<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '3. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 330px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner3ap]',
		'value' => ($__vars['option']['option_value']['banner3ap'] ? $__vars['option']['option_value']['banner3ap'] : 'rgb(4, 98, 147)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 330px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner3renk]',
		'value' => ($__vars['option']['option_value']['banner3renk'] ? $__vars['option']['option_value']['banner3renk'] : 'rgb(355, 355, 355)'),
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
		'style' => 'width: 330px;',
		'name' => $__vars['inputName'] . '[banner3ikon]',
		'value' => ($__vars['option']['option_value']['banner3ikon'] ? $__vars['option']['option_value']['banner3ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '
</div>
		
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '4. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner4ap]',
		'value' => ($__vars['option']['option_value']['banner4ap'] ? $__vars['option']['option_value']['banner4ap'] : 'rgb(0, 174, 179)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner4renk]',
		'value' => ($__vars['option']['option_value']['banner4renk'] ? $__vars['option']['option_value']['banner4renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner4ikon]',
		'value' => ($__vars['option']['option_value']['banner4ikon'] ? $__vars['option']['option_value']['banner4ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>
				
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '5. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner5ap]',
		'value' => ($__vars['option']['option_value']['banner5ap'] ? $__vars['option']['option_value']['banner5ap'] : 'rgb(237, 178, 32)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner5renk]',
		'value' => ($__vars['option']['option_value']['banner5renk'] ? $__vars['option']['option_value']['banner5renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner5ikon]',
		'value' => ($__vars['option']['option_value']['banner5ikon'] ? $__vars['option']['option_value']['banner5ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '	
</div>
				
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '6. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner6ap]',
		'value' => ($__vars['option']['option_value']['banner6ap'] ? $__vars['option']['option_value']['banner6ap'] : 'rgb(230, 133, 35)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner6renk]',
		'value' => ($__vars['option']['option_value']['banner6renk'] ? $__vars['option']['option_value']['banner6renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner6ikon]',
		'value' => ($__vars['option']['option_value']['banner6ikon'] ? $__vars['option']['option_value']['banner6ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>
				
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '7. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner7ap]',
		'value' => ($__vars['option']['option_value']['banner7ap'] ? $__vars['option']['option_value']['banner7ap'] : 'rgb(123, 83, 157)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner7renk]',
		'value' => ($__vars['option']['option_value']['banner7renk'] ? $__vars['option']['option_value']['banner7renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner7ikon]',
		'value' => ($__vars['option']['option_value']['banner7ikon'] ? $__vars['option']['option_value']['banner7ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>
				
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '8. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner8ap]',
		'value' => ($__vars['option']['option_value']['banner8ap'] ? $__vars['option']['option_value']['banner8ap'] : 'rgb(199, 55, 116)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
	 		<div class="inputGroup-text">
		  		<span class="colorPickerBox js-colorPickerTrigger"></span>
	 		</div>
		</div>
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
	 		' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner8renk]',
		'value' => ($__vars['option']['option_value']['banner8renk'] ? $__vars['option']['option_value']['banner8renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner8ikon]',
		'value' => ($__vars['option']['option_value']['banner8ikon'] ? $__vars['option']['option_value']['banner8ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>

<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '9. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner9ap]',
		'value' => ($__vars['option']['option_value']['banner9ap'] ? $__vars['option']['option_value']['banner9ap'] : 'rgb(0, 140, 201)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
			<div class="inputGroup-text">
				<span class="colorPickerBox js-colorPickerTrigger"></span>
			</div>
		</div>
	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner9renk]',
		'value' => ($__vars['option']['option_value']['banner9renk'] ? $__vars['option']['option_value']['banner9renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner9ikon]',
		'value' => ($__vars['option']['option_value']['banner9ikon'] ? $__vars['option']['option_value']['banner9ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>
		
<h3 class="block-formSectionHeader">
	<span class="collapseTrigger collapseTrigger--block" data-xf-click="toggle" data-target="< :up:next">
		<span class="block-formSectionHeader-aligner">
			' . '10. Banner' . '
		</span>
	</span>
</h3>
<div class="block-body block-body--collapsible">
	' . $__templater->formRow('
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Arka Plan rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner10ap]',
		'value' => ($__vars['option']['option_value']['banner10ap'] ? $__vars['option']['option_value']['banner10ap'] : 'rgb(77, 79, 81)'),
		'class' => 'input--cssProp',
		'dir' => 'ltr',
	)) . '
			<div class="inputGroup-text">
				<span class="colorPickerBox js-colorPickerTrigger"></span>
			</div>
		</div>
	
		<dfn class="formRow-explain"></dfn>
		<div>' . 'Metin rengi' . '</div>
		<div class="inputGroup inputGroup--joined inputGroup--colorSmall" data-xf-init="color-picker" style="width: 220px;">
			' . $__templater->formTextBox(array(
		'name' => $__vars['inputName'] . '[banner10renk]',
		'value' => ($__vars['option']['option_value']['banner10renk'] ? $__vars['option']['option_value']['banner10renk'] : 'rgb(255, 255, 255)'),
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
		'name' => $__vars['inputName'] . '[banner10ikon]',
		'value' => ($__vars['option']['option_value']['banner10ikon'] ? $__vars['option']['option_value']['banner10ikon'] : ''),
	)) . '      
		<dfn class="formRow-explain">' . 'FA ikon unicode belirtiniz,ikon unicode ve gorünümlerini <a href="https://fontawesome.com/icons?d=gallery" target="blank">bu bağlantıdan</a> inceleyebilirsiniz.
<br />
Örnek unicode: f195' . '</dfn>
	', array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	)) . '		
</div>';
	return $__finalCompiled;
});