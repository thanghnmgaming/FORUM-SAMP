<?php

namespace SV\MultiPrefix\XF\Admin\Controller;



/**
 * Extends \XF\Admin\Controller\Feed
 */
class Feed extends XFCP_Feed
{
    protected function getFeedInput()
    {
        $input = parent::getFeedInput();

        $input['sv_prefix_ids'] = $prefixIds = $this->filter('prefix_id', 'array-uint');
        $input['prefix_id'] = reset($input['sv_prefix_ids']);

        return $input;
    }
}