<?php

class VNXF_MobileSwitcher_Model extends XenForo_Model {
	
	/**
	 * Get callback class of all add-on
	*/
	public function getAddonCallbackClasses($selectedAddonIds)
	{
		if (!is_array($selectedAddonIds))
		{
			$selectedAddonIds = ($selectedAddonIds ? explode(',', $selectedAddonIds) : array());
		}
		
		$addonClasses = $this->fetchAllKeyed('
			SELECT `xf_addon`.addon_id, `xf_addon`.title, `xf_code_event_listener`.callback_class
			FROM `xf_code_event_listener`
			LEFT JOIN `xf_addon` ON (`xf_addon`.addon_id = `xf_code_event_listener`.addon_id)
			WHERE callback_class != \'VNXF_MobileSwitcher_Listener\'
			ORDER BY `xf_addon`.addon_id
		', 'callback_class');
		
		$classes = array();
		foreach ($addonClasses AS $addonClass)
		{
			$classes[] = array(
				'label' => $addonClass['title'].' <span class="explain">'.$addonClass['callback_class'].'</span>',
				'value' => $addonClass['callback_class'],
				'selected' => in_array($addonClass['callback_class'], $selectedAddonIds)
			);
		}
		return $classes;
	}
}