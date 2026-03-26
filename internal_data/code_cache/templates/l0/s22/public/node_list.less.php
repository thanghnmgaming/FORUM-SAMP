<?php
// FROM HASH: 80d6cf11aba5e02eb9459ba1dbd3cf32
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '@_nodeList-statsCellBreakpoint: 1000px;
@_nodeList-PaddingH: 10px;
@_nodeList-PaddingV: 12px;

.node
{
	& + .node
	{
		 border-top: @xf-borderSize solid @xf-borderColorFaint;
	}
}

.node-body
{
	display: table;
	table-layout: fixed;
	width: 100%;
}

' . $__templater->includeTemplate('node_list_ext.less', $__vars) . '
.node-icon
{
	display: table-cell;
	vertical-align: middle;
	text-align: center;
	width: 40px;
	padding: @_nodeList-PaddingV 0 @_nodeList-PaddingV @_nodeList-PaddingH;

	i
	{
		display: block;
		line-height: 1;
		font-size: 0px;

		&:before
		{
			display: inline-block;
			content: \'\';
			width: 30px;
			height: 36px;
			background: url(\'styles/brivium/tin/extra/node-icons.png\')  no-repeat;
		}

		.node--forum &:before,
		.node--category &:before
		{
			background-position: -50px center;
		}

		.node--page &:before
		{
			background-position: -130px center;
		}

		.node--link &:before
		{
			background-position: -90px center;
		}
	}
}

.node--unread
{
	&.node--forum ' . $__templater->includeTemplate('node_list_ext.less', $__vars) . '
.node-icon i:before,
	&.node--category ' . $__templater->includeTemplate('node_list_ext.less', $__vars) . '
.node-icon i:before
	{
		background-position: -10px center;
	}
}

.node-main
{
	display: table-cell;
	vertical-align: middle;
	padding: @_nodeList-PaddingV @_nodeList-PaddingH;
	
	&:before,
	&:after
	{
		display: block;
		content: \'\';
		margin: -3px 0;
	}
}

.node-stats
{
	display: none;
	width: 170px;
	vertical-align: middle;
	text-align: center;
	padding: @_nodeList-PaddingV 0;

	> dl.pairs.pairs--rows
	{
		width: 50%;
		float: left;
		margin: 0;
		padding: 0 @xf-paddingMedium/2;

		&:first-child
		{
			padding-left: 0;
		}

		&:last-child
		{
			padding-right: 0;
		}
	}

	&.node-stats--single
	{
		width: 100px;

		> dl.pairs.pairs--rows
		{
			width: 100%;
			float: none;
		}
	}

	&.node-stats--triple
	{
		width: 240px;

		> dl.pairs.pairs--rows
		{
			width: 33.333%;
		}
	}

	@media (max-width: @_nodeList-statsCellBreakpoint)
	{
		display: none;
	}
}

@_nodeExtra-avatarSize: 36px;

.node-extra
{
	display: table-cell;
	vertical-align: middle;
	width: 250px;
	padding: @_nodeList-PaddingV @_nodeList-PaddingH;

	font-size: @xf-fontSizeSmall;
	
	&:before,
	&:after
	{
		display: block;
		content: \'\';
		margin: -3px 0;
	}
}

.node-extra-row
{
	.m-overflowEllipsis();
	color: @xf-textColorMuted;
	
	&:first-child
	{
		font-weight: @xf-fontWeightHeavy;
		line-height: 20px;
	}
	
	&:last-child
	{
		font-size: @xf-fontSizeSmallest;
		line-height: 20px;
	}
	
	.listInline.listInline--bullet
	{
		> li
		{
			&:before { display: none; }
			
			@media ( min-width: 768px )
			{
				+ li
				{
					margin-left: 45px;
				}
			}
			
			@media ( max-width: 767px )
			{
				+ li
				{
					&:before { display: inline-block; }
				}
			}
		}
	}
}

.node-extra-icon
{
	padding-right: @xf-paddingLarge;
	float: left;

	.avatar
	{
		.m-avatarSize(@_nodeExtra-avatarSize);
	}
}

.node-extra-placeholder
{
	font-style: italic;
}

.node-title
{
	margin: 0;
	padding: 0;
	font-size: @xf-fontSizeSmall;
	font-weight: @xf-fontWeightHeavy;
	
	line-height: 20px;

	.node--unread &
	{
		/// font-weight: @xf-fontWeightHeavy;
	}
	
	@media ( max-width: 650px )
	{
		font-size: @xf-fontSizeNormal;
	}
}

.node-description
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorDimmed;

	&.node-description--tooltip
	{
		.has-js:not(.has-touchevents) &
		{
			display: none;
		}
	}
}

