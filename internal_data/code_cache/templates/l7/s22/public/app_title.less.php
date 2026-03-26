<?php
// FROM HASH: 15c75735e3a8da14fa588d70d218fec2
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.p-title
{
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	max-width: 100%;
	margin-bottom: -5px;

	&.p-title--noH1
	{
		flex-direction: row-reverse;
	}
}

.p-title-value
{
	padding: 0;
	margin: 0 0 5px 0;
	font-size: @xf-fontSizeLarge;
	font-weight: @xf-fontWeightHeavy;
	min-width: 0;
	margin-right: auto;

	line-height: 30px;
	
	.label
	{
		vertical-align: 2px;
		margin-right: .5em;
	}
}

.p-title-pageAction
{
	margin-bottom: 5px;
}

.p-description
{
	margin: 5px 0 0;
	padding: 0;
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorMuted;
}

@media (max-width: @xf-responsiveNarrow)
{
	.p-title-value
	{
		font-size: @xf-fontSizeLarger;
	}
}';
	return $__finalCompiled;
});