<?php
// FROM HASH: e5128703b4797829f9942cf164a22b13
return array('macros' => array('Mesajlar' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'mesaj' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="MiniHeader">
		<div class="MiniHeaderHucre IstatistikAvatar"></div>
		<div class="IstatistikHucre">
			' . 'Konu' . '
		</div>
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikForum">
				' . 'Forumu' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikCevap">
				' . 'Cevap' . '
			</div>
			<div class="MiniHeaderHucre IstatistikGoruntuleme">
				' . 'Görüntüleme' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikZaman">
				' . 'Gönderim' . '
			</div>	
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
		$__finalCompiled .= '	
			<div class="MiniHeaderHucre IstatistikSonCevap">
				' . 'Son yazan' . '
			</div>
		';
	}
	$__finalCompiled .= '		  
	</div>
';
	return $__finalCompiled;
},
'Konular' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'konu' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="MiniHeader">
		<div class="MiniHeaderHucre IstatistikAvatar"></div>
		<div class="IstatistikHucre">
			' . 'Konu' . '
		</div>
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikForum">
				' . 'Forumu' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikCevap">
				' . 'Cevap' . '
			</div>
			<div class="MiniHeaderHucre IstatistikGoruntuleme">
				' . 'Görüntüleme' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikZaman">
				' . 'Gönderim' . '
			</div>	
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
		$__finalCompiled .= '	
			<div class="MiniHeaderHucre IstatistikSonCevap">
				' . 'Konu başlatan' . '
			</div>
		';
	}
	$__finalCompiled .= '		  
	</div>
';
	return $__finalCompiled;
},
'encokmesaj' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'encokmesaj' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="MiniHeader">
		<div class="MiniHeaderHucre IstatistikAvatar"></div>
		<div class="IstatistikHucre">
			' . 'Konu' . '
		</div>
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikForum">
				' . 'Forumu' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikCevap">
				' . 'Cevap' . '
			</div>
			<div class="MiniHeaderHucre IstatistikGoruntuleme">
				' . 'Görüntüleme' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikZaman">
				' . 'Gönderim' . '
			</div>	
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
		$__finalCompiled .= '	
			<div class="MiniHeaderHucre IstatistikSonCevap">
				' . 'Konu başlatan' . '
			</div>
		';
	}
	$__finalCompiled .= '		  
	</div>
';
	return $__finalCompiled;
},
'encoktepki' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'encoktepki' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="MiniHeader">
		<div class="MiniHeaderHucre IstatistikAvatar"></div>
		<div class="IstatistikHucre">
			' . 'Konu' . '
		</div>
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikForum">
				' . 'Forumu' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikCevap">
				' . 'Cevap' . '
			</div>
			<div class="MiniHeaderHucre IstatistikGoruntuleme">
				' . 'Tepki' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikZaman">
				' . 'Gönderim' . '
			</div>	
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
		$__finalCompiled .= '	
			<div class="MiniHeaderHucre IstatistikSonCevap">
				' . 'Konu başlatan' . '
			</div>
		';
	}
	$__finalCompiled .= '		  
	</div>
';
	return $__finalCompiled;
},
'encokgoruntulenen' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'encokgoruntulenen' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="MiniHeader">
		<div class="MiniHeaderHucre IstatistikAvatar"></div>
		<div class="IstatistikHucre">
			' . 'Konu' . '
		</div>
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['forumugoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikForum">
				' . 'Forumu' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['mesajgosterim']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikCevap">
				' . 'Cevap' . '
			</div>
			<div class="MiniHeaderHucre IstatistikGoruntuleme GoruntulemeVurgusuS">
				' . 'Görüntüleme' . '
			</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['zamangoster']) {
		$__finalCompiled .= '
			<div class="MiniHeaderHucre IstatistikZaman">
				' . 'Gönderim' . '
			</div>	
		';
	}
	$__finalCompiled .= '
		';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sonyazan']) {
		$__finalCompiled .= '	
			<div class="MiniHeaderHucre IstatistikSonCevap">
				' . 'Konu başlatan' . '
			</div>
		';
	}
	$__finalCompiled .= '		  
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
' . '
' . '
' . '
';
	return $__finalCompiled;
});