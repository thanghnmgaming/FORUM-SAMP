<?php
// FROM HASH: 05a915320b24e81eaa143d234d16b4fe
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="prefixContainer">
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'select', array(
		'name' => 'na',
		'prefixes' => $__vars['prefixes'],
		'contentParent' => $__vars['category'],
		'type' => 'resource',
	), $__vars) . '
</div>';
	return $__finalCompiled;
});