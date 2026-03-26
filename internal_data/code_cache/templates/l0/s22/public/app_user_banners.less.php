<?php
// FROM HASH: 6a830c5fb63d44c3a22c8f576e0e6846
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.m-userBannerVariation(@color; @bg; @border: false)
{
	color: @color;
	background: @bg;
	border-color: xf-intensify(@bg, 10%);

	& when (iscolor(@border))
	{
		border-color: @border;
	}
}

.userBanner
{
	font-size: @xf-fontSizeSmall;
	font-weight: @xf-fontWeightNormal;
	font-style: normal;
	padding: @xf-paddingMedium;
	border: @xf-borderSizeMinorFeature solid transparent;
	border-radius: 4px @xf-borderRadiusSmall;
	text-align: center;
	display: inline-block;

	strong
	{
		font-weight: inherit;
	}

	// variations
	&.userBanner--hidden
	{
		background: none;
		border: none;
		box-shadow: none;
	}

	&.userBanner--staff,
	&.userBanner--primary
	{
		.m-userBannerVariation(@xf-paletteAccent3, transparent, @xf-borderColor);
		
		@media ( max-width: @xf-messageSingleColumnWidth ) {
			border-color: @xf-contentBg;
		}
	}

	&.userBanner--accent
	{
		.m-userBannerVariation(@xf-textColorAccentContent, @xf-contentAccentBg, @xf-borderColorAccentContent);
	}

	&.userBanner--red { .m-userBannerVariation(white, #AA0000 ,black); }
	&.userBanner--green { .m-userBannerVariation(green, transparent, green); }
	&.userBanner--olive { .m-userBannerVariation(white, #242915, olive); }
	&.userBanner--lightGreen { .m-userBannerVariation(black, #bee8ba, #bee8ba); }
	&.userBanner--blue { .m-userBannerVariation(#0008e3, transparent, #0008e3); }
	&.userBanner--royalBlue { .m-userBannerVariation(white, #1D4667, #45A5F4); }
	&.userBanner--skyBlue { .m-userBannerVariation(#7cc3e0, transparent, #7cc3e0); }
	&.userBanner--gray { .m-userBannerVariation(gray, transparent, gray); }
	&.userBanner--silver { .m-userBannerVariation(silver, transparent, silver); }
	&.userBanner--yellow { .m-userBannerVariation(black, #e6e687, #e6e687); }
	&.userBanner--orange { .m-userBannerVariation(#ffcb00, transparent, #ffcb00); } 
	&.userBanner--fdsa { .m-userBannerVariation(white, #35141F, #FF6699); }
	&.userBanner--sanews { .m-userBannerVariation(white, #002E17, #00CC66); }
	&.userBanner--gamemaster { .m-userBannerVariation(white, #663300, #CC9933); }
	&.userBanner--traf { .m-userBannerVariation(white, #205745, #009966); }
	&.userBanner--vip { .m-userBannerVariation(black, #EEC900, #EEC900); }
}' . $__templater->includeTemplate('XGT_UserBanner.less', $__vars);
	return $__finalCompiled;
});