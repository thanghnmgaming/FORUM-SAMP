<?php
// FROM HASH: dd0c05c200cce4c058c138803243c38d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('xtr_message_block.less');
	$__finalCompiled .= '

<div class="xtr-message-block">	
	<div class="xtr-overlay"></div>	
    <div class="message-body-inner">    
	';
	if ($__vars['xf']['visitor']['user_id']) {
		$__finalCompiled .= '
		';
		$__compilerTemp1 = '';
		$__compilerTemp1 .= '
			';
		$__compilerTemp2 = '';
		$__compilerTemp2 .= '
						';
		if (!$__vars['noH1']) {
			$__compilerTemp2 .= '
							<h1 class="p-title-value">' . $__templater->escape($__vars['h1']) . '</h1>
						';
		}
		$__compilerTemp2 .= '
						';
		$__compilerTemp3 = '';
		$__compilerTemp3 .= (isset($__templater->pageParams['pageAction']) ? $__templater->pageParams['pageAction'] : '');
		if (strlen(trim($__compilerTemp3)) > 0) {
			$__compilerTemp2 .= '
							<div class="p-title-pageAction">' . $__compilerTemp3;
			if ($__vars['sidebar']) {
				if ($__templater->func('property', array('xtr_collapsibleSidebar', ), false) AND ((!$__templater->func('property', array('xtr_sidebarDisable', ), false)) AND $__vars['sidebar'])) {
					$__compilerTemp2 .= '<span id="collapse-side" class="button collapseTrigger collapseTrigger--block ' . ((!$__templater->func('is_toggled', array('_sidebarCollapse', ), false)) ? ' is-active' : '') . '" data-xf-click="toggle" data-xf-init="toggle-storage" data-storage-type="cookie" data-target=".p-body-main--withSidebar" data-storage-key="_sidebarCollapse"></span>';
				}
			}
			$__compilerTemp2 .= '</div>
						';
		}
		$__compilerTemp2 .= '
					';
		if (strlen(trim($__compilerTemp2)) > 0) {
			$__compilerTemp1 .= '
				<div class="p-title ' . ($__vars['noH1'] ? 'p-title--noH1' : '') . '">
					' . $__compilerTemp2 . '
				</div>
			';
		}
		$__compilerTemp1 .= '
			';
		if (!$__templater->test($__vars['headerHtml'], 'empty', array())) {
			$__finalCompiled .= '
			<div class="p-body-header">
				' . $__templater->filter($__vars['headerHtml'], array(array('raw', array()),), true) . '
			</div>
		';
		} else if (strlen(trim($__compilerTemp1)) > 0) {
			$__finalCompiled .= '
		<div class="p-body-header">
			' . $__compilerTemp1 . '
		</div>
		';
		}
		$__finalCompiled .= '	
		';
	} else {
		$__finalCompiled .= '
		<div class="xtr-message-block-text">
			<h1>' . $__templater->func('property', array('xtr_guestMessageBlockHeader', ), true) . ' ' . $__templater->escape($__vars['xf']['options']['boardTitle']) . '</h1>
			<h5>' . $__templater->func('property', array('xtr_guestMessageBlockContent', ), true) . '</h5>
			<div class="message-guest-button button-group-option" data-grouptype="OR">
				' . $__templater->button('Đăng nhập', array(
			'href' => $__templater->func('link', array('login', ), false),
			'icon' => 'user',
			'data-xf-click' => 'overlay',
			'data-follow-redirects' => 'on',
		), '', array(
		)) . '
				';
		if ($__vars['xf']['options']['registrationSetup']['enabled']) {
			$__finalCompiled .= '
					' . $__templater->button('Đăng ký', array(
				'href' => $__templater->func('link', array('register', ), false),
				'class' => 'button--cta',
				'icon' => 'add',
				'data-xf-click' => 'overlay',
				'data-follow-redirects' => 'on',
			), '', array(
			)) . '
				';
		}
		$__finalCompiled .= '
			</div>
		</div>	
	';
	}
	$__finalCompiled .= '
    </div>
	';
	if ($__templater->func('property', array('xtr_message_wave', ), false)) {
		$__finalCompiled .= '
		<div class="message-wave">
			<div class="divider-shape">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="shape-waves">
					<path class="shape-fill shape-fill-1" d="M790.5,93.1c-59.3-5.3-116.8-18-192.6-50c-29.6-12.7-76.9-31-100.5-35.9c-23.6-4.9-52.6-7.8-75.5-5.3c-10.2,1.1-22.6,1.4-50.1,7.4c-27.2,6.3-58.2,16.6-79.4,24.7c-41.3,15.9-94.9,21.9-134,22.6C72,58.2,0,25.8,0,25.8V100h1000V65.3c0,0-51.5,19.4-106.2,25.7C839.5,97,814.1,95.2,790.5,93.1z"></path>
				</svg>
			</div>
		</div>
	';
	}
	$__finalCompiled .= '
	';
	if ($__templater->func('property', array('xtr_message_block_bubble_animation', ), false)) {
		$__finalCompiled .= '
	<div class="bubble-animate">
		<div class="circle small square1"></div>
		<div class="circle small square2"></div>
		<div class="circle small square3"></div>
		<div class="circle small square4"></div>
		<div class="circle small square5"></div>
		<div class="circle medium square1"></div>
		<div class="circle medium square2"></div>
		<div class="circle medium square3"></div>
		<div class="circle medium square4"></div>
		<div class="circle medium square5"></div>
		<div class="circle large square1"></div>
		<div class="circle large square2"></div>
		<div class="circle large square3"></div>
		<div class="circle large square4"></div>
	</div>
	';
	}
	$__finalCompiled .= '
</div>';
	return $__finalCompiled;
});