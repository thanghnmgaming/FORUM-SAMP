<?php
// FROM HASH: a6d3aaeeca421d03a102fbe2d3b10aaf
return array('macros' => array('footerWidgets' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'block' => $__vars['block'],
	), $__arguments, $__vars);
	$__finalCompiled .= '
	';
	$__vars['blockId'] = $__templater->func('property', array('xtr_extra_footer_column' . $__vars['block'], ), false);
	$__finalCompiled .= '
		';
	if ($__vars['blockId'] == 'custom') {
		$__finalCompiled .= '
		<div class="block-container">
			<div class="block">
				<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon' . $__vars['block'], ), true) . '"></i>' . $__templater->func('property', array('xtr_extra_footer_column_title' . $__vars['block'], ), true) . '</h3>
				<div class="block-body block-row">
					' . $__templater->func('property', array('xtr_extra_footer_column_content' . $__vars['block'], ), true) . '
				</div>
			</div>	
		</div>
		';
	} else if ($__vars['blockId'] == 'socialicons') {
		$__finalCompiled .= '
			<div class="block-container">
				' . $__templater->includeTemplate('xtr_social_icons', $__vars) . '
			</div>	
			';
	} else if ($__vars['blockId'] == 'whatsNewLinks') {
		$__finalCompiled .= '
				' . $__templater->callMacro(null, 'whatsNewLinks', array(), $__vars) . '
			';
	} else if ($__vars['blockId'] == 'ForumStatistics') {
		$__finalCompiled .= '
				' . $__templater->renderWidget('XF\\Widget\\ForumStatistics', array(), array()) . '
			';
	} else if ($__vars['blockId'] == 'OnlineStatistics') {
		$__finalCompiled .= '
				' . $__templater->renderWidget('XF\\Widget\\OnlineStatistics', array(), array()) . '
			';
	} else if ($__vars['blockId'] == 'sharePage') {
		$__finalCompiled .= '
				' . $__templater->renderWidget('forum_overview_share_page', array(), array()) . '
		';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
},
'whatsNewLinks' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(), $__arguments, $__vars);
	$__finalCompiled .= '
	<div class="block-container">
		<div class="block">
			<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon' . $__vars['block'], ), true) . '"></i><i class="fas fa-bolt"></i> ' . 'What\'s new' . '</h3>
			<div class="block-body block-row">
				' . '
				<div class="blockLink"><i class="fas fa-caret-right"></i> <a class="' . $__templater->escape($__vars['baseClass']) . ' ' . (($__vars['pageSelected'] == 'new_thread') ? $__templater->escape($__vars['selectedClass']) : '') . '" href="' . $__templater->func('link', array('whats-new/posts', ), true) . '" rel="nofollow">' . 'New posts' . '</a></div>
				' . '
				';
	if ($__templater->method($__vars['xf']['visitor'], 'canViewProfilePosts', array())) {
		$__finalCompiled .= '
					<div class="blockLink"><i class="fas fa-caret-right"></i> <a class="' . $__templater->escape($__vars['baseClass']) . ' ' . (($__vars['pageSelected'] == 'new_profile_post') ? $__templater->escape($__vars['selectedClass']) : '') . '" href="' . $__templater->func('link', array('whats-new/profile-posts', ), true) . '" rel="nofollow">' . 'New profile posts' . '</a></div>
				';
	}
	$__finalCompiled .= '
				' . '
				';
	if ($__vars['xf']['options']['enableNewsFeed']) {
		$__finalCompiled .= '
					';
		if ($__vars['xf']['visitor']['user_id']) {
			$__finalCompiled .= '
						<div class="blockLink"><i class="fas fa-caret-right"></i> <a class="' . $__templater->escape($__vars['baseClass']) . ' ' . (($__vars['pageSelected'] == 'news_feed') ? $__templater->escape($__vars['selectedClass']) : '') . '" href="' . $__templater->func('link', array('whats-new/news-feed', ), true) . '" rel="nofollow">' . 'Your news feed' . '</a></div>
					';
		}
		$__finalCompiled .= '

					<div class="blockLink"><i class="fas fa-caret-right"></i> <a class="' . $__templater->escape($__vars['baseClass']) . ' ' . (($__vars['pageSelected'] == 'latest_activity') ? $__templater->escape($__vars['selectedClass']) : '') . '" href="' . $__templater->func('link', array('whats-new/latest-activity', ), true) . '" rel="nofollow">' . 'Latest activity' . '</a></div>
				';
	}
	$__finalCompiled .= '
			</div>		
		</div>	
	</div>
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('xtr_extra_footer.less');
	$__finalCompiled .= '

