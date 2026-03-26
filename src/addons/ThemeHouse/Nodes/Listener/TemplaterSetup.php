<?php

namespace ThemeHouse\Nodes\Listener;

use ThemeHouse\Nodes\Repository\NodeStyling;
use XF\Container;
use XF\Entity\Node;
use XF\Entity\Style;
use XF\Template\Templater;

/**
 * Class TemplaterSetup
 * @package ThemeHouse\Nodes\Listener
 */
class TemplaterSetup
{
    /**
     * @param Container $container
     * @param Templater $templater
     */
    public static function templaterSetup(Container $container, Templater &$templater)
    {
        $templater->addFunction('th_nodeclasses_nodes', ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnNodeClasses']);
        $templater->addFunction('th_inheritedstylingvalue_nodes',
            ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnInheritedStylingValue']);
        $templater->addFunction('th_nodeicon_nodes', ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnNodeIcon']);
        $templater->addFunction('th_subnodeclasses_nodes',
            ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnSubNodeClasses']);
        $templater->addFunction('th_grid_config_nodes', ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnGridConfig']);
        $templater->addFunction('thnodes_customcolors',
            ['\ThemeHouse\Nodes\Listener\TemplaterSetup', 'fnCustomColors']);
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @param Node $node
     * @param array $extras
     * @return string
     */
    public static function fnNodeClasses(Templater $templater, &$escape, Node $node, array $extras = [])
    {
        /** @var NodeStyling $nodeStylingRepo */
        $nodeStylingRepo = \XF::repository('ThemeHouse\Nodes:NodeStyling');
        $classes = $nodeStylingRepo->getClassesForNode($node, $extras);

        return implode(' ', $classes);
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @param Node $node
     * @param array $extras
     * @return string
     */
    public static function fnSubNodeClasses(Templater $templater, &$escape, Node $node, array $extras = [])
    {
        /** @var \ThemeHouse\Nodes\Repository\NodeStyling $nodeStylingRepo */
        $nodeStylingRepo = \XF::repository('ThemeHouse\Nodes:NodeStyling');

        $iconClass = $nodeStylingRepo->getNodeIconClass($node, $extras);
        if ($iconClass) {
            $escape = false;
            return 'th_node--hasCustomIcon';
        }

        return null;
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @param Node|null $node
     * @param Style|null $style
     * @param $itemType
     * @param $featureKey
     * @return string
     */
    public static function fnInheritedStylingValue(
        Templater $templater,
        &$escape,
        Node $node = null,
        Style $style = null,
        $itemType,
        $featureKey
    ) {
        if (!$node || !$style) {
            return '';
        }

        $inheritedValuePhrase = \XF::phrase('th_inherited_value_nodes:');

        /** @var \ThemeHouse\Nodes\XF\Entity\Node $node */
        $inheritedFeature = $node->getNodeStylingInheritedFeature($style->style_id, $itemType, $featureKey);

        $inheritedValue = \XF::phrase('disabled');
        if ($inheritedFeature) {
            if ($inheritedFeature['inherited'] && $inheritedFeature['value']) {
                $inheritedValue = $inheritedFeature['value'];
            } elseif (!$inheritedFeature['inherited']) {
                return '';
            }
        }

        return $inheritedValuePhrase . ' ' . $inheritedValue;
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @param Node|null $node
     * @param array $extras
     * @param string $extraClass
     * @return string
     */
    public static function fnNodeIcon(
        Templater $templater,
        &$escape,
        Node $node = null,
        array $extras = [],
        $extraClass = ''
    ) {
        /** @var \ThemeHouse\Nodes\Repository\NodeStyling $nodeStylingRepo */
        $nodeStylingRepo = \XF::repository('ThemeHouse\Nodes:NodeStyling');

        $iconClass = $nodeStylingRepo->getNodeIconClass($node, $extras);
        if ($iconClass) {
            $escape = false;
            return '<span class="' . $iconClass['class_name'] . ' ' . $extraClass . '"></span>';
        }

        return null;
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @return string
     * @throws \XF\PrintableException
     */
    public static function fnGridConfig(Templater $templater, &$escape)
    {
        /** @var \ThemeHouse\Nodes\Repository\NodeStyling $repo */
        $repo = \XF::repository('ThemeHouse\Nodes:NodeStyling');
        $returnData = null;

        $data = $repo->getStandardizedNodeStylingCache($templater->getStyleId());

        foreach ($data as $nodeId => $option) {
            if (!isset($option['grid_options'])) {
                continue;
            }

            $returnData[$nodeId] = $option['grid_options'];
        }

        return 'window.themehouse.nodes.grid_options = ' . json_encode((object)$returnData) . ';'; // object so indexed by node_id
    }

    /**
     * @param Templater $templater
     * @param $escape
     * @return array
     */
    public static function fnCustomColors(Templater $templater, &$escape)
    {
        $customColors = [];

        for ($i = 1; $i <= \XF::options()->thnodes_customColors; $i++) {
            $customColors[$i] = 'custom_color_' . $i;
        }

        return $customColors;
    }
}
