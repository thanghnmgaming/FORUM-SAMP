<?php
// FROM HASH: 22711560d37d234263657bff2f8a1d26
return array('macros' => array('setup' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'src' => 'sv/multiprefix/prefix_menu.js',
		'addon' => 'SV/MultiPrefix',
		'min' => '1',
	));
	$__finalCompiled .= '
	';
	$__templater->includeJs(array(
		'prod' => 'vendor/select2/select2.full.min.js',
		'dev' => 'vendor/select2/select2.full.js',
	));
	$__finalCompiled .= '
	';
	$__templater->includeCss('prefix_menu.less');
	$__finalCompiled .= '
	';
	$__templater->includeCss('select2.less');
	$__finalCompiled .= '
	';
	$__templater->includeCss('sv_multiprefix_prefix_input.less');
	$__finalCompiled .= '


	<script class="js-extraPhrases" type="application/json">
		{
			"sv_prefix_placeholder": "' . $__templater->filter('Tiền tố' . $__vars['xf']['language']['ellipsis'], array(array('escape', array('js', )),), true) . '",
			"sv_multiprefix_none": "' . $__templater->filter($__vars['xf']['language']['parenthesis_open'] . 'Không tiền tố' . $__vars['xf']['language']['parenthesis_close'], array(array('escape', array('js', )),), true) . '"
		}
	</script>
';
	return $__finalCompiled;
},
'select' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'prefixes' => '!',
		'type' => '!',
		'label' => 'Tiền tố',
		'explain' => '',
		'selected' => '',
		'name' => 'prefix_id',
		'multiple' => true,
		'includeAny' => false,
		'class' => '',
		'href' => '',
		'listenTo' => '',
		'minTokens' => 0,
		'maxTokens' => 0,
		'forumPrefixesLimit' => 0,
		'contentParent' => false,
		'content' => false,
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'setup', array(), $__vars) . '

	<script type="text/template">
        ' . $__templater->func('mustache', array('#rich_prefix', '
            <span class="' . $__templater->func('mustache', array('css_class', ), true) . '"
               data-prefix-id="' . $__templater->func('mustache', array('prefix_id', ), true) . '"
               data-prefix-class="' . $__templater->func('mustache', array('css_class', ), true) . '"
               role="option">' . $__templater->func('mustache', array('title', ), true) . '</span>
        ')) . '
    </script>

	';
	if ($__vars['contentParent']) {
		$__finalCompiled .= '
		';
		$__vars['min_tokens'] = $__vars['contentParent']['sv_min_prefixes'];
		$__finalCompiled .= '
		';
		$__vars['max_tokens'] = $__vars['contentParent']['sv_max_prefixes'];
		$__finalCompiled .= '
	';
	} else {
		$__finalCompiled .= '
		';
		$__vars['min_tokens'] = $__vars['minTokens'];
		$__finalCompiled .= '
		';
		$__vars['max_tokens'] = $__vars['maxTokens'];
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

	';
	if ($__vars['forumPrefixesLimit'] > 0) {
		$__finalCompiled .= '
		';
		$__vars['max_tokens'] = $__vars['forumPrefixesLimit'];
		$__finalCompiled .= '
	';
	}
	$__finalCompiled .= '

   ';
	$__compilerTemp1 = array();
	$__compilerTemp2 = $__templater->func('array_keys', array($__vars['prefixes'], ), false);
	if ($__templater->isTraversable($__compilerTemp2)) {
		foreach ($__compilerTemp2 AS $__vars['groupId']) {
			if ($__vars['groupId'] > 0) {
				$__compilerTemp1[] = array(
					'label' => $__templater->func('prefix_group', array($__vars['type'], $__vars['groupId'], ), false),
					'_type' => 'optgroup',
					'options' => array(),
				);
				end($__compilerTemp1); $__compilerTemp3 = key($__compilerTemp1);
				if ($__templater->isTraversable($__vars['prefixes'][$__vars['groupId']])) {
					foreach ($__vars['prefixes'][$__vars['groupId']] AS $__vars['prefixId'] => $__vars['prefix']) {
						$__compilerTemp1[$__compilerTemp3]['options'][] = array(
							'value' => $__vars['prefixId'],
							'label' => $__templater->func('prefix_title', array($__vars['type'], $__vars['prefixId'], ), true),
							'data-prefix-class' => $__vars['prefix']['css_class'],
							'_type' => 'option',
						);
					}
				}
			} else {
				if ($__templater->isTraversable($__vars['prefixes'][$__vars['groupId']])) {
					foreach ($__vars['prefixes'][$__vars['groupId']] AS $__vars['prefixId'] => $__vars['prefix']) {
						$__compilerTemp1[] = array(
							'value' => $__vars['prefixId'],
							'label' => $__templater->func('prefix_title', array($__vars['type'], $__vars['prefixId'], ), true),
							'data-prefix-class' => $__vars['prefix']['css_class'],
							'_type' => 'option',
						);
					}
				}
			}
		}
	}
	$__finalCompiled .= $__templater->formSelect(array(
		'name' => $__vars['name'],
		'value' => $__vars['selected'],
		'multiple' => $__vars['multiple'],
		'class' => $__vars['class'],
		'placeholder' => 'Tiền tố',
		'data-xf-init' => (($__vars['href'] AND $__vars['listenTo']) ? 'sv-multi-prefix-loader' : '') . ' sv-multi-prefix-menu',
		'data-href' => $__vars['href'],
		'data-listen-to' => $__vars['listenTo'],
		'data-min-tokens' => $__vars['min_tokens'],
		'data-max-tokens' => $__vars['max_tokens'],
	), $__compilerTemp1) . '
';
	return $__finalCompiled;
},
'row' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'prefixes' => '!',
		'type' => '!',
		'label' => 'Tiền tố',
		'explain' => '',
		'selected' => '',
		'name' => 'prefix_id',
		'noneLabel' => $__vars['xf']['language']['parenthesis_open'] . 'Không tiền tố' . $__vars['xf']['language']['parenthesis_close'],
		'multiple' => false,
		'includeAny' => false,
		'class' => '',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	' . $__templater->callMacro('sv_multiprefix_prefix_macros', 'setup', array(), $__vars) . '

    ';
	$__compilerTemp1 = '';
	if ($__vars['explain']) {
		$__compilerTemp1 .= '
            <div class="formRow-explain">' . $__templater->filter($__vars['explain'], array(array('raw', array()),), true) . '</div>
        ';
	}
	$__finalCompiled .= $__templater->formRow('
        ' . $__templater->callMacro(null, 'select', array(
		'prefixes' => $__vars['prefixes'],
		'type' => $__vars['type'],
		'label' => $__vars['label'],
		'explain' => $__vars['explain'],
		'selected' => $__vars['selected'],
		'name' => $__vars['name'],
		'noneLabel' => $__vars['noneLabel'],
		'multiple' => $__vars['multiple'],
		'includeAny' => $__vars['includeAny'],
		'class' => $__vars['class'],
	), $__vars) . '
        ' . $__compilerTemp1 . '
    ', array(
		'rowtype' => 'input',
		'label' => $__templater->escape($__vars['label']),
	)) . '
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '

' . '

';
	return $__finalCompiled;
});