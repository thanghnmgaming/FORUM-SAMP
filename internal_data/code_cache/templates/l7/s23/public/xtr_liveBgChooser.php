<?php
// FROM HASH: cbf72af6f11c1202477c3781dc0c1cd7
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('xtr_liveBgChooser.less');
	$__finalCompiled .= '

<div class="bgChooser clearfix">
	<ul>
		';
	if ($__templater->func('property', array('xtr_live_background_picker_bg1', ), false)) {
		$__finalCompiled .= '
			<li id="bg-1"></li>
		';
	}
	$__finalCompiled .= '
		';
	if ($__templater->func('property', array('xtr_live_background_picker_bg2', ), false)) {
		$__finalCompiled .= '
			<li id="bg-2"></li>
		';
	}
	$__finalCompiled .= '	
		';
	if ($__templater->func('property', array('xtr_live_background_picker_bg3', ), false)) {
		$__finalCompiled .= '	
			<li id="bg-3"></li>
		';
	}
	$__finalCompiled .= '	
		';
	if ($__templater->func('property', array('xtr_live_background_picker_bg4', ), false)) {
		$__finalCompiled .= '	
			<li id="bg-4"></li>
		';
	}
	$__finalCompiled .= '	
	</ul>
	<div class="closeBgChooser" data-xf-init="tooltip" data-original-title="' . 'Đóng' . '"><i class="fa fa-window-close" aria-hidden="true"></i></div>
</div>';
	return $__finalCompiled;
});