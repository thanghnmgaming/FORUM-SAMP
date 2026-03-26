<?php
// FROM HASH: 7c50698f9d1ddf11d0f6c88a5d849b43
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ################################# BLOCKS ##################

.blocks
{
	margin-bottom: @xf-elementSpacer;

	&:last-child
	{
		margin-bottom: 0;
	}

	.block
	{
		margin-bottom: (@xf-elementSpacer / 2);

		&:last-child
		{
			margin-bottom: 0;
		}
	}

	&.blocks--close .block
	{
		margin-bottom: (@xf-elementSpacer / 4);
	}

	&.blocks--separated
	{
		+ .blocks
		{
			padding-top: @xf-elementSpacer;
			border-top: @xf-borderSize solid @xf-borderColor;
		}
	}
}

.blocks-header
{
	font-size: @xf-fontSizeLarger;
	font-weight: @xf-fontWeightNormal;
	color: @xf-textColorMuted;

	margin: 0;
	padding: 0;
	margin-bottom: 5px;

	&.blocks-header--strong
	{
		color: @xf-textColorDimmed;

		.blocks-desc
		{
			color: @xf-textColorMuted;
		}
	}
}

.blocks-textJoiner
{
	display: table;
	width: 100%;
	margin-bottom: (@xf-elementSpacer / 2);
	padding: 0 @xf-paddingMedium;

	> span
	{
		display: table-cell;
		position: relative;

		&:before
		{
			content: \'\';
			position: absolute;
			left: 0;
			right: 0;
			top: 50%;
			border-top: @xf-borderSize solid @xf-borderColor;
		}
	}

	> em
	{
		display: table-cell;
		padding: 0 @xf-paddingLarge;
		width: 1%;
		white-space: nowrap;
		font-size: @xf-fontSizeLargest;
		line-height: 1;
		font-style: normal;
		text-align: center;
	}
}

.block
{
	margin-bottom: @xf-elementSpacer/2;

	&.block--close
	{
		margin-bottom: 5px;
	}

	&.block--treeEntryChooser
	{
		.block-header
		{
			font-size: @xf-fontSizeLarge;

			.block-desc
			{
				font-size: @xf-fontSizeSmallest;
			}
		}

		.block-row
		{
			padding-top: 6px;
			padding-bottom: 6px;
		}

		.contentRow
		{
			&.is-disabled
			{
				opacity: 0.5;
			}
		}

		.contentRow-title
		{
			font-size: @xf-fontSizeNormal;
		}

		.contentRow-minor
		{
			font-size: @xf-fontSizeSmaller;
		}

		.contentRow-suffix
		{
			font-size: @xf-fontSizeSmall;
		}
	}
}

.block-outer
{
	margin-bottom: @xf-blockPaddingV;
	.m-clearFix();
	
	border: @xf-borderSizeMinorFeature solid @xf-borderColor;
	border-radius: @xf-borderRadiusSmall;
	background: fade(@xf-paletteColor4, 50%);

	&:empty
	{
		display: none;
	}

	&.block-outer--after
	{
		margin-top: @xf-blockPaddingV;
		margin-bottom: 0;
	}

	.block-outer-hint
	{
		font-size: @xf-fontSizeSmall;
		color: @xf-textColorMuted;
	}
	
	.button
	{
		background: transparent !important;
		color: @xf-paletteColor2 !important;
		padding-top: 9px;
		padding-bottom: 9px;
	}
}
.block-outer-main { float: right; }
.block-outer-opposite { float: left; }
.block-outer-middle { text-align: center; }

.block-container
{
	.xf-contentBase();
	.xf-blockBorder();
	border-radius: @xf-blockBorderRadius;

	&.block-container--none
	{
		background: none;
		border: none;
		color: @xf-textColor;
		padding: 0;
	}
	
	.overlay &
	{
		border-radius: 0;
	}
}

