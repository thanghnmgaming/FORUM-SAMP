<?php
// FROM HASH: be38b768316332ba1fa03ffe7ad84970
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*
	----------------
	
	XENTR.NET STYLES
	
	----------------
*/

/*

	Prefix filter bar
	Forum Node Layout Classic
	Node Stats
	Node Stats Hover
	Node layout dual column
	Sub-Forums
	Forum Node Icons
	Collapse Category
	Category Description

*/

// ######################################### PREFIX FILTER BAR #################################

// Prefix filter bar
#XF .prefix-block-container {
    background: @xf-contentBg;
    border-radius: @xf-borderRadiusMedium;
    border: @xf-borderSize solid @xf-borderColorLight;
    padding: @xf-paddingSmall;
    margin-bottom: @xf-paddingSmall;
}

// Conversation button
.xm-icon {
    margin-left: 5px;
}


// ######################################### FORUM NODE LAYOUTS #################################

// Forum Node Layout Classic
';
	if ($__templater->func('property', array('xmNodeLayout', ), false) == 'classic') {
		$__finalCompiled .= '
.block--category {
	border-width: 0px;
	border-style: solid;
	margin-bottom: 0;
	.block-container {
		border-width: 0;
		background-color: transparent;
		box-shadow: none;
		
		// Block header
		.block-header {
			margin-bottom: @xf-paddingLarge;
			border-radius: @xf-borderRadiusMedium;
			-webkit-box-shadow: 0 1px 20px 0 rgba(0,0,0,0.06);
			box-shadow: 0 1px 20px 0 rgba(0,0,0,0.06);
		}
		
		.node {
			&:first-child {
				margin-top: 0;
			}
			.xf-xmNodeLayout_classic_node();
			';
		if ($__templater->func('property', array('xtr_nodes_hover_effect', ), false)) {
			$__finalCompiled .= '
			// Hover transform
			-webkit-transition: all .3s ease-in-out;
			-moz-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			-ms-transition: all .3s ease-in-out;
			
			// Hover transform
			&:hover {
				z-index: 10;
				-webkit-box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
				box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
				-webkit-transform: scale(01);
				-moz-transform: scale(1.01);
				-o-transform: scale(1.01);
				transform: scale(1.01);
			}
			';
		}
		$__finalCompiled .= '
			
			.node-extra {
				border-right: @xf-borderSize solid @xf-borderColorHeavy;
			}	
		}
	}
}

// Node Stats
.node-body {
	.node-icon {
		width: 60px;
		padding: 0;
		border-right: @xf-borderSize solid @xf-borderColorHeavy;
	}
	.node-main {
		border-right: @xf-borderSize solid @xf-borderColorHeavy;
	}
	.node-stats {
		padding: 0;
	}
	.node-threads {
		border-bottom: @xf-borderSize solid @xf-borderColorHeavy;
		padding: @xf-paddingMedium 0 (@xf-paddingLarge - 3) 0;
		text-align: center;
		
		.node-stats-bg {		
			position: relative;
			display: inline-block;
			.xf-xtr_node_layout_classic_stats();
			// Stats mark
			.stats-mark {
				width: 11px;
				height: 11px;
				background-color: @xf-xtr_node_layout_classic_stats--background-color;
				position: absolute;
				bottom: 0;
				left: 40%;
				margin-bottom: -5px;
				transform: rotate(45deg);
				-ms-transform: rotate(45deg);
				-webkit-transform: rotate(45deg);
			}
		}
	}
	.node-messages {
		color: @xf-xtr_node_layout_classic_stats--color;
		text-align: center;
		line-height: 32px;
	}
}
';
	}
	$__finalCompiled .= '

// ######################################### NODE LAYOUT CLASSIC IMAGE & DUAL #################################

