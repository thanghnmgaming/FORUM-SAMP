<?php

namespace SV\MultiPrefix\XF\Service\Report;

use XF\Entity\Forum;

/**
 * Extends \XF\Service\Report\Creator
 */
class Creator extends XFCP_Creator
{
    public function sendReportIntoForum(Forum $forum)
    {
        /** @var \SV\MultiPrefix\XF\Entity\Forum $forum */
        $threadCreator = parent::sendReportIntoForum($forum);

        if ($forum->sv_default_prefix_ids && !$threadCreator->getThread()->prefix_id)
        {
            $threadCreator->setPrefix($forum->sv_default_prefix_ids);
        }

        return $threadCreator;
    }
}