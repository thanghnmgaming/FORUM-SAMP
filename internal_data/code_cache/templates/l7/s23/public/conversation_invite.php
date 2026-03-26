<?php
// FROM HASH: e2a0d6d455d410143c51ee248e258b46
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Mời thành viên tham gia cuộc trò chuyện');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Trò chuyện'), $__templater->func('link', array('conversations', ), false), array(
	));
	$__finalCompiled .= '
';
	$__templater->breadcrumb($__templater->preEscaped($__templater->escape($__vars['conversation']['title'])), $__templater->func('link', array('conversations', $__vars['conversation'], ), false), array(
	));
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__vars['remainingRecipients'] > 1) {
		$__compilerTemp1 .= 'Phân tách các tên bằng dấu (,).';
	}
	$__compilerTemp2 = '';
	if ($__vars['remainingRecipients'] > 0) {
		$__compilerTemp2 .= 'Bạn có thể mời ' . $__templater->filter($__vars['remainingRecipients'], array(array('number', array()),), true) . ' thành viên(s).';
	}
	$__finalCompiled .= $__templater->form('
	<div class="block-container">
		<div class="block-body">
			' . $__templater->formTokenInputRow(array(
		'name' => 'recipients',
		'href' => $__templater->func('link', array('members/find', ), false),
		'max-tokens' => (($__vars['remainingRecipients'] > -1) ? $__vars['remainingRecipients'] : null),
	), array(
		'label' => 'Mời thành viên',
		'explain' => '
					' . $__compilerTemp1 . ' ' . 'Thành viên được mời có thể xem toàn bộ cuộc trò chuyện từ khi bắt đầu.
' . '
					' . $__compilerTemp2 . '
				',
	)) . '
		</div>
		' . $__templater->formSubmitRow(array(
		'submit' => 'Mời',
	), array(
	)) . '
	</div>
', array(
		'action' => $__templater->func('link', array('conversations/invite', $__vars['conversation'], ), false),
		'class' => 'block',
		'ajax' => 'true',
	));
	return $__finalCompiled;
});