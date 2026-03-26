<?php

namespace SV\MultiPrefix\XFRM\InlineMod\ResourceItem;

use SV\MultiPrefix\XFRM\Entity\ResourceItem as MultiPrefixedEntity;
use XF\Http\Request;
use XF\Mvc\Entity\AbstractCollection;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Reply\View;

class Move extends XFCP_Move
{
    /**
     * @param AbstractCollection $entities
     * @param Request $request
     *
     * @return array
     */
    public function getFormOptions(AbstractCollection $entities, Request $request)
    {
        $options = parent::getFormOptions($entities, $request);

        if ($request->filter('apply_prefix', 'bool'))
        {
            $options ['prefix_id'] = $request->filter('prefix_id', 'array-uint');
        }

        return $options;
    }

    /**
     * @param AbstractCollection $entities
     * @param \XF\Mvc\Controller $controller
     *
     * @return null|View
     */
    public function renderForm(AbstractCollection $entities, \XF\Mvc\Controller $controller)
    {
        $view = parent::renderForm($entities, $controller);

        if ($view instanceof View &&
            ($entities = $view->getParam('resources')))
        {
            /** @var MultiPrefixedEntity[] $entities */
            $prefixCounts = [];
            if ($entities->count() === 1)
            {
                foreach($entities->first()->sv_prefix_ids as $prefixId)
                {
                    if (!isset($prefixCounts[$prefixId]))
                    {
                        $prefixCounts[$prefixId] = 1;
                    }
                    else
                    {
                        $prefixCounts[$prefixId]++;
                    }
                }
                unset($prefixCounts[0]);
            }

            $view->setParam('selectedPrefix', array_keys($prefixCounts));
        }

        return $view;
    }
}