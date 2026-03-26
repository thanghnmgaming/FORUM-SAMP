<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs\Admin\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Param;
use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Tab extends AbstractController
{
    public function actionIndex()
    {
        $viewParams = [
            'tabs' => $this->finder('XFA\ForumTabs:Tab')->fetch()
        ];
        return $this->view('', 'xfa_ft_tabs_list', $viewParams);
    }

    public function actionAdd()
    {
        $tab = $this->em()->create('XFA\ForumTabs:Tab');

        return $this->tabAddEdit($tab);
    }

    public function actionEdit(ParameterBag $params)
    {
        $tab = $this->assertTabExists($params->tab_id);
        return $this->tabAddEdit($tab);
    }

    public function tabAddEdit(\XFA\ForumTabs\Entity\Tab $tab)
    {
        /** @var \XF\Repository\Node $nodeRepo */
        $nodeRepo = \XF::repository('XF:Node');
        $nodeTree = $nodeRepo->createNodeTree($nodeRepo->getFullNodeList());

        $viewParams = [
            'nodeTree'      => $nodeTree,
            'tab'           => $tab,
            'userGroups'    => $this->em()->getRepository('XF:UserGroup')->getUserGroupTitlePairs()
        ];

        return $this->view('', 'xfa_ft_tab_edit', $viewParams);
    }

    protected function tabSaveProcess(\XFA\ForumTabs\Entity\Tab $tab)
    {
        $entityInput = $this->filter([
            'title'         => 'str',
            'icon'          => 'str',
            'order'         => 'uint',
            'category_ids'  => 'array-uint',
            'usergroups'    => 'array-uint'
        ]);

        $form = $this->formAction();
        $form->basicEntitySave($tab, $entityInput);

        return $form;
    }

    public function actionSave(ParameterBag $params)
    {
        $this->assertPostOnly();

        if ($params->tab_id)
        {
            $tab = $this->assertTabExists($params->tab_id);
        }
        else
        {
            $tab = $this->em()->create('XFA\ForumTabs:Tab');
        }

        $this->tabSaveProcess($tab)->run();

        return $this->redirect(
            $this->buildLink('nodes-tab') . $this->buildLinkHash($tab->getEntityId())
        );
    }

    public function actionDelete(ParameterBag $params)
    {
        $tab = $this->assertTabExists($params->tab_id);

        if ($this->isPost())
        {
            $tab->delete();

            return $this->redirect(
                $this->buildLink('nodes-tab')
            );
        }
        else
        {
            $viewParams = [
                'tab' => $tab,
            ];

            return $this->view('', 'xfa_ft_tab_delete', $viewParams);

        }
    }

    protected function assertTabExists($id, $with = null, $phraseKey = null)
    {
        return $this->assertRecordExists('XFA\ForumTabs:Tab', $id, $with, $phraseKey);
    }
}