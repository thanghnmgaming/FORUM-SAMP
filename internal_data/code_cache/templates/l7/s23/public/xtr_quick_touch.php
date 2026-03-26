<?php
// FROM HASH: 37205b2ba15ca1f1d7649128da23cf8a
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('xtr_quick_touch.less');
	$__finalCompiled .= '
<div id="quick-touch-page-content" class="quick-touch-section">
	<div class="p-quick-touch-inner container">
		';
	if ($__templater->func('property', array('xtr_quickTouchOneColumns', ), false)) {
		$__finalCompiled .= '
		<div class="quick-touch-block ask">
			<div class="quick-touch-body">
				<div class="quick-touch-content">
					<div class="quick-touch-icon-box-style">
						<div class="quick-touch_icon blue">
							<span class="quick-touch_crown">
								<span class="quick-touch_crown"><i class="' . $__templater->func('property', array('xtr_quickTouchOneColumnsIcon', ), true) . '"></i></span>
							</span>
						</div>
						<div class="icon-box-body">
						<h4>' . $__templater->func('property', array('xtr_quickTouchOneColumnsTitle', ), true) . '</h4>
							<p>' . $__templater->func('property', array('xtr_quickTouchOneColumnsContent', ), true) . '</p>	
						</div>
						<div class="icon-box-links">
							';
		if ($__vars['xf']['visitor']['user_id']) {
			$__finalCompiled .= '							
								';
			if (!$__templater->func('property', array('xtr_quickTouchFirstColumnsURL', ), false)) {
				$__finalCompiled .= '
								';
				if ($__templater->method($__vars['xf']['visitor'], 'canCreateThread', array())) {
					$__finalCompiled .= '
									' . $__templater->button('', array(
						'href' => $__templater->func('link', array('forums/create-thread', ), false),
						'class' => 'button--blue button',
						'icon' => 'write',
						'overlay' => 'true',
						'data-xf-init' => 'tooltip',
						'title' => $__templater->filter('Đăng chủ đề mới' . $__vars['xf']['language']['ellipsis'], array(array('for_attr', array()),), false),
					), '', array(
					)) . '
								';
				}
				$__finalCompiled .= '
								';
			} else {
				$__finalCompiled .= '
								' . $__templater->button('
								', array(
					'href' => $__templater->func('property', array('xtr_quickTouchFirstColumnsURL', ), false),
					'class' => 'button--blue',
					'icon' => 'write',
					'data-xf-init' => 'tooltip',
					'title' => $__templater->func('property', array('xtr_quickTouchFirstColumnsButtonName', ), false),
					'target' => $__templater->func('property', array('xtr_quickTouchSecondColumnsButtonOpen', ), false),
				), '', array(
				)) . '
								';
			}
			$__finalCompiled .= '
							';
		} else {
			$__finalCompiled .= '
								';
			if ($__vars['xf']['options']['registrationSetup']['enabled']) {
				$__finalCompiled .= '
									' . $__templater->button('
									', array(
					'href' => $__templater->func('link', array('register', ), false),
					'class' => 'button--register button',
					'icon' => 'write',
					'overlay' => 'true',
					'data-xf-click' => 'overlay',
					'data-follow-redirects' => 'on',
					'data-xf-init' => 'tooltip',
					'title' => $__templater->filter('Đăng ký', array(array('for_attr', array()),), false),
				), '', array(
				)) . '
								';
			}
			$__finalCompiled .= '	
							';
		}
		$__finalCompiled .= '
						</div>
					</div>
				</div>
			</div>	
		</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__templater->func('property', array('xtr_quickTouchSecondColumns', ), false)) {
		$__finalCompiled .= '
		<div class="quick-touch-block answer">
			<div class="quick-touch-body">
				<div class="quick-touch-content">
					<div class="quick-touch-icon-box-style">
						<div class="quick-touch_icon green">
							<span class="quick-touch_crown"><i class="' . $__templater->func('property', array('xtr_quickTouchSecondColumnsIcon', ), true) . '"></i></span>
						</div>
						<div class="icon-box-body">
						<h4>' . $__templater->func('property', array('xtr_quickTouchSecondColumnsTitle', ), true) . '</h4>
							<p>' . $__templater->func('property', array('xtr_quickTouchSecondColumnsContent', ), true) . '</p>
						</div>
						<div class="icon-box-links">
							';
		if (!$__templater->func('property', array('xtr_quickTouchSecondColumnsURL', ), false)) {
			$__finalCompiled .= '
								' . $__templater->button('', array(
				'href' => $__templater->func('link', array('whats-new/posts', ), false),
				'class' => 'button--green button',
				'icon' => 'bolt',
				'data-xf-init' => 'tooltip',
				'title' => $__templater->filter('Bài viết mới', array(array('for_attr', array()),), false),
			), '', array(
			)) . '
							';
		} else {
			$__finalCompiled .= '
								' . $__templater->button('
								', array(
				'href' => $__templater->func('property', array('xtr_quickTouchSecondColumnsURL', ), false),
				'class' => 'button--green button',
				'icon' => 'write',
				'data-xf-init' => 'tooltip',
				'title' => $__templater->func('property', array('xtr_quickTouchSecondColumnsButtonName', ), false),
				'target' => $__templater->func('property', array('xtr_quickTouchSecondColumnsButtonOpen', ), false),
			), '', array(
			)) . '
							';
		}
		$__finalCompiled .= '
						</div>
					</div>
				</div>
			</div>	
		</div>
		';
	}
	$__finalCompiled .= '
		';
	if ($__templater->func('property', array('xtr_quickTouchThirdColumns', ), false)) {
		$__finalCompiled .= '
		<div class="quick-touch-block expert">
			<div class="quick-touch-body">
				<div class="quick-touch-content">
					<div class="quick-touch-icon-box-style">
						<div class="quick-touch_icon red">
							<span class="quick-touch_crown"><i class="' . $__templater->func('property', array('xtr_quickTouchThirdColumnsIcon', ), true) . '"></i></span>
						</div>
						<div class="icon-box-body">
						<h4>' . $__templater->func('property', array('xtr_quickTouchThirdColumnsTitle', ), true) . '</h4>
							<p>' . $__templater->func('property', array('xtr_quickTouchThirdColumnsContent', ), true) . '</p>
						</div>
						<div class="icon-box-links">
							';
		if (!$__templater->func('property', array('xtr_quickTouchThirdColumnsURL', ), false)) {
			$__finalCompiled .= '
							';
			if ($__templater->method($__vars['xf']['visitor'], 'canUseContactForm', array())) {
				$__finalCompiled .= '
								';
				if ($__vars['xf']['contactUrl']) {
					$__finalCompiled .= '	
									' . $__templater->button('
									', array(
						'href' => $__vars['xf']['contactUrl'],
						'data-xf-click' => (($__vars['xf']['options']['contactUrl']['overlay'] OR ($__vars['xf']['options']['contactUrl']['type'] == 'default')) ? 'overlay' : ''),
						'class' => 'button--red button',
						'icon' => 'reply',
						'data-xf-init' => 'tooltip',
						'title' => $__templater->filter('Liên hệ', array(array('for_attr', array()),), false),
					), '', array(
					)) . '	
								';
				}
				$__finalCompiled .= '
							';
			}
			$__finalCompiled .= '
							';
		} else {
			$__finalCompiled .= '	
								' . $__templater->button('
								', array(
				'href' => $__templater->func('property', array('xtr_quickTouchThirdColumnsURL', ), false),
				'class' => 'button--red button',
				'icon' => 'write',
				'data-xf-init' => 'tooltip',
				'title' => $__templater->func('property', array('xtr_quickTouchThirdColumnsButtonName', ), false),
				'target' => $__templater->func('property', array('xtr_quickTouchThirdColumnsButtonOpen', ), false),
			), '', array(
			)) . '						
							';
		}
		$__finalCompiled .= '
						</div>
					</div>
				</div>
			</div>	
		</div>
		';
	}
	$__finalCompiled .= '
	</div>
</div>';
	return $__finalCompiled;
});