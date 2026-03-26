<?php

namespace ThemeHouse\Nodes\Repository;

use XF\Entity\Node;
use XF\Mvc\Entity\Repository;
use XF\Style;

/**
 * Class NodeStyling
 * @package ThemeHouse\Nodes\Repository
 */
class NodeStyling extends Repository
{
    /**
     * @param $nodeIds
     * @return \XF\Mvc\Entity\ArrayCollection
     */
    public function getNodeStylingForNodeIds($nodeIds)
    {
        /** @var \XF\Mvc\Entity\Finder $finder */
        $finder = $this->finder('ThemeHouse\Nodes:NodeStyling');

        return $finder->where('node_id', '=', $nodeIds)->fetch();
    }

    /**
     * @param $styleId
     * @return null|\XF\Mvc\Entity\Entity
     */
    public function getNodeStylingForDefault($styleId)
    {
        /** @var \XF\Mvc\Entity\Finder $finder */
        $finder = $this->finder('ThemeHouse\Nodes:NodeStyling');

        return $finder->where('node_id', '=', 0)->where('style_id', '=', $styleId)->fetchOne();
    }

    /**
     * @param Node|null $node
     * @param $styleId
     * @return \XF\Mvc\Entity\Entity
     */
    public function getDefaultNodeStylingForNode(Node $node = null, $styleId)
    {
        $nodeId = 0;
        if ($node && $node->node_id) {
            $nodeId = $node->node_id;
        }

        /** @var \ThemeHouse\Nodes\Entity\NodeStyling $nodeStyling */
        $nodeStyling = $this->em->create('ThemeHouse\Nodes:NodeStyling');
        $nodeStyling->bulkSet([
            'node_id' => $nodeId,
            'style_id' => $styleId
        ]);

        if (!$node) {
            $nodeStyling->inherit_styling = 0;
            $nodeStyling->inherit_grid = 0;
        }

        return $nodeStyling;
    }

