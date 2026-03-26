<?php

class VNXF_MobileSwitcher_Option {
	
	public static function renderAddonCheckbox(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
	{
		$preparedOption['formatParams'] = XenForo_Model::create('VNXF_MobileSwitcher_Model')->getAddonCallbackClasses(
			$preparedOption['option_value']
		);
		return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal(
			'option_list_option_checkbox',
			$view, $fieldPrefix, $preparedOption, $canEdit
		);
	}
}