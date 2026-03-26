<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs\XF\Pub\Controller;

class Account extends XFCP_Account
{
    protected function preferencesSaveProcess(\XF\Entity\User $visitor)
    {
        $form = parent::preferencesSaveProcess($visitor);

        $xfaFtDisable = $this->filter('xfa_ft_disable', 'uint');

        $form->setup(function() use ($visitor, $xfaFtDisable)
        {
            $visitor->xfa_ft_disable = $xfaFtDisable;
        });

        return $form;
    }
}