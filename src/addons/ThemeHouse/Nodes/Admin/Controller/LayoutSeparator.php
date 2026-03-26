<?php

namespace ThemeHouse\Nodes\Admin\Controller;

use XF\Admin\Controller\AbstractNode;
use XF\Entity\Node;
use XF\Mvc\FormAction;
use XF\Mvc\Reply\View;

/**
 * Class LayoutSeparator
 * @package ThemeHouse\Nodes\Admin\Controller
 */
class LayoutSeparator extends AbstractNode
{
    /**
     * @return string
     */
    protected function getNodeTypeId()
    {
        return 'LayoutSeparator';
    }

    /**
     * @return string
     */
    protected function getDataParamName()
    {
        return 'layoutSeparator';
    }

    /**
     * @return string
     */
    protected function getTemplatePrefix()
    {
        return 'th_layoutSeparator_nodes';
    }

    /**
     * @return string
     */
    protected function getViewClassPrefix()
    {
        return 'ThemeHouse\Nodes:LayoutSeparator';
    }

    /**
     * @param Node $node
     * @return View
     */
    protected function nodeAddEdit(Node $node)
    {
        $response = parent::nodeAddEdit($node);

        if ($response instanceof View) {
            /** @var \ThemeHouse\Nodes\Repository\NodeStyling $nodeStyleRepo */
            $nodeStyleRepo = $this->repository('ThemeHouse\Nodes:NodeStyling');

            if ($node->isInsert()) {
                $nodeStyling = $nodeStyleRepo->getNodeStylingForDefault(0);
            } else {
                /** @var \ThemeHouse\Nodes\XF\Entity\Node $node */
                $nodeStyling = $node->getNodeStylingForStyle(0);
            }

            if (!$nodeStyling) {
                $nodeStyling = $nodeStyleRepo->getDefaultNodeStylingForNode($node, 0);
            }

            $response->setParams([
                'nodeStyling' => $nodeStyling,
            ]);
        }

        return $response;
    }

    /**
     * @param Node $node
     * @return FormAction
     */
    protected function nodeSaveProcess(Node $node)
    {
        $form = parent::nodeSaveProcess($node);

        $form->complete(function () {
            /** @var \ThemeHouse\Nodes\Repository\NodeStyling $nodeStyleRepo */
            $nodeStyleRepo = $this->repository('ThemeHouse\Nodes:NodeStyling');
            $nodeStyleRepo->rebuildNodeStylingCache();
        });

        return $form;
    }

    /**
     * @param FormAction $form
     * @param Node $node
     * @param \XF\Entity\AbstractNode $data
     */
    protected function saveTypeData(FormAction $form, Node $node, \XF\Entity\AbstractNode $data)
    {
        $input = $this->filter([
            'separator_type' => 'string',
            'separator_max_width' => 'uint',
        ]);

        /** @var \XF\Entity\Forum $data */
        $data->bulkSet($input);

        $gridOptions = $this->filter('grid_options', 'array');
        $form->complete(function () use ($data, $gridOptions) {
            /** @var \ThemeHouse\Nodes\Repository\NodeStyling $nodeStyleRepo */
            $nodeStyleRepo = $this->repository('ThemeHouse\Nodes:NodeStyling');

            if ($data->isInsert()) {
                $nodeStyling = $nodeStyleRepo->getNodeStylingForDefault(0);
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                $nodeStyling = $data->Node->getNodeStylingForStyle(0);
            }

            if (!$nodeStyling) {
                $nodeStyling = $nodeStyleRepo->getDefaultNodeStylingForNode($data->Node, 0);
            }

            $nodeStyling->grid_options = $gridOptions;

            $nodeStyling->save();

            $nodeStyleRepo->rebuildNodeStylingCache();
        });
    }
}
