<?php
// FROM HASH: 3e556ec9ee339c71fe5e45b9209a59fa
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '' . ($__templater->escape($__vars['user']['username']) ?: $__templater->escape($__vars['alert']['username'])) . ' đã đề cập đến bạn trong một tin nhắn trên hồ sơ của ' . $__templater->escape($__vars['content']['ProfileUser']['username']) . '\'.' . '
<push:url>' . $__templater->func('link', array('canonical:profile-posts', $__vars['content'], ), true) . '</push:url>';
	return $__finalCompiled;
});