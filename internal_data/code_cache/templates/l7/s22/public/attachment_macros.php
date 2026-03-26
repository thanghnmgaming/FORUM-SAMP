<?php
// FROM HASH: 59ad5608b8763fee7708447311f6229d
return array('macros' => array('attachment_list_item' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'attachment' => '!',
		'canView' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '
	<li class="attachment">
		<div class="attachment-figure">
			';
	if ($__vars['attachment']['has_thumbnail']) {
		$__finalCompiled .= '
				' . $__templater->callMacro('lightbox_macros', 'setup', array(
			'canViewAttachments' => $__vars['canView'],
		), $__vars) . '

				<div class="attachment-icon attachment-icon--img">
					<a href="' . $__templater->func('link', array('attachments', $__vars['attachment'], ), true) . '" target="_blank" class="' . ($__vars['canView'] ? 'js-lbImage' : '') . '">
						<img src="' . $__templater->escape($__vars['attachment']['thumbnail_url']) . '" alt="' . $__templater->escape($__vars['attachment']['filename']) . '" />
					</a>
				</div>
			';
	} else {
		$__finalCompiled .= '
				<div class="attachment-icon" data-extension="' . $__templater->escape($__vars['attachment']['extension']) . '">
					<a href="' . $__templater->func('link', array('attachments', $__vars['attachment'], ), true) . '" target="_blank"><i aria-hidden="true"></i></a>
				</div>
			';
	}
	$__finalCompiled .= '
		</div>
			
		<div class="attachment-main">
			<div class="attachment-name">
				<a href="' . $__templater->func('link', array('attachments', $__vars['attachment'], ), true) . '" target="_blank" title="' . $__templater->escape($__vars['attachment']['filename']) . '">' . $__templater->escape($__vars['attachment']['filename']) . '</a>
			</div>
			<div class="attachment-details">
				<dl class="pairs pairs--justified">
					<dt>File size</dt>
					<dd><span class="attachment-details-size">' . $__templater->filter($__vars['attachment']['file_size'], array(array('file_size', array()),), true) . '</span></dd>
				</dl>
				
				<dl class="pairs pairs--justified">
					<dt>Download</dt>
					<dd><span class="attachment-details-views">' . $__templater->filter($__vars['attachment']['view_count'], array(array('number', array()),), true) . '</span></dd>
				</dl>
			</div>
		</div>
	</li>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});