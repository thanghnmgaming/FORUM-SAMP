<?php

namespace SV\MultiPrefix\DBTech\eCommerce\Admin\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View;
use SV\MultiPrefix\Listener;

class Product extends XFCP_Product
{
	/**
	 * @param \SV\MultiPrefix\DBTech\eCommerce\Entity\Category $category
	 * @return \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Create|\DBTech\eCommerce\Service\Product\Create
	 */
	protected function setupProductCreate(\DBTech\eCommerce\Entity\Category $category)
	{
		/** @var \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Create $creator */
		$creator = parent::setupProductCreate($category);
		Listener::$draftEntity = $creator->getProduct();
		
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
			/** @var \SV\MultiPrefix\DBTech\eCommerce\Entity\Product $product */
			$product = $response->getParam('product');
			if ($product && $product->prefix_id)
			{
				$product->sv_prefix_ids = [$product->prefix_id];
			}
		}
		
		return $response;
	}
	
    /**
     * @param \DBTech\eCommerce\Entity\Product|\SV\MultiPrefix\DBTech\eCommerce\Entity\Product $product
     * @return \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Edit|\DBTech\eCommerce\Service\Product\Edit
     */
    protected function setupProductEdit(\DBTech\eCommerce\Entity\Product $product)
    {
        $originalPrefixes = \array_fill_keys($product->getPreviousValue('sv_prefix_ids') ?: [], true);
        //$product->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentIgnoreMinPrefixLimit', false);
        //$product->getBehavior('SV\MultiPrefix:MultiPrefixable')->setOption('silentApplyMaxPrefixLimit', false);
        /** @var \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Edit $editor */
        $editor = parent::setupProductEdit($product);

        $prefixIds = $this->filter('prefix_id', 'array-uint');

        foreach ($prefixIds AS $key => $prefixId)
        {
            if (!$prefixId || (empty($originalPrefixes[$prefixId]) && !$product->Category->isPrefixUsable($prefixId)))
            {
                unset($prefixIds[$key]);
            }
        }

        $editor->setPrefix($prefixIds);

        return $editor;
    }

    /**
     * @param \DBTech\eCommerce\Entity\Product|\SV\MultiPrefix\DBTech\eCommerce\Entity\Product $product
     * @param \DBTech\eCommerce\Entity\Category|\SV\MultiPrefix\DBTech\eCommerce\Entity\Category $category
     * @return \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Move|\DBTech\eCommerce\Service\Product\Move
     */
    protected function setupProductMove(\DBTech\eCommerce\Entity\Product $product, \DBTech\eCommerce\Entity\Category $category)
    {
        /** @var \SV\MultiPrefix\DBTech\eCommerce\Service\Product\Move $mover */
        $mover = parent::setupProductMove($product, $category);

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
            /** @var \SV\MultiPrefix\DBTech\eCommerce\Entity\Product $product */
            $product = $response->getParam('product');

            /** @var \SV\MultiPrefix\DBTech\eCommerce\Entity\Category $category */
            $category = $response->getParam('category');
            if ($product && !$category)
            {
                $category = $product->Category;
            }

            if ($product && $category)
            {
                $prefixes = $product->sv_prefix_ids;
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
            /** @var \SV\MultiPrefix\DBTech\eCommerce\Entity\Product $product */
            $product = $response->getParam('product');

            /** @var \SV\MultiPrefix\DBTech\eCommerce\Entity\Category $category */
            $category = $response->getParam('category');
            if ($product && !$category)
            {
                $category = $product->Category;
            }

            if ($product && $category)
            {
                $prefixes = $product->sv_prefix_ids;
                $prefixes = $category->getMultipleUsablePrefixes($prefixes);

                $response->setParam('prefixes', $prefixes);
            }
        }

        return $response;
    }
}