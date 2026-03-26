<?php

namespace ThemeHouse\Nodes\Service\NodeStyling;

use XF\App;
use XF\Entity\Node;
use XF\Entity\Style;
use XF\Service\AbstractService;
use XF\SubTree;

/**
 * Class Cache
 * @package ThemeHouse\Nodes\Service\NodeStyling
 */
class Cache extends AbstractService
{
    /**
     * @var \XF\Mvc\Entity\ArrayCollection
     */
    protected $nodes;
    /**
     * @var null|\XF\Tree
     */
    protected $nodeTree;

    /**
     * @var
     */
    protected $nodeStyling;
    /**
     * @var
     */
    protected $nodeGrid;

    /**
     * @var array
     */
    protected $styles = [];
    /**
     * @var \XF\Tree
     */
    protected $styleTree;

    /**
     * Cache constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);

        $nodeRepo = $this->getNodeRepo();
        $this->nodes = $nodeRepo->getFullNodeList();
        $this->nodeTree = count($this->nodes) ? $nodeRepo->createNodeTree($this->nodes) : null;

        $styleRepo = $this->getStyleRepo();
        $this->styleTree = $styleRepo->getStyleTree(true);

        $nodeIds = [0];
        foreach ($this->nodes as $node) {
            $nodeIds[] = $node->node_id;
        }

        $nodeStyleRepo = $this->getNodeStyleRepo();
        $nodeStyling = $nodeStyleRepo->getNodeStylingForNodeIds($nodeIds);

        foreach ($nodeStyling as $item) {
            if (!isset($this->nodeStyling[$item->node_id])) {
                $this->nodeStyling[$item->node_id] = [];
            }

            $this->nodeStyling[$item->node_id][$item->style_id] = [
                'styling_options' => $item->styling_options,
            ];

            if (!isset($this->nodeGrid[$item->node_id])) {
                $this->nodeGrid[$item->node_id] = [];
            }

            $this->nodeGrid[$item->node_id][$item->style_id] = [
                'is_default_grid' => false,
                'grid_options' => $item->grid_options,
            ];
        }
    }

    /**
     * @return \XF\Repository\Node
     */
    protected function getNodeRepo()
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->repository('XF:Node');
    }

    /**
     * @return \XF\Repository\Style
     */
    protected function getStyleRepo()
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->repository('XF:Style');
    }

    /**
     * @return \ThemeHouse\Nodes\Repository\NodeStyling
     */
    protected function getNodeStyleRepo()
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->repository('ThemeHouse\Nodes:NodeStyling');
    }

    /**
     * @return array
     * @throws \XF\PrintableException
     * @throws \XF\PrintableException
     * @throws \XF\PrintableException
     */
    public function rebuildCache()
    {
        $this->buildNodeStylingCache();
        return $this->updateNodeStylingCache();
    }

    /**
     *
     */
    protected function buildNodeStylingCache()
    {
        foreach ($this->styleTree as $subTree) {
            $this->handleStyleSubTree($subTree);
        }
    }

    /**
     * @param SubTree $subTree
     */
    protected function handleStyleSubTree(SubTree $subTree)
    {
        $this->handleStyle($subTree->record);

        foreach ($subTree->children() as $child) {
            $this->handleStyleSubTree($child);
        }
    }

    /**
     * @param Style $style
     */
    protected function handleStyle(Style $style)
    {
        $this->styles[$style->style_id] = $style;

        // Handle default grid options
        $this->handleNodeGrid(null, $style);

        if ($this->nodeTree) {
            foreach ($this->nodeTree as $subTree) {
                $this->handleNodeSubTree($subTree, $style);
            }
        }
    }

    /**
     * @param Node|null $node
     * @param Style $style
     */
    protected function handleNodeGrid(Node $node = null, Style $style)
    {
        $nodeId = 0;
        if ($node) {
            $nodeId = $node->node_id;
        }

        if (isset($this->nodeGrid[$nodeId][$style->style_id])) {
            $gridItem = $this->nodeGrid[$nodeId][$style->style_id];
        } else {
            $gridItem = $this->getDefaultGrid();
        }

        $this->nodeGrid[$nodeId][$style->style_id] = $this->inheritFeaturesForGrid($node, $style, $gridItem);
    }

    /**
     * @return array
     */
    protected function getDefaultGrid()
    {
        return [
            'grid_options' => [
                'max_columns' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'min_column_width' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'fill_last_row' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
            ],
        ];
    }

    /**
     * @param Node|null $node
     * @param Style $style
     * @param $nodeGrid
     * @return mixed
     */
    protected function inheritFeaturesForGrid(Node $node = null, Style $style, $nodeGrid)
    {
        $defaultGrid = $this->getDefaultGrid();
        $nodeGrid['grid_options'] = array_merge($defaultGrid['grid_options'], $nodeGrid['grid_options']);

        foreach ($nodeGrid['grid_options'] as $key => &$gridOption) {
            if (!$gridOption['enable']) {
                $gridOption = $this->inheritFeatureForGrid($node, $style, $key);
            } else {
                $gridOption = array_merge($gridOption, [
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ]);
            }
        }

        return $nodeGrid;
    }

    /**
     * @param Node|null $node
     * @param Style $style
     * @param $featureKey
     * @return array
     */
    protected function inheritFeatureForGrid(Node $node = null, Style $style, $featureKey)
    {
        return $this->inheritFeature($node, $style, 'grid', $featureKey);
    }

    /**
     * @param Node|null $node
     * @param Style $style
     * @param $itemType
     * @param $featureKey
     * @param bool $inheritNodes
     * @return array|bool
     */
    protected function inheritFeature(Node $node = null, Style $style, $itemType, $featureKey, $inheritNodes = false)
    {
        $nodeId = 0;
        $parentNodeId = 0;
        if ($node) {
            $nodeId = $node->node_id;
            $parentNodeId = $node->parent_node_id;
        }

        $parentKey = null;
        $typeArray = null;
        switch ($itemType) {
            case 'grid':
                $parentKey = 'grid_options';
                $typeArray = $this->nodeGrid;
                break;
            case 'styling':
                $parentKey = 'styling_options';
                $typeArray = $this->nodeStyling;
                break;
        }

        if (!$parentKey) {
            return false;
        }

        $inheritedFromParentStyle = false;
        if ($style->style_id) {
            $parentStyle = $typeArray[$nodeId][$style->parent_id];

            if (!isset($parentStyle[$parentKey][$featureKey])) {
                $inheritedFromParentStyle = [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ];
            } else {
                $inheritedFromParentStyle = array_merge($parentStyle[$parentKey][$featureKey], [
                    'inherited_from_parent_style' => true,
                ]);
            }
        }

        $inheritedFromParentNode = false;
        if ($node && $inheritNodes && $parentNodeId) {
            $parentNode = $typeArray[$parentNodeId][$style->style_id];
            if (isset($parentNode[$parentKey][$featureKey])
                && (!$inheritedFromParentStyle || !$inheritedFromParentStyle['enable']
                    || $inheritedFromParentStyle['inherited_from_parent_node'])) {
                $inheritedFromParentNode = array_merge($parentNode[$parentKey][$featureKey], [
                    'inherited_from_parent_node' => true,
                ]);
            }
        }

        $inheritedFromDefaultStyling = false;
        if ($node) {
            if ((!$inheritedFromParentStyle || !$inheritedFromParentStyle['enable'])
                && (!$inheritedFromParentNode || !$inheritedFromParentNode['enable'])
                && isset($typeArray[0][$style->style_id][$parentKey][$featureKey])) {
                $inheritedFromDefaultStyling = array_merge($typeArray[0][$style->style_id][$parentKey][$featureKey], [
                    'inherited_from_default_styling' => true,
                ]);
            }
        }

        if ($inheritedFromParentNode) {
            $use = $inheritedFromParentNode;
        } elseif ($inheritedFromDefaultStyling) {
            $use = $inheritedFromDefaultStyling;
        } elseif ($inheritedFromParentStyle) {
            $use = $inheritedFromParentStyle;
        } else {
            $use = [
                'enable' => 0,
                'inherited_from_parent_style' => false,
                'inherited_from_default_styling' => false,
                'inherited_from_parent_node' => false,
            ];
        }

        $inherited = false;

        if ((isset($use['inherited_from_parent_style']) && $use['inherited_from_parent_style'])
            || isset($use['inherited_from_default_styling']) && $use['inherited_from_default_styling']
            || isset($use['inherited_from_parent_node']) && $use['inherited_from_parent_node']) {
            $inherited = true;
        }

        return array_merge([
            'inherited_from_parent_style' => true,
            'inherited_from_default_styling' => false,
            'inherited_from_parent_node' => false,
            'inherited' => $inherited,
        ], $use);
    }

    /**
     * @param SubTree $subTree
     * @param Style $style
     */
    protected function handleNodeSubTree(SubTree $subTree, Style $style)
    {
        $this->handleNode($subTree->record, $style);

        if (!empty($subTree->children())) {
            foreach ($subTree->children() as $child) {
                $this->handleNodeSubTree($child, $style);
            }
        }
    }

    /**
     * @param Node $node
     * @param Style $style
     */
    protected function handleNode(Node $node, Style $style)
    {
        $this->handleNodeStyling($node, $style);
        $this->handleNodeGrid($node, $style);
    }

    /**
     * @param Node|null $node
     * @param Style $style
     */
    protected function handleNodeStyling(Node $node = null, Style $style)
    {
        $nodeId = 0;
        if ($node) {
            $nodeId = $node->node_id;
        }

        if (isset($this->nodeStyling[$nodeId][$style->style_id])) {
            $stylingItem = $this->nodeStyling[$nodeId][$style->style_id];
        } else {
            $stylingItem = $this->getDefaultStyling();
        }

        $this->nodeStyling[$nodeId][$style->style_id] = $this->inheritFeaturesForStyling($node, $style, $stylingItem);;
    }

    /**
     * @return array
     */
    protected function getDefaultStyling()
    {
        $defaultStyling = [
            'styling_options' => [
                'class_name' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'background_image_url' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'background_color' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'text_color' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'retain_text_styling' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],

                // Node Icons
                'category_icon_class' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'category_icon_class_unread' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'forum_icon_class' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'forum_icon_class_unread' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'page_icon_class' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
                'link_forum_icon_class' => [
                    'enable' => 0,
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ],
            ],
        ];

        for ($i = 1; $i <= \XF::options()->thnodes_customColors; $i++) {
            $defaultStyling['styling_options']['custom_color_' . $i] = [
                'enable' => 0,
                'inherited_from_parent_style' => false,
                'inherited_from_default_styling' => false,
                'inherited_from_parent_node' => false,
            ];
        }

        return $defaultStyling;
    }

    /**
     * @param Node|null $node
     * @param Style $style
     * @param $stylingItem
     * @return mixed
     */
    protected function inheritFeaturesForStyling(Node $node = null, Style $style, $stylingItem)
    {
        $defaultStyling = $this->getDefaultStyling();
        $stylingItem['styling_options'] = array_merge(
            $defaultStyling['styling_options'],
            $stylingItem['styling_options']
        );

        foreach ($stylingItem['styling_options'] as $key => &$stylingOption) {
            if (!$stylingOption['enable']) {
                $stylingOption = $this->inheritFeatureForStyling($node, $style, $key);
            } else {
                $stylingOption = array_merge($stylingOption, [
                    'inherited_from_parent_style' => false,
                    'inherited_from_default_styling' => false,
                    'inherited_from_parent_node' => false,
                ]);
            }
        }

        return $stylingItem;
    }

    /**
     * @param Node|null $node
     * @param Style $style
     * @param $featureKey
     * @return array
     */
    protected function inheritFeatureForStyling(Node $node = null, Style $style, $featureKey)
    {
        return $this->inheritFeature($node, $style, 'styling', $featureKey, true);
    }

    /**
     * @return array
     * @throws \XF\PrintableException
     */
    protected function updateNodeStylingCache()
    {
        /** @var \XF\DataRegistry $registry */
        $registry = $this->app->registry();

        $stylingCache = [];

        foreach ($this->styles as $style) {
            $styleId = $style->style_id;
            $styling = [];

            $nodeStyling = $this->getCacheValuesForNode(null, $styleId);

            if (!empty($nodeStyling)) {
                $styling[0] = $nodeStyling;
            }

            foreach ($this->nodes as $node) {
                $nodeStyling = $this->getCacheValuesForNode($node, $styleId);

                if (!empty($nodeStyling)) {
                    $styling[$node->node_id] = $nodeStyling;
                }
            }

            $registry->set("th_nodeStyling_nodes_{$styleId}", $styling);
//            if (!empty($styling)) {
//                $stylingCache[$styleId] = $styling;
//            }
        }

        #$registry->set('th_nodeStyling_nodes', $stylingCache);

        $this->getNodeStyleRepo()->buildNodeStylingTemplates($this->styles);

        return $stylingCache;
    }

    /**
     * @param Node|null $node
     * @param $styleId
     * @return array
     */
    protected function getCacheValuesForNode(Node $node = null, $styleId)
    {
        if (!$node) {
            $nodeId = 0;
            $nodeDepth = 0;
        } else {
            $nodeId = $node->node_id;
            $nodeDepth = $node->depth;
        }

        if (!isset($this->nodeStyling[$nodeId][$styleId])) {
            $nodeStyling = [];
        } else {
            $nodeStyling = $this->nodeStyling[$nodeId][$styleId];
        }

        if (!isset($this->nodeGrid[$nodeId][$styleId])) {
            $nodeGrid = [];
        } else {
            $nodeGrid = $this->nodeGrid[$nodeId][$styleId];
        }

        $returnStyling = [];

        if ($nodeId && isset($nodeStyling['styling_options'])) {
            if (!empty($nodeStyling['styling_options'])) {
                $returnStyling['styling_options'] = $nodeStyling['styling_options'];
            }
        }

        if ((!$nodeDepth || ($nodeId && $node->node_type_id === 'LayoutSeparator')) && isset($nodeGrid['grid_options'])) {
            $gridOptions = [];
            foreach ($nodeGrid['grid_options'] as $key => $values) {
                if ($values['enable'] && isset($values['value'])) {
                    $gridOptions[$key] = [
                        'enable' => 1,
                        'value' => $values['value'],
                    ];
                } else {
                    $gridOptions[$key] = [
                        'enable' => 0,
                    ];
                }
            }

            if (!empty($gridOptions)) {
                $returnStyling['grid_options'] = $gridOptions;
            }
        }

        if (empty($returnStyling)) {
            return [];
        }

        return $returnStyling;
    }
}
