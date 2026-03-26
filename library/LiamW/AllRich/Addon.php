<?php

abstract class LiamW_AllRich_Addon
{

	public static function initDependencies(XenForo_Dependencies_Abstract $dependencies, array $data)
	{
		$array = array(
			'usernamehtml' => array(
				'LiamW_AllRich_Template_Helper_Core',
				'helperUserNameHtml'
			)
		);

		XenForo_Template_Helper_Core::$helperCallbacks = array_merge(XenForo_Template_Helper_Core::$helperCallbacks, $array);
	}

}