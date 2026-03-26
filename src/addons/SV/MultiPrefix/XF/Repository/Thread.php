<?php

namespace SV\MultiPrefix\XF\Repository;



/**
 * Extends \XF\Repository\Thread
 */
class Thread extends XFCP_Thread
{
    /**
     * @param \XF\Finder\Thread|\SV\MultiPrefix\XF\Finder\Thread $finder
     * @return \XF\Finder\Thread
     */
    public function ignorePrefixes(\XF\Finder\Thread $finder)
    {
        /** @var \AVForums\PrefixEssentials\XF\Entity\User $visitor */
        $visitor = \XF::visitor();
        if ($visitor->canIgnorePrefixes())
        {
            /** @var \AVForums\PrefixEssentials\XF\Entity\UserOption $option */
            $option = $visitor->Option;
            if ($option->prefixess_ignored_prefix_ids)
            {
                $finder->notHasPrefixes($option->prefixess_ignored_prefix_ids);
            }
        }

        return $finder;
    }
}