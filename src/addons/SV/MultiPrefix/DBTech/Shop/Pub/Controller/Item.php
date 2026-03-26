<?php

namespace SV\MultiPrefix\DBTech\Shop\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View;
use SV\MultiPrefix\Listener;

class Item extends XFCP_Item
{
	/**
	 * @param \DBTech\Shop\Entity\Category $category
	 *
	 * @return \DBTech\Shop\Service\Item\Create|\SV\MultiPrefix\DBTech\Shop\Service\Item\Create
	 * @throws \Exception
	 */
	protected function setupItemCreate(\DBTech\Shop\Entity\Category $category)
	{
		/** @var \SV\MultiPrefix\DBTech\Shop\Service\Item\Create $creator */
		$creator = parent::setupItemCreate($category);
		Listener::$draftEntity = $item = $creator->getItem();
        $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentIgnoreMinPrefixLimit', false);
        $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentApplyMaxPrefixLimit', false);
		
		$prefixIds = $this->filter('prefix_id', 'array-uint');
		
		if ($prefixIds)
		{
			foreach ($prefixIds AS $key => $prefixId)
			{
				if (!$prefixId || !$category->isPrefixUsable($prefixId))
				{
					unset($prefixIds[$key]);
				}
			}
			
			$creator->setPrefix($prefixIds);
		}
		
		return $creator;
	}
	
	/**
	 * @return View
	 * @throws \XF\Mvc\Reply\Exception
	 */
	public function actionAdd()
	{
		$response = parent::actionAdd();
		
		if ($response instanceof View)
		{
			/** @var \SV\MultiPrefix\DBTech\Shop\Entity\Item $item */
			$item = $response->getParam('item');
			if ($item && $item->prefix_id)
			{
				$item->sv_prefix_ids = [$item->prefix_id];
			}
		}
		
		return $response;
	}
	
	/**
	 * @param \DBTech\Shop\Entity\Item $item
	 *
	 * @return \DBTech\Shop\Service\Item\Edit|\SV\MultiPrefix\DBTech\Shop\Service\Item\Edit
	 * @throws \Exception
	 */
    protected function setupItemEdit(\DBTech\Shop\Entity\Item $item)
    {
        $originalPrefixes = \array_fill_keys($item->getPreviousValue('sv_prefix_ids') ?: [], true);
        $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentIgnoreMinPrefixLimit', false);
        $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentApplyMaxPrefixLimit', false);

        /** @var \SV\MultiPrefix\DBTech\Shop\Service\Item\Edit $editor */
        $editor = parent::setupItemEdit($item);

        $prefixIds = $this->filter('prefix_id', 'array-uint');

        foreach ($prefixIds AS $key => $prefixId)
        {
            if (!$prefixId || (empty($originalPrefixes[$prefixId]) && !$item->Category->isPrefixUsable($prefixId)))
            {
                unset($prefixIds[$key]);
            }
        }

        $editor->setPrefix($prefixIds);

        return $editor;
    }

    /**
     * @param \DBTech\Shop\Entity\Item|\SV\MultiPrefix\DBTech\Shop\Entity\Item $item
     * @param \DBTech\Shop\Entity\Category|\SV\MultiPrefix\DBTech\Shop\Entity\Category $category
     * @return \SV\MultiPrefix\DBTech\Shop\Service\Item\Move|\DBTech\Shop\Service\Item\Move
     */
    protected function setupItemMove(\DBTech\Shop\Entity\Item $item, \DBTech\Shop\Entity\Category $category)
    {
        if (empty(\XF::options()->svStripPrefixOnContainerChange))
        {
            $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentIgnoreMinPrefixLimit', false);
            $item->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentApplyMaxPrefixLimit', false);
        }

        /** @var \SV\MultiPrefix\DBTech\Shop\Service\Item\Move $mover */
        $mover = parent::setupItemMove($item, $category);

        $prefixIds = $this->filter('prefix_id', 'array-uint');

        if ($prefixIds !== null)
        {
            $mover->setPrefix($prefixIds);
        }

        return $mover;
    }
	
	/**
	 * @param ParameterBag $params
	 *
	 * @return View
	 * @throws \XF\Mvc\Reply\Exception
	 */
    public function actionEdit(ParameterBag $params)
    {
        $response = parent::actionEdit($params);

        if ($response instanceof View)
        {
            /** @var \SV\MultiPrefix\DBTech\Shop\Entity\Item $item */
            $item = $response->getParam('item');

            /** @var \SV\MultiPrefix\DBTech\Shop\Entity\Category $category */
            $category = $response->getParam('category');
            if ($item && !$category)
            {
                $category = $item->Category;
            }

            if ($item && $category)
            {
                $prefixes = $item->sv_prefix_ids;
                $prefixes = $category->getMultipleUsablePrefixes($prefixes);

                $response->setParam('prefixes', $prefixes);
            }
        }

        return $response;
    }
	
	/**
	 * @param ParameterBag $params
	 *
	 * @return \XF\Mvc\Reply\Error|\XF\Mvc\Reply\Redirect|View
	 * @throws \XF\Mvc\Reply\Exception
	 * @throws \XF\PrintableException
	 */
    public function actionMove(ParameterBag $params)
    {
        $response = parent::actionMove($params);

        if ($response instanceof View)
        {
            /** @var \SV\MultiPrefix\DBTech\Shop\Entity\Item $item */
            $item = $response->getParam('item');

            /** @var \SV\MultiPrefix\DBTech\Shop\Entity\Category $category */
            $category = $response->getParam('category');
            if ($item && !$category)
            {
                $category = $item->Category;
            }

            if ($item && $category)
            {
                $prefixes = $item->sv_prefix_ids;
                $prefixes = $category->getMultipleUsablePrefixes($prefixes);

                $response->setParam('prefixes', $prefixes);
            }
        }

        return $response;
    }
}