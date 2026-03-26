<?php

namespace SV\MultiPrefix\DBTech\eCommerce\Repository;

class CategoryPrefix extends XFCP_CategoryPrefix
{
    /**
     * @param \XF\Entity\AbstractPrefix $prefix
     * @param array $contentIds
     */
    public function updatePrefixAssociations(\XF\Entity\AbstractPrefix $prefix, array $contentIds)
    {
        $this->updateMultiplePrefixAssociations($prefix, $contentIds);
    }

    /**
     * @param \XF\Entity\AbstractPrefix $prefix
     * @param array $contentIds
     */
    public function updateMultiplePrefixAssociations(\XF\Entity\AbstractPrefix $prefix, array $contentIds)
    {
        $emptyKey = array_search(0, $contentIds);
        if ($emptyKey !== false)
        {
            unset($contentIds[$emptyKey]);
        }
        $contentIds = array_unique($contentIds);

        $structureData = $this->getStructureData();

        $existingAssociations = $this->getAssociationsForPrefix($prefix);
        if (!count($existingAssociations) && !$contentIds)
        {
            return;
        }

        $db = $this->db();
        $db->beginTransaction();

        $db->delete($structureData['table'], 'prefix_id = ?', $prefix->prefix_id);

        $map = [];

        foreach ($contentIds AS $id)
        {
            $map[] = [
                $structureData['key'] => $id,
                'prefix_id' => $prefix->prefix_id
            ];
        }
        if ($map)
        {
            $db->insertBulk($structureData['table'], $map);
        }

        $rebuildIds = $contentIds;

        foreach ($existingAssociations AS $association)
        {
            $rebuildIds[] = $association->getValue($structureData['key']);
        }

        $rebuildIds = array_unique($rebuildIds);
        $this->rebuildContentAssociationCache($rebuildIds);

        $db->commit();
    }

    /**
     * @param \XF\Entity\AbstractPrefix $prefix
     */
    public function removePrefixAssociations(\XF\Entity\AbstractPrefix $prefix)
    {
        $this->removeMultiplePrefixAssociations($prefix);
    }

    /**
     * @param \XF\Entity\AbstractPrefix $prefix
     */
    public function removeMultiplePrefixAssociations(\XF\Entity\AbstractPrefix $prefix)
    {
        $structureData = $this->getStructureData();

        $rebuildIds = $this->db()->fetchAllColumn("
			SELECT $structureData[key]
			FROM $structureData[table]
			WHERE prefix_id = ?
		", $prefix->prefix_id);

        if (!$rebuildIds)
        {
            return;
        }

        $db = $this->db();
        $db->beginTransaction();

        $db->delete($structureData['table'], 'prefix_id = ?', $prefix->prefix_id);

        $this->rebuildContentAssociationCache($rebuildIds);

        $db->commit();
    }

    /**
     * @param $contentId
     * @param array $prefixIds
     */
    public function updateContentAssociations($contentId, array $prefixIds)
    {
        $this->updateContentAssociationsForMultiplePrefixes($contentId, $prefixIds);
    }

    /**
     * @param $contentId
     * @param array $prefixIds
     */
    public function updateContentAssociationsForMultiplePrefixes($contentId, array $prefixIds)
    {
        $structureData = $this->getStructureData();

        $db = $this->db();
        $db->beginTransaction();

        $db->delete($structureData['table'], $structureData['key'] . ' = ?', $contentId);

        $map = [];

        foreach ($prefixIds AS $prefixId)
        {
            $map[] = [
                $structureData['key'] => $contentId,
                'prefix_id' => $prefixId
            ];
        }

        if ($map)
        {
            $db->insertBulk($structureData['table'], $map);
        }

        $this->rebuildContentAssociationCache($contentId);

        $db->commit();
    }

    /**
     * @param $contentIds
     */
    public function rebuildContentAssociationCache($contentIds)
    {
        $this->rebuildContentAssociationCacheForMultiplePrefixes($contentIds);
    }

    /**
     * @param $contentIds
     */
    public function rebuildContentAssociationCacheForMultiplePrefixes($contentIds)
    {
        if (!is_array($contentIds))
        {
            $contentIds = [$contentIds];
        }
        if (!$contentIds)
        {
            return;
        }

        $structureData = $this->getStructureData();

        $newCache = [];

        $prefixAssociations = $this->finder($structureData['mapEntity'])
            ->with('Prefix')
            ->where($structureData['key'], $contentIds)
            ->order('Prefix.materialized_order');
        foreach ($prefixAssociations->fetch() AS $prefixMap)
        {
            $key = $prefixMap->get($structureData['key']);
            $newCache[$key][$prefixMap->prefix_id] = $prefixMap->prefix_id;
        }

        foreach ($contentIds AS $contentId)
        {
            if (!isset($newCache[$contentId]))
            {
                $newCache[$contentId] = [];
            }
        }

        $this->updateAssociationCache($newCache);
    }
}