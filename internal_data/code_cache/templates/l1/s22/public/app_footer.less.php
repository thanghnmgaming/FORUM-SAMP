<?php
// FROM HASH: 67ffbf72758b85b768cf6c5e9ae3969a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.p-footer
{
	.xf-publicFooter();

	a
	{
		.xf-publicFooterLink();
	}
}

.p-footer-middle
{
	font-size: @xf-fontSizeSmaller;
}

.p-footer-inner
{
	.m-pageWidth();
	.m-pageInset();
	.m-clearFix();

	padding-top: @xf-paddingLarge;
	padding-bottom: @xf-paddingLarge;
	
	&:empty { display: none; }
}

.p-footer-custom
{
	justify-content: space-between;
	display: flex;
	flex-direction: column;
	flex-flow: row wrap;
	a { color: inherit; }
}

.footer-column
{
	margin-top: 35px;
	margin-bottom: 25px;
	
	&.footer-column-1
	{
		width: 360px;
	}
	
	&.footer-column-2,
	&.footer-column-3
	{
		width: 105px;
	}
	
	&.footer-column-4
	{
		width: 205px;
	}
}

.footer-header
{
	font-size: @xf-fontSizeNormal;
	font-weight: @xf-fontWeightNormal;
	text-transform: uppercase;
	color: rgb(77, 119, 207);
}

.footer-body
{
	font-weight: @xf-fontWeightLight;
	color: @xf-paletteColor2;
}

.social-link
{
	.m-clearFix();
	margin-top: 25px;
	margin-bottom: -5px;
	
	a
	{
		float: left;
		width: 32px;
		height: 32px;
		line-height: 32px;
		text-align: center;
		color: #fff;
		border-radius: 32px;
		margin-right: 10px;
		position: relative;
		margin-bottom: 5px;
		
		&:after
		{
			display: inline-block;
			content: "";
			width: 32px;
			height: 32px;
			position: absolute;
			top: 0;
			left: 0;
			border-radius: 32px;
			background: linear-gradient(135deg, transparent 0%, transparent 50%, rgba(0,0,0,0.1) 50%, rgba(0,0,0,0.1) 100%);
		}
	}
	
	.s-facebook{background-color: #507cbe;}
	.s-youtube{background-color: #f16261;}
	.s-vimeo{background-color: #87d3e0;}
	.s-google-plus{background-color: #4d4f54;}
	.s-flickr{background-color: #dc97c0;}
}

.extra-link,
.contact-link
{
	margin: 1em 0;
	
	li { margin-bottom: 6px; }
	
	i { margin-right: 15px; }
}

.p-footer-row
{
	.m-clearFix();

	/// margin-bottom: -@xf-paddingLarge;
	
	float: right;
}

.p-footer-row-main
{
	float: left;
	margin: 2px 0;
}

.p-footer-row-opposite
{
	float: right;
	margin: 2px 0;
}

.p-footer-linkList
{
	.m-listPlain();
	.m-clearFix();

	> li
	{
		float: left;
		margin-right: .5em;

		&:last-child
		{
			margin-right: 0;
		}

		a
		{
			padding: 2px 4px;
			border-radius: @xf-borderRadiusSmall;

			&:hover
			{
				text-decoration: none;
				background-color: fade(@xf-publicFooterLink--color, 10%);
			}
		}
	}
}

.p-footer-rssLink
{
	> span
	{
		position: relative;
		top: -1px;

		display: inline-block;
		width: 1.44em;
		height: 1.44em;
		line-height: 1.44em;
		text-align: center;
		font-size: .8em;
		background-color: #FFA500;
		border-radius: 2px;
	}

	.fa-rss
	{
		color: white;
	}
}

.p-footer-copyright
{
	margin: 2px 0;
	text-align: center;
	/// font-size: @xf-fontSizeSmallest;
	
	float: left;
}

.p-footer-debug
{
	/// margin-top: @xf-paddingLarge;
	text-align: right;
	font-size: @xf-fontSizeSmallest;

	.pairs > dt { color: inherit; }
}

@media (max-width: @xf-responsiveWide)
{
	.p-footer-row,
	.p-footer-copyright
	{
		float: none;
	}
	
	.p-footer-row
	{
		text-align: center;
	}
	
	.p-footer-row-main,
	.p-footer-row-opposite
	{
		float: none;
		display: inline-block;
	}
}

@media (max-width: @xf-responsiveMedium)
{
	.p-footer-copyright
	{
		/// text-align: left;
		padding: 0 4px; // aligns with other links
	}
}';
	return $__finalCompiled;
});