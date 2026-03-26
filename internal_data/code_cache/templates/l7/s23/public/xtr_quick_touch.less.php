<?php
// FROM HASH: d4d985c04f7d285bf37cadfa974f8072
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '@_quick-touchList-tabletCellBreakpoint: @xf-responsiveWide;
@_quick-touchList-mobileCellBreakpoint: @xf-responsiveMedium;

#quick-touch-page-content {
	display: flex;
	flex-flow: row wrap;
	border: 0;
	margin: -5px;
	background: none;
	padding-bottom: ((@xf-elementSpacer) / 2);
	.p-quick-touch-inner {
		display: flex;
		width: 100%;
	}
	.quick-touch-block {
		.xf-xtr_quick_touchBlock();
		margin: ((@xf-paddingMedium) - 3);
		flex: 1;
		flex-direction: column;
		box-shadow: 0 4px 25px 0 rgba(0,0,0,0.1);
		border-radius: @xf-borderRadiusLarge;
		.quick-touch-body {
			.xf-xtr_quick_touchBlockBody();
			width: 100%;
		}	
	}
	.quick-touch-content {
		padding: 0;
	}
	.quick-touch-icon-box-style {
		position: relative;
	}
}

@media (max-width: @_quick-touchList-tabletCellBreakpoint)
{
	#quick-touch-page-content .p-quick-touch-inner {
		display: block;
	}
}	

.quick-touch-block {
	.quick-touch-icon-box-style {
		.quick-touch_icon {
			padding: 35px;
			border-radius: 3px;
			position: relative;
			-webkit-transition: all .3s ease;
			-o-transition: all .3s ease;
			transition: all .3s ease;
			float: left;
			span {
				.xf-xtr_quick_touch_block_icon_style();
				position: absolute;
				top: 50%;
				left: 50%;
				-webkit-transform: translate(-50%, -50%);
				-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
			}
		}
		.icon-box-body {
			float: left;
			width: 100%;
			text-align: left;
		}
	}
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon + .icon-box-body {
    width: ~"calc(100% - 100px)";
    padding-left: @xf-paddingLarge;
}


.quick-touch-block .quick-touch-icon-box-style .icon-box-body h4 {
    margin: 0;
    -webkit-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
    color: inherit;
    .xf-xtr_quick_touchBlockTitle();
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.blue {
	.xf-xtr_quick_touch_block_first_button_color();
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.blue + .icon-box-body h4 {
    color: @xf-xtr_quick_touch_block_first_button_color--background-color;
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.green {
	.xf-xtr_quick_touch_block_second_button_color();
}

.quick-touch-block .quick-touch-icon-box-style .icon-box-links .button--green {
	.xf-xtr_quick_touch_block_second_button_color();
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.green + .icon-box-body h4 {
    color: @xf-xtr_quick_touch_block_second_button_color--background-color;
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.red {
    .xf-xtr_quick_touch_block_third_button_color();
}

.quick-touch-block .quick-touch-icon-box-style .icon-box-links .button--red {
	.xf-xtr_quick_touch_block_third_button_color();
}

.quick-touch-block .quick-touch-icon-box-style .quick-touch_icon.red + .icon-box-body h4 {
    color: @xf-xtr_quick_touch_block_third_button_color--background-color;
}

.quick-touch-block .quick-touch-icon-box-style + .quick-touch-icon-box-style {
    margin-top: 30px;
}
.quick-touch-block .quick-touch-icon-box-style .icon-box-body p {
    .xf-xtr_quick_touch_block_content();
}
.quick-touch-block .quick-touch-icon-box-style:after {
    content: "";
    display: table;
    clear: both;
}


// quick-touch content button icons
#quick-touch-page-content {
	.quick-touch-icon-box-style {
		.icon-box-links {
			.button {
				position: absolute;
				right: 0;
				color: #000;
				top: 0;
				padding: 0;
				border: none;
				width: 30px;
				height: 30px;
				background: none;
				&:hover {
					&:after {
						opacity: 1;
					}
				}
				.button-text {
					display: none;
				}
				&::after {
					.m-faBase();
					font-size: @xf-fontSizeLarge !important;
					color: inherit;
					position: relative;
    				transform: none;
					content: \'\\f304\';
					border: none;
					background: none;
				}
			}
			.button--blue {
				&:after {
					content: \'\\f044\';
					color: @xf-xtr_quick_touch_block_first_button_color--background-color;
					font-size: 22px !important;
				}
			}
			.button--register {
				&:after {
					content: \'\\f084\';
					color: @xf-xtr_quick_touch_block_first_button_color--background-color;
					font-size: 22px !important;
				}
			}
			.button--green {
				&:after {
					content: \'\\f0e7\';
					color: @xf-xtr_quick_touch_block_second_button_color--background-color;
					font-size: 22px !important;
				}
			}
			.button--red {
				&:after {
					content: \'\\f0e0\';
					color: @xf-xtr_quick_touch_block_third_button_color--background-color;
					font-size: 22px !important;
				}
			}
		}
	}
}

// quick-touch content mobile device
';
	if ($__templater->func('property', array('xtr_mobileQuickTouch', ), false)) {
		$__finalCompiled .= '
@media (max-width: ' . ($__templater->func('property', array('xtr_quickTouchMobileWidth', ), false) - 1) . 'px ) 
{
	#quick-touch-page-content {
		display: none;
	}
}
';
	}
	return $__finalCompiled;
});