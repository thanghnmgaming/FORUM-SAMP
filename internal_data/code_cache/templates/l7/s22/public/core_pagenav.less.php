<?php
// FROM HASH: fe5d7c2944765214062b69317448cab4
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ####################################### PAGE NAVIGATION ########################

@_page-paddingV: 0;
@_page-paddingH: 5px;
@_page-paddingHSimple: 10px;
@_pageWidth: 24px;
@_pageHeight: 24px;
@_page-marginH: 10px;

.pageNavWrapper
{
	padding: 6px 5px;
}

.pageNav
{
	display: flex;
}

.m-pageNavElCore()
{
	background: transparent;
	color: @xf-paletteColor2;
	/// .xf-blockBorder();
	/// font-size: @xf-fontSizeSmall;
	white-space: nowrap;

	&:hover,
	&:active
	{
		color: @xf-paletteNeutral1;
		background: @xf-paletteAccent3;
		text-decoration: none;
	}
}

.pageNav-jump
{
	display: inline-block;
	.m-pageNavElCore();
	border-radius: @xf-borderRadiusSmall;
	padding: @_page-paddingV @_page-paddingH;

	line-height: @_pageHeight;

	&.pageNav-jump--prev
	{
		margin-right: @_page-marginH/2;
	}
	
	&.pageNav-jump--next
	{
		margin-left: @_page-marginH/2;
	}
	
	&.pageNav-jump--prev:before,
	&.pageNav-jump--next:after
	{
		.m-faBase(\'Pro\', @faWeight-solid);
		font-size: 80%;
		unicode-bidi: isolate; // maintain position in RTL with LTR text
	}

	&.pageNav-jump--prev:before
	{
		/// .m-faContent("@{fa-var-caret-left}\\00a0", .61em, ltr);
		/// .m-faContent("@{fa-var-caret-right}\\00a0", .61em, rtl);
	}

	&.pageNav-jump--next:after
	{
		/// .m-faContent("\\00a0@{fa-var-caret-right}", .61em, ltr);
		/// .m-faContent("\\00a0@{fa-var-caret-left}", .61em, rtl);
	}
}

.pageNav-main
{
	.m-listPlain();
	display: inline-table;
}

.pageNav-page
{
	display: inline-block;
	.m-pageNavElCore();
	
	float: left;
	margin: 0 @_page-marginH/2;
	border-radius: @xf-borderRadiusSmall;

	&:not(:last-child)
	{
		border-right: none;
	}

	&:not(:first-child)
	{
		border-left-color: @xf-borderColorLight;
	}

	&:first-child
	{
		/// .m-borderLeftRadius(@xf-borderRadiusSmall);
		margin-left: 0;
	}

	&:last-child
	{
		/// .m-borderRightRadius(@xf-borderRadiusSmall);
		margin-right: 0;
	}

	> a
	{
		display: block;
		/// padding: @_page-paddingV @_page-paddingH;
		text-decoration: none;
		color: inherit;
		
		width: @_pageWidth;
		line-height: @_pageHeight;
		text-align: center;
	}

	&.pageNav-page--current
	{
		background: @xf-paletteAccent3;
		color: @xf-paletteNeutral1;

		/// border: @xf-borderSize solid @xf-borderColorAccentContent;
		cursor: pointer;

		&:hover,
		&:active
		{
			/// background: @xf-paletteColor3;
		}

		+ .pageNav-page
		{
			border-left: none;
		}
	}
}

// Hide relative page numbers on narrow devices when we have a skip entry as we don\'t necessarily have space.
@media (max-width: @xf-responsiveNarrow)
{
	.pageNav--skipStart
	{
		.pageNav-page.pageNav-page--earlier
		{
			display: none;
		}
	}

	.pageNav--skipEnd
	{
		.pageNav-page.pageNav-page--later
		{
			display: none;
		}

		.pageNav-page.pageNav-page--skipEnd
		{
			border-left: none;
		}
	}
}

// ########################### SIMPLE PAGE NAV VARIANT ########################

.pageNavSimple
{
	display: inline-flex;
}

.pageNavSimple-el
{
	display: inline-block;
	.xf-blockBorder();
	border-radius: @xf-borderRadiusSmall;
	padding: @_page-paddingV @_page-paddingHSimple;
	font-size: @xf-fontSizeSmall;
	text-align: center;
	white-space: nowrap;
	margin-right: 4px;
	
	line-height: @_pageHeight;

	&:last-child
	{
		margin-right: 0;
	}

	&.pageNavSimple-el--current
	{
		.xf-contentAccentBase();

		&:hover,
		&:active
		{
			background: xf-intensify(@xf-contentAccentBg, 3%);
			text-decoration: none;
		}
	}

	&.pageNavSimple-el--prev,
	&.pageNavSimple-el--next
	{
		background: @xf-paletteColor5;
		color: @xf-linkColor;
		min-width: 75px;

		@media (max-width: 350px)
		{
			min-width: 0;
		}

		&:hover,
		&:active
		{
			background: xf-intensify(@xf-contentHighlightBg, 3%);
			text-decoration: none;
		}

		i:before
		{
			.m-faBase(\'Pro\', @faWeight-solid);
		}
	}

	&.pageNavSimple-el--prev i:before
	{
		.m-faContent(@fa-var-caret-left, .44em, ltr);
		.m-faContent(@fa-var-caret-right, .44em, rtl);
	}

	&.pageNavSimple-el--next i:before
	{
		.m-faContent(@fa-var-caret-right, .44em, ltr);
		.m-faContent(@fa-var-caret-left, .44em, rtl);
	}

	&.pageNavSimple-el--first,
	&.pageNavSimple-el--last
	{
		border-color: transparent;
		padding-left: (@_page-paddingHSimple / 2);
		padding-right: (@_page-paddingHSimple / 2);
		color: fade(@xf-linkColor, 60%);

		&:hover,
		&:active
		{
			.xf-blockBorder();
			background: xf-intensify(@xf-contentHighlightBg, 3%);
			color: @xf-linkColor;
			text-decoration: none;
		}

		i:before
		{
			.m-faBase(\'Pro\', @faWeight-solid);
		}
	}

	&.pageNavSimple-el--first i:before
	{
		.m-faContent(@fa-var-backward, 1em, ltr);
		.m-faContent(@fa-var-forward, 1em, rtl);
	}

	&.pageNavSimple-el--last i:before
	{
		.m-faContent(@fa-var-forward, 1em, ltr);
		.m-faContent(@fa-var-backward, 1em, rtl);
	}

	&.is-disabled
	{
		border-color: transparent;
		background: none;
		color: @xf-textColorMuted;
		text-decoration: none;
		pointer-events: none;

		&:hover
		{
			background: none;
			color: @xf-textColorMuted;
		}
	}
}

// #################### DISPLAY VARIANTS #########################

.pageNavWrapper--simple
{
	.pageNav
	{
		display: none;
	}
}

.pageNavWrapper--full
{
	.pageNavSimple
	{
		display: none;
	}
}

.pageNavWrapper--mixed
{
	.pageNavSimple
	{
		display: none;
	}

	@media (max-width: @xf-responsiveMedium)
	{
		.pageNav
		{
			display: none;
		}

		.pageNavSimple
		{
			display: inline-flex;
		}
	}
}

// Hide any block page nav that goes before the block as we will be wasting vertical space.
@media (max-width: @xf-responsiveNarrow)
{
	.block-outer:not(.block-outer--after) .pageNavWrapper:not(.pageNavWrapper--forceShow)
	{
		display: none;
	}

	// this is a sanity check in case .block-outer--after is forgotten
	.block-container + .block-outer .pageNavWrapper
	{
		display: block;
	}
}';
	return $__finalCompiled;
});