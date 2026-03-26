<?php

namespace XFRM;

use XF\Container;

class Listener
{
	public static function appSetup(\XF\App $app)
	{
		$container = $app->container();

		$container['prefixes.resource'] = $app->fromRegistry('xfrmPrefixes',
			function(\XF\Container $c) { return $c['em']->getRepository('XFRM:ResourcePrefix')->rebuildPrefixCache(); }
		);

		$container['customFields.resources'] = $app->fromRegistry('xfrmResourceFields',
			function(\XF\Container $c) { return $c['em']->getRepository('XFRM:ResourceField')->rebuildFieldCache(); },
			function(array $fields)
			{
				return new \XF\CustomField\DefinitionSet($fields);
			}
		);

		$container['xfrmIconSizeMap'] = function(Container $c)
		{
			return $c['avatarSizeMap'];
		};
	}

	public static function criteriaUser($rule, array $data, \XF\Entity\User $user, &$returnValue)
	{
		switch ($rule)
		{
			case 'resource_count':
				if (isset($user->xfrm_resource_count) && $user->xfrm_resource_count >= $data['resources'])
				{
					$returnValue = true;
				}
				break;
		}
	}

	public static function criteriaPage($rule, array $data, \XF\Entity\User $user, array $params, &$returnValue)
	{
		if ($rule === 'xfrm_categories')
		{
			$returnValue = false;

			if (!empty($data['resource_category_ids']))
			{
				$selectedCategoryIds = $data['resource_category_ids'];

				if (isset($params['breadcrumbs']) && is_array($params['breadcrumbs']) && empty($data['category_only']))
				{
					foreach ($params['breadcrumbs'] AS $i => $navItem)
					{
						if (
							isset($navItem['attributes']['resource_category_id'])
							&& in_array($navItem['attributes']['resource_category_id'], $selectedCategoryIds)
						)
						{
							$returnValue = true;
						}
					}
				}

				if (!empty($params['containerKey']))
				{
					list ($type, $id) = explode('-', $params['containerKey'], 2);

					if ($type == 'xfrmCategory' && $id && in_array($id, $selectedCategoryIds))
					{
						$returnValue = true;
					}
				}
			}
		}
	}

	public static function criteriaTemplateData(array &$templateData)
	{
		$categoryRepo = \XF::repository('XFRM:Category');
		$templateData['xfrmCategories'] = $categoryRepo->getCategoryOptionsData(false);
	}

	public static function postDispatchThread(
		\XF\Mvc\Controller $controller, $action, \XF\Mvc\ParameterBag $params, \XF\Mvc\Reply\AbstractReply &$reply
	)
	{
		if (!($reply instanceof \XF\Mvc\Reply\View))
		{
			return;
		}

		$template = $reply->getTemplateName();

		/** @var \XF\Entity\Thread $thread */
		$thread = $reply->getParam('thread');

		if ($template != 'thread_view' || !$thread || $thread->discussion_type != 'resource')
		{
			return;
		}

		/** @var \XFRM\Entity\ResourceItem $resource */
		$resource = \XF::repository('XFRM:ResourceItem')->findResourceForThread($thread)->fetchOne();
		if (!$resource || !$resource->canView())
		{
			return;
		}

		$reply->setParam('resource', $resource);
	}

	public static function templaterSetup(\XF\Container $container, \XF\Template\Templater &$templater)
	{
		/** @var \XFRM\Template\TemplaterSetup $templaterSetup */
		$class = \XF::extendClass('XFRM\Template\TemplaterSetup');
		$templaterSetup = new $class();

		$templater->addFunction('resource_icon', [$templaterSetup, 'fnResourceIcon']);
	}

	public static function userContentChangeInit(\XF\Service\User\ContentChange $changeService, array &$updates)
	{
		$updates['xf_rm_category_watch'] = ['user_id', 'emptyable' => false];
		$updates['xf_rm_resource'] = ['user_id', 'username'];
		$updates['xf_rm_resource_download'] = ['user_id', 'emptyable' => false];
		$updates['xf_rm_resource_rating'] = ['user_id', 'emptyable' => false];
		$updates['xf_rm_resource_watch'] = ['user_id', 'emptyable' => false];
	}

	public static function userDeleteCleanInit(\XF\Service\User\DeleteCleanUp $deleteService, array &$deletes)
	{
		$deletes['xf_rm_category_watch'] = 'user_id = ?';
		$deletes['xf_rm_resource_download'] = 'user_id = ?';
		$deletes['xf_rm_resource_watch'] = 'user_id = ?';
	}

	public static function userMergeCombine(
		\XF\Entity\User $target, \XF\Entity\User $source, \XF\Service\User\Merge $mergeService
	)
	{
		$target->xfrm_resource_count += $source->xfrm_resource_count;
	}

	public static function userSearcherOrders(\XF\Searcher\User $userSearcher, array &$sortOrders)
	{
		$sortOrders['xfrm_resource_count'] = \XF::phrase('xfrm_resource_count');
	}

	public static function importImporterClasses(\XF\SubContainer\Import $container, \XF\Container $parentContainer, array &$importers)
	{
		$importers = array_merge(
			$importers, \XF\Import\Manager::getImporterShortNamesForType('XFRM')
		);
	}
}