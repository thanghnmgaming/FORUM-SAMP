<?php

namespace ThemeHouse\Nodes\Entity;

use XF\Entity\AbstractNode;
use XF\Mvc\Entity\Structure;

/**
 * Class LayoutSeparator
 * @package ThemeHouse\Nodes\Entity
 *
 * @property integer node_id
 * @property string separator_type
 * @property integer separator_max_width
 */
class LayoutSeparator extends AbstractNode
{
    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_th_node_layout_separator';
        $structure->shortName = 'ThemeHouse\Nodes:LayoutSeparator';
        $structure->primaryKey = 'node_id';
        $structure->columns = [
            'node_id' => ['type' => self::UINT, 'required' => true],
            'separator_type' => ['type' => self::STR, 'default' => 'grid'],
            'separator_max_width' => ['type' => self::UINT, 'default' => 0],
        ];

        self::addDefaultNodeElements($structure);

        return $structure;
    }

    /**
     * @param $depth
     * @return array
     */
    public function getNodeTemplateRenderer($depth)
    {
        return [
            'template' => 'th_node_list_separator_nodes',
            'macro' => 'renderSeparator'
        ];
    }

    /**
     * @return array
     */
    public function getNodeListExtras()
    {
        return [
            'separator' => [
                'separator_type' => $this->separator_type,
                'separator_max_width' => $this->separator_max_width,
            ],
        ];
    }
}
