<?php
// FROM HASH: 63d03d28cf7c167c187bad8ea7e6d976
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Border');
	$__finalCompiled .= '

' . 'Click' . ' <a href="' . $__templater->func('link', array('posts', $__vars['post'], ), true) . '">' . 'here' . '</a> ' . 'to return to post. Reload page to see changes.' . '
<br />
<br />

<div class="block-container">
	<div class="block-body">
		';
	$__compilerTemp1 = '';
	if ($__templater->isTraversable($__vars['attachments'])) {
		foreach ($__vars['attachments'] AS $__vars['attachment']) {
			$__compilerTemp1 .= '
				' . $__templater->dataRow(array(
				'rowclass' => 'dataList-row--noHover',
			), array(array(
				'_type' => 'cell',
				'html' => '<img class="resizeThumb" src="' . $__templater->escape($__vars['attachment']['thumbnailUrl']) . '?' . $__templater->escape($__vars['serverTime']) . '">',
			),
			array(
				'_type' => 'cell',
				'html' => $__templater->escape($__vars['attachment']['filename']),
			),
			array(
				'_type' => 'cell',
				'html' => '<a href="' . $__templater->func('link', array('posts/bordersave/', '', array('attachment_id' => $__vars['attachment']['attachment_id'], ), ), true) . '">' . 'Add border' . '</a>',
			))) . '
			';
		}
	}
	$__finalCompiled .= $__templater->dataList('
			' . $__templater->dataRow(array(
		'rowtype' => 'header',
	), array(array(
		'_type' => 'cell',
		'html' => 'Attachment',
	),
	array(
		'_type' => 'cell',
		'html' => 'Filename',
	),
	array(
		'_type' => 'cell',
		'html' => 'Action',
	))) . '
			' . $__compilerTemp1 . '
		', array(
		'data-xf-init' => 'responsive-data-list',
	)) . '
	</div>
</div>';
	return $__finalCompiled;
});