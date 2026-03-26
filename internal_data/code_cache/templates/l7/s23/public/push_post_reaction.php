<?php
// FROM HASH: e69cafba2cbc89fa5d0ba88d17ef2189
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '' . ($__templater->escape($__vars['user']['username']) ?: $__templater->escape($__vars['alert']['username'])) . ' đã cho bạn ' . $__templater->func('reaction_title', array($__vars['extra']['reaction_id'], ), true) . ' trong bình luận của bạn trong bài viết: <a {posterParams}>' . ($__templater->func('prefix', array('thread', $__vars['content']['Thread'], 'plain', ), true) . $__templater->escape($__vars['content']['Thread']['title'])) . '</a>' . '
<push:url>' . $__templater->func('link', array('canonical:posts', $__vars['content'], ), true) . '</push:url>
<push:tag>post_reaction_' . $__templater->escape($__vars['content']['post_id']) . '_' . $__templater->escape($__vars['extra']['reaction_id']) . '</push:tag>';
	return $__finalCompiled;
});