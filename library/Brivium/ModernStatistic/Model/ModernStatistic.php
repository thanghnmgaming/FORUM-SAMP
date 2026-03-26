<?php
class Brivium_ModernStatistic_Model_ModernStatistic extends XenForo_Model
{
	
	public function getAllModernStatistics()
	{
		$modernStatistics = $this->fetchAllKeyed('
			SELECT *
			FROM xf_brivium_modern_statistic
		', 'modern_statistic_id');
		return $modernStatistics;
	}
	
	public function getActiveModernStatistics()
	{
		$modernStatistics = $this->fetchAllKeyed('
			SELECT *
			FROM xf_brivium_modern_statistic
			WHERE active = 1
		', 'modern_statistic_id');
		return $modernStatistics;
	}
	/**
	*	get product type by its id
	* 	@param integer $modernStatisticId
	*	@return array|false statistic info
	*/
	
	public function getModernStatisticById($modernStatisticId)
	{
		return $this->_getDb()->fetchRow('
			SELECT *
			FROM xf_brivium_modern_statistic
			WHERE modern_statistic_id = ?
		',$modernStatisticId);
	}
	
	public function getModernStatisticByIds(array $modernStatisticIds,$fetchOptions = array())
	{
		if (!$modernStatisticIds)
		{
			return array();
		}
		$joinOptions = $this->prepareProductFetchOptions($fetchOptions);
		return $this->fetchAllKeyed('
			SELECT modern_statistic.*
			' .$joinOptions['selectFields']. '
			FROM xf_brivium_modern_statistic AS modern_statistic
			' .$joinOptions['joinTables']. '
			WHERE modern_statistic.modern_statistic_id IN (' . $this->_getDb()->quote($modernStatisticIds) . ')
		', 'modern_statistic_id');
	}
	
	public function getAllModernStatisticsForCache()
	{
		$this->resetLocalCacheData('allModernStatistics');

		$modernStatistics = $this->getActiveModernStatistics();
		return $modernStatistics;
	}

	/**
	 * Rebuilds the full Statistic cache.
	 *
	 * @return array Format: [statistic id] => info, with phrase cache as array
	 */
	public function rebuildModernStatisticCache()
	{
		$this->resetLocalCacheData('allStatistics');

		$modernStatistics = $this->getAllModernStatisticsForCache();
		$positions = array();
		
		foreach($modernStatistics AS &$modernStatistic){
			if(!empty($modernStatistic['position'])){
				$positionMap =	preg_split('/\s+/', trim($modernStatistic['position']));
				foreach($positionMap AS $position){
					if(empty($positions[$position])) $positions[$position] = array();
					$positions[$position][] = $modernStatistic['modern_statistic_id'];
				}
				$modernStatistic = $this->prepareModernStatistic($modernStatistic);
			}
		}
		$cache = array(
			'modernStatistics'	=> $modernStatistics,
			'positions'	=> $positions,
		);
		$this->_getDataRegistryModel()->set('brmsModernStatisticCache', $cache);
		return $cache;
	}
	
	/**
	 * Rebuilds all statistic caches.
	 */
	public function rebuildModernStatisticCaches()
	{
		$this->rebuildModernStatisticCache();
	}

	public function prepareModernStatistic($modernStatistic, $edit = false)
	{
		$modernStatistic['tabData'] = @unserialize($modernStatistic['tab_data']);
		$modernStatistic['styleSettings'] = @unserialize($modernStatistic['style_settings']);
		$modernStatistic['itemLimit'] = @unserialize($modernStatistic['item_limit']);
		$modernStatistic['modernCriteria'] = @unserialize($modernStatistic['modern_criteria']);
		if(!$modernStatistic['tabData'] || !is_array($modernStatistic['tabData'])){
			$modernStatistic['tabData'] = array();
		}
		foreach($modernStatistic['tabData'] AS $key=>&$tab){
			if(!$edit){
				if(!empty($tab['active']) && (($tab['kind']!='resource' && $tab['type']!='user_most_resources') || $this->checkXenForoResourceAddon())){
				}else{
					unset($modernStatistic['tabData'][$key]);
					continue;
				}
			}
			$tab['defaultTitle'] = $tab['title'];
			if(empty($tab['title']) && !empty($tab['type'])){
				switch($tab['type']){
					case 'thread_latest':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_latest_threads');
						break;
					case 'thread_hotest':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_most_viewed_threads');
						break;
					case 'post_latest':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_latest_replies');
						break;
					case 'most_reply':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_most_replied_threads');
						break;
					case 'sticky_threads':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_sticky_threads');
						break;
					case 'my_threads':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_my_threads');
						break;
					case 'resource_last_update':
						$tab['defaultTitle'] = new XenForo_Phrase('latest_updates');
						break;
					case 'resource_resource_date':
						$tab['defaultTitle'] = new XenForo_Phrase('newest_resources');
						break;
					case 'resource_rating_weighted':
						$tab['defaultTitle'] = new XenForo_Phrase('top_resources');
						break;
					case 'resource_download_count':
						$tab['defaultTitle'] = new XenForo_Phrase('most_downloaded');
						break;
					case 'user_most_messages':
						$tab['defaultTitle'] = new XenForo_Phrase('most_messages');
						break;
					case 'user_most_likes':
						$tab['defaultTitle'] = new XenForo_Phrase('most_likes');
						break;
					case 'user_most_points':
						$tab['defaultTitle'] = new XenForo_Phrase('most_points');
						break;
					case 'user_staff_members':
						$tab['defaultTitle'] = new XenForo_Phrase('staff_members');
						break;
					case 'user_most_resources':
						$tab['defaultTitle'] = new XenForo_Phrase('most_resources');
						break;
					case 'user_latest_members':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_latest_members');
						break;
					case 'user_latest_banned':
						$tab['defaultTitle'] = new XenForo_Phrase('BRMS_latest_banned_members');
						break;
					case 'user_richest':
						$tab['defaultTitle'] = new XenForo_Phrase('BRC_top_richest');
						break;
					case 'user_poorest':
						$tab['defaultTitle'] = new XenForo_Phrase('BRC_top_poorest');
						break;
				}
				if($tab['defaultTitle'])$tab['defaultTitle'] = $tab['defaultTitle']->render();
			}
		}
		if(!$modernStatistic['itemLimit'] || !is_array($modernStatistic['itemLimit'])){
			$modernStatistic['itemLimit'] = array('default'=>15);
		}
		return $modernStatistic;
	}
	
	public function prepareModernStatistics($modernStatistics, $edit = false)
	{
		foreach ($modernStatistics AS &$modernStatistic)
		{
			$modernStatistic = $this->prepareModernStatistic($modernStatistic, $edit);
		}
		return $messages;
	}

	public function getStatisticTabParams($modernStatisticId, $tabId, $userId, $limit, $useCache = true)
	{
		$statisticParams = array();
		$modernStatistic = XenForo_Application::get('brmsModernStatistics')->$modernStatisticId;
		
		$viewParams = array(
			'items'		=> array(),
			'useCacheParam'	=> false,
			'cachedStatistic'	=> array(),
			'statisticParams'	=> array(),
			'modernStatistic'	=> $modernStatistic,
		);
		
		if(!empty($modernStatistic) && !empty($modernStatistic['tabData'][$tabId])){
			if(!$limit){
				$limit = !empty($modernStatistic['itemLimit']['default'])?$modernStatistic['itemLimit']['default']:15;
			}
			$tabParam = $modernStatistic['tabData'][$tabId];
			$cachedStatistic = array();
			if($useCache && !empty($modernStatistic['enable_cache']) && !empty($modernStatistic['cache_time'])){
				$cacheTime = max(1,$modernStatistic['cache_time']);
				$lastUpdate =  XenForo_Application::$time - $cacheTime*60;
				
				$cachedStatistic = $this->getModernCacheDataForUserId($modernStatisticId, $userId, $lastUpdate);
				
				$cachedStatistic['tabCacheHtmls'] = @unserialize($cachedStatistic['tab_cache_htmls']);
				$cachedStatistic['tabCacheParams'] = @unserialize($cachedStatistic['tab_cache_params']);
				$viewParams['cachedStatistic'] = $cachedStatistic;
				if(!empty($cachedStatistic['tabCacheHtmls'])){
					if(!empty($cachedStatistic['tabCacheHtmls'][$tabId])){
						$statisticParams['renderedHtml'] = $cachedStatistic['tabCacheHtmls'][$tabId];
						$viewParams['useCacheParam'] = true;
					}
				}else if(!empty($cachedStatistic['tabCacheParams'])){
					if(!empty($cachedStatistic['tabCacheParams'][$tabId])){
						$statisticParams = $cachedStatistic['tabCacheParams'][$tabId];
						$viewParams['useCacheParam'] = true;
					}
				}
			}
			if(empty($viewParams['useCacheParam'])){
				$tabParam['kind'] = !empty($tabParam['kind'])?$tabParam['kind']:'thread';
				switch($tabParam['kind']){
					case 'resource':
						$statisticParams = $this->getResourceStatistics($tabParam, $limit, $modernStatistic);
						break;
					case 'user':
						$statisticParams = $this->getUserStatistics($tabParam, $limit, $modernStatistic);
						break;
					case 'resource':
					default:
						$statisticParams = $this->getThreadStatistics($tabParam, $limit, $modernStatistic);
						break;
				}
			}
			$viewParams['tabParams'] = $statisticParams;
			$viewParams = array_merge($statisticParams, $viewParams);
		}
		
		return $viewParams;
	}
	
	public function getModernCacheDataForUserId($modernStatisticId, $userId, $lastUpdate = 0)
	{
		return $this->_getDb()->fetchRow('
			SELECT *
				FROM xf_brivium_modern_cache
			WHERE modern_statistic_id = ? AND user_id = ? AND last_update >= ?
		', array($modernStatisticId, $userId, $lastUpdate));
	}
	
	public function getResourceStatistics($tab, $limit, $modernStatistic)
	{
		if($this->checkXenForoResourceAddon()){
			$resourceModel = $this->_getResourceModel();
			$categoryModel = $this->_getCategoryModel();
			$fetchOptions = array(
				'join' => XenResource_Model_Resource::FETCH_VERSION
				| XenResource_Model_Resource::FETCH_USER
				| XenResource_Model_Resource::FETCH_CATEGORY
				| XenResource_Model_Resource::FETCH_FEATURED,
				'limit' => $limit,
				'order' => 'last_update',
				'direction' => 'desc',
			);
			$template = '';
			$criteria = array();
			if(empty($tab['type']) && !empty($tab['resource_type'])) $tab['type'] = $tab['resource_type'];
			switch ($tab['type'])
			{       	
				case 'resource_last_update':
					$fetchOptions['order'] = 'last_update';
					$template	=	'BRMS_resource_last_update';
					break;
				case 'resource_resource_date':
					$fetchOptions['order'] = 'resource_date';
					$template	=	'BRMS_resource_resource_date';
					break;
				case 'resource_rating_weighted':
					$fetchOptions['order'] = 'rating_weighted';
					$template	=	'BRMS_resource_rating_weighted';
					break;
				case 'resource_download_count':
					$fetchOptions['order'] = 'download_count';
					$template	=	'BRMS_resource_download_count';
					break;
			}

			$criteria += $categoryModel->getPermissionBasedFetchConditions();
			
			$criteria['resource_state'] = 'visible';
			$viewableCategories = $this->_getCategoryModel()->getViewableCategories();
			$categoryIds = array_keys($viewableCategories);
			if(!empty($tab['categories']) && $tab['categories'] != array(0=>0)){
				$categoryIds = array_intersect($categoryIds, $tab['categories']);
			}
			$criteria['resource_category_id'] = $categoryIds;
			$resources = $resourceModel->getResources($criteria,$fetchOptions);
			$resources = $this->_getResourceModel()->filterUnviewableResources($resources);
			$resources = $resourceModel->prepareResources($resources);
			$viewParams = array(
				'template' => $template,
				'items' => $resources,
				'limit' => $limit,
			);
		}else{
			$viewParams = array(
				'template' => '',
				'items' => array(),
				'limit' => $limit,
			);
		}

		return $viewParams;
	}
	
	public function getUserStatistics($tab, $limit, $modernStatistic)
	{
		$userModel = $this->_getUserModel();
		$fetchOptions = array(
			'join' => XenForo_Model_User::FETCH_USER_FULL,
			'limit' => $limit,
			'order' => 'username',
			'direction' => 'desc',
		);
		$viewParams = array(
			'template' => '',
			'items' => array(),
			'limit' => $limit,
		);
		$template = '';
		$criteria = array(
			'user_state' => 'valid',
			'is_banned' => 0
		);
		if(empty($tab['type']) && !empty($tab['resource_type'])) $tab['type'] = $tab['resource_type'];
		if(empty($tab['type']) && !empty($tab['user_type'])) $tab['type'] = $tab['user_type'];
		switch ($tab['type'])
		{       	
			case 'user_most_messages':
				$fetchOptions['order'] = 'message_count';
				$template	=	'BRMS_user_most_messages';
				break;
			case 'user_most_likes':
				$fetchOptions['order'] = 'like_count';
				$template	=	'BRMS_user_most_likes';
				break;
			case 'user_most_points':
				$fetchOptions['order'] = 'trophy_points';
				$template	=	'BRMS_user_most_points';
				break;
			case 'user_staff_members':
				$criteria['is_staff'] = true;
				$fetchOptions['order'] = 'username';
				$fetchOptions['direction'] = 'asc';
				$template	=	'BRMS_user_staff_members';
				break;
			case 'user_most_resources':
				$fetchOptions['order'] = 'resource_count';
				$template	=	'BRMS_user_most_resources';
				break;
			case 'user_latest_members':
				$fetchOptions['order'] = 'register_date';
				$template	=	'BRMS_user_latest_members';
				break;
			case 'user_latest_banned':
				$fetchOptions['order'] = 'ban_date';
				$fetchOptions['BRMS_fetch_banned_user'] = true;
				$criteria['is_banned'] = true;
				$template	=	'BRMS_user_latest_banned';
				break;
			case 'user_richest':
			case 'user_poorest':
				$creditVersion = $this->checkBriviumCreditsAddon();
				$column = '';
				if($creditVersion >= 1000000 && !empty($tab['currency_id'])){
					$currency = XenForo_Application::get('brcCurrencies')->$tab['currency_id'];
					if(!empty($currency['column'])){
						$column = $currency['column'];
					}
				}else{
					$column = 'credits';
				}
				if($column){
					$fetchOptions['order'] = $column;
					$viewParams['currency'] = $currency;
					$viewParams['currencyId'] = $tab['currency_id'];
					$viewParams['column'] = $currency['column'];
					if($tab['type']=='user_poorest'){
						$fetchOptions['direction'] = 'asc';
					}
					$template	=	'BRMS_user_richest';
				}
				
				break;
		}
		if(!$template){
			return $viewParams;
		}
		
		$userGroupsIds = array();
		if(!empty($tab['user_groups']) && $tab['user_groups'] != array(0=>0)){
			$userGroupsIds = $tab['user_groups'];
		}
		$criteria['user_group_id'] = $userGroupsIds;
		
		$users = $userModel->getUsers($criteria,$fetchOptions);
		foreach($users AS &$user){
			$user = $userModel->prepareUser($user);
		}
		$viewParams['template'] = $template;
		$viewParams['items'] = $users;
		$viewParams['limit'] = $limit;
		return $viewParams;
	}
	
	public function getThreadStatistics($tab, $limit, $modernStatistic)
	{
		$conditions = array();
		$fetchOptions = array(
			'limit' => $limit,
			'order' => 'post_date',
			'direction' => 'desc',
			'join' => XenForo_Model_Thread::FETCH_FORUM,
			'readUserId' => XenForo_Visitor::getUserId(),
			'includeForumReadDate' => true,
			'BRMS_fetch_user' => true,
		);
		if(!$modernStatistic['usename_marke_up']){
			$fetchOptions['BRMS_fetch_user'] = false;
		}
		
		$now = XenForo_Application::$time;
		$template = '';
		switch ($tab['type'])
		{       	
			case 'thread_latest':
				$fetchOptions['order'] = 'post_date';
				$template	=	'BRMS_thread_latest';
				break;
			case 'thread_hotest':
				$fetchOptions['order'] = 'view_count';
				$template	=	'BRMS_thread_most_viewed';
				if (!empty($tab['cut_off']) && $tab['cut_off'] > 0) {
					$conditions['BRMS_post_date'] = array('>', $now - $tab['cut_off'] * 86400);
				}else if($modernStatistic['thread_cutoff'] > 0){
					$conditions['BRMS_post_date'] = array('>', $now - $modernStatistic['thread_cutoff'] * 86400);
				}
				break;
			case 'post_latest':
				$fetchOptions['order'] = 'last_post_date';
				if($modernStatistic['usename_marke_up']){
					$fetchOptions['BRMS_fetch_user'] = false;
					$fetchOptions['BRMS_join_last_post'] = true;
				}
				$template	=	'BRMS_thread_post_latest';
				break;
			case 'most_reply':
				if (!empty($tab['cut_off']) && $tab['cut_off'] > 0) {
					$conditions['BRMS_post_date'] = array('>', $now - $tab['cut_off'] * 86400);
				}else if($modernStatistic['thread_cutoff'] > 0){
					$conditions['BRMS_post_date'] = array('>', $now - $modernStatistic['thread_cutoff'] * 86400);
				}
				$fetchOptions['order'] = 'reply_count';
				$template	=	'BRMS_thread_most_reply';
				break;
			case 'my_threads':
				
				if(!empty($tab['order_type'])){
					$fetchOptions['order'] = $tab['order_type'];
				}
				if(!empty($tab['order_direction'])){
					$fetchOptions['order'] = $tab['order_direction'];
				}
				$conditions['user_id'] = XenForo_Visitor::getUserId();
				$template	=	'BRMS_thread_my_threads';
				break;
			case 'sticky_threads':
				if(!empty($tab['order_type'])){
					$fetchOptions['order'] = $tab['order_type'];
				}
				if(!empty($tab['order_direction'])){
					$fetchOptions['order'] = $tab['order_direction'];
				}
				$conditions['sticky'] = 1;
				$template	=	'BRMS_thread_my_threads';
				break;
		}
		$GLOBALS['BRMS_ControllerPublic_ModernStatistic'] = true;
		
		/* get thread by viewable forum
		$viewableNodes = $this->_getViewableNode();
		$nodeIds = array_keys($viewableNodes);
		if(!empty($tab['forums']) && $tab['forums'] != array(0=>0)){
			$nodeIds = array_intersect($nodeIds, $tab['forums']);
		}
		$conditions['node_id'] = $nodeIds;
		 */
		/* get thread by unviewable forum */
		
		$unviewableNodes = $this->_getUnviewableNode();
		$unviewableNodeIds = array_keys($unviewableNodes);
		$viewableNodeIds = array();
		
		if(!empty($tab['forums']) && $tab['forums'] != array(0=>0)){
			$viewableNodeIds = array_diff($tab['forums'],$unviewableNodeIds);
			if($viewableNodeIds){
				
			}else{
				$viewableNodeIds = array(0=>0);
			}
		}else{
			$conditions['BRMS_not_node_id'] = $unviewableNodeIds;
		}
		
		$conditions['node_id'] = $viewableNodeIds;
		
		$conditions['discussion_state'] = 'visible';
		$conditions['not_discussion_type'] = 'redirect';
		$threadModel = $this->_getThreadModel();
		$threads = $threadModel->getThreads($conditions, $fetchOptions);
		$threads = $threadModel->modernStatisticPrepareThreads($threads, $modernStatistic);
		unset($GLOBALS['BRMS_ControllerPublic_ModernStatistic']);
		$viewParams = array(
			'template' => $template,
			'items' => $threads,
			'limit' => $limit,
		);
		return $viewParams;
	}
	
	protected static  $_viewAbleNode = null;
	
	protected function _getViewableNode()
	{
		if (!isset(self::$_viewAbleNode)) {
			self::$_viewAbleNode = $this->_getNodeModel()->getViewableNodeList();
		}
		return self::$_viewAbleNode;
	}

	protected static  $_unviewableNode = null;
	
	protected function _getUnviewableNode()
	{
		if (!isset(self::$_unviewableNode)) {
			self::$_unviewableNode = $this->_getNodeModel()->getUnviewableNodeList();
		}
		return self::$_unviewableNode;
	}

	protected static  $_resourceAddOn = null;
	
	public function checkXenForoResourceAddon()
	{
		if(self::$_resourceAddOn != null){
			return self::$_resourceAddOn;
		}
		if (XenForo_Application::isRegistered('addOns'))
		{
			$addOns = XenForo_Application::get('addOns');
			if (!empty($addOns['XenResource']))
			{
				return true;
			}
		}else{
			if ($this->getModelFromCache('XenForo_Model_AddOn')->getAddOnVersion('XenResource')) {
				return true;
			}
		}
		return false;
	}
	
	protected static  $_creditAddOn = null;
	
	public function checkBriviumCreditsAddon()
	{
		if(self::$_creditAddOn != null){
			return self::$_creditAddOn;
		}
		if (XenForo_Application::isRegistered('addOns'))
		{
			$addOns = XenForo_Application::get('addOns');
			if (!empty($addOns['Brivium_Credits']))
			{
				return $addOns['Brivium_Credits'];
			}
		}else{
			$creditAddOn = $this->getModelFromCache('XenForo_Model_AddOn')->getAddOnVersion('Brivium_Credits');
			if (!empty($creditAddOn['version_id'])) {
				return $creditAddOn['version_id'];
			}
		}
		return false;
	}
	
	public function getStatisticsContentFromStatisticIds($statisticIds)
	{
		
		$content = '';
		$modernStatistics = $this->getModernStatisticByIds($statisticIds);
		if($modernStatistics){
			foreach($modernStatistics AS $modernStatistic){
				$content .= $this->getStatisticContent($modernStatistic);
			}
		}
		return $content;
	}
	
	public function getModernStatisticForHook($hookName, $loadedTemplates, $templateParams, XenForo_Template_Abstract $template)
	{
		
		$renderedContents = '';
		$positions = XenForo_Application::get('brmsPositions');
		if(!empty($positions) && is_array($positions) && array_key_exists($hookName, $positions)){
			$renderedContents = $this->renderModernStatistics($positions[$hookName], $loadedTemplates, $templateParams, $template);
		}
		return $renderedContents;
	}
	
	public function validateStatisticCriteria($statisticCriteria, $loadedTemplates, $templateParams)
	{
		if(!$statisticCriteria) return true;
		if(!empty($statisticCriteria['template_name'])){
			if(!$loadedTemplates || !is_array($loadedTemplates)){
				return false;
			}
			$templateNames = preg_split('/\s+/', trim($statisticCriteria['template_name']));
			if($templateNames && !array_intersect($templateNames, $loadedTemplates)){
				return false;
			}
		}
		if(!empty($statisticCriteria['user_group_ids']) && is_array($statisticCriteria['user_group_ids']) && !$this->checkExcludeUserGroups($statisticCriteria['user_group_ids'])){
			return false;
		}
		if(!empty($statisticCriteria['node_ids']) && $statisticCriteria['node_ids']!=array(0=>'') && !empty($templateParams)){
			$nodeId = 0;
			if(!empty($templateParams['forum']['node_id'])){
				$nodeId = $templateParams['forum']['node_id'];
			}else if(!empty($templateParams['category']['node_id'])){
				$nodeId = $templateParams['category']['node_id'];
			}else if(!empty($templateParams['page']['node_id'])){
				$nodeId = $templateParams['page']['node_id'];
			}
			if(!$nodeId || !in_array($nodeId,$statisticCriteria['node_ids'])){
				return false;
			}
		}
		return true;
		
	}
	
	public function renderModernStatistics($modernStatisticIds, $loadedTemplates, $templateParams, XenForo_Template_Abstract $template)
	{
		$renderedContents = '';
		$statisticObj = XenForo_Application::get('brmsModernStatistics');
		$request = new Zend_Controller_Request_Http();
		$visitor = XenForo_Visitor::getInstance()->toArray();
		$userId = $visitor['user_id'];
		$visitorPerferences = !empty($visitor['brms_statistic_perferences'])?@unserialize($visitor['brms_statistic_perferences']):array();
		
		
		foreach($modernStatisticIds AS $modernStatisticId){
			$modernStatistic = $statisticObj->$modernStatisticId;

			if(!empty($modernStatistic['active'])){

				if(!empty($modernStatistic['allow_user_setting']) && !empty($visitorPerferences[$modernStatisticId])){
					continue;
				}
				if(!empty($modernStatistic['modernCriteria']) && !$this->validateStatisticCriteria($modernStatistic['modernCriteria'], $loadedTemplates, $templateParams)){
					$renderedContents .= '';
					continue;
				}

				$rendered = false;
				if(!empty($modernStatistic['enable_cache']) && !empty($modernStatistic['cache_time'])){
					$cacheTime = max(1,$modernStatistic['cache_time']);
					$lastUpdate =  XenForo_Application::$time - $cacheTime*60;
					
					$cachedStatistic = $this->getModernCacheDataForUserId($modernStatisticId, $userId, $lastUpdate);
					if(!empty($cachedStatistic['cache_html'])){
						if(isset($templateParams['visitorStyle']['style_id'])){
							$styleId = $templateParams['visitorStyle']['style_id'];
							if(!empty($modernStatistic['styleSettings']) && !empty($modernStatistic['styleSettings'][$styleId])){
								if($modernStatistic['styleSettings'][$styleId] =='dark'){
									if(!strpos($cachedStatistic['cache_html'], 'BRMSContainerDark')){
										$cachedStatistic['cache_html'] = str_replace('BRMSContainer', 'BRMSContainer BRMSContainerDark', $cachedStatistic['cache_html']);
									}
								}else{
									$cachedStatistic['cache_html'] = str_replace('BRMSContainerDark', '', $cachedStatistic['cache_html']);
								}
							}
						}
						$renderedContents .= $cachedStatistic['cache_html'];
						$rendered = true;
					}
				}
				if(!$rendered){
					$newTemplate = $template->create('BRMS_ModernStatistic',$template->getParams());
					
					$tabCacheHtmls = array();
					$tabCacheParams = array();
					
					if(!empty($modernStatistic['load_fisrt_tab']) && !empty($modernStatistic['tabData'])){
						$tabId = -1;
						foreach($modernStatistic['tabData'] AS $key=>$tab){
							if($tab['type']!='my_threads' || !empty($userId)){
								$tabId = $key;
								break;
							}
						}
						if($tabId!=-1){
							if(!empty($modernStatistic['itemLimit']['enabled'])){
								$limit = $request->getCookie('brmsNumberEntry' . $modernStatisticId);
							}
							$firstTabParams = $this->getStatisticTabParams($modernStatisticId, $tabId, $userId, $limit, false);
							if(!empty($firstTabParams['tabParams'])){
								$firstTabTemplate = $template->create($firstTabParams['template'],$template->getParams());
								$firstTabTemplate->setParams($firstTabParams['tabParams']);
								$firstTabTemplate->setParam('modernStatistic', $modernStatistic);
								$firstTabHtml = $firstTabTemplate->render();
								$tabCacheHtmls[$tabId] = $firstTabHtml;
								$tabCacheParams[$tabId] = $firstTabParams['tabParams'];
								$newTemplate->setParam('firstTabHtml', $firstTabHtml);
							}
						}
					}
					$templateParams = $template->getParams();
					if(!empty($modernStatistic['style_display']) && $modernStatistic['style_display']=='dark'){
						$modernStatistic['displayStyle'] = 'BRMSContainerDark';
					}
					if(isset($templateParams['visitorStyle']['style_id'])){
						$styleId = $templateParams['visitorStyle']['style_id'];
						if(!empty($modernStatistic['styleSettings']) && !empty($modernStatistic['styleSettings'][$styleId])){
							if($modernStatistic['styleSettings'][$styleId] =='dark'){
								$modernStatistic['displayStyle'] = 'BRMSContainerDark';
							}else{
								$modernStatistic['displayStyle'] = '';
							}
						}
					}
					
					$newTemplate->setParam('modernStatistic', $modernStatistic);
					
					$modernHtml = $newTemplate->render();
					if(!empty($modernStatistic['enable_cache'])){
						$this->saveCacheForStatistic($modernStatisticId, $userId, $modernHtml, $modernStatistic, $tabCacheHtmls, $tabCacheParams);
					}
					$renderedContents .= $modernHtml;
				}
			}
		}
		return $renderedContents;
	}
	
	public function saveCacheForStatistic($modernStatisticId, $userId, $cacheHtmls, $cacheParams, $tabCacheHtmls, $tabCacheParams)
	{
		if (!is_string($cacheParams))
		{
			$cacheParams = serialize($cacheParams);
		}
		if (!is_string($tabCacheHtmls))
		{
			$tabCacheHtmls = serialize($tabCacheHtmls);
		}
		if (!is_string($tabCacheParams))
		{
			$tabCacheParams = serialize($tabCacheParams);
		}
		$db = $this->_getDb();
		$updateArray = array(
			'cache_html'	=>	$cacheHtmls,
			'cache_params'	=>	$cacheParams,
			'tab_cache_htmls'	=>	$tabCacheHtmls,
			'tab_cache_params'	=>	$tabCacheParams,
			'last_update'		=>	XenForo_Application::$time,
		);
		if(!$this->getModernCacheDataForUserId($modernStatisticId, $userId)){
			$updateArray['modern_statistic_id'] = $modernStatisticId;
			$updateArray['user_id'] = $userId;
			$result = $db->query('
				INSERT IGNORE INTO xf_brivium_modern_cache
					(`modern_statistic_id`, `user_id`, `last_update`, `cache_html`, `cache_params`, `tab_cache_htmls`, `tab_cache_params`)
				VALUES
					(?, ?, ?, ?, ?, ?, ?)
			', array($modernStatisticId, $userId, XenForo_Application::$time, $cacheHtmls, $cacheParams, $tabCacheHtmls, $tabCacheParams));
		
		}else{
			$updateArray = array(
				'cache_html'	=>	$cacheHtmls,
				'cache_params'	=>	$cacheParams,
				'tab_cache_htmls'	=>	$tabCacheHtmls,
				'tab_cache_params'	=>	$tabCacheParams,
				'last_update'		=>	XenForo_Application::$time,
			);
			$db->update('xf_brivium_modern_cache',
				$updateArray,
				'`modern_statistic_id` = ' . $db->quote($modernStatisticId) . ' AND `user_id` = ' . $db->quote($userId)
			);
		}
	}
	
	protected static  $_userGroups = null;
	
	public function checkExcludeUserGroups($excludeGroups = array())
	{
		/* if (XenForo_Application::isRegistered('addOns'))
		{
			$addOns = XenForo_Application::get('addOns');
			if (!empty($addOns['Brivium_ModernStatistics']) && $addOns['Brivium_ModernStatistics'] < 1080000)
			{
				//throw new XenForo_Exception(new XenForo_Phrase('board_currently_being_upgraded'));
				return true;
			}
		} */
		if($excludeGroups){
			if(self::$_userGroups === null){
				$visitor = XenForo_Visitor::getInstance();
				$userGroups = $visitor['user_group_id'];
				if (!empty($visitor['secondary_group_ids']))
				{
					$userGroups .= ','.$visitor['secondary_group_ids'];
				}
				$userGroups = explode(',',$userGroups);
				self::$_userGroups = $userGroups;
			}
			if(!is_array(self::$_userGroups)) self::$_userGroups = array();
			if(!is_array($excludeGroups)) $excludeGroups = array();
			if(array_intersect(self::$_userGroups, $excludeGroups)){
				return false;
			}
		}
		return true;
	}
	
	protected function _getNodeModel()
	{
		return $this->getModelFromCache('XenForo_Model_Node');
	}
	
	protected function _getThreadModel()
	{
		return $this->getModelFromCache('XenForo_Model_Thread');
	}
	
	/**
	 * @return XenResource_Model_Resource
	 */
	protected function _getResourceModel()
	{
		return $this->getModelFromCache('XenResource_Model_Resource');
	}

	/**
	 * @return XenResource_Model_Category
	 */
	protected function _getCategoryModel()
	{
		return $this->getModelFromCache('XenResource_Model_Category');
	}
	
	protected function _getUserModel()
	{
		return $this->getModelFromCache('XenForo_Model_User');
	}
	protected function _getUserGroupModel()
	{
		return $this->getModelFromCache('XenForo_Model_UserGroup');
	}

	
}