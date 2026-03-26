<?php
// FROM HASH: d458c78ad79caf9d1a4a9d5def00dadf
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="prefixContainer">
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'select', array(
		'name' => 'na',
		'prefixes' => $__vars['prefixes'],
		'contentParent' => $__vars['forum'],
		'type' => 'thread',
		'forumPrefixesLimit' => $__vars['force_limit_prefix'],
	), $__vars) . '
</div>';
	return $__finalCompiled;
});