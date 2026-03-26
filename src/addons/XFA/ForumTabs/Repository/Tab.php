<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs\Repository;

use XF\Mvc\Entity\AbstractCollection;
use XF\Mvc\Entity\Repository;

class Tab extends Repository
{
    public function getTabsList()
    {
        $tabs = $this->finder('XFA\ForumTabs:Tab')->order('order', 'asc')->fetch();

        return $tabs->filterViewable($tabs);
    }
}