<?php
// FROM HASH: 955907fa006c4ad45566f8db241c482d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ################## IGNORED USERS / CONTENT ##########################

.is-ignored
{
	display: none !important;
}

.showIgnoredLink
{
	&.is-hidden
	{
		display: none !important;
	}
}

.block-outer .showIgnoredLink,
.showIgnoredLink.showIgnoredLink--subtle
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorMuted;
	
	display: inline-block;
	padding: 9px 10px;

	&:hover
	{
		color: @xf-textColorDimmed;
	}
}';
	return $__finalCompiled;
});