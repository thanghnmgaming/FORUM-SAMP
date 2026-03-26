<?php

namespace SV\MultiPrefix;

use SV\Utils\InstallerSoftRequire;
use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    // from https://github.com/Xon/XenForo2-Utils cloned to src/addons/SV/Utils
    use \SV\Utils\InstallerHelper;
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        $sm = $this->schemaManager();

        foreach ($this->getTables() as $tableName => $callback)
        {
            $sm->createTable($tableName, $callback);
            $sm->alterTable($tableName, $callback);
        }

        foreach ($this->getAlterTables() as $tableName => $callback)
        {
            if ($sm->tableExists($tableName))
            {
                $sm->alterTable($tableName, $callback);
            }
        }
    }

    public function installStep2()
    {
        $db = $this->db();
        $db->beginTransaction();
        /** @noinspection SqlResolve */
        $db->query("
                UPDATE xf_forum
                SET sv_min_prefixes = require_prefix, require_prefix = 1
                WHERE require_prefix > 0 and sv_min_prefixes  = 0
            ");

        $db->query("
                UPDATE xf_thread
                SET sv_prefix_ids = prefix_id
                WHERE (sv_prefix_ids = '' OR sv_prefix_ids IS NULL) AND prefix_id <> 0 
            ");
        $db->commit();

        if ($this->resourceManagerInstalled())
        {
            $db->beginTransaction();
            /** @noinspection SqlResolve */
            $db->query("
                UPDATE xf_rm_category
                SET sv_min_prefixes = require_prefix, require_prefix = 1
                WHERE require_prefix > 0 and sv_min_prefixes  = 0
            ");

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_rm_resource
                    SET sv_prefix_ids = prefix_id
                    WHERE (sv_prefix_ids = '' OR sv_prefix_ids is null) AND prefix_id <> 0 
                ");
            $db->commit();
        }

        if ($this->dbtechEcommerceInstalled())
        {
            $db->beginTransaction();
            /** @noinspection SqlResolve */
            $db->query("
                UPDATE xf_dbtech_ecommerce_category
                SET sv_min_prefixes = require_prefix, require_prefix = 1
                WHERE require_prefix > 0 and sv_min_prefixes  = 0
            ");

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_dbtech_ecommerce_product
                    SET sv_prefix_ids = prefix_id
                    WHERE (sv_prefix_ids = '' OR sv_prefix_ids is null) AND prefix_id <> 0
                ");
            $db->commit();
        }

        if ($this->dbtechShopInstalled())
        {
            $db->beginTransaction();
            /** @noinspection SqlResolve */
            $db->query("
                UPDATE xf_dbtech_shop_category
                SET sv_min_prefixes = require_prefix, require_prefix = 1
                WHERE require_prefix > 0 and sv_min_prefixes  = 0
            ");

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_dbtech_shop_item
                    SET sv_prefix_ids = prefix_id
                    WHERE (sv_prefix_ids = '' OR sv_prefix_ids is null) AND prefix_id <> 0
                ");
            $db->commit();
        }
    }

    public function installStep3()
    {
        $db = $this->db();

        $db->beginTransaction();
        $db->delete('xf_sv_thread_prefix_link', 'prefix_id  = ?', 0);

        $db->query("
                UPDATE xf_thread
                SET  sv_prefix_ids = null
                WHERE prefix_id = 0
            ");

        $db->query("
                INSERT IGNORE INTO xf_sv_thread_prefix_link (prefix_id, thread_id)
                SELECT prefix_id, thread_id
                FROM xf_thread
                WHERE prefix_id <> 0
            ");
        $db->commit();

        if ($this->resourceManagerInstalled())
        {
            $db->beginTransaction();
            $db->delete('xf_sv_resource_prefix_link', 'prefix_id  = ?', 0);

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_rm_resource
                    SET  sv_prefix_ids = null
                    WHERE prefix_id = 0
                ");
            /** @noinspection SqlResolve */
            $db->query("
                    INSERT IGNORE INTO xf_sv_resource_prefix_link (prefix_id, resource_id)
                    SELECT prefix_id, resource_id
                    FROM xf_rm_resource
                    WHERE prefix_id <> 0
                ");
            $db->commit();
        }

        if ($this->dbtechEcommerceInstalled())
        {
            $db->beginTransaction();
            $db->delete('xf_sv_dbtech_ecommerce_product_prefix_link', 'prefix_id  = ?', 0);

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_dbtech_ecommerce_product
                    SET  sv_prefix_ids = null
                    WHERE prefix_id = 0
                ");
            /** @noinspection SqlResolve */
            $db->query("
                    INSERT IGNORE INTO xf_sv_dbtech_ecommerce_product_prefix_link (prefix_id, product_id)
                    SELECT prefix_id, product_id
                    FROM xf_dbtech_ecommerce_product
                    WHERE prefix_id <> 0
                ");
            $db->commit();
        }

        if ($this->dbtechShopInstalled())
        {
            $db->beginTransaction();
            $db->delete('xf_sv_dbtech_shop_item_prefix_link', 'prefix_id  = ?', 0);

            /** @noinspection SqlResolve */
            $db->query("
                    UPDATE xf_dbtech_shop_item
                    SET  sv_prefix_ids = null
                    WHERE prefix_id = 0
                ");
            /** @noinspection SqlResolve */
            $db->query("
                    INSERT IGNORE INTO xf_sv_dbtech_shop_item_prefix_link (prefix_id, item_id)
                    SELECT prefix_id, item_id
                    FROM xf_dbtech_shop_item
                    WHERE prefix_id <> 0
                ");
            $db->commit();
        }
    }

    public function upgrade1070000Step1()
    {
        $sm = $this->schemaManager();

        if ($sm->tableExists('xf_thread_prefix_link'))
        {
            $sm->renameTable('xf_thread_prefix_link', 'xf_sv_thread_prefix_link');
        }

        if ($this->resourceManagerInstalled() && $sm->tableExists('xf_resource_prefix_link'))
        {
            $sm->renameTable('xf_resource_prefix_link', 'xf_sv_resource_prefix_link');
        }

        if ($sm->columnExists('xf_forum', 'xm_max_prefixes'))
        {
            $sm->alterTable('xf_forum', function (Alter $table) {
                $table->renameColumn('xm_max_prefixes', 'sv_max_prefixes')->setDefault(0);
            });
        }

        if ($sm->columnExists('xf_thread', 'xm_prefixes'))
        {
            $sm->alterTable('xf_thread', function (Alter $table) {
                $table->renameColumn('xm_prefixes', 'sv_prefix_ids')
                      ->length(null)
                      ->type('mediumblob')
                      ->nullable()
                      ->setDefault(null);
            });
        }
        else if (!$sm->columnExists('xf_thread', 'sv_prefix_ids'))
        {
            $sm->alterTable('xf_thread', function (Alter $table) {
                $table->addColumn('sv_prefix_ids', 'mediumblob')
                      ->nullable()
                      ->setDefault(null);
            });
            $this->db()->query("
                UPDATE xf_thread
                SET sv_prefix_ids = prefix_id
                WHERE sv_prefix_ids IS NULL
            ");
        }

        if ($this->resourceManagerInstalled())
        {
            if ($sm->columnExists('xf_rm_category', 'xm_max_prefixes'))
            {
                $sm->alterTable('xf_rm_category', function (Alter $table) {
                    $table->renameColumn('xm_max_prefixes', 'sv_max_prefixes')->setDefault(0);
                });
            }

            if ($sm->columnExists('xf_rm_resource', 'xm_prefixes'))
            {
                $sm->alterTable('xf_rm_resource', function (Alter $table) {
                    $table->renameColumn('xm_prefixes', 'sv_prefix_ids')
                          ->length(null)
                          ->type('mediumblob')
                          ->nullable()
                          ->setDefault(null);
                });
            }
            else if (!$sm->columnExists('xf_rm_resource', 'sv_prefix_ids'))
            {
                $sm->alterTable('xf_rm_resource', function (Alter $table) {
                    $table->addColumn('sv_prefix_ids', 'mediumblob')
                          ->nullable()
                          ->setDefault(null);
                });
                $this->db()->query("
                    update xf_rm_resource
                    set sv_prefix_ids = prefix_id
                    WHERE sv_prefix_ids is null
                ");
            }
        }
    }

    public function upgrade1070000Step2()
    {
        $this->db()->query("
                UPDATE xf_thread
                SET sv_prefix_ids = prefix_id,
                    prefix_id = IF(LEFT(prefix_id,LOCATE(',',prefix_id) - 1) != '', LEFT(prefix_id,LOCATE(',',prefix_id) - 1), prefix_id)
                WHERE prefix_id LIKE '%,%'
            ");
    }

    public function upgrade1070000Step3()
    {
        $this->db()->query("
                UPDATE xf_thread
                SET prefix_id = 0, sv_prefix_ids = null
                WHERE sv_prefix_ids = '0' OR sv_prefix_ids = '' OR sv_prefix_ids is null
            ");
    }

    public function upgrade1070000Step4()
    {
        $this->installStep1();

        $threads = $this->db()->fetchAll("
                SELECT thread_id, sv_prefix_ids
                FROM xf_thread
                WHERE sv_prefix_ids <> '0' and sv_prefix_ids is not null
            ");

        foreach ($threads as $thread)
        {
            $id = $thread['thread_id'];
            $prefixes = explode(',', $thread['sv_prefix_ids']);
            $args = [];
            $sqlBits = [];
            foreach ($prefixes as $prefixId)
            {
                $prefixId = intval($prefixId);
                if (empty($prefixId))
                {
                    continue;
                }
                $sqlBits[] = '(?,?)';
                $args[] = $prefixId;
                $args[] = $id;
            }
            if ($args)
            {
                $sql = join(',', $sqlBits);
                $this->query('
                        INSERT IGNORE INTO xf_sv_thread_prefix_link (prefix_id, thread_id) 
                        VALUES ' . $sql . '
                    ', $args);
            }
        }

        $this->schemaManager()->alterTable('xf_thread', function (Alter $table)
        {
            $table->changeColumn('prefix_id', 'int')->unsigned()->nullable(false)->setDefault(0);
        });
    }

    public function upgrade1070000Step5()
    {
        if ($this->resourceManagerInstalled())
        {
            /** @noinspection SqlResolve */
            $this->db()->query("
                    UPDATE xf_rm_resource
                    SET sv_prefix_ids = prefix_id,
                        prefix_id = IF(LEFT(prefix_id,LOCATE(',',prefix_id) - 1) != '', LEFT(prefix_id,LOCATE(',',prefix_id) - 1), prefix_id)
                    where prefix_id like '%,%'
                ");
        }
    }

    public function upgrade1070000Step6()
    {
        if ($this->resourceManagerInstalled())
        {
            /** @noinspection SqlResolve */
            $this->db()->query("
                    UPDATE xf_rm_resource
                    SET prefix_id = 0, sv_prefix_ids = null
                    WHERE sv_prefix_ids = '0' OR sv_prefix_ids = '' OR sv_prefix_ids is null
                ");
        }
    }

    public function upgrade1070000Step7()
    {
        if ($this->resourceManagerInstalled())
        {
            /** @noinspection SqlResolve */
            $resources = $this->db()->fetchAll("
                    SELECT resource_id, sv_prefix_ids
                    FROM xf_rm_resource
                    WHERE sv_prefix_ids <> '0'
                ");

            foreach ($resources as $resource)
            {
                $id = $resource['resource_id'];
                $prefixes = explode(',', $resource['sv_prefix_ids']);
                $args = [];
                $sqlBits = [];
                foreach ($prefixes as $prefixId)
                {
                    $prefixId = intval($prefixId);
                    if (empty($prefixId))
                    {
                        continue;
                    }
                    $sqlBits[] = '(?,?)';
                    $args[] = $prefixId;
                    $args[] = $id;
                }
                if ($args)
                {
                    $sql = join(',', $sqlBits);
                    $this->db()->query('
                            INSERT IGNORE INTO xf_sv_resource_prefix_link (prefix_id, resource_id)
                            VALUES ' . $sql . '
                        ', $args);
                }
            }

            $this->schemaManager()->alterTable('xf_rm_resource', function (Alter $table)
            {
                $table->changeColumn('prefix_id', 'int')->unsigned()->nullable(false)->setDefault(0);
            });
        }
    }

    public function upgrade2000000Step1()
    {
        $this->upgrade1070000Step1();
    }

    public function upgrade2000000Step2()
    {
        $this->installStep1();
    }

    public function upgrade2000000Step3()
    {
        $this->installStep2();
    }

    public function upgrade2000000Step4()
    {
        $this->installStep3();
    }

    public function upgrade2020100Step1()
    {
        $this->installStep1();
    }

    public function upgrade2010000Step2()
    {
        $this->db()->query("
            update xf_forum
            set sv_default_prefix_ids = default_prefix_id
            where sv_default_prefix_ids is null
        ");
    }

    public function upgrade2020000Step1()
    {
        $this->installStep1();
    }

    public function upgrade2020000Step2()
    {
        $this->db()->query("
            UPDATE xf_thread
            SET sv_prefix_ids = prefix_id
            WHERE (sv_prefix_ids = '' OR sv_prefix_ids IS NULL) AND prefix_id <> 0 
        ");
    }

    public function upgrade2050000Step1()
    {
        $this->installStep1();
    }

    public function upgrade2050000Step2()
    {
        $this->installStep2();
    }

    public function upgrade2050000Step3()
    {
        $this->installStep3();
    }

    public function uninstallStep1()
    {
        $sm = $this->schemaManager();

        foreach ($this->getTables() as $tableName => $callback)
        {
            $sm->dropTable($tableName);
        }
    }

    public function uninstallStep2()
    {
        $sm = $this->schemaManager();

        foreach ($this->getRemoveAlterTables() as $tableName => $callback)
        {
            if ($sm->tableExists($tableName))
            {
                $sm->alterTable($tableName, $callback);
            }
        }
    }

    /**
     * @return array
     */
    protected function getTables()
    {
        $tables = [];


        $tables['xf_sv_thread_prefix_link'] = function ($table)
        {
            /** @var Create|Alter $table */
            $this->addOrChangeColumn($table,'thread_id', 'int');
            $this->addOrChangeColumn($table,'prefix_id', 'int');

            $table->addPrimaryKey(['thread_id', 'prefix_id']);
        };

        if ($this->resourceManagerInstalled())
        {
            $tables['xf_sv_resource_prefix_link'] = function ($table)
            {
                /** @var Create|Alter $table */
                $this->addOrChangeColumn($table,'resource_id', 'int');
                $this->addOrChangeColumn($table,'prefix_id', 'int');

                $table->addPrimaryKey(['resource_id', 'prefix_id']);
            };
        }

        if ($this->dbtechEcommerceInstalled())
        {
            $tables['xf_sv_dbtech_ecommerce_product_prefix_link'] = function ($table)
            {
                /** @var Create|Alter $table */
                $this->addOrChangeColumn($table,'product_id', 'int');
                $this->addOrChangeColumn($table,'prefix_id', 'int');

                $table->addPrimaryKey(['product_id', 'prefix_id']);
            };
        }

        if ($this->dbtechShopInstalled())
        {
            $tables['xf_sv_dbtech_shop_item_prefix_link'] = function ($table)
            {
                /** @var Create|Alter $table */
                $this->addOrChangeColumn($table,'item_id', 'int');
                $this->addOrChangeColumn($table,'prefix_id', 'int');

                $table->addPrimaryKey(['item_id', 'prefix_id']);
            };
        }

        return $tables;
    }

    public static $supportedAddOns = [
        'XFRM' => true,
        'DBTech/eCommerce' => true,
        'DBTech/Shop' => true,
    ];

    /**
     * @return array
     */
    protected function getAlterTables()
    {
        $tables = [];

        $tables['xf_forum'] = function (Alter $table) {
            $this->addOrChangeColumn($table, 'sv_min_prefixes', 'int')->setDefault(0);
            $this->addOrChangeColumn($table, 'sv_max_prefixes', 'int')->setDefault(0);
            $this->addOrChangeColumn($table, 'sv_default_prefix_ids', 'mediumblob')->after('default_prefix_id')->nullable()->setDefault(null);
        };

        $tables['xf_thread'] = function (Alter $table) {
            // force an error to occur if an old version of multiprefix was installed and not cleanly uninstalled
            $table->changeColumn('prefix_id', 'int')->unsigned()->nullable(false)->setDefault(0);

            $this->addOrChangeColumn($table, 'sv_prefix_ids', 'mediumblob')->after('prefix_id')->nullable()->setDefault(null);
        };

        $tables['xf_feed'] = function (Alter $table) {
            $this->addOrChangeColumn($table, 'sv_prefix_ids', 'mediumblob')->after('prefix_id')->nullable()->setDefault(null);
        };

        if ($this->resourceManagerInstalled())
        {
            $tables['xf_rm_category'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_min_prefixes', 'int')->setDefault(0);
                $this->addOrChangeColumn($table, 'sv_max_prefixes', 'int')->setDefault(0);
            };

            $tables['xf_rm_resource'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_prefix_ids', 'mediumblob')->after('prefix_id')->nullable()->setDefault(null);
            };
        }

        if ($this->dbtechEcommerceInstalled())
        {
            $tables['xf_dbtech_ecommerce_category'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_min_prefixes', 'int')->setDefault(0);
                $this->addOrChangeColumn($table, 'sv_max_prefixes', 'int')->setDefault(0);
            };

            $tables['xf_dbtech_ecommerce_product'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_prefix_ids', 'mediumblob')->after('prefix_id')->nullable()->setDefault(null);
            };
        }

        if ($this->dbtechShopInstalled())
        {
            $tables['xf_dbtech_shop_category'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_min_prefixes', 'int')->setDefault(0);
                $this->addOrChangeColumn($table, 'sv_max_prefixes', 'int')->setDefault(0);
            };

            $tables['xf_dbtech_shop_item'] = function (Alter $table) {
                $this->addOrChangeColumn($table, 'sv_prefix_ids', 'mediumblob')->after('prefix_id')->nullable()->setDefault(null);
            };
        }

        return $tables;
    }

    protected function getRemoveAlterTables()
    {
        $tables = [];

        $tables['xf_forum'] = function (Alter $table) {
            $table->dropColumns(['sv_min_prefixes', 'sv_max_prefixes', 'sv_default_prefix_ids']);
        };

        $tables['xf_thread'] = function (Alter $table) {
            $table->dropColumns(['sv_prefix_ids']);
        };

        if ($this->resourceManagerInstalled())
        {
            $tables['xf_rm_category'] = function (Alter $table) {
                $table->dropColumns(['sv_min_prefixes', 'sv_max_prefixes']);
            };
            $tables['xf_rm_resource'] = function (Alter $table) {
                $table->dropColumns(['sv_prefix_ids']);
            };
        }

        if ($this->dbtechEcommerceInstalled())
        {
            $tables['xf_dbtech_ecommerce_category'] = function (Alter $table) {
                $table->dropColumns(['sv_min_prefixes', 'sv_max_prefixes']);
            };
            $tables['xf_dbtech_ecommerce_product'] = function (Alter $table) {
                $table->dropColumns(['sv_prefix_ids']);
            };
        }

        if ($this->dbtechShopInstalled())
        {
            $tables['xf_dbtech_shop_category'] = function (Alter $table) {
                $table->dropColumns(['sv_min_prefixes', 'sv_max_prefixes']);
            };
            $tables['xf_dbtech_shop_item'] = function (Alter $table) {
                $table->dropColumns(['sv_prefix_ids']);
            };
        }

        return $tables;
    }

    /**
     * @return bool
     */
    protected function resourceManagerInstalled()
    {
        return $this->addonExists('XFRM');
    }

    /**
     * @return bool
     */
    protected function dbtechEcommerceInstalled()
    {
        return $this->addonExists('DBTech/eCommerce');
    }

    /**
     * @return bool
     */
    protected function dbtechShopInstalled()
    {
        return $this->addonExists('DBTech/Shop');
    }

    use InstallerSoftRequire;

    /**
     * @param array $errors
     * @param array $warnings
     */
    public function checkRequirements(&$errors = [], &$warnings = [])
    {
        $this->checkSoftRequires($errors,$warnings);
        $this->isCliRecommended($warnings, 'svMultiPrefixCliWarning', 1070000, 5000, 0, 0);

        if ($this->schemaManager()->tableExists('xf_resource_category'))
        {
            $errors[] = "Multi Prefix requires XenForo Resource Manager v2.0.0+";
        }
    }
}