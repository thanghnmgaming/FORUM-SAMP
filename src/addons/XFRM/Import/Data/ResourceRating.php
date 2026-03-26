<?php

namespace XFRM\Import\Data;

use XF\Import\Data\AbstractEmulatedData;

class ResourceRating extends AbstractEmulatedData
{
	public function getImportType()
	{
		return 'resource_rating';
	}

	public function getEntityShortName()
	{
		return 'XFRM:ResourceRating';
	}

	protected function postSave($oldId, $newId)
	{
		/** @var \XFRM\Entity\ResourceItem $resourceItem */
		$resourceItem = $this->em()->find('XFRM:ResourceItem', $this->resource_id);

		if ($resourceItem)
		{
			$resourceItem->rebuildReviewCount();
			$resourceItem->rebuildRating();

			$this->em()->detachEntity($resourceItem);
		}
	}
}