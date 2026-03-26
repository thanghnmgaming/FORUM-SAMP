<?php
// FROM HASH: 0be4fd1d392345f4f40400bbcb3ef08d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '// ######################################### LIVE BACKGROUND PICKER #################################

.bgPicker {
	display: inline-block;
	&:hover {
		opacity: 1;
	}
}
.bgChooser {
	display: none;
	position: relative;
	';
	if ($__templater->func('property', array('xtr_mobileQuickTouch', ), false)) {
		$__finalCompiled .= '
	margin-bottom: @xf-paddingMedium;
	';
	}
	$__finalCompiled .= '
	ul {
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0;
		margin: 0;
	}
	li {
		flex: 1 1 auto;
		display: block;
		position: relative;
		background-size: cover !important;
		background-position: 50% 50% !important;
		border-radius: 3px;
		box-shadow: inset rgba(0,0,0,0.1) 0px 5px 10px, inset rgba(0,0,0,0.25) 0px 1px 2px;
		color: #fff;
		font-size: 1.45rem;
		text-shadow: rgba(0,0,0,0.3) 0px 2px 3px;
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
		user-select: none;
		margin-bottom: 5px;
		height: ' . $__templater->func('property', array('xtr_bgSwitcherHeight', ), true) . 'px;
		margin: 0 5px;
		text-align: center;
		cursor: pointer;
		&:before {
			content: \'\';
			background: rgba(0, 0, 0, 0.5);
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			border-radius: inherit;
			transition: all 0.2s ease-in-out;
			opacity: 0;
		}
		&:after {
			display: flex;
			align-items: center;
			justify-content: center;
			content: "\\f03e";
			.m-faBase();
			font-size: 24px;
			line-height: 1;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			transform: translateY(20px);
			transition: all 0.2s ease-in-out;
			opacity: 0;
		}
	}
}
@media (min-width: @xf-responsiveWide) {
	.bgChooser {
		li {
			&:hover {
				&:before {
					opacity: 1;
				}
				&:after {
					transform: translateY(0);
					opacity: 0.8;
				}
			}
		}
	}
}
	

@media (max-width: @xf-responsiveMedium)
{	
	.bgChooser {
		li {
			&:before {
				display: none;
			}
			&:after {
				display: none;
			}
		}
	}
}
.closeBgChooser {
	position: absolute;
	right: -5px;
	top: -10px;
	cursor: pointer;
	z-index: 10;
	opacity: 0.3;
	color: #000;
	display: none;
	i {
		padding: 5px;
		background: #000;
		position: relative;
		top: 3px;
		color: #fff;
		border-radius: 3px;
	}
	&:hover {
		opacity: 1;
	}
}
.bgChooser {
	ul {
		li#bg-1 {
			background: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage1', ), true) . '\') no-repeat;
		}
		li#bg-2 {
			background: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage2', ), true) . '\') no-repeat;
		}
		li#bg-3 {
			background: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage3', ), true) . '\') no-repeat;
		}
		li#bg-4 {
			background: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage4', ), true) . '\') no-repeat;
		}
	}
}

';
	if (($__templater->func('property', array('xtr_message_block_enable', ), false) == '1') AND ($__templater->func('property', array('xtr_live_background_picker', ), false) == '1')) {
		$__finalCompiled .= '
body.bg-default .xtr-message-block,
body.bg-1 .xtr-message-block,
body.bg-2 .xtr-message-block,
body.bg-3 .xtr-message-block,
body.bg-4 .xtr-message-block {
	background-size: cover !important;
    background-position: 50% 50% !important;
    background-repeat: no-repeat !important;
}

body.bg-default {
	.xtr-message-block {
		background: url(\'' . $__templater->func('property', array('xtr_live_bg_picker_default_image', ), true) . '\') no-repeat;
		
	}
}
body.bg-1 {
	.xtr-message-block {
		background-color: ' . $__templater->func('property', array('xtr_switcherBackgroundColor1', ), true) . ';
		background-image: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage1', ), true) . '\');
	}
}
body.bg-2 {
	.xtr-message-block {
		background-color: ' . $__templater->func('property', array('xtr_switcherBackgroundColor2', ), true) . ';
		background-image: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage2', ), true) . '\');
	}
}
body.bg-3 {
	.xtr-message-block {
		background-color: ' . $__templater->func('property', array('xtr_switcherBackgroundColor3', ), true) . ';
		background-image: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage3', ), true) . '\');
	}
}
body.bg-4 {
	.xtr-message-block {
		background-color: ' . $__templater->func('property', array('xtr_switcherBackgroundColor4', ), true) . ';
		background-image: url(\'' . $__templater->func('property', array('xtr_switcherBackgroundImage4', ), true) . '\');
	}
}
';
	}
	$__finalCompiled .= '

// Mobile bg picker disable
@media (max-width: @xf-responsiveNarrow) {
	.xtr-nav-logo .p-nav-opposite .p-navgroup-link.bgPicker,
	.xtr-nav-logo .p-nav-opposite .p-navgroup-link--language {
    	display: none;
	}
}';
	return $__finalCompiled;
});