<div class="xtr-extra-footer">
	<div class="p-footer-inner">
		<div class="xtr-extra-footer-row">
			';
	if ($__templater->func('property', array('xtr_enable_extra_footer_column1', ), false)) {
		$__finalCompiled .= '
				<div class="block box xtr-aboutUs">
					';
		if ($__vars['blockId'] == 'custom') {
			$__finalCompiled .= '
						<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon1', ), true) . '"></i> ' . $__templater->func('property', array('xtr_extra_footer_column_title1', ), true) . '</h3>
						<ul class="block-body">
							' . $__templater->func('property', array('xtr_extra_footer_column1_content', ), true) . '
						</ul>
					';
		} else {
			$__finalCompiled .= '
						' . $__templater->callMacro(null, 'footerWidgets', array(
				'block' => '1',
			), $__vars) . '
					';
		}
		$__finalCompiled .= '
				</div>
			';
	}
	$__finalCompiled .= '

			';
	if ($__templater->func('property', array('xtr_enable_extra_footer_column2', ), false)) {
		$__finalCompiled .= '
				<div class="block box xtr-navigation">
					';
		if ($__vars['blockId'] == 'custom') {
			$__finalCompiled .= '
						<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon2', ), true) . '"></i> ' . $__templater->func('property', array('xtr_extra_footer_column_title2', ), true) . '</h3>
						<div class="block-body block-row">
							';
			if ($__vars['xf']['options']['homePageUrl']) {
				$__finalCompiled .= '
								<div class="blockLink"><a class="' . $__templater->escape($__vars['baseClass']) . '" href="' . $__templater->escape($__vars['xf']['options']['homePageUrl']) . '">' . 'Home' . '</a></div>
							';
			}
			$__finalCompiled .= '
							<div class="blockLink"><a class="' . $__templater->escape($__vars['baseClass']) . '" href="' . $__templater->func('link', array('forums', ), true) . '">' . 'Forums' . '</a></div>
							<div class="blockLink"><a class="' . $__templater->escape($__vars['baseClass']) . '" href="' . $__templater->func('link', array('whats-new/posts', ), true) . '">' . 'New posts' . '</a></div>
						</div>
					';
		} else {
			$__finalCompiled .= '
						' . $__templater->callMacro(null, 'footerWidgets', array(
				'block' => '2',
			), $__vars) . '
					';
		}
		$__finalCompiled .= '
				</div>
			';
	}
	$__finalCompiled .= '

			';
	if ($__templater->func('property', array('xtr_enable_extra_footer_column3', ), false)) {
		$__finalCompiled .= '
				<div class="block box xtr-user-navigation">
					';
		if ($__vars['blockId'] == 'custom') {
			$__finalCompiled .= '
						<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon3', ), true) . '"></i> ' . $__templater->func('property', array('xtr_extra_footer_column_title3', ), true) . '</h3>
					';
		} else {
			$__finalCompiled .= '
						' . $__templater->callMacro(null, 'footerWidgets', array(
				'block' => '3',
			), $__vars) . '
					';
		}
		$__finalCompiled .= '
				</div>
			';
	}
	$__finalCompiled .= '

			';
	if ($__templater->func('property', array('xtr_enable_extra_footer_column4', ), false)) {
		$__finalCompiled .= '
				<div class="block box xtr-user-navigation">
					';
		if ($__vars['blockId'] == 'custom') {
			$__finalCompiled .= '
						<h3 class="block-minorHeader"><i class="' . $__templater->func('property', array('xtr_extra_footer_column_icon4', ), true) . '"></i> ' . $__templater->func('property', array('xtr_extra_footer_column_title4', ), true) . '</h3>
					';
		} else {
			$__finalCompiled .= '
						' . $__templater->callMacro(null, 'footerWidgets', array(
				'block' => '4',
			), $__vars) . '
					';
		}
		$__finalCompiled .= '
				</div>
			';
	}
	$__finalCompiled .= '
		</div>
	</div>
</div>

' . '


';
	return $__finalCompiled;
});