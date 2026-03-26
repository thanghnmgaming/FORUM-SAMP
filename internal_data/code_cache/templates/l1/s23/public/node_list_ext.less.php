<?php
// FROM HASH: 2a30d656141f1a39be315134f7c04ba0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.node-icon-ext
{
	display: table-cell;
	vertical-align: middle;
	text-align: center;
	width: 46px;
	padding: @xf-paddingLarge 0 @xf-paddingLarge @xf-paddingLarge;
	color: @xf-nodeIconReadColor;

	i
	{
		display: block;
		line-height: 1.125;
		font-size: 32px;
		
		&:before, &{
			.node--unread &
			{
				opacity: 1;
				color: @xf-nodeIconUnreadColor;
			}
		}

		&.fa:before,
		&.fas:before,
		&.far:before,
		&.fal:before,
		&.fa--xf:before
		{
			.m-faBase();
		}
		
		&.far:before
		{
			font-weight: 400;
		}
		
		&.fas:before
		{
			font-weight: 900;
		}
		
		&.fal:before
		{
			font-weight: 300;
		}
	}
}

.subNodeLink-ext
{
	&.fa:before,
	&.fa--xf:before
	{
		display: inline-block;
		.m-faBase();
		width: 1em;
		padding-right: .3em;
		text-decoration: none;

		color: @xf-nodeIconReadColor;
	}

	&:hover:before
	{
		text-decoration: none;
	}

	&.subNodeLink--unread
	{
		font-weight: @xf-fontWeightHeavy;

		&:before, i
		{
			color: @xf-nodeIconUnreadColor;
		}
	}
}

.subNodeMenu
{
	.subNodeLink-ext
	{
		display: block;
		padding: @xf-blockPaddingV @xf-blockPaddingH;
		text-decoration: none;
		cursor: pointer;

		&:hover
		{
			text-decoration: none;
			background: @xf-contentHighlightBg;
		}
		
		img{
			height:1em;
		}
	}
	
	li li .subNodeLink-ext { padding-left: 1.5em; }
	li li li .subNodeLink-ext { padding-left: 3em; }
	li li li li .subNodeLink-ext { padding-left: 4.5em; }
	li li li li li .subNodeLink-ext { padding-left: 6em; }
	li li li li li li .subNodeLink-ext { padding-left: 7.5em; }
}';
	return $__finalCompiled;
});