';
	if (($__templater->func('property', array('xmNodeLayout', ), false) == 'classicImage') OR ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual')) {
		$__finalCompiled .= '
@_nodeList-statsCellBreakpoint: 1000px;
@_nodeListPaddingV: @xf-paddingLargest;
@_nodeListPaddingH: @xf-paddingLargest;


// Block category
.block.block--category {
	border-radius: 5px;
	// Block container
	.block-container {
		// background: @xf-contentAltBg;
		border: none;
	}
}

// Block box wrapper
.block {
	.block-box.wrapper {
		max-height: (@xf-paddingLarge * 18);
		min-height: (@xf-paddingLarge * 13);
		max-width: 100%;
		border-top-left-radius: 4px;
		border-top-right-radius: 4px;
		';
		if ($__templater->func('property', array('xtr_block_header_image_enable', ), false)) {
			$__finalCompiled .= '
		background-image: url(' . $__templater->func('base_url', array('@xf-xtr_filesPath/exclusive_dark/images/category-header/cat-bg.jpg', ), true) . ');
		background-size: cover;
		background-position: 50% 50%;
		color: #FFF;
		';
		} else {
			$__finalCompiled .= '
		.xf-blockHeader();
		border-bottom: none;
		';
		}
		$__finalCompiled .= '
		// Block header
		.block-header {
			a {
				color: inherit;
				text-decoration: none;
			}
			// Block header description
			.block-desc {
				color: inherit;
			}	
		}
	}

	// Block body wrapper
	.block-body.wrapper {
		position: relative;
		z-index: 1;
		border-radius: @xf-borderRadiusLarge;
		margin: -(@xf-paddingLarge * 7 - 5px) auto 0 auto;
		';
		if ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual') {
			$__finalCompiled .= '
		width: 100%;
		';
		} else {
			$__finalCompiled .= '
		width: ~"calc(100% - 15px)";
		';
		}
		$__finalCompiled .= '
		display: flex;
		flex-flow: row wrap;
		justify-content: space-between;
	}

	// Block body node
	.block-body {
		.node {
			background: @xf-contentBg;
			float: left;
			';
		if ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual') {
			$__finalCompiled .= '
			width: ~"calc(50% - 10px)";
			';
		} else {
			$__finalCompiled .= '
			width: 100%;
			';
		}
		$__finalCompiled .= '
			margin: 0 auto @xf-paddingMedium;
			padding: @xf-paddingMedium;
			border-radius: @xf-borderRadiusLarge;
			border: @xf-borderSize solid @xf-borderColorFaint;
			-webkit-box-shadow: 0 1px 20px 0 rgba(0,0,0,0.06);
			box-shadow: 0 1px 20px 0 rgba(0,0,0,0.06);
			
			';
		if ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual') {
			$__finalCompiled .= '
			@media (max-width: @_nodeList-statsCellBreakpoint)
			{
				width: ~"calc(100% - 10px)";
			}
			';
		}
		$__finalCompiled .= '
			
			';
		if ($__templater->func('property', array('xtr_nodes_hover_effect', ), false)) {
			$__finalCompiled .= '
			// Hover transform
			-webkit-transition: all .3s ease-in-out;
			-moz-transition: all .3s ease-in-out;
			-o-transition: all .3s ease-in-out;
			-ms-transition: all .3s ease-in-out;
			
			// Hover transform
			&:hover {
				z-index: 10;
				-webkit-box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
				box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.02);
				-webkit-transform: scale(01);
				-moz-transform: scale(1.01);
				-o-transform: scale(1.01);
				transform: scale(1.01);		
			}
			';
		}
		$__finalCompiled .= '
			.node-body {
				@media (min-width: ' . ($__templater->func('property', array('responsiveMedium', ), false) + 1) . 'px ) {
					display: flex;
					align-items: center;
					justify-content: space-evenly;
				}
				.node-main {
					flex: 1;
				}	
				.node-stats,
				.node-statsMeta {
					display: none;
				}
				.node_rss,
				.node_more {
					width: 38px;
					display: flex;
					align-items: center;
					justify-content: flex-end;
				}
				.node_rss {
					a {
						color: #333;
						&:hover {
							color: #FF9800;
						}
					}
				}
				.node_more {
					button {
						background: none;
						border: none;
						color: @xf-linkColor;
						transform: none;
						&:active {
							background: none;
							border: none;
							color: @xf-linkColor;
							transform: none;
						}
					}
					.menuTrigger {
						&:after {
							content: "\\f142";
							position: relative;
							transform: none;
							background: none;
						}
						&:hover {
							&:after {
								opacity: 1;
								transform: none;
							}
						}
					}
					.button {
						&:not(.button--splitTrigger) {
							&:hover {
								background: none;
								color: @xf-linkHoverColor;
							}
						}
					}
				}

				@media (max-width: ' . ($__templater->func('property', array('responsiveMedium', ), false) + 1) . 'px ) 
				{
					.node_rss,
					.node_more {
						display: none;
					}
					.forum-node-icon {
						width: 46px;
					}
				}
			}
			
			&:nth-child(2n+1) {
				clear: left;
			}
			
			';
		if ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual') {
			$__finalCompiled .= '
			&:last-child {
				&:nth-child(2n+1) {
					width: ~"calc(100% - 10px)";
				}
			}
			.node-extra
			{
				display: block;
				width: 100%;
				background-color: @xf-contentAltBg;
				border-radius: 4px;
			}
			';
		}
		$__finalCompiled .= '
		}
	}
}

// Forum list template block header
body[data-template=\'forum_list\'] {
	.block {
		.block-box.wrapper {
			.block-header {
				border: none;
				background: transparent;
				color: inherit;
			}
		}
	}
}

// Category view template 
body[data-template=\'category_view\'] {
	.block {
		.block-container {
			border: none;
			background: transparent;
		}
		.block-body.wrapper {
			margin: 0 auto;
			width: 100%;
		}
	}
}

