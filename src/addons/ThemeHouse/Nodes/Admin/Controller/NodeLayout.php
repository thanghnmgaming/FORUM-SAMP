<?php

namespace ThemeHouse\Nodes\Admin\Controller;

use ThemeHouse\Nodes\Entity\NodeStyling;
use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

/**
 * Class NodeLayout
 * @package ThemeHouse\Nodes\Admin\Controller
 */
class NodeLayout extends AbstractController
{
    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Reroute|\XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionIndex(ParameterBag $params)
    {
        if ($params['node_id']) {
            return $this->rerouteController(__CLASS__, 'node', $params);
        }
        $styleId = $this->filter('style_id', 'uint');
        $style = $this->assertStyleExists($styleId);

        $nodeRepo = $this->getNodeRepo();
        $nodeTree = $nodeRepo->createNodeTree(
            $nodeRepo->getFullNodeList(null, ['NodeType', 'NodeStyling|' . $styleId])
        );

        /** @var \XF\Repository\StyleProperty $stylePropertyRepo */
        $stylePropertyRepo = $this->repository('XF:StyleProperty');
        $styleProperty = $stylePropertyRepo->getEffectivePropertyInStyle($style, 'th_enableStyling_nodes');

        $viewParams = [
            'nodeTree' => $nodeTree,

            'styleTree' => $this->getStyleRepo()->getStyleTree(),
            'style' => $style,
            'enabled' => $styleProperty ? $styleProperty->property_value : false
        ];
        return $this->view('ThemeHouse\Nodes:NodeLayout\Index', 'thnodes_node_layout', $viewParams);
    }

    /**
     * @param string $id
     * @param array|string|null $with
     * @param null|string $phraseKey
     *
     * @return \XF\Entity\Style|\XF\Mvc\Entity\Entity
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function assertStyleExists($id, $with = null, $phraseKey = null)
    {
        if ($id === 0 || $id === "0") {
            return $this->getStyleRepo()->getMasterStyle();
        }

        return $this->assertRecordExists('XF:Style', $id, $with, $phraseKey);
    }

    /**
     * @return \XF\Mvc\Entity\Repository|\XF\Repository\Style
     */
    protected function getStyleRepo()
    {
        return $this->repository('XF:Style');
    }

    /**
     * @return \XF\Mvc\Entity\Repository|\XF\Repository\Node
     */
    protected function getNodeRepo()
    {
        return $this->repository('XF:Node');
    }

    /**
     * @throws \XF\Mvc\Reply\Exception
     * @throws \XF\PrintableException
     */
    public function actionToggle()
    {
        $styleId = $this->filter('style_id', 'uint');
        $style = $this->assertStyleExists($styleId);

        /** @var \XF\Repository\StyleProperty $stylePropertyRepo */
        $stylePropertyRepo = $this->repository('XF:StyleProperty');
        $styleProperty = $stylePropertyRepo->getEffectivePropertyInStyle($style, 'th_enableStyling_nodes');
        $previousValue = $styleProperty->property_value;
        $newValue = !$previousValue;

        if ($styleProperty->style_id != $styleId) {
            $newProperty = $this->em()->create('XF:StyleProperty');
            $data = $styleProperty->toArray();
            unset($data['property_id']);
            $data['style_id'] = $styleId;
            $newProperty->bulkSet($data);
            $styleProperty = $newProperty;
        }

        $styleProperty->property_value = $newValue;
        $styleProperty->save();

        $nodeStyleRepo = $this->getNodeStyleRepo();
        $nodeStyleRepo->rebuildNodeStylingCache();

        return $this->redirect($this->buildLink('node-layout', null, ['style_id' => $styleId]));
    }

    /**
     * @return \ThemeHouse\Nodes\Repository\NodeStyling|\XF\Mvc\Entity\Repository
     */
    protected function getNodeStyleRepo()
    {
        return $this->repository('ThemeHouse\Nodes:NodeStyling');
    }

    /**
     * @return \XF\Mvc\Reply\Redirect
     * @throws \XF\PrintableException
     */
    public function actionRebuild()
    {
        $nodeStyleRepo = $this->getNodeStyleRepo();
        $nodeStyleRepo->rebuildNodeStylingCache();

        return $this->redirect($this->buildLink('node-layout'));
    }

    /**
     *
     */
    public function actionViewCache()
    {
        /** @var \XF\DataRegistry $registry */
        $registry = $this->app->registry();

        $styleIds = $this->finder('XF:Style')->fetch()->keys();

        $cache = [];
        foreach ($styleIds as $styleId) {
            $cache[$styleId] = $registry->get("th_nodeStyling_nodes_{$styleId}");
        }
        \XF::dump($cache);
        die;
    }

