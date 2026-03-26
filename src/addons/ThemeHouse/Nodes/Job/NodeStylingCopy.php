<?php

namespace ThemeHouse\Nodes\Job;

use ThemeHouse\Nodes\Repository\NodeStyling;
use ThemeHouse\Nodes\XF\Entity\Node;
use XF\Job\AbstractJob;

/**
 * Class NodeStylingCopy
 * @package ThemeHouse\Nodes\Job
 */
class NodeStylingCopy extends AbstractJob
{
    /**
     * @var array
     */
    protected $defaultData = [
        'start' => 0,
        'count' => 0,
        'nodeId' => null,
        'styleId' => null,
        'nodeIds' => null,
    ];

    /**
     * @param int $maxRunTime
     * @return \XF\Job\JobResult
     * @throws \XF\PrintableException
     */
    public function run($maxRunTime)
    {
        $startTime = microtime(true);

        $ids = $this->prepareNodeIds();
        if (!$ids) {
            return $this->complete();
        }

        $db = $this->app->db();
        $db->beginTransaction();

        /** @var Node $selectedNode */
        $selectedNode = \XF::em()->find('XF:Node', $this->data['nodeId']);
        if (!$selectedNode) {
            return $this->complete();
        }

        $styleId = $this->data['styleId'];
        /** @var \ThemeHouse\Nodes\Entity\NodeStyling $selectedNodeStyling */
        $selectedNodeStyling = $selectedNode->getNodeStylingForStyle($styleId);
        if (!$selectedNodeStyling) {
            return $this->complete();
        }

        /** @var NodeStyling $nodeStyleRepo */
        $nodeStyleRepo = \XF::repository('ThemeHouse\Nodes:NodeStyling');

        $limitTime = ($maxRunTime > 0);
        foreach ($ids as $key => $id) {
            $this->data['count']++;
            $this->data['start'] = $id;
            unset($ids[$key]);

            /** @var Node $node */
            $node = \XF::em()->find('XF:Node', $id);
            if ($node) {
                /** @var \ThemeHouse\Nodes\Entity\NodeStyling $nodeStyling */
                $nodeStyling = $node->getNodeStylingForStyle($styleId);
                if (!$nodeStyling) {
                    $nodeStyling = $nodeStyleRepo->getDefaultNodeStylingForNode($node, $styleId);
                }
                $nodeStyling->styling_options = $selectedNodeStyling->styling_options;
                $nodeStyling->grid_options = $selectedNodeStyling->grid_options;
                $nodeStyling->save();
            }

            if ($limitTime && microtime(true) - $startTime > $maxRunTime) {
                break;
            }
        }

        if (is_array($this->data['nodeIds'])) {
            $this->data['nodeIds'] = $ids;
        }

        $db->commit();

        return $this->resume();
    }

    /**
     * @return array
     */
    protected function prepareNodeIds()
    {
        if (is_array($this->data['nodeIds'])) {
            $ids = $this->data['nodeIds'];
        } else {
            $ids = [];
        }
        sort($ids, SORT_NUMERIC);
        return $ids;
    }

    /**
     * @return \XF\Job\JobResult
     * @throws \XF\PrintableException
     */
    public function complete()
    {
        /** @var NodeStyling $nodeStylingRepo */
        $nodeStylingRepo = \XF::repository('ThemeHouse\Nodes:NodeStyling');
        $nodeStylingRepo->rebuildNodeStylingCache();

        return parent::complete();
    }

    /**
     * @return string
     */
    public function getStatusMessage()
    {
        $actionPhrase = \XF::phrase('thnodes_copying');
        $typePhrase = \XF::phrase('th_node_styling_nodes');

        return sprintf('%s... %s (%d)', $actionPhrase, $typePhrase, $this->data['start']);
    }

    /**
     * @return bool
     */
    public function canCancel()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function canTriggerByChoice()
    {
        return false;
    }
}
