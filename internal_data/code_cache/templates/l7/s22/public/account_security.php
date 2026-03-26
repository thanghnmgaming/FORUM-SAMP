<?php
// FROM HASH: cd4d76dfbae5fbf27965a21d5fd6f51d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Mật khẩu và bảo mật');
	$__finalCompiled .= '

';
	$__templater->wrapTemplate('account_wrapper', $__vars);
	$__finalCompiled .= '

' . $__templater->form('
	<div class="block-container">
		<div class="block-body">
			<b>Vui lòng thay đổi mật khẩu tại UCP</b>

			<hr class="formRowSep" />

			
		</div>
		
	</div>
', array(
		'action' => $__templater->func('link', array('account/security', ), false),
		'ajax' => 'true',
		'class' => 'block',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
});