<?php
// FROM HASH: ffeb6b27d2e93c7305ffa64d9b60353b
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.shareButtons
{
	.m-clearFix();
}

.shareButtons-buttons
{
	.shareButtons--iconic &
	{
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(35px, 1fr));
	}
}

.shareButtons-label
{
	float: left;
	margin-right: 3px;
	color: @xf-textColorMuted;
	min-height: 35px;
	line-height: 35px;
}

.shareButtons-button
{
	float: left;
	margin-right: 3px;
	padding: 6px;
	color: @xf-textColorMuted;
	font-size: 20px;
	line-height: 20px;
	white-space: nowrap;
	min-width: 35px;
	border-radius: @xf-borderRadiusSmall;
	background-color: transparent;
	.m-transition();

	&:last-of-type
	{
		margin-right: 0;
	}

	&:hover
	{
		text-decoration: none;
		color: white;
	}

	> i
	{
		display: inline-block;
		vertical-align: middle;

		.m-faBase(\'Pro\');
	}

	&.shareButtons-button--brand
	{
		> i
		{
			.m-faBase(\'Brands\');
		}
	}

	> span
	{
		font-weight: @xf-fontWeightNormal;
		font-size: @xf-fontSizeNormal;
	}

	.shareButtons--iconic &
	{
		text-align: center;

		> i
		{
			min-width: 20px;
		}

		> span
		{
			.m-visuallyHidden();
		}
	}

	&.shareButtons-button--facebook
	{
		&:hover { background-color: #3B5998; }
		> i:before { .m-faContent(@fa-var-facebook-f); }
	}

	&.shareButtons-button--twitter
	{
		&:hover { background-color: #1DA1F3; }
		> i:before { .m-faContent(@fa-var-twitter); }
	}
	
	&.shareButtons-button--youtube
	{
		&:hover { background-color: #FF0000; }
		> i:before { .m-faContent(@fa-var-youtube); }
	}
	
	&.shareButtons-button--linkedin
	{
		&:hover { background-color: #0077B5; }
		> i:before { .m-faContent(@fa-var-linkedin); }
	}
	
	&.shareButtons-button--vimeo
	{
		&:hover { background-color: #162221; }
		> i:before { .m-faContent(@fa-var-vimeo); }
	}
	
	&.shareButtons-button--steam
	{
		&:hover { background-color: #000000; }
		> i:before { .m-faContent(@fa-var-steam); }
	}

	&.shareButtons-button--pinterest
	{
		&:hover { background-color: #bd081c; }
		> i:before { .m-faContent(@fa-var-pinterest-p); }
	}
	
	&.shareButtons-button--twitch
	{
		&:hover { background-color: #B9A3E3; }
		> i:before { .m-faContent(@fa-var-twitch); }
	}
	
	&.shareButtons-button--vk
	{
		&:hover { background-color: #6441A5; }
		> i:before { .m-faContent(@fa-var-vk); }
	}

	&.shareButtons-button--tumblr
	{
		&:hover { background-color: #35465C; }
		> i:before { .m-faContent(@fa-var-tumblr); }
	}
	
	&.shareButtons-button--instagram
	{
		&:hover { background-color: #405DE6; }
		> i:before { .m-faContent(@fa-var-instagram); }
	}

	&.shareButtons-button--reddit
	{
		&:hover { background-color: #FF4500; }
		> i:before { .m-faContent(@fa-var-reddit-alien); }
	}
	
	&.shareButtons-button--github
	{
		&:hover { background-color: #4078C0; }
		> i:before { .m-faContent(@fa-var-github); }
	}

	&.shareButtons-button--whatsApp
	{
		&:hover { background-color: #25D366; }
		> i:before { .m-faContent(@fa-var-whatsapp); }
	}

	&.shareButtons-button--email
	{
		&:hover { background-color: #1289ff; }
		> i:before { .m-faContent(@fa-var-envelope); }
	}
	
	&.shareButtons-button--rss
	{
		&:hover { background-color: #F26522; }
		> i:before { .m-faContent(@fa-var-rss); }
	}
	
	&.shareButtons-button--instagram
	{
		&:hover { background-color: #405DE6; }
		> i:before { .m-faContent(@fa-var-instagram); }
	}

	&.shareButtons-button--link
	{
		cursor: pointer;
		&:hover { background-color: #787878; }
		> i:before { .m-faContent(@fa-var-link); }
	}

	&.is-hidden
	{
		display: none;
	}
}

.shareInput
{
	margin-bottom: 5px;

	&:last-child
	{
		margin-bottom: 0;
	}
}

.shareInput-label
{
	font-size: @xf-fontSizeSmall;
	.m-appendColon();
}

.shareInput-button
{
	color: @xf-linkColor;
	cursor: pointer;

	> i
	{
		display: inline-block;
		vertical-align: middle;
		.m-faBase();

		&:before { .m-faContent(@fa-var-copy); }
	}

	&.is-hidden
	{
		display: none;
	}
}

.shareInput-input
{
	font-size: @xf-fontSizeSmall;

	.m-inputZoomFix();

	.shareInput-button.is-hidden + &
	{
		border-radius: @xf-borderRadiusMedium;
	}
}';
	return $__finalCompiled;
});