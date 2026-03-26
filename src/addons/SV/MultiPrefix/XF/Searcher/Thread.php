<?php

namespace SV\MultiPrefix\XF\Searcher;

use XF\Mvc\Entity\Finder;

class Thread extends XFCP_Thread
{
    /**
     * @param Finder $finder
     * @param $key
     * @param $value
     * @param $column
     * @param $format
     * @param $relation
     *
     * @return bool
     */
    protected function applySpecialCriteriaValue(Finder $finder, $key, $value, $column, $format, $relation)
    {
        if ($key === 'prefix_id')
        {
            /** @var \SV\MultiPrefix\XF\Finder\Thread $finder */
            $finder->hasPrefixes($value);

            return true;
        }

        return parent::applySpecialCriteriaValue($finder, $key, $value, $column, $format, $relation);
    }
}