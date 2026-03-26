<?php
// FROM HASH: a536c830bbf8e9b184febb97a58a2139
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*
	----------------
	
	XENTR.NET STYLES
	
	----------------
*/

/*

	Links Hover
	Node title links hover
	Bubble Animations
	Sub forums Links Hover
	Navigations Hover Effect
	Breadcrumbs
	Breadcrumbs Share Buttons
	Visitor Menu Icons
	Sidebar Menu Icons
	Notable Members Page Icons
	Account Page Sidenav Icons
	Shape Styles

*/

// ################################# LINKS HOVER #####################

';
	if ($__templater->func('property', array('xtr_links_hover_effect', ), false)) {
		$__finalCompiled .= '
.block-header a:before,
.block-minorHeader a:before,
.xentr_stats_text a:before {
    right: 3px;
    content: \'[\';
    -webkit-transform: translateX(20px);
    -moz-transform: translateX(20px);
    transform: translateX(20px);
    color: inherit;
}

.block-header a:after,
.block-minorHeader a:after,
.xentr_stats_text a:after{
    left: 3px;
    content: \']\';
    -webkit-transform: translateX(-20px);
    -moz-transform: translateX(-20px);
    transform: translateX(-20px);
    color: inherit;
}

.block-header a:before,
.block-header a:after,
.block-minorHeader a:before,
.block-minorHeader a:after,
.xentr_stats_text a:before,
.xentr_stats_text a:after {
    margin: 0 -2px;
    display: inline-block;
    opacity: 0;
    position: relative;
    -webkit-transition: -webkit-transform .3s, opacity .2s;
    -moz-transition: -moz-transform .3s, opacity .2s;
    transition: transform .3s, opacity .2s;
    color: inherit;
}

.block-header a:hover:before,
.block-header a:hover:after,
.block-minorHeader a:hover:before,
.block-minorHeader a:hover:after,
.xentr_stats_text a:hover:before,
.xentr_stats_text a:hover:after {
    opacity: 1;
    -webkit-transform: translateX(0px);
    -moz-transform: translateX(0px);
    transform: translateX(0px);
    color: currentColor;
    color: inherit;
}

// Node title links hover
.node-title {
	>a {
		position: relative;
		color: @xf-xtr_secondary_color;
		&:hover {
			color: @xf-linkHoverColor;
			text-decoration: none;
			&:after {
				width: 100%;
				left: 0;
			}
		}
		&:after {
			content: "";
			width: 0;
			height: 1px;
			background: currentColor;
			position: absolute;
			left: 50%;
			bottom: 1px;
			transition: all 0.4s;
		}
	}
}

// Sub forums Links Hover
.node-subNodeFlatList {
	>li {
		a {
			position: relative;
			color: @xf-xtr_secondary_color;
			&:hover {
				color: @xf-linkHoverColor;
				text-decoration: none;
				&:after {
					width: 100%;
					left: 0;
				}
			}
			&:after {
				content: "";
				width: 0;
				height: 1px;
				background: currentColor;
				position: absolute;
				left: 50%;
				bottom: 1px;
				transition: all 0.4s;
			}
		}
	}
}
';
	}
	$__finalCompiled .= '

