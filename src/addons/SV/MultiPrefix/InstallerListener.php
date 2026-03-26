<?php

namespace SV\MultiPrefix;

class InstallerListener
{
    public static function addonPostRebuild(/** @noinspection PhpUnusedParameterInspection */
        \XF\AddOn\AddOn $addOn, \XF\Entity\AddOn $installedAddOn, array $json)
    {
        if (empty(Setup::$supportedAddOns[$addOn->getAddOnId()]))
        {
            return;
        }

        // kick off the installer
        $setup = new Setup($addOn, \XF::app());
        $setup->installStep1();
        $setup->installStep2();
        $setup->installStep3();
    }

    public static function addonPostInstall(/** @noinspection PhpUnusedParameterInspection */
        \XF\AddOn\AddOn $addOn, \XF\Entity\AddOn $installedAddOn, array $json, array &$stateChanges)
    {
        if (empty(Setup::$supportedAddOns[$addOn->getAddOnId()]))
        {
            return;
        }

        // kick off the installer
        $setup = new Setup($addOn, \XF::app());
        $setup->installStep1();
        $setup->installStep2();
        $setup->installStep3();
    }
}