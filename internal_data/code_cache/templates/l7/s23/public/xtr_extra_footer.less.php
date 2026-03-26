<?php
// FROM HASH: 3fa0e68549cba4e1dcf5539ab72740d3
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '.xtr-extra-footer {
	.xf-xtr_extra_footer_styles();
	.block {
    	margin: 0;
	}
	.p-footer-inner {
    	padding-bottom: 0;
	}
	.xtr-extra-footer-row {
		display: flex;
		flex-wrap: wrap;
		margin: calc(-@xf-xtr_extra_footer_block_spacing / 2);
		
		>.block {
			flex-basis: ' . $__templater->func('property', array('xtr_extra_footer_block_width', ), true) . 'px;
			padding: calc(@xf-xtr_extra_footer_block_spacing / 2);
			margin: 0;
			flex-grow: 1;
			min-width: 0;
			&:first-child {
				border-left-width: 0;
			}
			
			.block-container {
				margin-left: 0;
				margin-right: 0;
				background: none;
				box-shadow: none;
				border: none;
				
				.block-minorHeader {
					.xf-xtr_extra_footer_minor_header();
				}
				
				.block-row {
					.xf-xtr_extra_footer_block_body();
					.blockLink {
						padding: 5px 10px;
						background: none;
						border-bottom: @xf-borderSize dotted rgba(255, 255, 255, 0.1);
					}
				}
				
				.blockLink {
					a {
						.xf-xtr_extra_footer_block_links();
						&:hover {
							.xf-xtr_extra_footer_block_links_hover();
						}
					}
				}
				.block-footer {
					background: rgba(0,0,0,0.25);
					border: none;
					color: @xf-xtr_extra_footer_block_links--color;
					border-radius: @xf-borderRadiusMedium;
				}	
			}
		}
	}
}

.p-footer.extra {
    background: fade(@xf-publicFooter--background-color, 15%);
}

// Vave Style
.wave {
	position: relative;
	overflow: hidden;
	.divider-shape {
		width: 100%;
		svg {
			display: block;
			width: calc(' . $__templater->func('property', array('xtr_footer_wave_width', ), true) . '% + 1.3px);
			height: ' . $__templater->func('property', array('xtr_footer_wave_height', ), true) . 'px;
			left: 0;
			transform: rotate3d(0,1,0,' . $__templater->func('property', array('xtr_footer_wave_transform', ), true) . 'deg);
		}
	}
	.shape-fill.shape-fill-1 {
		fill: @xf-xtr_footer_wave_fill_background--background-color;
	}
}';
	return $__finalCompiled;
});