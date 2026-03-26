<?php

namespace CinVin\Home;

use XF\Mvc\Entity\Entity;

use XF\App;
use XF\Container;

class Listener
{

	public static function homePageUrl(&$homePageUrl, \XF\Mvc\Router $router)
	{
		$autoHomePageUrl = \XF::options()->cinvinHome_AutoEnableHome;
		if ($autoHomePageUrl)
		{
			$homePageUrl = $router->buildLink('canonical:cv-home');

		}
	}

	public static function appSetup(App $app)
	{
		$autoHomePageUrl = \XF::options()->cinvinHome_AutoEnableHome;
		if ($autoHomePageUrl)
		{
			$container = $app->container();
			$container->router->setindexRoute('cv-home/');
		}			
	}

}
