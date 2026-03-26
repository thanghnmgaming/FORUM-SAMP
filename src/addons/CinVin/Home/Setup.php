<?php

namespace CinVin\Home;



class Setup extends \XF\AddOn\AbstractSetup
{
	use \XF\AddOn\StepRunnerInstallTrait;
	use \XF\AddOn\StepRunnerUpgradeTrait;
	use \XF\AddOn\StepRunnerUninstallTrait;


	/* *************** */
	/* *** INSTALL *** */
	/* *************** */

	public function installStep1()
	{

		// Add default widgets to CinVin Portal sidebar
		$this->createWidget('cinvin_home_view_members_online', 'members_online', [
			'positions' => ['cinvin_home_sidebar' => 10]
		]);
		$this->createWidget('cinvin_home_view_new_posts', 'new_posts', [
			'positions' => ['cinvin_home_sidebar' => 20]
		]);
		$this->createWidget('cinvin_home_view_new_profile_posts', 'new_profile_posts', [
			'positions' => ['cinvin_home_sidebar' => 30]
		]);
		$this->createWidget('cinvin_home_view_forum_statistics', 'forum_statistics', [
			'positions' => ['cinvin_home_sidebar' => 40]
		]);
		$this->createWidget('cinvin_home_view_share_page', 'share_page', [
			'positions' => ['cinvin_home_sidebar' => 50]
		]);

	}

	public function postInstall(array &$stateChanges)
	{
		// Anything we need to do post install?
	}


	/* ***************** */
	/* *** UNINSTALL *** */
	/* ***************** */

	public function uinstallStep1()
	{

	}

}
