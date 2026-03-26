<?php
// FROM HASH: 49348ac74616fb8a7cd0f22517fb497d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<div class="node-body">
    <span class="node-icon" aria-hidden="true"><i></i></span>
    <div class="node-main js-nodeMain">
        ';
	if ($__vars['chooseName']) {
		$__finalCompiled .= '
            ' . $__templater->formCheckBox(array(
			'standalone' => 'true',
		), array(array(
			'labelclass' => 'u-pullRight',
			'class' => 'js-chooseItem',
			'name' => $__vars['chooseName'] . '[]',
			'value' => $__vars['node']['node_id'],
			'_type' => 'option',
		))) . '
        ';
	}
	$__finalCompiled .= '

        ';
	$__vars['descriptionDisplay'] = $__templater->func('property', array('nodeListDescriptionDisplay', ), false);
	$__finalCompiled .= '
        <h3 class="node-title">
			<a href="' . $__templater->func('link', array('forums', $__vars['node'], ), true) . '" data-xf-init="' . (($__vars['descriptionDisplay'] == 'tooltip') ? 'element-tooltip' : '') . '" data-shortcut="node-description">' . $__templater->escape($__vars['node']['title']) . '</a>
		</h3>
        ';
	if (($__vars['descriptionDisplay'] != 'none') AND $__vars['node']['description']) {
		$__finalCompiled .= '
			<div class="node-description ' . (($__vars['descriptionDisplay'] == 'tooltip') ? 'node-description--tooltip js-nodeDescTooltip' : '') . '">' . $__templater->filter($__vars['node']['description'], array(array('raw', array()),), true) . '</div>
        ';
	}
	$__finalCompiled .= '

        <div class="node-meta">
            ';
	if (!$__vars['extras']['privateInfo']) {
		$__finalCompiled .= '
                <div class="node-statsMeta">
                    <dl class="pairs pairs--inline">
                        <dt>' . 'Threads' . '</dt>
                        <dd>' . $__templater->filter($__vars['extras']['discussion_count'], array(array('number_short', array(1, )),), true) . '</dd>
                    </dl>
                    <dl class="pairs pairs--inline">
                        <dt>' . 'Messages' . '</dt>
                        <dd>' . $__templater->filter($__vars['extras']['message_count'], array(array('number_short', array(1, )),), true) . '</dd>
                    </dl>
                </div>
            ';
	}
	$__finalCompiled .= '

            ';
	if (($__vars['depth'] == 2) AND ($__templater->func('property', array('nodeListSubDisplay', ), false) == 'menu')) {
		$__finalCompiled .= '
                ' . $__templater->callMacro('forum_list', 'sub_nodes_menu', array(
			'children' => $__vars['children'],
			'childExtras' => $__vars['childExtras'],
			'depth' => ($__vars['depth'] + 1),
		), $__vars) . '
            ';
	}
	$__finalCompiled .= '
        </div>

        ';
	if (($__vars['depth'] == 2) AND ($__templater->func('property', array('nodeListSubDisplay', ), false) == 'flat')) {
		$__finalCompiled .= '
            ' . $__templater->callMacro('forum_list', 'sub_nodes_flat', array(
			'children' => $__vars['children'],
			'childExtras' => $__vars['childExtras'],
			'depth' => ($__vars['depth'] + 1),
		), $__vars) . '
        ';
	}
	$__finalCompiled .= '

        ';
	if (!$__templater->test($__vars['bonusInfo'], 'empty', array())) {
		$__finalCompiled .= '
            <div class="node-bonus">' . $__templater->escape($__vars['bonusInfo']) . '</div>
        ';
	}
	$__finalCompiled .= '
    </div>
	
	<div class="node-extra">
        ';
	if ($__vars['extras']['privateInfo']) {
		$__finalCompiled .= '
            <span class="node-extra-placeholder">' . 'Private' . '</span>
            ';
	} else if ($__vars['extras']['LastThread']) {
		$__finalCompiled .= '
            <div class="node-extra-icon">
                ';
		if ($__templater->method($__vars['xf']['visitor'], 'isIgnoring', array($__vars['extras']['last_post_user_id'], ))) {
			$__finalCompiled .= '
                    ' . $__templater->func('avatar', array(null, 'xs', false, array(
			))) . '
                    ';
		} else {
			$__finalCompiled .= '
                    ' . $__templater->func('avatar', array($__vars['extras']['LastPostUser'], 'xs', false, array(
				'defaultname' => $__vars['extras']['last_post_username'],
			))) . '
                ';
		}
		$__finalCompiled .= '
            </div>
            <div class="node-extra-row">
                ';
		if ($__templater->method($__vars['extras']['LastThread'], 'isUnread', array())) {
			$__finalCompiled .= '
                    <a href="' . $__templater->func('link', array('threads/unread', $__vars['extras']['LastThread'], ), true) . '" class="node-extra-title" title="' . $__templater->escape($__vars['extras']['LastThread']['title']) . '">' . $__templater->func('prefix', array('thread', $__vars['extras']['LastThread'], ), true) . $__templater->escape($__vars['extras']['LastThread']['title']) . '</a>
                    ';
		} else {
			$__finalCompiled .= '
                    <a href="' . $__templater->func('link', array('threads/post', $__vars['extras']['LastThread'], array('post_id' => $__vars['extras']['last_post_id'], ), ), true) . '" class="node-extra-title" title="' . $__templater->escape($__vars['extras']['LastThread']['title']) . '">' . $__templater->func('prefix', array('thread', $__vars['extras']['LastThread'], ), true) . $__templater->escape($__vars['extras']['LastThread']['title']) . '</a>
                ';
		}
		$__finalCompiled .= '
            </div>
            <div class="node-extra-row">
				<ul class="listInline listInline--bullet">
					<li>' . $__templater->func('date_dynamic', array($__vars['extras']['last_post_date'], array(
			'class' => 'node-extra-date',
		))) . '</li>
					';
		if ($__templater->method($__vars['xf']['visitor'], 'isIgnoring', array($__vars['extras']['last_post_user_id'], ))) {
			$__finalCompiled .= '
						<li class="node-extra-user">' . 'Ignored member' . '</li>
					';
		} else {
			$__finalCompiled .= '
						<li class="node-extra-user">' . $__templater->func('username_link', array($__vars['extras']['LastPostUser'], false, array(
				'defaultname' => $__vars['extras']['last_post_username'],
			))) . '</li>
					';
		}
		$__finalCompiled .= '
				</ul>
            </div>
		';
	} else {
		$__finalCompiled .= '
            <span class="node-extra-placeholder">' . 'None' . '</span>
        ';
	}
	$__finalCompiled .= '
    </div>

    ';
	if (!$__vars['extras']['privateInfo']) {
		$__finalCompiled .= '
		<div class="node-stats">
			<div class="node-threads">
				<div class="node-stats-bg" data-xf-init="tooltip" title="' . 'Threads' . '">				
					' . $__templater->filter($__vars['extras']['discussion_count'], array(array('number_short', array(1, )),), true) . '
					<div class="stats-mark"></div>
				</div>
			</div>
			<div class="node-messages" data-xf-init="tooltip" title="' . 'Messages' . '"><i class="fas fa-comment-dots"></i> ' . $__templater->filter($__vars['extras']['message_count'], array(array('number_short', array(1, )),), true) . '</div>
		</div>
    ';
	}
	$__finalCompiled .= '
</div>';
	return $__finalCompiled;
});