@media (min-width: @xf-responsiveEdgeSpacerRemoval)
{
	@{block-noStripSel} > :first-child,
	.block-topRadiusContent,
	@{block-noStripSel} > .block-body:first-child > .blockLink:first-child
	{
		border-top-left-radius: @block-borderRadius-inner;
		border-top-right-radius: @block-borderRadius-inner;
	}

	@{block-noStripSel} > :last-child,
	.block-bottomRadiusContent,
	@{block-noStripSel} > .block-body:last-child > .blockLink:last-child
	{
		border-bottom-left-radius: @block-borderRadius-inner;
		border-bottom-right-radius: @block-borderRadius-inner;
	}

	@{block-noStripSel} > .block-body:first-child > .dataList:first-child,
	.block-topRadiusContent.dataList,
	.block-topRadiusContent > .dataList:first-child
	{
		tbody:first-child .dataList-row:first-child,
		thead:first-child .dataList-row:first-child
		{
			> .dataList-cell:first-child { border-top-left-radius: @block-borderRadius-inner; }
			> .dataList-cell:last-child { border-top-right-radius: @block-borderRadius-inner; }
		}
	}

	@{block-noStripSel} > .block-body:first-child > .formRow:first-child,
	.block-topRadiusContent.formRow,
	.block-topRadiusContent > .formRow:first-child
	{
		> dt { border-top-left-radius: @block-borderRadius-inner; }
		> dd { border-top-right-radius: @block-borderRadius-inner; }
	}

	@{block-noStripSel} > .block-body:last-child > .dataList:last-child,
	.block-bottomRadiusContent.dataList,
	.block-bottomRadiusContent > .dataList:last-child
	{
		tbody:last-child .dataList-row:last-child
		{
			> .dataList-cell:first-child { border-bottom-left-radius: @block-borderRadius-inner; }
			> .dataList-cell:last-child { border-bottom-right-radius: @block-borderRadius-inner; }
		}
	}

	@{block-noStripSel} > .block-body:last-child > .formRow:last-child,
	.block-bottomRadiusContent.formRow,
	.block-bottomRadiusContent > .formRow:last-child
	{
		> dt { border-bottom-left-radius: @block-borderRadius-inner; }
		> dd { border-bottom-right-radius: @block-borderRadius-inner; }
	}

	@{block-noStripSel} > .block-body:last-child .formSubmitRow:not(.is-sticky),
	@{block-noStripSel} > .formSubmitRow:not(.is-sticky):last-child,
	.block-bottomRadiusContent > .formSubmitRow:not(.is-sticky)
	{
		> dt { border-bottom-left-radius: @block-borderRadius-inner; }
		> dd { border-bottom-right-radius: @block-borderRadius-inner; }

		.formSubmitRow-bar
		{
			border-bottom-left-radius: @block-borderRadius-inner;
			border-bottom-right-radius: @block-borderRadius-inner;
		}
	}
}

