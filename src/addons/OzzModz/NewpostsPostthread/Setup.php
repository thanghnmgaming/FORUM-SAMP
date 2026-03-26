<?php

namespace OzzModz\NewpostsPostthread;

class Setup extends \XF\AddOn\AbstractSetup
{
	use \XF\AddOn\StepRunnerInstallTrait;
	use \XF\AddOn\StepRunnerUpgradeTrait;
	use \XF\AddOn\StepRunnerUninstallTrait;
  
  	public function checkRequirements(&$errors = [], &$warnings = [])
	{
		if (\XF::$versionId < 2010031)
		{
			$errors[] = 'This add-on may only be used on XenForo 2.1 or higher';
			return $errors;
		}

		return $errors;
	}
}