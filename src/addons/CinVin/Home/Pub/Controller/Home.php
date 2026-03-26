<?php

namespace CinVin\Home\Pub\Controller;

class Home extends \XF\Pub\Controller\AbstractController
{
	
	/* View the Home page template */
	public function actionIndex()
	{
		$viewParams = [];
		return $this->view('CinVin\Home:View', 'cinvin_home_view', $viewParams);
	}

	/* Acivity description when viewing memers online */
	public static function getActivityDetails(array $activities)
	{
		return \XF::phrase('cinvin_home_viewing');
	}

}


