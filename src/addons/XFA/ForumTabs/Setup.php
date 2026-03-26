<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs;

use XF\AddOn\AbstractSetup;
use XF\Db\Schema\Create;
use XF\Db\Schema\Alter;

class Setup extends AbstractSetup
{
	public function install(array $stepParams = [])
	{
        $sm = $this->schemaManager();

        $sm->createTable('xfa_forum_tabs', function(Create $table)
        {
            $table->addColumn('tab_id', 'int')->autoIncrement();
            $table->addColumn('title', 'varchar', 150)->setDefault('');
            $table->addColumn('icon', 'varchar', 50)->setDefault('');
            $table->addColumn('usergroups', 'blob');
            $table->addColumn('category_ids', 'blob');
            $table->addColumn('order', 'int')->setDefault(1);
        });

        $sm->alterTable('xf_user', function(Alter $table)
        {
            $table->addColumn('xfa_ft_disable', 'tinyint', 1)->unsigned()->setDefault(0);
        });
	}

	public function upgrade(array $stepParams = [])
	{
		// Nothing to do
	}

	public function uninstall(array $stepParams = [])
	{
        $sm = $this->schemaManager();

        $sm->dropTable('xfa_forum_tabs');

        $sm->alterTable('xf_user', function(Alter $table)
        {
            $table->dropColumns(['xfa_ft_disable']);
        });
	}
}