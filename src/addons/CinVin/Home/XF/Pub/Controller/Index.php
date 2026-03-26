<?php

namespace CinVin\Home\XF\Pub\Controller;

class Index extends XFCP_Index
{
	public function actionIndex()
	{
		$defaultRoute = parent::actionIndex();
dump($defaultRoute);
exit('yep');
		return $this->reroutePath('cv-home/');
	}

}
