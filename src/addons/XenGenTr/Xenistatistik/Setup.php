<?php

namespace XenGenTr\Xenistatistik;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

    /**
     * ----------------
     *     Kuruluma basla
     * ----------------
     */

    public function installStep1()
    {
        $this->createWidget('XenYeniMesaj_Widget', 'XenYeniMesaj_Widget', [
            'positions' => []

        ]);

        $this->createWidget('XenYeniKonu_Widget', 'XenYeniKonu_Widget', [
            'positions' => []

        ]);

         $this->createWidget('XenEncokGrnKonular_Widget', 'XenEncokGrnKonular_Widget', [
            'positions' => []
        ]);


        $this->createWidget('Xenuyeistatik_widget', 'Xenuyeistatik_widget', [
            'positions' => []
        ]);
    }

    /**
     * ----------------
     *     Guncelleme yap
     * ----------------
     */

     /* 1.2.2 Beta1 */
     /* Widget olustur */ 

     public function upgrade1020030Step1()
      {
         $this->createWidget('XenEncokGrnKonular_Widget', 'XenEncokGrnKonular_Widget', [
            'positions' => []
        ]);
      }
}