    /**
     * @return \XF\Mvc\Reply\Reroute
     */
    public function actionDefaultGrid()
    {
        return $this->rerouteController(__CLASS__, 'node');
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionNode(ParameterBag $params)
    {
        $nodeStyleRepo = $this->getNodeStyleRepo();
        $nodeId = $params['node_id'];

        $styleId = $this->filter('style_id', 'uint');

        if ($nodeId) {
            list($node, $style) = $this->assertNodeAndStyleExists($nodeId, $styleId);
            $nodeStyling = $node->getNodeStylingForStyle($styleId);
        } else {
            $style = $this->assertStyleExists($styleId);
            $node = null;
            $nodeStyling = $nodeStyleRepo->getNodeStylingForDefault($styleId);
        }


        if (!$nodeStyling) {
            $nodeStyling = $nodeStyleRepo->getDefaultNodeStylingForNode($node, $styleId);
        }

        $viewParams = [
            'node' => $node,

            'styleTree' => $this->getStyleRepo()->getStyleTree(),
            'style' => $style,

            'nodeStyling' => $nodeStyling,
        ];

        return $this->view('ThemeHouse\Nodes:NodeLayout:Edit', 'th_node_layout_edit_nodes', $viewParams);
    }

    public function actionRevert(ParameterBag $params)
    {
        $nodeStyleRepo = $this->getNodeStyleRepo();
        $nodeId = $params['node_id'];

        $styleId = $this->filter('style_id', 'uint');

        if ($nodeId) {
            list($node, $style) = $this->assertNodeAndStyleExists($nodeId, $styleId);
            $nodeStyling = $node->getNodeStylingForStyle($styleId);
        } else {
            $style = $this->assertStyleExists($styleId);
            $node = null;
            $nodeStyling = $nodeStyleRepo->getNodeStylingForDefault($styleId);
        }

        if($this->isPost()) {
            $nodeStyling->delete();
            return $this->redirect($this->buildLink('node-layout'));
        }
        else {
            $viewParams = [
                'node' => $node,
                'styleId' => $styleId,
                'nodeId' => $nodeId,
                'nodeStyling' => $nodeStyling
            ];

            return $this->view('ThemeHouse\Nodes:NodeLayout\Revert', 'thnodes_node_layout_revert', $viewParams);
        }
    }

    /**
     * @param $nodeId
     * @param $styleId
     * @return array
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function assertNodeAndStyleExists($nodeId, $styleId)
    {
        $node = $this->assertNodeExists($nodeId);
        $style = $this->assertStyleExists($styleId);

        return [$node, $style];
    }

    /**
     * @param string $id
     * @param array|string|null $with
     * @param null|string $phraseKey
     *
     * @return \XF\Entity\Node
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function assertNodeExists($id, $with = null, $phraseKey = null)
    {
        if (!is_array($with)) {
            $with = $with ? [$with] : [];
        }
        $with[] = 'NodeType';

        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->assertRecordExists('XF:Node', $id, $with, $phraseKey);
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect
     * @throws \XF\Mvc\Reply\Exception
     * @throws \XF\PrintableException
     */
    public function actionSave(ParameterBag $params)
    {
        $this->assertPostOnly();

        $nodeStyleRepo = $this->getNodeStyleRepo();

        $nodeId = $params['node_id'];
        $styleId = $this->filter('style_id', 'uint');

        if ($nodeId) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            list($node, $style) = $this->assertNodeAndStyleExists($nodeId, $styleId);
            $nodeStyling = $node->getNodeStylingForStyle($styleId);
        } else {
            $this->assertStyleExists($styleId);
            $node = null;
            $nodeStyling = $nodeStyleRepo->getNodeStylingForDefault($styleId);
        }

        if (!$nodeStyling) {
            /** @var \ThemeHouse\Nodes\Entity\NodeStyling $nodeStyling */
            $nodeStyling = $nodeStyleRepo->getDefaultNodeStylingForNode($node, $styleId);
        }

        $this->nodeStylingSaveProcess($nodeStyling)->run();

        $nodeStyleRepo->rebuildNodeStylingCache();

        return $this->redirect($this->buildLink('node-layout', '', [
            'style_id' => $styleId,
        ]));
    }

    /**
     * @param NodeStyling $nodeStyling
     * @return \XF\Mvc\FormAction
     */
    protected function nodeStylingSaveProcess(NodeStyling $nodeStyling)
    {
        $form = $this->formAction();

        $input = $this->filter([
            'styling_options' => 'array',
            'grid_options' => 'array',
        ]);

        $form->basicEntitySave($nodeStyling, $input);

        return $form;
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionCopy(ParameterBag $params)
    {
        $nodeId = $params['node_id'];
        $styleId = $this->filter('style_id', 'uint');

        if (!$nodeId) {
            return $this->notFound();
        }

        list($selectedNode, $style) = $this->assertNodeAndStyleExists($nodeId, $styleId);

        if ($this->isPost()) {
            $this->app->jobManager()->enqueueUnique('thNodes_nodeStylingCopy', 'ThemeHouse\Nodes:NodeStylingCopy', [
                'nodeId' => $nodeId,
                'styleId' => $styleId,
                'nodeIds' => $this->filter('node_ids', 'array'),
            ]);

            return $this->redirect($this->buildLink('node-layout', null, ['style_id' => $styleId, 'success' => true]));
        }

        $nodeRepo = $this->getNodeRepo();
        $nodeTree = $nodeRepo->createNodeTree(
            $nodeRepo->getFullNodeList(null, ['NodeType', 'NodeStyling|' . $styleId])
        );

        $viewParams = [
            'selectedNode' => $selectedNode,
            'nodeTree' => $nodeTree,
            'style' => $style,
        ];
        return $this->view('ThemeHouse\Nodes:NodeLayout\Copy', 'thnodes_node_layout_copy', $viewParams);
    }
}
