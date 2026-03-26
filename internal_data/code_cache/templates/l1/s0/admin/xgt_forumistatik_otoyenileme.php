<?php
// FROM HASH: fbb3cf8323821e8d70f27725431ff2d6
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->formCheckBoxRow(array(
	), array(array(
		'name' => $__vars['inputName'] . '[otoyenileme]',
		'label' => 'Enable',
		'selected' => $__vars['option']['option_value']['otoyenileme'],
		'data-hide' => 'true',
		'_dependent' => array(' 
		   <dfn class="formRow-explain"></dfn><br>
		   <div class="inputGroup"> 
			   ' . $__templater->formCheckBox(array(
	), array(array(
		'name' => $__vars['inputName'] . '[ziyaretciler]',
		'selected' => $__vars['option']['option_value']['ziyaretciler'],
		'value' => ($__vars['option']['option_value']['ziyaretciler'] ? $__vars['option']['option_value']['ziyaretciler'] : '1'),
		'label' => 'Ziyaretçiler içinde oto yenile',
		'_type' => 'option',
	))) . '   
           </div>	
		<dfn class="formRow-explain">' . 'Eger seçim yapılır ise otomatik yenileme sistemi sadece foruma giriş yapmış olan kullanıcılar için çalıştırılacaktır.' . '</dfn>
		<dfn class="formRow-explain"></dfn>
		   <div class="inputGroup">
			   <span class="inputGroup-text">
				   ' . 'Ne kadar süre ile yenilensin ?' . '
                </span>
                <span class="inputGroup" dir="ltr">
                    ' . $__templater->formNumberBox(array(
		'name' => $__vars['inputName'] . '[otoyenilemezamani]',
		'class' => 'input--inline input--autoSize',
		'value' => ($__vars['option']['option_value']['otoyenilemezamani'] ? $__vars['option']['option_value']['otoyenilemezamani'] : '30'),
		'min' => '10',
		'step' => '5',
	)) . '
                </span>
		   </div>
        '),
		'_type' => 'option',
	)), array(
		'label' => $__templater->escape($__vars['option']['title']),
		'hint' => $__templater->escape($__vars['hintHtml']),
		'explain' => $__templater->escape($__vars['explainHtml']),
		'html' => $__templater->escape($__vars['listedHtml']),
	));
	return $__finalCompiled;
});