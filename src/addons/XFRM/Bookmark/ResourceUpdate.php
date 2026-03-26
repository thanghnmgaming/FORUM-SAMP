<?php

namespace XFRM\Bookmark;

use XF\Bookmark\AbstractHandler;
use XF\Mvc\Entity\Entity;

class ResourceUpdate extends AbstractHandler
{
	public function getContentTitle(Entity $content)
	{
		return \XF::phrase('xfrm_resource_update_in_x', [
			'title' => $content->Resource->title
		]);
	}

	public function getContentRoute(Entity $content)
	{
		return 'resources/update';
	}

	/**
	 * @return string
	 */
	public function getCustomIconTemplateName()
	{
		return 'public:xfrm_resource_update_bookmark_custom_icon';
	}

	public function getEntityWith()
	{
		return ['Resource', 'Resource.Category'];
	}
}