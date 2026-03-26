<?php

namespace ThemeHouse\Nodes\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * Class Node
 * @package ThemeHouse\Nodes\XF\Entity
 */
class Node extends XFCP_Node
{
    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->relations += [
            'NodeStyling' => [
                'entity' => 'ThemeHouse\Nodes:NodeStyling',
                'type' => self::TO_MANY,
                'conditions' => 'node_id',
                'key' => 'style_id'
            ],
            'CurrentNodeStyling' => [
                'entity' => 'ThemeHouse\Nodes:NodeStyling',
                'type' => self::TO_ONE,
                'conditions' => [
                    ['node_id', '=', '$node_id'],
                    ['style_id', '=', \XF::app()->templater()->getStyleId()]
                ]
            ]
        ];

        return $structure;
    }

    /**
     * @param $styleId
     * @return null|\XF\Mvc\Entity\Entity
     */
    public function getNodeStylingForStyle($styleId)
    {
        return $this->finder('ThemeHouse\Nodes:NodeStyling')->where('node_id', $this->node_id)->where('style_id',
            $styleId)->fetchOne();
    }

    /**
     * @param null $styleId
     * @return bool
     */
    public function getNodeStylingFromCacheForStyle($styleId = null)
    {
        if (!$styleId) {
            if (!$styleId = \XF::visitor()->style_id) {
                $styleId = \XF::app()->style()->getId();
            }
        }

        $registry = $this->app()->registry();

        $nodeStyling = $registry->get("th_nodeStyling_nodes_{$styleId}");

        if (!isset($nodeStyling[$this->node_id])) {
            return false;
        }

        return $nodeStyling[$this->node_id];
    }

    /**
     * @param null $styleId
     * @param $itemType
     * @param $featureKey
     * @return bool
     */
    public function getNodeStylingInheritedFeature($styleId = null, $itemType, $featureKey)
    {
        if (!$styleId) {
            $styleId = \XF::app()->style()->getId();
        }

        $registry = $this->app()->registry();

        $nodeStyling = $registry->get("th_nodeStyling_nodes_{$styleId}");

        if (!isset($nodeStyling[$this->node_id][$itemType][$featureKey])) {
            return false;
        }

        $item = $nodeStyling[$this->node_id][$itemType][$featureKey];

        return $item;
    }

    /**
     *
     * @throws \XF\PrintableException
     */
    protected function _postDelete()
    {
        parent::_postDelete();

        $db = $this->db();
        $db->beginTransaction();
        $db->delete('xf_th_node_styling', 'node_id IN (' . $db->quote($this->node_id) . ')');
        $db->commit();

        /** @var \ThemeHouse\Nodes\Repository\NodeStyling $repo */
        $repo = $this->repository('ThemeHouse\Nodes:NodeStyling');

        $repo->rebuildNodeStylingCache();
    }
}