.block-header
{
	padding: @xf-blockPaddingV/2 @xf-blockPaddingH @xf-blockPaddingV/2 55px;
	margin: 0;
	font-weight: @xf-fontWeightNormal;
	text-decoration: none;
	.xf-blockHeader();

	.m-clearFix();
	.m-hiddenLinks();
	
	position: relative;
	line-height: 30px;

	&.block-header--separated
	{
		border-top: @xf-borderSize solid @xf-borderColorLight;
	}

	.block-desc
	{
		color: fade(@xf-blockHeader--color, 70);
		.m-textColoredLinks();
	}
	
	html[dir="RTL"] &
	{
		background-image: url(\'styles/brivium/tin/extra/header-bg-RTL.png\');
		background-position: right center;
	}
}

.block-minorHeader
{
	padding: @xf-blockPaddingV @xf-blockPaddingH*1.5 @xf-blockPaddingV 55px;
	margin: 0;
	font-weight: @xf-fontWeightNormal;
	text-decoration: none;
	.xf-blockMinorHeader();

	.m-clearFix();
	.m-hiddenLinks();
	
	position: relative;
	line-height: 20px;

	.block-body + &
	{
		border-top: @xf-borderSize solid @xf-borderColorLight;
	}

	.block-desc
	{
		.m-textColoredLinks();
	}

	&--spaced
	{
		margin-top: @xf-paddingSmall;
	}

	&--small
	{
		font-size: @xf-fontSizeSmall;
	}
	
	html[dir="RTL"] &
	{
		background-image: url(\'styles/brivium/tin/extra/header-bg-RTL.png\');
		background-position: right center;
	}
}

.block-tabHeader
{
	padding: 0;
	margin: 0;
	font-weight: @xf-fontWeightNormal;
	.xf-blockTabHeader();
	.m-tabsTogether(xf-default(@xf-blockTabHeader--font-size, @xf-fontSizeNormal));

	.tabs-tab
	{
		padding: @xf-blockPaddingV @xf-blockPaddingH max(0px, @xf-blockPaddingV - @xf-borderSizeFeature);
		border-bottom: @xf-borderSizeFeature solid transparent;

		&:hover
		{
			color: @xf-blockTabHeaderSelected--color;
			background: fade(@xf-blockTabHeaderSelected--color, 10%);
		}

		&.is-active
		{
			background: none;
			.xf-blockTabHeaderSelected();
		}
	}

	.block-tabHeader-extra
	{
		float: right;
		color: inherit;
		font-size: @xf-blockTabHeader--font-size;
		padding: @xf-blockPaddingV @xf-blockPaddingH;
	}

	.hScroller-action
	{
		.m-hScrollerActionColorVariation(
			xf-default(@xf-blockTabHeader--background-color, transparent),
			@xf-blockTabHeader--color,
			@xf-blockTabHeaderSelected--color
		);
	}
}

.block-minorTabHeader
{
	padding: 0;
	margin: 0;
	font-weight: @xf-fontWeightNormal;
	.xf-blockMinorTabHeader();
	.m-tabsTogether(xf-default(@xf-blockMinorTabHeader--font-size, @xf-fontSizeNormal));

	.tabs-tab
	{
		padding: @xf-blockPaddingV @xf-blockPaddingH max(0px, @xf-blockPaddingV - @xf-borderSizeFeature);
		border-bottom: @xf-borderSizeFeature solid transparent;

		&:hover
		{
			color: @xf-blockMinorTabHeaderSelected--color;
		}

		&.is-active
		{
			background: none;
			.xf-blockMinorTabHeaderSelected();
		}
	}

	.hScroller-action
	{
		.m-hScrollerActionColorVariation(
			xf-default(@xf-blockMinorTabHeader--background-color, transparent),
			@xf-blockMinorTabHeader--color,
			@xf-blockMinorTabHeaderSelected--color
		);
	}
}

.block-filterBar
{
	padding: @xf-blockPaddingV @xf-blockPaddingH;
	.xf-blockFilterBar();

	&.block-filterBar--standalone
	{
		padding: @xf-paddingLarge @xf-blockPaddingH;
		border: @xf-borderSize solid @xf-borderColor;
		border-radius: @block-borderRadius-inner;

		@media (max-width: @xf-responsiveEdgeSpacerRemoval)
		{
			border-radius: 0;
			border-left: none;
			border-right: none;
		}
	}

	.filterBar-filterToggle
	{
		background: mix(
			xf-default(@xf-blockFilterBar--color, @xf-linkColor),
			xf-default(@xf-blockFilterBar--background-color, transparent),
			8%
		);
	}

	.filterBar-filterToggle,
	.filterBar-menuTrigger
	{
		&:hover
		{
			text-decoration: none;
			background: mix(
				xf-default(@xf-blockFilterBar--color, @xf-linkColor),
				xf-default(@xf-blockFilterBar--background-color, transparent),
				16%
			);
		}
	}

	.filterBar-menuTrigger
	{
		margin-right: -5px;
		color: @xf-textColorEmphasized;
	}
}

.block-textHeader
{
	margin: @xf-blockPaddingV/2 0;
	padding: 0;
	font-weight: @xf-fontWeightNormal;
	.xf-blockTextHeader();

	.m-clearFix();
	.m-hiddenLinks();

	&.block-textHeader--scaled
	{
		font-size: inherit;
	}

	.block-textHeader-highlight
	{
		color: @xf-textColor;
	}

	.block-desc
	{
		.m-textColoredLinks();
	}

	&:first-child
	{
		margin-top: 0;
	}
}

.block-formSectionHeader
{
	padding: @xf-blockPaddingV @xf-blockPaddingH;
	margin: 0;
	font-weight: @xf-fontWeightNormal;
	text-decoration: none;
	.xf-formSectionHeader();

	.m-clearFix();
	.m-hiddenLinks();

	.block-desc
	{
		.m-textColoredLinks();
	}

	.block-container > &:first-child,
	.block-body--collapsible &:first-child,
	.block-header + &
	{
		border-top: none;
	}

	.block-formSectionHeader-aligner
	{
		@_blockPaddingShift: (unit(@xf-formLabelWidth) / 100) * (@xf-blockPaddingH);

		display: inline-block;
		text-align: right;
		min-width: @xf-formLabelWidth;
		min-width: ~"calc((@{xf-formLabelWidth}) - (@{_blockPaddingShift}) - (@{xf-formRowPaddingHInner}) - (@{xf-borderSize}))";
		max-width: 100%;

		@media (max-width: @xf-formResponsive)
		{
			display: inline;
			text-align: left;
			min-width: 0;
			padding-left: 0;
		}
	}

	@media (max-width: @xf-formResponsive)
	{
		padding-left: @xf-formRowPaddingHOuter;
	}

	.block-formSectionHeader-multiChecker
	{
		float: right;
	}

	&--small
	{
		font-size: @xf-fontSizeNormal;
	}
}

.block-tooltip
{
	display: none;
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	text-transform: none;
}

.block-desc,
.blocks-desc
{
	display: block;
	font-size: @xf-fontSizeSmaller;
	font-weight: @xf-fontWeightNormal;
	
	.block-tooltip &
	{
		.xf-tooltip();

		&:before
		{
			display: inline-block;
			content: "";
			position: absolute;
			top: 50%;
			right: 100%;
			border: 5px solid transparent;
			border-left-width: 0;
			border-right-color: @xf-tooltip--background-color;
			transform: translateY(-50%);
		}
	}
}

.block-control
{
	position: absolute;
	top: ~"calc(50%)";
	right: @xf-blockPaddingH * 1.5;
	transform: translateY(-50%);
	cursor: pointer;
	line-height: 0;
	
	i:after
	{
		.m-faBase();
	}
	
	&.block-control--collapse i:after
	{
		.m-faContent(@fa-var-angle-up);
	}
	
	.active &
	{
		&.block-control--collapse i:after
		{
			.m-faContent(@fa-var-angle-down);
		}
	}
	
	&.block-control--sideBar
	{
		i:after
		{
			.m-faContent(@fa-var-sliders);
		}
		
		@media (max-width: @xf-responsiveWide)
		{
			display: none;
		}
	}
}

.block-body
{
	.m-listPlain();
	.m-clearFix();

	&.block-body--collapsible
	{
		.has-no-js & { display: block; }

		.m-transitionFadeDown();
	}

	&.block-body--contained
	{
		overflow: auto;
		max-height: 300px;
		max-height: 70vh;
	}
}

.block-row
{
	margin: 0;
	padding: @xf-blockPaddingV @xf-blockPaddingH;
	.m-clearFix();

	&.block-row--alt
	{
		.xf-contentAltBase();
	}

	&.block-row--minor
	{
		font-size: @xf-fontSizeSmall;
	}

	&.block-row--separated
	{
		padding-top: (@xf-blockPaddingV) * 2;
		padding-bottom: (@xf-blockPaddingV) * 2;

		+ .block-row
		{
			border-top: @xf-borderSize solid @xf-borderColorLight;
		}
	}

	&.block-row--connectAbove
	{
		padding-bottom: (@xf-blockPaddingV) * 2;

		.block-body > &:last-child
		{
			padding-bottom: @xf-blockPaddingV;
		}
	}

	&.block-row--highlighted
	{
		.xf-contentHighlightBase();
	}

	&.block-row--clickable:hover
	{
		.xf-contentHighlightBase();
	}

	&.is-mod-selected
	{
		background: @xf-inlineModHighlightColor;
	}

	> pre
	{
		&:first-child { margin-top: 0; }
		&:last-child { margin-bottom: 0; }
	}
}

.block-separator
{
	margin: 0;
	padding: 0;
	border: none;
	border-top: @xf-borderSize solid @xf-borderColorLight;
}

.block-footer
{
	padding: @xf-blockPaddingV @xf-blockPaddingH;
	.xf-blockFooter();
	.m-clearFix();

	&:first-child
	{
		border: none;
	}

	[data-app=admin] &
	{
		.block-footer-counter,
		.block-footer-select
		{
			line-height: 30px;
		}
	}

	&:not(.block-footer--split)
	{
		.block-footer-counter
		{
			float: left;
		}

		.block-footer-controls
		{
			float: right;
		}
	}

	&.block-footer--split
	{
		display: flex;
		align-items: center;

		.block-footer-main,
		.block-footer-counter
		{
			flex-grow: 1;
		}

		.block-footer-select:not(:last-child)
		{
			margin: 0 1em;
		}

		.block-footer-opposite,
		.block-footer-controls
		{
			margin-left: auto;
		}
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.block-outer
	{
		text-align: center;
	}

	.block-outer-main,
	.block-outer-opposite
	{
		float: none;
		text-align: center;
	}

	.block-outer-main + .block-outer-opposite
	{
		/// margin-top: @xf-paddingMedium;
	}
}';
	return $__finalCompiled;
});