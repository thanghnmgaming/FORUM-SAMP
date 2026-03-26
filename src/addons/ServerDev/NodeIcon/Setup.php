<?php

namespace ServerDev\NodeIcon;

use XF\AddOn\AbstractSetup;

class Setup extends AbstractSetup
{
	public function install(array $stepParams = [])
	{
		$this->schemaManager()->alterTable('xf_node', function (\XF\Db\Schema\Alter $table)
        {
            $table->addColumn('node_icon', 'varchar', 250)->nullable()->after('effective_navigation_id');
            $table->addColumn('node_icon_unread', 'varchar', 250)->nullable()->after('effective_navigation_id');
            $table->addColumn('node_icon_type', 'enum', 50)->values(['default','fa','img','custom'])->setDefault('default')->after('effective_navigation_id');
        });
	}

	public function upgrade(array $stepParams = [])
	{
		if($this->addOn->version_id < 2100022){

			$this->query('ALTER TABLE xf_node CHANGE COLUMN fa_icon node_icon varchar(250)');
			$this->query('ALTER TABLE xf_node ADD COLUMN node_icon_type ENUM (\'default\',\'fa\',\'img\',\'custom\') DEFAULT \'default\' AFTER node_icon');

	        $this->query('UPDATE xf_node SET node_icon_type = "fa" WHERE node_icon IS NOT NULL AND node_icon != \'\'');
		}

		if($this->addOn->version_id < 2100024){

			$this->query('ALTER TABLE xf_node ADD COLUMN node_icon_unread varchar(250) AFTER node_icon');
		}
	}

	public function uninstall(array $stepParams = [])
	{
		$this->schemaManager()->alterTable('xf_node', function (\XF\Db\Schema\Alter $table)
        {
            $table->dropColumns(['node_icon', 'node_icon_unread', 'node_icon_type']);
        });
	}
}