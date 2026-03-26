<?php

namespace ThemeHouse\Nodes;

use ThemeHouse\Nodes\XF\Entity\Node;
use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;
use XF\Entity\Template;

/**
 * Class Setup
 * @package ThemeHouse\Nodes
 */
class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     *
     */
    public function installStep1()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->createTable('xf_th_node_styling', function (Create $table) {
            $table->addColumn('node_styling_id', 'int')->autoIncrement();
            $table->addColumn('style_id', 'int');
            $table->addColumn('node_id', 'int');
            $table->addColumn('inherit_styling', 'boolean')->setDefault(1);
            $table->addColumn('styling_options', 'mediumblob');
            $table->addColumn('inherit_grid', 'boolean')->setDefault(1);
            $table->addColumn('grid_options', 'mediumblob');
        });
    }

    /**
     *
     */
    public function installStep2()
    {
        $schemaManager = $this->schemaManager();

        $schemaManager->createTable('xf_th_node_layout_separator', function (Create $table) {
            $table->addColumn('node_id', 'int')->primaryKey();
            $table->addColumn('separator_type', 'varchar', 25)->setDefault('grid');
            $table->addColumn('separator_max_width', 'int')->setDefault(0);
        });
    }

    /**
     * @throws \XF\PrintableException
     */
    public function installStep3()
    {
        $nodeType = \XF::em()->create('XF:NodeType');

        $nodeType->bulkSet([
            'node_type_id' => 'LayoutSeparator',
            'entity_identifier' => 'ThemeHouse\Nodes:LayoutSeparator',
            'permission_group_id' => 'th_layoutSeparator_nodes',
            'admin_route' => 'layout-separators',
            'public_route' => 'layout-separators',
        ]);

        $nodeType->save();

        /** @var \XF\Repository\NodeType $repo */
        $repo = \XF::repository('XF:NodeType');
        $repo->rebuildNodeTypeCache();
    }

    /**
     * @throws \XF\PrintableException
     */
    public function upgrade1000470Step1()
    {
        $templates = \XF::finder('XF:Template')
            ->where('title', '=', 'th_nodeStyling_nodes.less')
            ->fetch();

        foreach ($templates as $template) {
            /** @var Template $template */
            $template->delete();
        }
    }

    /**
     * @param array $stateChanges
     * @throws \XF\PrintableException
     */
    public function postInstall(array &$stateChanges)
    {
        $defaultStyling = \XF::em()->create('ThemeHouse\Nodes:NodeStyling');
        $defaultStyling->bulkSet([
            'style_id' => 0,
            'node_id' => 0,
            'inherit_styling' => 0,
            'styling_options' => [],
            'inherit_grid' => 0,
            'grid_options' => [
                'max_columns' => [
                    'enable' => '1',
                    'value' => '2',
                ],
                'min_column_width' => [
                    'enable' => '1',
                    'value' => '250px',
                ],
                'fill_last_row' => [
                    'enable' => '1',
                    'value' => '0',
                ],
            ],
        ]);
        $defaultStyling->save();
        $this->rebuildCaches(true);
    }

    /**
     * @param bool $fullRebuild
     * @throws \XF\PrintableException
     */
    protected function rebuildCaches($fullRebuild = false)
    {
        if ($fullRebuild) {
            $styles = $this->app->finder('XF:Style')->fetch();
            foreach ($styles as $style) {
                /** @var \XF\Entity\Template $template */
                $template = $this->app->finder('XF:Template')->where('style_id', '=', $style->style_id)->where('title',
                    '=', 'th_nodeStyling_nodes.less')->fetchOne();
                if ($template) {
                    $template->delete();
                }
            }
        }

        /** @var \ThemeHouse\Nodes\Repository\NodeStyling $repo */
        $repo = \XF::repository('ThemeHouse\Nodes:NodeStyling');
        $repo->rebuildNodeStylingCache();
    }

    /**
     * @param $previousVersion
     * @param array $stateChanges
     * @throws \XF\PrintableException
     */
    public function postUpgrade($previousVersion, array &$stateChanges)
    {
        if ($previousVersion < 1000052) {
            $this->rebuildCaches(true);
        }
    }

    /**
     *
     * @throws \XF\PrintableException
     */
    public function uninstallStep1()
    {
        $nodes = \XF::finder('XF:Node')->where('node_type_id', '=', 'LayoutSeparator')->fetch();
        foreach ($nodes as $node) {
            /** @var Node $node */
            $node->delete();
        }

        $schemaManager = $this->schemaManager();

        $schemaManager->dropTable('xf_th_node_styling');

        $registry = $this->app->registry();
        $registry->delete('th_nodeStyling_nodes');
    }

    /**
     *
     */
    public function uninstallStep2()
    {
        // Remove separator nodes
        $schemaManager = $this->schemaManager();

        $schemaManager->dropTable('xf_th_node_layout_separator');
    }

    /**
     * @throws \XF\PrintableException
     */
    public function uninstallStep3()
    {
        /** @var \XF\Entity\NodeType $nodeType */
        $nodeType = \XF::em()->find('XF:NodeType', 'LayoutSeparator');
        $nodeType->delete();

        /** @var \XF\Repository\NodeType $repo */
        $repo = \XF::repository('XF:NodeType');
        $repo->rebuildNodeTypeCache();
    }

    /**
     * @throws \XF\PrintableException
     */
    public function uninstallStep4()
    {
        $templates = \XF::finder('XF:Template')->where('title', '=', 'th_nodeStyling_nodes.less');

        foreach ($templates as $template) {
            /** @var \XF\Entity\Template $template */
            $template->delete();
        }
    }
}
