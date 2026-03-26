<?php
// FROM HASH: 8884c12d038408eca9852bc6aea437a0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="prefixContainer">
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'select', array(
		'name' => 'na',
		'prefixes' => $__vars['prefixes'],
		'contentParent' => $__vars['category'],
		'type' => 'dbtechShopItem',
	), $__vars) . '
</div>';
	return $__finalCompiled;
});