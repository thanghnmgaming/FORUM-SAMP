<?php
// FROM HASH: 371d8c4bd787826d52e1233af45353ea
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.p-breadcrumbs
{
	.m-listPlain();
	.m-clearFix();

	margin-bottom: ((@xf-elementSpacer) / 2);
	/// line-height: 1.5;
	
	position: relative;
	padding: 9px @xf-paddingLarge;
	color: @xf-paletteAccent2;
	border: @xf-borderSizeMinorFeature solid @xf-borderColorAttention;
	border-radius: @xf-borderRadiusSmall;
	background: fade(@xf-paletteColor4, 50%);

	&.p-breadcrumbs--bottom
	{
		margin-top: ((@xf-elementSpacer) / 2);
		margin-bottom: 0;
	}

	> li
	{
		float: left;
		margin-right: .75em;
		font-size: @xf-fontSizeSmall;

		a
		{
			display: inline-block;
			vertical-align: bottom;
			max-width: 300px;
			.m-overflowEllipsis();
			
			color: inherit;
		}

		&:after,
		&:before
		{
			.m-faBase();
			font-size: 90%;
			color: @xf-textColorMuted;
		}

		&:after
		{
			/// .m-faContent(@fa-var-angle-right, false, ltr);
			/// .m-faContent(@fa-var-angle-left, false, rtl);
			/// margin-left: .5em;
		}

		&:last-child
		{
			margin-right: 0;

			a
			{
				/// font-weight: @xf-fontWeightHeavy;
			}
		}
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.p-breadcrumbs > li a
	{
		max-width: 200px;
	}
}

@media (max-width: @xf-responsiveNarrow)
{
	.p-breadcrumbs
	{
		> li
		{
			display: none;
			font-size: @xf-fontSizeSmallest;

			&:last-child
			{
				display: block;
			}

			a
			{
				max-width: 90vw;
			}

			&:after
			{
				display: none;
			}

			&:before
			{
				/// .m-faContent(@fa-var-chevron-left, false, ltr);
				/// .m-faContent(@fa-var-chevron-right, false, rtl);
				/// margin-right: .5em;
			}
		}
	}
}';
	return $__finalCompiled;
});