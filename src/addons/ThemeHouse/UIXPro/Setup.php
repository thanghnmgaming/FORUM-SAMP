<?php

namespace ThemeHouse\UIXPro;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;

/**
 * Class Setup
 * @package ThemeHouse\UIXPro
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

        foreach ($this->getTables() as $tableName => $closure) {
            $schemaManager->createTable($tableName, $closure);
        }
    }

    /**
     * @return array
     */
    public function getTables()
    {
        $tables = [];

        $tables['xf_th_uix_pro_rating'] = function (Create $table) {
            $table->addColumn('rating_id', 'varchar', 100);
            $table->addColumn('group_id', 'varchar', 100);
            $table->addColumn('value', 'int')->unsigned(false)->setDefault(0);
            $table->addColumn('manual', 'tinyint')->setDefault(0);
            $table->addColumn('auto_resolvable', 'tinyint')->setDefault(0);
            $table->addColumn('resolve_date', 'int')->setDefault(0);
            $table->addColumn('dismissible', 'tinyint')->setDefault(1);
            $table->addColumn('state', 'enum')->values(['active', 'resolved', 'dismissed']);
            $table->addColumn('type', 'enum')->values(['error', 'warning', 'general', 'resolved']);
            $table->addColumn('extra', 'blob');
            $table->addPrimaryKey('rating_id');
        };

        return $tables;
    }

    /**
     * @param array $stateChanges
     */
    public function postInstall(array &$stateChanges)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        \XF::repository('ThemeHouse\UIXPro:UIXPro')->createRatings();
    }

    /**
     * @param $previousVersion
     * @param array $stateChanges
     */
    public function postUpgrade($previousVersion, array &$stateChanges)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        \XF::repository('ThemeHouse\UIXPro:UIXPro')->createRatings();
    }

    // ############################# TABLE / DATA DEFINITIONS ##############################

    /**
     *
     */
    public function uninstallStep1()
    {
        $schemaManager = $this->schemaManager();

        foreach (array_keys($this->getTables()) as $tableName) {
            $schemaManager->dropTable($tableName);
        }
    }
}
