<?php
// FROM HASH: 6bb5a1210086f03800c16edb61278f74
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="prefixContainer">
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'select', array(
		'name' => 'na',
		'prefixes' => $__vars['prefixes'],
		'contentParent' => $__vars['category'],
		'type' => 'dbtechEcommerceProduct',
	), $__vars) . '
</div>';
	return $__finalCompiled;
});