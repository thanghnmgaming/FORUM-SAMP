<?php
// FROM HASH: f2459bc2c9a1ce7d259df6c8e7d0a027
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*
	----------------
	
	XENTR.NET STYLES
	
	----------------
*/

/*

	Message Block
	Message Wave
	Bubble Animations

*/

// Message Block
.xtr-message-block {
	.xf-xtr_message_block();
	position: relative;
	height: 100%;
	margin-top: -(@header-navHeight + 1);
	padding: ' . $__templater->func('property', array('xtr_message_block_height', ), true) . 'px 0;
	text-align: center;
	overflow: hidden;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-align-items: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-justify-content: center;
	-ms-flex-pack: center;
	justify-content: center;
	.xtr-overlay {
	';
	if (($__templater->func('property', array('xtr_logo_position', ), false) == 'insidenav') AND (($__templater->func('property', array('xtr_message_block_enable', ), false) == '1') AND ($__templater->func('property', array('xtr_gradient_bg_animations', ), false) == '1'))) {
		$__finalCompiled .= '
	height: 100%;
	width: 100%;
	position: absolute;
	opacity: ' . $__templater->func('property', array('xtr_overlay_gradient_opacity', ), true) . ';	
	';
	} else {
		$__finalCompiled .= '
	position: static;
	overflow: hidden;
		&:after {
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			position: absolute;
			overflow: hidden;
			content: \'\';
			.xf-xtr_message_overlay();
			opacity: ' . $__templater->func('property', array('xtr_overlay_gradient_opacity', ), true) . ';
		}
		';
	}
	$__finalCompiled .= '
	}
	.message-body-inner {
		position: relative;
		display: flex;
		flex-direction: column;
		z-index: 1;
    	width: 100%;
		.xf-xtr_message_body_inner();
	}
	.p-body-header {
		margin: 0;
		position: relative;
		';
	if (!$__templater->func('property', array('xtr_message_wave', ), false)) {
		$__finalCompiled .= '
		top: @xf-paddingLargest;
		';
	}
	$__finalCompiled .= '
		.p-description {
			color: inherit;
			display: flex;
			margin: 0;
    		position: absolute;
		}
		@media (max-width: ' . ($__templater->func('property', array('responsiveWide', ), false) + 1) . 'px ) {	
			.p-title {
				display: block;
			}
			.p-title-value {
				font-size: @xf-fontSizeLarger;
			}
			.p-description {
				display: none;
			}
		}	
	}	
	.xtr-message-block-text {
		.xf-xtr_message_block_text();
		z-index: 2;
		h1 {
			margin: 5px 0;
		}
		h5 {
			font-size: 15px;
			font-weight: normal;
		}
	}
}

@media (max-width: ' . ($__templater->func('property', array('responsiveWide', ), false) + 1) . 'px ) {
	.xtr-message-block {
		margin-top: -(@header-navHeight + @xf-publicNavPaddingV - @xf-publicSubNavPaddingV - 1 );
	}
}	

// Message Buttons
.button-group-option {
	position: relative;
	-webkit-align-items: center;
	-ms-flex-align: center;
	align-items: center;
	overflow: hidden;
	display: inline-block;	
	-webkit-align-items: stretch;
	-ms-flex-align: stretch;
	align-items: stretch;
	.button {
		margin: 3px;
		padding: 8px 30px;
		-webkit-flex: 0 0 auto;
		-ms-flex: 0 0 auto;
		flex: 0 0 auto;
		-webkit-flex: 1 1 0px;
		-ms-flex: 1 1 0px;
		flex: 1 1 0px;
		font-size: 15px;
		&:last-child {
			margin-right: 0;
		}
	}
}	

// Message Wave Style
.message-wave {
	position: absolute;
    overflow: hidden;
    width: 100%;
    bottom: 0;
	z-index: 1;
	.divider-shape {
		width: 100%;
		svg {
			display: block;
			width: calc(' . $__templater->func('property', array('xtr_message_wave_width', ), true) . '% + 1.3px);
			height: ' . $__templater->func('property', array('xtr_message_wave_height', ), true) . 'px;
			left: 0;
			transform: rotate3d(0,1,0,' . $__templater->func('property', array('xtr_message_wave_transform', ), true) . 'deg);
		}
	}
	.shape-fill.shape-fill-1 {
		fill: @xf-xtr_wave_fill_background--background-color;
	}
}

