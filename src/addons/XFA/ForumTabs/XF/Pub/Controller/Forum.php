<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

class Forum extends XFCP_Forum
{
    public function actionList(ParameterBag $params)
    {
        $reply = parent::actionList($params);

        if ($reply instanceof \XF\Mvc\Reply\View
            && $reply->getParam('nodeTree')
            && !(\XF::visitor()->hasPermission('general', 'disableTabbedForumList')
                    && \XF::visitor()->xfa_ft_disable))
        {
            /* Get tabs */
            $tabs = $this->repository('XFA\ForumTabs:Tab')->getTabsList();

            if (!$tabs->count())
            {
                return $reply;
            }

            $nodeTree = $reply->getParam('nodeTree');

            /* Go through tabs to add nodes */
            $tabsNodeTrees = [];
            foreach ($tabs AS &$tab)
            {
                $GLOBALS['xfaFtTab'] = $tab;
                $tabsNodeTrees[$tab->tab_id] = $nodeTree->filter(null, function($id, \XF\Entity\Node $node, $depth, $children, \XF\Tree $tree)
                {
                    if ($depth > 0)
                    {
                        return true;
                    }

                    if ($node->node_type_id == 'Category' && in_array($node->node_id, $GLOBALS['xfaFtTab']->category_ids))
                    {
                        return true;
                    }
                    return false;
                });
            }

            $selfRoute = ($this->options()->forumsDefaultPage == 'forums' ? 'forums' : 'forums/list');

            $request = \XF::app()->container('request');
            $selectedTabId  = $request->getCookie('xfaForumTabsSelectedTabId');

            $viewParams = [
                'isTabbed'      => 1,
                'tabs'          => $tabs,
                'tabsNodeTrees' => $tabsNodeTrees,
                'nodeExtras'    => $reply->getParam('nodeExtras'),
                'selfRoute'     => $selfRoute,
                'selectedTabId' => $selectedTabId
            ];

            return $this->view('XF:Forum\Listing', 'forum_list', $viewParams);
        }

        return $reply;
    }
}