// ################################# NAVIGATION ICONS #####################
// NAVIGATION HOME ICON
';
	if ($__templater->func('property', array('showNavHomeIcon', ), false)) {
		$__finalCompiled .= '
.p-navEl a[data-nav-id=\'home\']:before 
{
	.m-faBase();
	content: "\\f015";
	text-indent: 0;
	position: absolute;
	left: 50%;
	width: 20px;
	text-align: center;
	margin-left: -10px;
	font-size: @xf-fontSizeLarge;
}
[data-nav-id=\'home\'].p-navEl-link 
{
	.xf-homeLinkIcon();
}
@media (max-width: @xf-responsiveWide)
{
	[data-nav-id=\'home\'].p-navEl-link:before {
		text-indent: inherit;
	}		
}
// NAVIGATION HOME ICON BACKGROUND
.p-navEl
{
	[data-nav-id="home"] {
	background: @xf-homeLink;
	color: @xf-homeLinkColor--color;

		+ .p-navEl-splitTrigger
		{
			background: @xf-homeLink;
		}
	}
	&:hover
	{
	[data-nav-id="home"]{
	background: @xf-homeLinkHover !important;
		+ .p-navEl-splitTrigger
			  {
				 background: @xf-homeLinkHover !important;
			}
		}
	}
}
';
	}
	$__finalCompiled .= '

// Navigations Hover Effect
';
	if ($__templater->func('property', array('xtr_button_hover_effect', ), false)) {
		$__finalCompiled .= '
.button {
	position: relative;
	overflow: hidden;
	&:after {
		content: \'\';
		position: absolute;
		display: inline-block;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 1;
		transition: all 0.5s;
		opacity: 1;
		-webkit-transform: translate(-105%, 0);
		transform: translate(-105%, 0);
		border-right-width: @xf-borderSize;
		border-right-style: solid;
		border-right-color: @xf-borderColorFaint;
		background-color: rgba(255, 255, 255, 0.25);
	}
	&:hover {
		&:after {
			opacity: 0;
			-webkit-transform: translate(0, 0);
			transform: translate(0, 0);
		}
	}
}
';
	}
	$__finalCompiled .= '

// ################################# BREADCRUMB #####################
// Breadcrumb
.breadcrumb-content {
    display: flex;
    @media (max-width: @xf-responsiveMedium) {
        flex-direction: column;
        align-items: center;
    }  
	
    .p-breadcrumbs{
        flex: 1 1 auto;
        width: 100%;
    }
	.block-minorHeader {
    	display: none;
	}
	.block {
    	display: none;
	}
}

.breadcrumb-content .shareButtons {
    background-color: @xf-xtr_breadcrumb--background-color;
    border-radius: 3px;
	border: @xf-borderSize solid @xf-borderColor;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex: 0 0 auto;
    margin-left: @xf-paddingSmall;
    margin-bottom: 10px;
    padding: 0;
    list-style: none;
    text-align: center;
    text-shadow: rgba(0, 0, 0, 0.3) 0px -1px 0px;
}

';
	if ($__templater->func('property', array('xtr_breadcrumbBottomSocialShare', ), false)) {
		$__finalCompiled .= '
.breadcrumb-content.bottom .shareButtons {
    display: none;
}
';
	} else {
		$__finalCompiled .= '
.breadcrumb-content.bottom .shareButtons {
	margin-top: @xf-elementSpacer;
    margin-bottom: 0;
}
';
	}
	$__finalCompiled .= '

.p-breadcrumbs {
	.xf-xtr_breadcrumb();
	overflow: hidden;
	line-height: ' . $__templater->func('property', array('xtr_breadcrumbHeight', ), true) . 'px;
	margin-bottom: 10px;
	position: relative;
	z-index: 0;	

	&::before {
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		border: @xf-borderSize solid @xf-xtr_breadcrumb--border-color;
		border-radius: inherit;
		pointer-events: none;
		z-index: 2;
	}

	> li {
		margin: 0;
		font-size: inherit;
		padding-left: 15px;
            
		&:first-child {
			border-top-left-radius: inherit;
			border-bottom-left-radius: inherit;
			span {
				&:before {
					.m-faBase();
					text-rendering: auto;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
					content: "\\f015";
					padding-right: 5px;
				}
			}
		}

		&::before,
		&::after{
			display: none;
		}

		a{
			padding: 0 15px;
			position: relative;
			z-index: 1;
			display: block;
			overflow: visible;
			max-width: none;
			text-decoration: none;
			color: inherit;
			margin-left: -15px;
               
			&:hover{
				color: xf-default(@xf-xtr_breadcrumbHover--color, inherit);
			}

			&::before,
			&::after {
				border-style: solid;
				border-width: 0;
				border-right-width: 1px;
				border-color: @xf-xtr_breadcrumbBorder--border-color;
				color: rgba(255, 255, 255, 0.38);
				box-shadow: inset currentColor -1px 0px 0px 0px;
				content: \'\';
				position: absolute;
				height: 50%;
				width: 100%;
				right: 0;
				z-index: -1;
				box-sizing: border-box;
				transform-origin: 100% 50%;
			}

			html[dir=\'rtl\'] &:before,
			html[dir=\'rtl\'] &:after{
				box-shadow: inset currentColor 1px 0px 0px 0px;
			}

			&::before {
				top: 0;
				transform: skewX(35deg);
			}

			&::after {
				top: 50%;
				transform: skewX(-35deg);
			}

			html[dir=\'rtl\'] &:before{
				transform: skewX(-35deg);
			}
			    
			html[dir=\'rtl\'] &:after{
				transform: skewX(35deg);
			}

			/* Hover */
			&:hover::before,
			&:hover::after {
				background: @xf-xtr_breadcrumbHover--background-color;
			}

			/* Active */
			&:active::before,
			&:active::after{
				background-color: fade(@xf-xtr_breadcrumbHover--color, 3%);
				color: rgba(0,0,0,0.05);
				box-shadow: inset currentColor -2px 1px 1px;
			}

			&:active::after{
				box-shadow: inset currentColor -2px -1px 1px;
			}

            }

		&:first-of-type a::before,
		&:first-of-type a::after {
			width: ~"calc(100% + 20px)";
		}
	}
}

@media (max-width: @xf-responsiveNarrow) {
		.p-breadcrumbs {
			& > li a {
				padding: 0 22px;

				&::before,
				&::after {
				transform: skewX(-30deg);
				width: ~"calc(100% + 20px)";
			}
				&::after {
					transform: skewX(30deg);
			}
		}
	}
}

// ######################################### ICONS #################################

// Visitor Menu Icons
';
	if ($__templater->func('property', array('xtr_visitor_menu_icon', ), false)) {
		$__finalCompiled .= '
.menu-content.js-visitorMenuBody a.menu-linkRow {
    &:before {
        .m-faBase();
        padding-right: 5px;
    }
    &[href*="whats-new/news-feed"]:before {
        .m-faContent(@fa-var-rss);
    }
    &[href*="search/member"]:before {
        .m-faContent(@fa-var-comments);
    }
    &[href*="account/reactions"]:before {
        .m-faContent(@fa-var-thumbs-up);
    }
    &[href*="account/alerts"]:before {
        .m-faContent(@fa-var-bell);
    }
    &[href*="account/account-details"]:before {
        .m-faContent(@fa-var-user-cog);
    }
    &[href*="account/security"]:before {
        .m-faContent(@fa-var-shield-alt);
    }
    &[href*="account/privacy"]:before {
        .m-faContent(@fa-var-lock);
    }
    &[href*="account/preferences"]:before {
        .m-faContent(@fa-var-cogs);
    }
    &[href*="account/signature"]:before {
        .m-faContent(@fa-var-signature);
    }
    &[href*="account/upgrades"]:before {
        .m-faBase(\'Brands\');
        .m-faContent(@fa-var-paypal);
    }
    &[href*="account/connected-accounts"]:before {
        .m-faContent(@fa-var-users-class);
    }
    &[href*="account/following"]:before {
        .m-faContent(@fa-var-user-plus);
    }
    &[href*="account/ignored"]:before {
        .m-faContent(@fa-var-user-minus);
    }
    &[href*="logout"]:before {
        .m-faContent(@fa-var-sign-out);
    }
	&[href*="/xenforo-license"]:before {
		.m-faContent(@fa-var-copyright);
	}
	&[href*="/members/banned"]:before {
		.m-faContent(@fa-var-ban);
	}
	&[href*="/conversation-view"]:before {
		.m-faContent(@fa-var-eye);
	}
}
';
	}
	$__finalCompiled .= '

/*** Highlight new menu item ***/
.menu-row.menu-row--separated.menu-row--clickable.menu-row--highlighted {
    &:before {
        .m-faBase();
        .m-faContent(@fa-var-dot-circle);
        float: right;
        color: @xf-paletteAccent2;
    }
    &:hover:before {
        .m-faBase(\'Pro\', @faWeight-solid);
        .m-faContent(@fa-var-dot-circle);
    }
}
/**********/

// Sidebar Menu Icons
';
	if ($__templater->func('property', array('xtr_sidebar_icons', ), false)) {
		$__finalCompiled .= '
	.block[data-widget-id],
	.p-body-sideNav {
		.block-minorHeader,
		.block-header
		{
			display: flex;
			align-items: center;
		}
	}
	.block[data-widget-id] .block-minorHeader:before,
	.block[data-widget-section] .block-minorHeader:before,
	[data-template="member_notable"] .p-body-sideNav .block-header:before,
	.xtr-extra-footer .xtr-extra-footer-row .xtr-aboutUs h3 i:before,
	.xtr-extra-footer .xtr-extra-footer-row .xtr-user-navigation h3 i:before,
	.xtr-extra-footer .xtr-extra-footer-row .xtr-navigation h3 i:before {
		.m-faBase();
		font-size: @xf-fontSizeLarge !important;
		padding-right: @xf-paddingMedium;
		color: inherit;
	}

	[data-template="member_notable"] .p-body-sideNav .block-header:before {content:"\\f0c0";}
	.block[data-widget-section="staffMembers"] .block-minorHeader:before {content: "\\f21b" !important;}	
	.block[data-widget-definition="members_online"] .block-minorHeader:before {content: "\\f0c0";}
	.block[data-widget-definition="board_totals"] .block-minorHeader:before,
	.block[data-widget-definition="forum_statistics"] .block-minorHeader:before {content: "\\f201";}
	.block[data-widget-definition="online_statistics"] .block-minorHeader:before {content: "\\f080";}
	.block[data-widget-definition="share_page"] .block-minorHeader:before {content: "\\f1e0";}
	.block[data-widget-definition="most_messages"] .block-minorHeader:before {content: "\\f086";}
	.block[data-widget-definition="find_member"] .block-minorHeader:before {content: "\\f4fc";}
	.block[data-widget-definition="new_threads"] .block-minorHeader:before,
	.block[data-widget-definition="new_profile_posts"] .block-minorHeader:before,
	.block[data-widget-definition="new_posts"] .block-minorHeader:before{content: "\\f0e7";}
	.block[data-widget-definition="birthdays"] .block-minorHeader:before{content: "\\f1fd";}
	form[data-xf-init*="poll-block"] .block-minorHeader:before {content: "\\f0e6";}
	.block[data-widget-definition="xfrm_new_resources"] .block-minorHeader:before{content: "\\f0ed";}
	.block[data-widget-definition="newest_members"] .block-minorHeader:before {content:"\\f234";}
';
	}
	$__finalCompiled .= '

// Icons on Notable members page
';
	if ($__templater->func('property', array('xtr_notable_member_page_icons', ), false)) {
		$__finalCompiled .= '
[data-template="member_notable"] .p-body-sideNavContent a.blockLink,
&[data-template="member_notable"] h3.block-textHeader a {
    &:before {
        .m-faBase();
        padding-right: 5px;
    }
    &[href*="members/"]:before {
        .m-faContent(@fa-var-ellipsis-h-alt);
    }
    &[href*="key=most_messages"]:before {
        .m-faContent(@fa-var-comments);
    }
    &[href*="key=highest_reaction_score"]:before {
        .m-faContent(@fa-var-thumbs-up);
    }
    &[href*="key=most_points"]:before {
        .m-faContent(@fa-var-dot-circle);
    }
    &[href*="key=xfrm_most_resources"]:before {
        .m-faContent(@fa-var-cog);
    }
    &[href*="key=xfmg_most_media_items"]:before {
        .m-faContent(@fa-var-images);
    }
    &[href*="key=xfmg_most_albums"]:before {
        .m-faContent(@fa-var-image);
    }
    &[href*="key=todays_birthdays"]:before {
        .m-faContent(@fa-var-gift);
    }
    &[href*="key=staff_members"]:before {
        .m-faContent(@fa-var-user-tie);
    }
}
';
	}
	$__finalCompiled .= '

// Account Page Sidenav Icons
';
	if ($__templater->func('property', array('xtr_account_page_icons', ), false)) {
		$__finalCompiled .= '
[data-template="account_alerts"], &[data-template="account_reactions"], &[data-template="account_bookmarks"],
&[data-template="account_details"], &[data-template="account_security"], &[data-template="account_privacy"],
&[data-template="account_preferences"], &[data-template="account_signature"], &[data-template="account_upgrades"],
&[data-template="account_connected"], &[data-template="account_following"], &[data-template="account_ignored"] {
    .p-body-sideNavContent a.blockLink {
        &:before {
            .m-faBase();
            padding-right: 5px;
        }
        &[href*="members/"]:before {
            .m-faContent(@fa-var-user);
        }
        &[href*="account/alerts"]:before {
            .m-faContent(@fa-var-bell);
        }
        &[href*="account/reactions"]:before {
            .m-faContent(@fa-var-thumbs-up);
        }
        &[href*="account/bookmarks"]:before {
            .m-faContent(@fa-var-bookmark);
        }
        &[href*="account/account-details"]:before {
            .m-faContent(@fa-var-user-cog);
        }
        &[href*="account/security"]:before {
            .m-faContent(@fa-var-shield-alt);
        }
        &[href*="account/privacy"]:before {
            .m-faContent(@fa-var-lock);
        }
        &[href*="account/preferences"]:before {
            .m-faContent(@fa-var-cogs);
        }
        &[href*="account/signature"]:before {
            .m-faContent(@fa-var-signature);
        }
        &[href*="account/upgrades"]:before {
            .m-faBase(\'Brands\');
            .m-faContent(@fa-var-paypal);
        }
        &[href*="account/connected-accounts"]:before {
            .m-faContent(@fa-var-users-class);
        }
        &[href*="account/following"]:before {
            .m-faContent(@fa-var-user-plus);
        }
        &[href*="account/ignored"]:before {
            .m-faContent(@fa-var-user-minus);
        }
        &[href*="logout"]:before {
            .m-faContent(@fa-var-sign-out);
        }
    }
}
';
	}
	$__finalCompiled .= '

// ######################################### FOOTER ICONS #################################
';
	if ($__templater->func('property', array('xtr_footer_icons', ), false)) {
		$__finalCompiled .= '
.p-footer-linkList  a[href*="/support-tickets"]:before{ .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f3ff" }
.p-footer-linkList  a[href*="/misc/contact"]:before{ .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f0e0" }
.p-footer-linkList  a[href*="help/terms"]:before{.m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f071" !important;}
.p-footer-linkList  a[href*="/help/"]:before{ .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f059" }
.p-footer-linkList  a[href*="/help/privacy-policy/"]:before{  .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f21b" !important; }
.p-footer-linkList  a[href*="/index.php?misc/contact"]:before{ .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f0e0" }
.p-footer-linkList  a[href*="/index.php?help/terms"]:before{.m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f071" !important;}
.p-footer-linkList  a[href*="/index.php?help/"]:before{ .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f059" }
.p-footer-linkList  a[href*="/index.php?help/privacy-policy/"]:before{  .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f21b" !important; }
.p-footer-linkList .footer-home:before{  .m-faBase(); padding-right: 5px; color: @xf-publicFooterLink--color; content: "\\f015" !important; }

';
	}
	$__finalCompiled .= '

// Shape Styles
.xtr_shape {
	position: static;
	.shape1 {
		position: absolute;
		left: 0;
		top: 30%;
		z-index: -1;
		-webkit-animation: 5s linear infinite movebounce;
		animation: 5s linear infinite movebounce;
		opacity: .2;
	}
	.shape2 {
		position: absolute;
		z-index: -1;
		top: 60%;
		left: 2%;
	}
	.shape3 {
		position: absolute;
		left: 3%;
		bottom: 25%;
		z-index: -1;
		-webkit-animation: 15s linear infinite animationFramesOne;
		animation: 15s linear infinite animationFramesOne;
	}
	.shape4 {
		position: absolute;
		right: 50%;
		bottom: 20%;
		z-index: -1;
		-webkit-animation: 20s linear infinite animationFramesOne;
		animation: 20s linear infinite animationFramesOne;
	}
	.shape5 {
		position: absolute;
		right: 0;
		top: 60%;
		z-index: -1;
		-webkit-animation: 5s linear infinite movebounce;
		animation: 5s linear infinite movebounce;
		opacity: .2;
	}
	.shape6 {
		position: absolute;
		z-index: -1;
		top: 50%;
		right: 2%;
	}
	.shape7 {
		position: absolute;
		left: 2%;
		top: 17%;
		z-index: -1;
		-webkit-animation: 20s linear infinite animationFramesOne;
		animation: 20s linear infinite animationFramesOne;
	}
	.shape8 {
		position: absolute;
		z-index: -1;
		top: 20%;
		right: 2%;
	}
}
.p-pageWrapper {
	z-index: 1;
}

@-webkit-keyframes movebounce {
    0%,
    100% {
        transform: translateY(0)
    }
    50% {
        transform: translateY(20px)
    }
}

@keyframes movebounce {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(20px);
    }
}

@-webkit-keyframes moveleftbounce {
    0%,
    100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(20px);
    }
}

@keyframes moveleftbounce {
    0%,
    100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(20px);
    }
}

.rotateme {
    -webkit-animation-name: rotateme;
    animation-name: rotateme;
    -webkit-animation-duration: 20s;
    animation-duration: 20s;
    -webkit-animation-iteration-count: infinite;
    animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    animation-timing-function: linear;
}

@keyframes rotateme {
    from {
        transform: rotate(0);
    }
    to {
        transform: rotate(360deg);
    }
}

@-webkit-keyframes rotateme {
    from {
        -webkit-transform: rotate(0);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@-webkit-keyframes rotate3d {
    0% {
        transform: rotateY(0);
    }
    100% {
        transform: rotateY(360deg);
    }
}

@keyframes rotate3d {
    0% {
        transform: rotateY(0);
    }
    100% {
        transform: rotateY(360deg);
    }
}

@keyframes animationFramesOne {
    0%,
    100% {
        transform: translate(0, 0) rotate(0);
    }
    20% {
        transform: translate(73px, -1px) rotate(36deg);
    }
    40% {
        transform: translate(141px, 72px) rotate(72deg);
    }
    60% {
        transform: translate(83px, 122px) rotate(108deg);
    }
    80% {
        transform: translate(-40px, 72px) rotate(144deg);
    }
}

@-webkit-keyframes animationFramesOne {
    0%,
    100% {
        -webkit-transform: translate(0, 0) rotate(0);
    }
    20% {
        -webkit-transform: translate(73px, -1px) rotate(36deg);
    }
    40% {
        -webkit-transform: translate(141px, 72px) rotate(72deg);
    }
    60% {
        -webkit-transform: translate(83px, 122px) rotate(108deg);
    }
    80% {
        -webkit-transform: translate(-40px, 72px) rotate(144deg);
    }
}

// Style Fix

// Style changer exclusive fix
.p-staffBar-inner {
	.p-navgroup-link.link-changer {
		&:after {
			display: none;
		}
	}
}';
	return $__finalCompiled;
});