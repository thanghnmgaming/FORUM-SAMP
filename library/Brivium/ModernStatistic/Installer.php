<?php
class Brivium_ModernStatistic_Installer extends Brivium_BriviumHelper_Installer
{
	protected $_installerType = 1;
	
	public static function install($existingAddOn, $addOnData)
	{
		self::$_addOnInstaller = __CLASS__;
		if (self::$_addOnInstaller && class_exists(self::$_addOnInstaller))
		{
			$installer = self::create(self::$_addOnInstaller);
			$installer->installAddOn($existingAddOn, $addOnData);
		}
		return true;
	}
	
	public static function uninstall($addOnData)
	{
		self::$_addOnInstaller = __CLASS__;
		if (self::$_addOnInstaller && class_exists(self::$_addOnInstaller))
		{
			$installer = self::create(self::$_addOnInstaller);
			$installer->uninstallAddOn($addOnData);
		}
	}
	protected $_modernStatistic = null;
	
	protected function _preInstall()
	{
		if(!empty($this->_existingAddOn['version_id']) && $this->_existingAddOn['version_id'] < 2000000){
			$options = XenForo_Application::get('options');
			$modernStatistic = array();
			$modernStatistic['title'] = 'Modern Statisitc';
			$tabList = $options->BRMS_tabsSelector;
			if(!$tabList) return;
			foreach($tabList AS &$tab){
				if(empty($tab['kind'])){
					$tab['kind'] = 'thread';
				}
			}
			$modernStatistic['tab_data'] = $tabList;
			$modernStatistic['position'] = $options->BRMS_position;
			$modernStatistic['control_position'] = $options->BRMS_navPosition;
			$modernStatistic['item_limit'] = $options->BRMS_itemLimit;
			$modernStatistic['auto_update'] = $options->BRMS_updateTime;
			$modernStatistic['style_display'] = $options->BRMS_styleDisplay;
			$modernStatistic['preview_tooltip'] = $options->BRMS_usePreviewTooltip;
			
			$tabCacheTime = $options->BRMS_tabCacheTime;
			$modernStatistic['enable_cache'] = !empty($tabCacheTime['enabled'])?1:0;
			$modernStatistic['cache_time'] = !empty($tabCacheTime['cache_time'])?$tabCacheTime['cache_time']:1;
			
			$modernStatistic['thread_cutoff'] = $options->BRMS_threadDateCutOff;
			$modernStatistic['usename_marke_up'] = $options->BRMS_usernameMakeUp;
			$modernStatistic['show_thread_prefix'] = $options->BRMS_showThreadPrefix;
			$modernStatistic['show_resource_prefix'] = $options->BRMS_showResourcePrefix;
			$modernStatistic['allow_change_layout'] = $options->BRMS_allowChangeLayout;
			$modernStatistic['allow_manual_refresh'] = $options->BRMS_allowRefresh;
			$modernStatistic['load_fisrt_tab'] = $options->BRMS_loadFirstTab;
			$modernCriteria = array(
				'template_name'	=> 'forum_list'
			);
			$modernStatistic['modern_criteria'] = $modernCriteria;
			
			$modernStatistic['active'] = 1;
			$this->_modernStatistic = $modernStatistic;
		}
	}
	
	protected function _postInstall()
	{
		if($this->_modernStatistic){
			$writer = XenForo_DataWriter::create('Brivium_ModernStatistic_DataWriter_ModernStatistic', XenForo_DataWriter::ERROR_SILENT);
			$writer->bulkSet($this->_modernStatistic);
			$writer->save();
		}
		$this->getModelFromCache('Brivium_ModernStatistic_Model_ModernStatistic')->rebuildModernStatisticCaches();
	}
	protected function _postUninstall()
	{
		$this->getModelFromCache('XenForo_Model_DataRegistry')->delete('brmsModernStatisticCache');
	}
	
	public function getTables()
	{
		$tables = array();
		
		return $tables;
	}
	
	public function getAlters()
	{
		$alters = array();
		
		return $alters;
	}
	
	public function getQueryFinal()
	{
		$query = array();
		
		return $query;
	}

}

?>