// Bubble Animations
.bubble-animate {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 0;
 
    .circle {
        .xf-xtr_message_block_bubble_animate();
        bottom: 0;
        position: absolute;

        &.small {
            width: 20px;
            height: 20px;
            opacity: 0.7;

            &.square1 {
                left: 18%;
                top: 100%;
                animation-name: smallBubble;
                animation-duration: 3s;
                animation-iteration-count: infinite;
                animation-delay: 1s;
                animation-timing-function: ease-in;
            }
            &.square2 {
                left: 36%;
                top: 100%;
                animation-name: smallBubble;
                animation-duration: 4s;
                animation-iteration-count: infinite;
                animation-delay: 2s;
                animation-timing-function: ease-in;
            }
            &.square3 {
                left: 54%;
                top: 100%;
                animation-name: smallBubble;
                animation-duration: 5s;
                animation-iteration-count: infinite;
                animation-delay: 1s;
                animation-timing-function: ease-in;
            }
            &.square4 {
                left: 72%;
                top: 100%;
                animation-name: smallBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 4s;
                animation-timing-function: ease-in;
            }
            &.square5 {
                left: 90%;
                top: 100%;
                animation-name: smallBubble;
                animation-duration: 7s;
                animation-delay: 5s;
                animation-timing-function: ease-in;
            }
        }
        &.medium {
            width: 40px;
            height: 40px;
            opacity: 0.35;

            &.square1 {
                left: 21%;
                top: 100%;
                animation-name: mediumBubble;
                animation-duration: 5s;
                animation-iteration-count: infinite;
                animation-delay: 2s;
                animation-timing-function: ease-in;
            }
            &.square2 {
                left: 42%;
                top: 100%;
                animation-name: mediumBubble;
                animation-duration: 8s;
                animation-iteration-count: infinite;
                animation-delay: 6s;
                animation-timing-function: ease-in;
            }
            &.square3 {
                left: 63%;
                top: 100%;
                animation-name: mediumBubble;
                animation-duration: 12s;
                animation-iteration-count: infinite;
                animation-delay: 12s;
                animation-timing-function: ease-in;
            }
            &.square4 {
                left: 84%;
                top: 100%;
                animation-name: mediumBubble;
                animation-duration: 4s;
                animation-iteration-count: infinite;
                animation-delay: 12s;
                animation-timing-function: ease-in;
            }
            &.square5 {
                left: 105%;
                top: 100%;
                animation-name: mediumBubble;
                animation-duration: 18s;
                animation-iteration-count: infinite;
                animation-delay: 6s;
                animation-timing-function: ease-in;
            }
        }
        &.large {
            width: 100px;
            height: 100px;
            opacity: 0.15;

            &.square1 {
                left: 21%;
                top: 100%;
                animation-name: bigBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 6s;
                animation-timing-function: ease-in;
            }
            &.square2 {
                left: 42%;
                top: 100%;
                animation-name: bigBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 3s;
                animation-timing-function: ease-in;
            }
            &.square3 {
                left: 63%;
                top: 100%;
                animation-name: bigBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 13s;
                animation-timing-function: ease-in;
            }
            &.square4 {
                left: 84%;
                top: 100%;
                animation-name: bigBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 9s;
                animation-timing-function: ease-in;
            }
            &.square5 {
                left: 105%;
                top: 100%;
                animation-name: bigBubble;
                animation-duration: 6s;
                animation-iteration-count: infinite;
                animation-delay: 13s;
                animation-timing-function: ease-in;
            }
        }
    }
}
@-webkit-keyframes smallBubble {
    0% {
        top: 100%;
        margin-left: 10px;
    }
    25% {
        margin-left: -10px;
    }
    50% {
        margin-left: 10px;
    }
    75% {
        margin-left: -10px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}
@keyframes smallBubble {
    0% {
        top: 100%;
        margin-left: 10px;
    }
    25% {
        margin-left: -10px;
    }
    50% {
        margin-left: 10px;
    }

    75% {
        margin-left: -10px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}
@-webkit-keyframes mediumBubble {
    0% {
        top: 100%;
        margin-left: 15px;
    }
    25% {
        margin-left: -15px;
    }
    50% {
        margin-left: 15px;
    }
    75% {
        margin-left: -15px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}
@keyframes mediumBubble {
    0% {
        top: 100%;
        margin-left: 15px;
    }
    25% {
        margin-left: -15px;
    }
    50% {
        margin-left: 15px;
    }
    75% {
        margin-left: -15px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}
@-webkit-keyframes bigBubble {
    0% {
        top: 100%;
        margin-left: 20px;
    }
    25% {
        margin-left: -20px;
    }
    50% {
        margin-left: 20px;
    }
    75% {
        margin-left: -20px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}
@keyframes bigBubble {
    0% {
        top: 100%;
        margin-left: 20px;
    }
    25% {
        margin-left: -20px;
    }
    50% {
        margin-left: 20px;
    }
    75% {
        margin-left: -20px;
    }
    100% {
        top: 0%;
        opacity: 0;
        margin-left: 0px;
    }
}';
	return $__finalCompiled;
});