// Forum view template
body[data-template=\'forum_view\'] {
	.block {
		.block-container {
			border: none;
			background: transparent;
		}
		.structItemContainer {
			background-color: @xf-contentBg;
		}	
	}
}

// Node layout dual column forum view fix
';
		if ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual') {
			$__finalCompiled .= '
body[data-template=\'forum_view\'] {
	.block {
		.block-body {
			.node {
				margin: 5px;
			}
		}
	}
}
';
		}
		$__finalCompiled .= '

// Node Stats Hover
';
		if ($__templater->func('property', array('xtr_node_stats_hover', ), false)) {
			$__finalCompiled .= '
.block {
	.block-body {
		.forum-node-icon {
			display: table-cell;
			vertical-align: middle;
			text-align: center;
			position: relative;
			width: 56px;
		}
		.forum_stats {
			line-height: 18px;
			position: absolute;
			left: 50%;
			top: 50%;
			display: block;
			color: @xf-linkColor;
			opacity: 0;
			visibility: hidden;
			transform: translate(-50%, -50%) scale(0);
			.node-icon-count {
				display: block;
				font-weight: bold;
			}
			.node-icon-phrase {
				display: block;
				font-size: 13px;
			}
		}
		.node-body {
			&:hover {
				.forum_stats {
					opacity: 1;
					visibility: visible;
					z-index: 1;
					transform: translate(-50%, -50%) scale(1);
					transition: all .5s;
				}
				.node-icon {
					i {
						opacity: 0;
						visibility: hidden;
					}
				}
			}
		}
		.node.node--link {
			.node-body {
				&:hover {
					.node-icon {
						i {
							opacity: 1;
							visibility: visible;
						}
					}
				}
			}
		}
		.node.node--page {
			.node-body {
				&:hover {
					.node-icon {
						i {
							opacity: 1;
							visibility: visible;
						}
					}
				}
			}
		}
	}
}
';
		}
		$__finalCompiled .= '

';
	}
	$__finalCompiled .= '

// ######################################### SUB FORUMS #################################
// Sub-Forums
';
	if ((($__templater->func('property', array('xmNodeLayout', ), false) == 'classic') OR ($__templater->func('property', array('xmNodeLayout', ), false) == 'classicImage')) OR ($__templater->func('property', array('xmNodeLayout', ), false) == 'dual')) {
		$__finalCompiled .= '
.node-subNodeFlatList {
    >li {
        float: left;
		width: 50%;
		margin-right: 0 !important;
		padding: (@xf-paddingSmall - 2);
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
        white-space: nowrap;
    }
}
';
	}
	$__finalCompiled .= '

// ######################################### FORUM NODE ICONS #################################
';
	if ($__templater->func('property', array('xtr_nodeIcons', ), false)) {
		$__finalCompiled .= '
	/* Read Icon */
	#XF .node--forum {
		.node-icon {
			i {
				&:before {
					content: "\\@xf-nodeIconRead";
				}
			}
		}
	}

	/* Unread Icon */
	#XF .node--forum.node--unread {
		.node-icon {
			i {
				&:before {
					content: "\\@xf-nodeIconUnread";
				}
			}
		}
	}

	/* Link Icon */
	#XF .node--link {
		.node-icon {
			i {
				&:before {
					content: "\\@xf-nodeLinkIcon";
				}
			}
		}
	}
		
	/* Page Icon */
	#XF .node--page {
		.node-icon {
			i {
				&:before {
					content: "\\@xf-nodePageIcon";
				}
			}
		}
	}
';
	}
	$__finalCompiled .= '

// ######################################### COLLAPSE CATEGORY #################################

// Collapse Category
.block--category
{
	.block-header {
		position: relative;
	}	
    .collapseTrigger
    {
		position: absolute;
		top: 50%;
		right: 18px;
		font-size: 28px;
		color: inherit;
		cursor: pointer;
		transform: translateY(-50%);
		
		&:before
        {
            content: ' . $__templater->func('property', array('xtr_categoryCollapsibleOnIcon', ), true) . ';
			width: 100%;
            font-size: 80%;
			margin: 0;
        }
		
        &.is-active:before
        {
            content: ' . $__templater->func('property', array('xtr_categoryCollapsibleOffIcon', ), true) . ';
        }
    }
}

// Category Description
';
	if ($__templater->func('property', array('xtr_category_description_hover', ), false)) {
		$__finalCompiled .= '
// Block header description hover
.block-header {
	.block-desc {
		display: inline-block;
		opacity: 0;
		margin-left: 4px;
		.m-transition(all, 0.3s);
	}
}

.block--category {
	.block-container {
		&:hover {
			.block-desc {
				opacity: 1;
			}
		}
	}
}
';
	}
	return $__finalCompiled;
});