.node-meta
{
	font-size: @xf-fontSizeSmallest;
	line-height: 20px;
}

.node-statsMeta
{
	/// display: none;

	@media (max-width: @_nodeList-statsCellBreakpoint)
	{
		/// display: inline;
	}
	
	.pairs
	{
		+ .pairs,
		+ .node-subNodeMenu
		{
			margin-left: 45px;
		}
	}
}

.node-bonus
{
	font-size: @xf-fontSizeSmall;
	color: @xf-textColorMuted;
	text-align: right;
}

.node-subNodesFlat
{
	font-size: @xf-fontSizeSmallest;
	margin-top: .3em;

	.node-subNodesLabel
	{
		display: none;
	}
}

.node-subNodeMenu
{
	display: inline;

	.menuTrigger
	{
		color: @xf-textColorMuted;
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.node-main
	{
		display: block;
		width: auto;
	}

	.node-extra
	{
		display: block;
		width: auto;
		// this gives an equivalent of medium padding between main and extra, with main still having large
		margin-top: (@xf-paddingMedium - @xf-paddingLarge);
		padding-top: 0;
	}

	.node-extra-row
	{
		display: inline-block;
		vertical-align: top;
		max-width: 100%;
	}

	.node-extra-icon
	{
		display: none;
	}

	.node-description,
	.node-stats,
	.node-subNodesFlat
	{
		display: none;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.node-subNodeMenu
	{
		display: none;
	}
}

.subNodeLink
{
	color: @xf-linkColor;
	font-weight: @xf-fontWeightHeavy;
	
	&:before
	{
		display: inline-block;
		.m-faBase(\'Pro\', @faWeight-solid);
		width: 1em;
		padding-right: .3em;
		text-decoration: none;

		color: @xf-linkColor;
		/// text-shadow: 1px 1px 0 fade(xf-intensify(@xf-nodeIconReadColor, 50%), 50%);
	}

	&:hover:before
	{
		text-decoration: none;
	}

	&.subNodeLink--unread
	{
		font-weight: @xf-fontWeightHeavy;

		&:before
		{
			/// color: @xf-nodeIconUnreadColor;
			/// text-shadow: 1px 1px 0 fade(xf-intensify(@xf-nodeIconUnreadColor, 50%), 50%);
		}
	}

	&.subNodeLink--forum:before,
	&.subNodeLink--category:before
	{
		.m-faContent(@fa-var-circle, 2em);
		font-size: 5px;
		transform: translateY(-50%);
	}

	&.subNodeLink--page:before
	{
		.m-faContent(@fa-var-file-alt);
	}

	&.subNodeLink--link:before
	{
		.m-faContent(@fa-var-link);
	}
}

.node-subNodeFlatList
{
	.m-listPlain();
	.m-clearFix();

	> li
	{
		display: inline-block;
		margin-right: 1.5em;
		margin-bottom: .5em;
		padding: 6px 0 6px;
		border-radius: @xf-borderRadiusSmall;
		float: left;

		&:last-child
		{
			margin-right: 0;
		}
		
		&:hover
		{
			cursor: pointer;
			
			a
			{
				text-decoration: none;
				
				&:before { color: inherit; }
			}
		}
	}

	ol,
	ul,
	.node-subNodes
	{
		display: none;
	}
}

.subNodeMenu
{
	.m-listPlain();

	ol,
	ul
	{
		.m-listPlain();
	}

	.subNodeLink
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
	}

	li li .subNodeLink { padding-left: 1.5em; }
	li li li .subNodeLink { padding-left: 3em; }
	li li li li .subNodeLink { padding-left: 4.5em; }
	li li li li li .subNodeLink { padding-left: 6em; }
	li li li li li li .subNodeLink { padding-left: 7.5em; }
}';
	return $__finalCompiled;
});