<?php
// FROM HASH: 0701233fa21995e1a40d821269ac54c0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->isTraversable($__vars['filters']['prefix_id'])) {
		foreach ($__vars['filters']['prefix_id'] AS $__vars['prefixId']) {
			$__finalCompiled .= '
	';
			$__vars['newFilters'] = $__vars['filters'];
			$__finalCompiled .= '
	';
			$__vars['newFilters']['prefix_id'] = $__templater->filter($__vars['newFilters']['prefix_id'], array(array('replaceValue', array($__vars['prefixId'], null, )),), false);
			$__finalCompiled .= '

	<li><a href="' . $__templater->func('link', array($__vars['baseLinkPath'], $__vars['container'], $__vars['newFilters'], ), true) . '"
		   class="filterBar-filterToggle" data-xf-init="tooltip" title="' . $__templater->filter('Xóa bộ lọc này', array(array('for_attr', array()),), true) . '">
		<span class="filterBar-filterToggle-label">' . 'Tiền tố' . $__vars['xf']['language']['label_separator'] . '</span>
		' . $__templater->func('prefix_title', array($__vars['prefixType'], $__vars['prefixId'], ), true) . '</a></li>
';
		}
	}
	return $__finalCompiled;
});