    /**
     * @param array $styles
     * @return void
     * @throws \XF\PrintableException
     */
    public function buildNodeStylingTemplates(array $styles)
    {
        $templates = $this->finder('XF:Template')
            ->where('style_id', '=', 0)
            ->where('title', 'LIKE', 'th_nodeStyling_nodes%.less')
            ->fetch()
            ->groupBy('title');

        foreach ($styles as $style) {
            $cssOutput = '<xf:comment>Do not edit this template directly, everything contained within this template is automatically generated and manual changes will cause issues</xf:comment>';
            $styleManager = \XF::app()->style($style->style_id);
            $styling = $this->renderNodeStylingForStyle($styleManager);
            if ($styling) {
                $cssOutput .= "\n\n<xf:if is=\"property('th_enableStyling_nodes')\">\n";
                $cssOutput .= $styling;
                $cssOutput .= "</xf:if>";
            }

            $templateName = 'th_nodeStyling_nodes.' . $style->style_id . '.less';
            if (isset($templates[$templateName])) {
                $template = reset($templates[$templateName]);
            } else {
                $template = $this->em->create('XF:Template');
                $template->bulkSet([
                    'type' => 'public',
                    'title' => $templateName,
                    'style_id' => 0,
                ]);
            }

            $template->template = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $cssOutput);
            $template->addon_id = '';
            $template->last_edit_date = \XF::$time;
            $template->save();
        }
    }

    /**
     * @param Style $style
     * @return string
     * @throws \XF\PrintableException
     */
    public function renderNodeStylingForStyle(Style $style)
    {
        $styleId = $style->getId();
        $nodeStylingCache = $this->getStandardizedNodeStylingCache($styleId);

        // Style properties necessary for generating css
        $backgroundSelector = $style->getProperty('th_backgroundSelector_nodes');
        $textSelector = $style->getProperty('th_textSelector_nodes');

        $templater = \XF::app()->templater();
        $originalStyle = $templater->getStyle();
        $templater->setStyle($style);

        $css = '';
        foreach ($nodeStylingCache as $nodeId => $options) {
            $nodeBackgroundSelector = $this->processSelectorForNode($backgroundSelector, $nodeId);
            $nodeTextSelector = $this->processSelectorForNode($textSelector, $nodeId);

            $styling = $this->prepareStyling($options['styling_options']);

            $params = [
                'nodeId' => $nodeId,
                'backgroundSelector' => $nodeBackgroundSelector,
                'textSelector' => $nodeTextSelector,
                'styling' => $styling
            ];

            $css .= $templater->renderMacro('public:thnodes_generator_macros', 'generator', $params);
        }

        if ($originalStyle) {
            $templater->setStyle($originalStyle);
        }
        return $css;
    }

    /**
     * @param null $returnStyleId
     * @return array|mixed
     * @throws \XF\PrintableException
     */
    public function getStandardizedNodeStylingCache($returnStyleId = null)
    {
        $nodeStyling = $this->getNodeStylingCache();
        if ($nodeStyling === null) {
            $nodeStyling = $this->rebuildNodeStylingCache();
        }

        if (!$nodeStyling) {
            return [];
        }

        foreach ($nodeStyling as $styleId => &$nodes) {
            if (empty($nodes)) {
                unset($nodeStyling[$styleId]);
                continue;
            }

            foreach ($nodes as $nodeId => &$node) {
                $node = array_merge([
                    'inherit_styling' => false,
                    'styling_options' => [],
                ], $node);

                $node['styling_options'] = array_merge([
                    'class_name' => '',
                    'background_image_url' => '',
                    'background_color' => '',
                    'text_color' => '',
                ], $node['styling_options']);

                if (isset($node['grid_options'])) {
                    $node['grid_options'] = array_merge([
                        'max_columns' => [
                            'enabled' => 0
                        ],
                        'min_column_width' => [
                            'enabled' => 0
                        ],
                        'fill_last_row' => [
                            'enabled' => 1,
                            'value' => 0
                        ],
                    ], $node['grid_options']);
                }
            }
        }


        if ($returnStyleId === null) {
            $returnStyling = $nodeStyling;
        } else {
            if (isset($nodeStyling[$returnStyleId])) {
                $returnStyling = $nodeStyling[$returnStyleId];
            } else {
                $returnStyling = [];
            }
        }

        return $returnStyling;
    }

    /**
     * @return array|mixed
     */
    public function getNodeStylingCache()
    {
        $registry = \XF::registry();

        $styles = $this->finder('XF:Style')->fetch()->keys();
        $cache = [];
        foreach ($styles as $styleId) {
            $cache[$styleId] = $registry->get("th_nodeStyling_nodes_{$styleId}");
        }
        return $cache;
    }

    /**
     * @return mixed
     * @throws \XF\PrintableException
     * @throws \XF\PrintableException
     */
    public function rebuildNodeStylingCache()
    {
        /** @var \ThemeHouse\Nodes\Service\NodeStyling\Cache $service */
        $service = \XF::app()->service('ThemeHouse\Nodes:NodeStyling\Cache');
        return $service->rebuildCache();
    }

    /**
     * @param $selector
     * @param $nodeId
     * @return mixed
     */
    protected function processSelectorForNode($selector, $nodeId)
    {
        return str_ireplace('{node_id}', $nodeId, $selector);
    }

    /**
     * @param array $styling
     * @return array
     */
    protected function prepareStyling(array $styling)
    {
        $styling = array_merge($this->getDefaultStylingOptions(), $styling);

        if (isset($styling['background_image_url'])) {
            if (!empty($styling['background_image_url']['value'])) {
                if (preg_match(
                    '/^(url|(repeating-)?(linear|radial)-gradient)\(/s',
                    $styling['background_image_url']['value']
                )) {
                    $styling['background_image'] = $styling['background_image_url'];
                    unset($styling['background_image_url']);
                }
            }
        }

        return $styling;
    }

    /**
     * @return array
     */
    protected function getDefaultStylingOptions()
    {
        return [
            'background_image_url' => [
                'enable' => false,
                'value' => null
            ],
            'background_color' => [
                'enable' => false,
                'value' => null
            ],
            'text_color' => [
                'enable' => false,
                'value' => null
            ]
        ];
    }

    /**
     * @param Node $node
     * @param array $extras
     * @return array
     */
    public function getClassesForNode(Node $node, array $extras = [])
    {
        /** @var \ThemeHouse\Nodes\XF\Entity\Node $node */
        $nodeStylingCache = $node->getNodeStylingFromCacheForStyle();
        $classes = [];

        if ($this->hasNodeIcon($node, $extras)) {
            $classes[] = 'th_node--hasCustomIcon';
        }

        if (\XF::app()->templater()->getStyle()->getProperty('th_enableStyling_nodes')) {
            if (isset($nodeStylingCache['styling_options']['class_name']['enable'])
                && $nodeStylingCache['styling_options']['class_name']['enable']
                && !empty($nodeStylingCache['styling_options']['class_name']['value'])) {
                $classes[] = $nodeStylingCache['styling_options']['class_name']['value'];

                if ($nodeStylingCache['styling_options']['class_name']['inherited']) {
                    $classes[] = $nodeStylingCache['styling_options']['class_name']['value'] . '--inherited';
                }
            }

            if (isset($nodeStylingCache['styling_options']['retain_text_styling']['enable'])
                && $nodeStylingCache['styling_options']['retain_text_styling']['enable']
                && !empty($nodeStylingCache['styling_options']['retain_text_styling']['value'])
                && $nodeStylingCache['styling_options']['retain_text_styling']['value'] === '1') {
                $classes[] = 'th_node--retainTextStyling';
            } else {
                $classes[] = 'th_node--overwriteTextStyling';
            }

            if (isset($nodeStylingCache['styling_options']['background_image_url']['enable'])
                && $nodeStylingCache['styling_options']['background_image_url']['enable']
                && !empty($nodeStylingCache['styling_options']['background_image_url']['value'])) {
                $classes[] = 'th_node--hasBackground';
                if (!preg_match(
                    '/^(url|(repeating-)?(linear|radial)-gradient)\(/s',
                    $nodeStylingCache['styling_options']['background_image_url']['value']
                )) {
                    $classes[] = 'th_node--hasBackgroundImage';
                }
            } elseif (isset($nodeStylingCache['styling_options']['background_color']['enable'])
                && $nodeStylingCache['styling_options']['background_color']['enable']
                && !empty($nodeStylingCache['styling_options']['background_color']['value'])) {
                $classes[] = 'th_node--hasBackground';
            }
        }

        return $classes;
    }

    /**
     * @param Node $node
     * @param array $extras
     * @return bool
     */
    protected function hasNodeIcon(Node $node, array $extras = [])
    {
        $iconClass = $this->getNodeIconClass($node, $extras);

        if ($iconClass) {
            return true;
        }

        return false;
    }

    /**
     * @param Node $node
     * @param array $extras
     * @return array|bool
     */
    public function getNodeIconClass(Node $node, $extras = [])
    {
        $featureKey = false;
        switch ($node->node_type_id) {
            case 'Forum':
                if ($extras['hasNew']) {
                    $featureKey = 'forum_icon_class_unread';
                } else {
                    $featureKey = 'forum_icon_class';
                }
                break;
            case 'Category':
                if ($extras['hasNew']) {
                    $featureKey = 'category_icon_class_unread';
                } else {
                    $featureKey = 'category_icon_class';
                }
                break;
            case 'Page':
                $featureKey = 'page_icon_class';
                break;
            case 'LinkForum':
                $featureKey = 'link_forum_icon_class';
                break;
        }

        if (!$featureKey) {
            return false;
        }

        /** @var \ThemeHouse\Nodes\XF\Entity\Node $node */
        $nodeStylingCache = $node->getNodeStylingFromCacheForStyle();

        if (isset($nodeStylingCache['styling_options'][$featureKey])) {
            $icon = $nodeStylingCache['styling_options'][$featureKey];
            if (isset($icon['enable']) && $icon['enable'] && isset($icon['value']) && $icon['value']) {
                return [
                    'class_name' => $icon['value'],
                    'inherited' => $icon['inherited'],
                ];
            }
        }

        return false;
    }
}
