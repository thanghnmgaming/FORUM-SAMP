<?php

namespace SV\MultiPrefix\XF\Job;

use XF\Entity\Thread;

class ThreadAction extends XFCP_ThreadAction
{
    protected function applyInternalThreadChange(Thread $thread)
    {
        parent::applyInternalThreadChange($thread);

        if ($prefixIds = $this->getActionValue('prefix_ids'))
        {
            /** @var \SV\MultiPrefix\XF\Entity\Thread $thread */
            $thread->sv_prefix_ids = $prefixIds;
        }
    }

    protected function getActionValue($action)
    {
        if ($action === 'prefix_id')
        {
            return null;
        }

        if ($action === 'prefix_ids')
        {
            $value = null;
            if (!empty($this->data['actions']['prefix_id']) && is_array($this->data['actions']['prefix_id']))
            {
                $value = $this->data['actions']['prefix_id'];
            }

            return $value;
        }

        return parent::getActionValue($action);
    }
}