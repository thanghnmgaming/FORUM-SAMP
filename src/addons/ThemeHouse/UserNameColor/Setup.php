<?php

namespace ThemeHouse\UserNameColor;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

/**
 * Class Setup
 * @package ThemeHouse\UserNameColor
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
        $this->schemaManager()->createTable('th_unco_user_name_style', function (Create $table) {
            $table->addColumn('user_name_style_id', 'int')->autoIncrement();
            $table->addColumn('user_criteria', 'blob');
            $table->addColumn('styling', 'text');
            $table->addColumn('active', 'tinyint')->setDefault(1);
            $table->addColumn('display_order', 'int')->setDefault(10);
        });
    }

    public function installStep2()
    {
        $this->schemaManager()->alterTable('xf_user', function (Alter $table) {
            $table->addColumn('th_unco_user_name_data', 'blob')->nullable();
        });
    }
}