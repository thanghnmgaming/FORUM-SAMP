<?php
// FROM HASH: 77fced3a8a341a5a4948456733579779
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*
	----------------
	
	XENTR.NET STYLES
	
	----------------
*/

/*

	Visitor tabs
	Header
	Logo Position
	Navigation
	Navigation and Canvas Menu Icons
	Navigations Hover Effect
	Forum Title
	Sidebar
	Messages
	Hide avatar reply editor
	Message Control Icons
	Message User Info Sticky
	Pagination

*/

// ######################################### VISITOR TABS #################################
// Visitor tabs staff
';
	if ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'staff') {
		$__finalCompiled .= '
.p-staffBar-inner
{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;	
    padding: 0;
	.hScroller-scroll.is-calculated
	{
		vertical-align: middle;
		margin-right: auto;
	}
	.p-navgroup-link {
		padding: @xf-paddingLarge;
		font-size: @xf-fontSizeNormal;
	}
	.badgeContainer {
		&:after {
			left: @xf-paddingSmall;
			top: @xf-paddingSmall;
		}
	}
	.avatar {
		vertical-align: text-top;
	}
}
@media (max-width: @xf-publicNavCollapseWidth) 
{
	
	.p-staffBar-inner .hScroller-scroll {
		display: flex;
		justify-content: space-between;
		width: 100%;
	}
}
';
	}
	$__finalCompiled .= '

// Staff bar height
.p-staffBar-link
{
	padding: @xf-paddingMedium;
}

';
	if (($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'default') OR ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'header')) {
		$__finalCompiled .= '
.p-staffBar-inner .hScroller-scroll {
	display: flex;
	justify-content: space-between;
}
';
	}
	$__finalCompiled .= '

// Visitor Tabs Default
';
	if ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) != 'default') {
		$__finalCompiled .= '
.p-nav .p-nav-opposite
{
	display: none;
}
@media (max-width: @xf-publicNavCollapseWidth)
{
	.p-nav-opposite
	{
		display: none;
	}
	.p-nav .p-nav-opposite
	{
		display: block;
	}
}
';
	}
	$__finalCompiled .= '

// ######################################### HEADER #################################
// LOGO POSITION

';
	if ((($__templater->func('property', array('xtr_logo_position', ), false) == 'default') OR ($__templater->func('property', array('xtr_logo_position', ), false) == 'belownav')) OR ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'default')) {
		$__finalCompiled .= '
.p-header-logo
{
    margin-left: auto;
}
';
	}
	$__finalCompiled .= '

';
	if (($__templater->func('property', array('xtr_logo_position', ), false) == 'default') OR ($__templater->func('property', array('xtr_logo_position', ), false) == 'belownav')) {
		$__finalCompiled .= '
.p-navgroup {
	border-radius: 0;
}
.p-navgroup.p-discovery {
    margin-left: 0;
	border-left: 1px solid @xf-publicHeaderAdjustColor;
}
.p-navgroup-link.bgPicker {
    display: none;
}
.p-nav-list .p-navEl {
    border-left: 1px solid rgba(255,255,255,0.1);
    border-right: 1px solid rgba(0,0,0,0.2);
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
}
.p-nav-list>li:last-child {
    border-right: 1px solid rgba(255,255,255,0.1);
}


@media (max-width: @xf-publicNavCollapseWidth)
{
	.p-nav-smallLogo {
		max-width: inherit;
	}
}	


';
	}
	$__finalCompiled .= '
// Inside Logo Style
.xtr-nav-logo {
	.p-nav-smallLogo {
		display: inline-block;
		vertical-align: middle;
		max-width: inherit;
		max-height: 200px;	
		img {
			display: block;
			
		}
	}
	.p-nav-list {	
		// Border radius
		.p-navEl.is-selected {
			border-radius: 0;
		}
		.p-navEl.is-menuOpen {
			border-radius: 0;
		}
	}
}

