<?php
// FROM HASH: f0ffec761a56ddfd9eca1b22ee876d1b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="u-alignCenter">
	' . 'Trang web này sử dụng cookie. Tiếp tục sử dụng trang web này đồng nghĩa với việc bạn đồng ý sử dụng cookie của chúng tôi.' . '
</div>

<div class="u-inputSpacer u-alignCenter">
	' . $__templater->button('Chấp nhận', array(
		'icon' => 'confirm',
		'href' => $__templater->func('link', array('account/dismiss-notice', null, array('notice_id' => $__vars['notice']['notice_id'], ), ), false),
		'class' => 'js-noticeDismiss button--notice',
	), '', array(
	)) . '
	' . $__templater->button('Tìm hiểu thêm.' . $__vars['xf']['language']['ellipsis'], array(
		'href' => $__templater->func('link', array('help/cookies', ), false),
		'class' => 'button--notice',
	), '', array(
	)) . '
</div>';
	return $__finalCompiled;
});