';
	if (($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') AND ($__templater->func('property', array('xtr_disable_subnav', ), false) == '0')) {
		$__finalCompiled .= '
.p-sectionLinks {
    position: absolute;
    width: 100%;
    left: 0;
    right: 0;
    z-index: 1;
    top: (@header-navHeight * 2 + @xf-publicSubNavPaddingV + @xf-publicSubNavPaddingH);
}
';
	}
	$__finalCompiled .= '

// Transparent Header and Navigation
';
	if (($__templater->func('property', array('xtr_message_block_enable', ), false) == '1') AND ($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav')) {
		$__finalCompiled .= '
.p-nav {
	position: relative;
	width: 100%;
	left: 0;
	right: 0;
	-webkit-transition: all .5s ease;
	transition: all .5s ease;
	z-index: 2;
	.p-navgroup {
		background: transparent;
	}
	.p-nav-list {
		.p-navEl.is-selected {
			background: transparent;
			color: inherit;
		}
	}
	.p-navgroup-link {
		border: none;
	}
}
.p-nav.xtr-nav-logo {
	background: transparent;
	border-bottom: @xf-borderSize solid rgba(255,255,255,0.1);
	overflow: hidden;
}
.p-navSticky.is-sticky {
		z-index: 400;
		box-shadow: 0 0 8px 3px rgba(0, 0, 0, 0.3);
		background-color: @xf-publicNav--background-color;
}

.p-navSticky--primary.is-sticky .p-nav-list .p-navEl.is-selected .p-navEl-splitTrigger:before {
    border-left: none;
}

.p-title .u-muted {
    color: inherit;
	font-weight: bold;
}

';
	}
	$__finalCompiled .= '

';
	if ($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') {
		$__finalCompiled .= '
// Navigation centered
.p-nav-scroller {
    margin-left: auto;
}
@media (max-width: @xf-responsiveWide) {
	.has-js .p-nav-scroller {
		display: none;
	}
	.has-js .p-nav .p-nav-menuTrigger {
    	display: inline-block;
	}
}
.p-body-decription {
    margin: 10px 0;
}
';
	}
	$__finalCompiled .= '

// Navigation menus right position
';
	if (($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') AND ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'staff')) {
		$__finalCompiled .= '
.p-nav-scroller {
    margin-left: auto;
    margin-right: 0;
}

.p-nav .p-nav-opposite
{
	display: none;
}
@media (max-width: @xf-responsiveWide)
{
	.p-staffBar-inner {
		display: block;
		padding: 0;
		.hScroller-scroll {
			display: flex;
			justify-content: space-between;
		}
	}
	
	.p-nav-opposite
	{
		display: none;
	}
	.p-nav .p-nav-opposite
	{
		display: block;
	}
}

';
	}
	$__finalCompiled .= '

';
	if (($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') AND ($__templater->func('property', array('xtr_visitor_tabs_position', ), false) == 'header')) {
		$__finalCompiled .= '
.p-nav .p-nav-opposite
{
	display: block;
}
';
	}
	$__finalCompiled .= '


// Guest Grup Login and Register Icons
.p-navgroup-linkText {
	display: none;
}
.p-navgroup-link.p-navgroup-link--logIn {
	i {
		&::after {
			.m-faContent(@fa-var-sign-in, 1em);
		}
	}
}
.p-navgroup-link.p-navgroup-link--register {
	i {
		&::after {
			.m-faContent(@fa-var-user-plus, 1em);
		}
	}
}
.p-navgroup-link.link--search {
	i {
		&::after {
			.m-faContent(@fa-var-search, 1em);
		}
	}
}
@media (max-width: @xf-publicNavCollapseWidth)
{
	.p-navgroup-user-linkText {
		display: none;
	}
}

// ######################################### NAVIGATION #################################
// Sub Navigations
';
	if ($__templater->func('property', array('xtr_disable_subnav', ), false)) {
		$__finalCompiled .= '
.p-nav-list .p-navEl.is-selected
{
	.p-navEl-splitTrigger
	{
		display: inline;
		position: relative;
	}
	.p-navEl-link.p-navEl-link--splitMenu
	{
		padding-right: (@xf-paddingMedium - 1);
	}
}
';
	}
	$__finalCompiled .= '

//Navigation and Canvas Menu Icons
';
	if ($__templater->func('property', array('xtr_navigation_icons', ), false)) {
		$__finalCompiled .= '
	a[data-nav-id="home"]:before { .m-faContent("\\f015"); }
	a[data-nav-id="forums"]:before { .m-faContent("\\f086"); }
	a[data-nav-id="members"]:before { .m-faContent("\\f0c0"); }
	a[data-nav-id="xfrm"]:before { .m-faContent("\\f019"); }
	a[data-nav-id="whatsNew"]:before { .m-faContent("\\f0e7"); }
	a[data-nav-id="mjstSupportTicket"]:before { .m-faContent("\\f3ff"); }
	a[data-nav-id="EWRrio"]:before { .m-faContent("\\f1e8"); }
	a[data-nav-id="xfmg"]:before { .m-faContent("\\f03d"); }
	a[data-nav-id="addonFlarePubAwards"]:before { .m-faContent("\\f559"); }
	a[data-nav-id="snog_raffles_navtab"]:before { .m-faContent("\\f145"); }
	a[data-nav-id="th_donate"]:before { .m-faContent("\\f2b5"); }
	a[data-nav-id="EWRatendo"]:before { .m-faContent(@fa-var-calendar-alt); }
	a[data-nav-id="EWRcarta"]:before { .m-faContent(@fa-var-book); }
	a[data-nav-id="EWRdiscord"]:before { .m-faContent(@fa-var-discord); .m-faBase(\'Brands\'); }
	a[data-nav-id="EWRmedio"]:before { .m-faContent(@fa-var-video-plus); }
	a[data-nav-id="EWRporta"]:before { .m-faContent(@fa-var-home); }
	a[data-nav-id="EWRrio"]:before { .m-faContent(@fa-var-play-circle); }
	a[data-nav-id="EWRtorneo"]:before { .m-faContent(@fa-var-trophy); }
	a[data-nav-id=\'dbtechEcommerce\']:before {.m-faContent("@{fa-var-shopping-cart}");}
	a[data-nav-id="xa_ams"]:before { .m-faContent("\\f15c"); }
	a[data-nav-id="xa_ubs"]:before { .m-faContent("\\f303"); }
	a[data-nav-id="xa_showcase"]:before { .m-faContent("\\f00b"); }
	a[data-nav-id="xa_sportsbook"]:before { .m-faContent("\\f091"); }
	a[data-nav-id="xa_pickem"]:before { .m-faContent("\\f51e"); }
	a[data-nav-id=\'xr_pm_products\']:before {.m-faContent("@{fa-var-shopping-cart}");}

a.p-navEl-link:before, a.offCanvasMenu-link:before
{
   .m-faBase();
	text-align: center;
	display: inline-block;
	margin-right: 5px;
}
';
	}
	$__finalCompiled .= '

// Navigations Hover Effect
';
	if ($__templater->func('property', array('xtr_navigation_hover_effect', ), false)) {
		$__finalCompiled .= '
.p-nav-list .p-navEl-link,
.p-navgroup-link.p-navgroup-link--user,
.has-js .p-nav .p-nav-menuTrigger,
.p-navgroup-link--logIn,
.p-navgroup-link--register,
.p-navgroup-link.bgPicker,
.p-navgroup-link--search {
    position: relative;
    overflow: hidden;
}

.p-nav-list .p-navEl-link:after,
.p-navgroup-link.p-navgroup-link--user:after,
.has-js .p-nav .p-nav-menuTrigger:after,
.p-navgroup-link--logIn:after,
.p-navgroup-link--register:after,
.p-navgroup-link.bgPicker:after,
.p-navgroup-link--search:after {
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

.p-nav-list .p-navEl-link:hover:after,
.p-navgroup-link.p-navgroup-link--user:hover:after,
.has-js .p-nav .p-nav-menuTrigger:hover:after,
.p-navgroup-link--logIn:hover:after,
.p-navgroup-link--register:hover:after,
.p-navgroup-link.bgPicker:hover:after,
.p-navgroup-link--search:hover:after {
    opacity: 0;
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0);
}
';
	}
	$__finalCompiled .= '

// Forum Title
';
	if ($__templater->func('property', array('xtr_forum_title', ), false)) {
		$__finalCompiled .= '
body[data-template="forum_list"]
{
	.p-title-value
	{
		display: none;
	}
	.p-title-pageAction
	{
		margin-left: auto;
	}
}
';
	}
	$__finalCompiled .= '

// ################################# BODY AND CONTENT #####################

@media (min-width: @xf-responsiveWide) 
{
	.p-body-main--withSidebar{
		display: flex;
		align-items: flex-start;
		
		.p-body-content{
			flex: 1 1 auto;
			// IE fix
			display: block;
			width: ~"calc(100% - @xf-sidebarWidth)";
			padding-right: @xf-sidebarSpacer;
		}
		
		.p-body-sideNav,
		.p-body-sidebar{
			flex: 0 0 auto;
			width: @xf-sidebarWidth;
			// IE fix
			display: block;
		}

	}
}

// ################################# SIDEBAR #####################
// Sticky sidebar height
@sticky-top: @xf-xtr_stickySidebarHeight;

// Disable Sidebar
';
	if ($__templater->func('property', array('xtr_sidebarDisable', ), false)) {
		$__finalCompiled .= '
.p-body-main .p-body-sidebar {
	display: none;
}
.p-body-main.p-body-main--withSidebar .p-body-content {
	width: 100%;
	max-width: 100%;
	padding-right: 0;
	padding-left: 0;
}
';
	}
	$__finalCompiled .= '

// Sidebar Position
';
	if ($__templater->func('property', array('xtr_sidebarPosition', ), false) == 'left') {
		$__finalCompiled .= '
@media (min-width: @xf-responsiveWide) {
	.p-body-main--withSidebar .p-body-content {
		order: 2;
		padding-left: @xf-sidebarSpacer;
		padding-right: 0 !important
	}
	.p-body-main.p-body-main--withSidebar.is-active .p-body-content, .p-body-main.p-body-main--withSideNav.is-active .p-body-content {
		width: 100%;
		max-width: 100%;
		padding-left: 0;
	}
	.p-body-sidebar {
		order: 1;
	}
}
';
	}
	$__finalCompiled .= '

// Sticky Sidebar
';
	if ($__templater->func('property', array('xtr_stickySidebar', ), false) AND (!$__templater->func('property', array('xtr_sidebarDisable', ), false))) {
		$__finalCompiled .= '
@media (min-width: @xf-publicNavCollapseWidth)
{
.p-body-sidebar {
	position: -webkit-sticky;
	position: sticky;
	';
		if (($__templater->func('property', array('publicNavSticky', ), false) === 'primary') OR ($__templater->func('property', array('publicNavSticky', ), false) === 'all')) {
			$__finalCompiled .= '
	top: @sticky-top * 1px + @xf-publicNavPaddingV;
	';
		} else {
			$__finalCompiled .= '
	top: 10px;
	';
		}
		$__finalCompiled .= '
}
}	
';
	}
	$__finalCompiled .= '

// Collapsible Sidebar
';
	if ($__templater->func('property', array('xtr_collapsibleSidebar', ), false) AND (!$__templater->func('property', array('xtr_sidebarDisable', ), false))) {
		$__finalCompiled .= '
.p-title-pageAction {
	.collapseTrigger {
		margin-left: auto;
		display: inline-flex;
		
		&:before
        {
			content: "\\' . $__templater->func('property', array('xtr_collapsibleOffIcon', ), true) . '";
			width: 100%;
			margin-left: 0;
        }
		
		&.is-active:before
        {
			content: "\\' . $__templater->func('property', array('xtr_collapsibleOnIcon', ), true) . '";
        }
		
	}
}	

@media (max-width: @xf-responsiveWide) {
	.p-title-pageAction .collapseTrigger {
		display: none;
	}
}

@media (min-width: @xf-responsiveWide) 
{
	.p-body-main.p-body-main--withSidebar.is-active .p-body-content, .p-body-main.p-body-main--withSideNav.is-active .p-body-content {
		width: 100%;
		max-width: 100%;
		padding-right: 0;
	}

	.p-body-main.p-body-main--withSidebar.is-active .p-body-sidebar, .p-body-main.p-body-main--withSideNav.is-active .p-body-sidebar, .p-body-main.p-body-main--withSidebar.is-active .p-body-sideNav, .p-body-main.p-body-main--withSideNav.is-active .p-body-sideNav {
		width: 0;
		height: 0;
		opacity: 0;
		overflow: hidden;
	}	
}
';
	}
	$__finalCompiled .= '

// Sidebar border line
.p-body-sidebar .block-row:nth-child(n) {
    border-top: @xf-borderSize solid @xf-borderColorHeavy;
}

// ######################################### MESSAGES #################################

// Block outer opposite
';
	if ($__templater->func('property', array('xtr_social_breadcrumb', ), false)) {
		$__finalCompiled .= '
@media (max-width: @xf-responsiveMedium) {
	.block-outer-opposite {
		float: none;
		margin: 0 auto;
		text-align: center;
	}
}
';
	}
	$__finalCompiled .= '


// Horizontal message layout
';
	if ($__templater->func('property', array('xtr_message_layout', ), false) == 'horizontal') {
		$__finalCompiled .= '
.block--messages .message:not(.message--simple) {
	.message-inner {
		flex-direction: column;
	}
	.message-inner .message-cell.message-cell--user,
	.message-inner .message-cell.message-cell--action {
		border-right: none;
		border-bottom: @xf-messageUserBlock--border-width solid @xf-messageUserBlock--border-color;
	}
	.message-inner .message-cell.message-cell--user {
		flex: 0 0 100%;
	}
	.message-cell.message-cell--user .message-user {
		display: flex;
		align-items: center;

		.message-userExtras {
			margin-top: 0;
			margin-left: auto;
		}

		.message-userDetails {
			margin-left: 20px;
		}

		.message-avatar {
			margin-bottom: 0;
		}

		@media (min-width: @xf-messageSingleColumnWidth) {
			.message-userArrow {
				position: absolute;
				bottom: -@xf-messagePadding;
				left: 50px;
				top: initial;
				right: initial;

				.m-triangleUp(xf-default(@xf-messageUserBlock--border-color, transparent), @xf-messagePadding);

				&:after
				{
					position: absolute;
					top: 2px;
					right: -@xf-messagePadding + 1;
					content: "";

					.m-triangleUp(@xf-contentBg, @xf-messagePadding - 1px);
				}
			}
		}
	}
}
';
	}
	$__finalCompiled .= '

// Hide avatar reply editor
';
	if ($__templater->func('property', array('xtr_hide_reply_avatar', ), false)) {
		$__finalCompiled .= '
	.message--quickReply {
		.message-cell.message-cell--user {
			display: none;
		}
	}
';
	}
	$__finalCompiled .= '

// Message Content 

#XF .block--messages
{
	.message
	{
		.message-content a
		{
			.xf-xtr_message_links();
			&:hover
			{
				.xf-xtr_message_link_hover();
			}
		}
	}
}

// Message Control Icons
';
	if ($__templater->func('property', array('xtr_message_controls_icons', ), false)) {
		$__finalCompiled .= '
	.actionBar-action {
		&:before {
			margin-right: 3px;
		}
	}
	.actionBar-action--like {
		&:before {
			content: "\\f087";
		}
	}
	.actionBar-action--bookmarks {
		&:before {
			content: "\\f02e";
		}
	}
	.actionBar-action--edit {
		&:before {
			content: "\\f040";
		}
	}
	.actionBar-action--report {
		&:before {
			content: "\\f071";
		}
	}
	.actionBar-action--warn {
		&:before {
			content: "\\f12a";
		}
	}
	.actionBar-action--ip {
		&:before {
			content: "\\f002";
		}
	}
	.actionBar-action--deleteSpam {
		&:before {
			content: "\\f024";
		}
	}
	.actionBar-action--history {
		&:before {
			content: "\\f1da";
		}
	}
	.actionBar-action--delete {
		&:before {
			content: "\\f00d";
		}
	}
';
	}
	$__finalCompiled .= '

// Message User Info Sticky

';
	if ($__templater->func('property', array('xtr_user_info_block_sticky', ), false)) {
		$__finalCompiled .= '
@media (min-width: ' . ($__templater->func('property', array('responsiveMedium', ), false) + 1) . 'px )
{
    .message-cell.message-cell--user section .message-userArrow,
    .message-inner .message-userArrow {
        right: -(@xf-paddingLarge + 1);
    }
    .message-user {
        position: -webkit-sticky;
        position: sticky;
		';
		if ($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') {
			$__finalCompiled .= '
        top: (@xf-publicNavPaddingV * 4) + (@xf-messagePadding * 2);
		';
		} else {
			$__finalCompiled .= '
		top: (@xf-publicNavPaddingV * 3) + @xf-messagePadding;
		';
		}
		$__finalCompiled .= '
    }
}
';
	}
	$__finalCompiled .= '

// Separate Thread
';
	if ($__templater->func('property', array('xtr_sticky_threads', ), false)) {
		$__finalCompiled .= '
	.separate_thread_important 
	{
		.xf-stickyThreadsStyle();
		height: ' . $__templater->func('property', array('xtr_sticky_threads_height', ), true) . 'px;
		line-height: ' . $__templater->func('property', array('xtr_sticky_threads_height', ), true) . 'px;
	}
';
	}
	$__finalCompiled .= '

// ######################################### PAGINATION #################################

// Pagination
@xentr-pagination: true;
@pagination-radius: @xf-buttonBase--border-radius;
@pagination-active: @xf-paletteColor4;
@pagination-minor: @xf-textColorMuted;
@pagination-gap: 5px;
@pagination-page: @xf-contentBg;
@pagination-shadow: rgba(0,0,0,0.12) 0px 1px 1px, rgba(0,0,0,0.05) 0px 1px 2px;
@pagination-shadow-active: inset rgba(0,0,0,0.2) 0px 1px 3px;
@pagination-page-hover: lighten(@pagination-page, 3%);

// Pagination

.xentr-pagination(@debug) when (@debug = true) {

	.pageNav{
		display: flex;

		> *{
			flex: 0 0 auto;
			margin-right: @pagination-gap;
		}
	}

		.pageNav-main{
			display: flex;
		}

		.pageNav-jump{
			padding-left: 12px;
			padding-right: 12px;
		}

	.pageNav-page{
		display: block;
		flex: 0 0 auto;
		border-radius: inherit;
		font-weight: bold;

		&:not(:last-child){
			margin-right: @pagination-gap;
		}

		> a{
			padding-left: 11px;
			padding-right: 11px;
		}
	}


	// Make border-radius inherit from parent
	.pageNavWrapper{
		border-radius: @pagination-radius;
	}

		.pageNav,
		.pageNav-main,
		.pageNavSimple,
		.pageNav-jump,
		.pageNavSimple-el,
		#XF .pageNav-page{
			border-radius: inherit;
		}


	// Style pagination buttons
	#XF{

		.pageNav-jump,
		.pageNav-page,
		.pageNavSimple-el{
			background: @pagination-page;
			color: contrast(@pagination-page, @xf-textColor, #fff);
			border-width: 0px;
			box-shadow: @pagination-shadow;

			&:hover,
			&:active{
				background-color: @pagination-page-hover;
				//color: contrast(@pagination-page, rgba(0,0,0,0.8), #fff);
			}
		}

		// Active page
		.pageNav-page.pageNav-page--current,
		.pageNavSimple-el.pageNavSimple-el--current{
			background: @pagination-active;
			color: contrast(@pagination-active, rgba(0,0,0,0.8), #fff);
			border-width: 0;
			box-shadow: @pagination-shadow-active;

			&:hover,
			&:active{
				background-color: xf-intensify(@pagination-active, 3%);
			}
		}

		// First and Last buttons on mobiles
		.pageNavSimple-el{
			padding-left: 10px;
			padding-right: 10px;
		}

	}

	// Add space around prev/next arrow
	.pageNavSimple-el--prev i::before,
	.pageNav-jump.pageNav-jump--prev::before{
		margin-right: 3px;
		width: auto;
	}

	.pageNavSimple-el--next i::before,
	.pageNav-jump.pageNav-jump--next::after{
		margin-left: 3px;
		width: auto;
	}

}
.xentr-pagination(@xentr-pagination);

// Exclusive Style Fix
.offCanvasMenu--nav .offCanvasMenu-content {
    text-transform: inherit;
}

// Button cta
.button.button--cta, a.button.button--cta {
    border: none;
}

// Footer
.p-footer {
    margin-bottom: 0 !important;
}';
	return $__finalCompiled;
});