<?php

namespace SV\MultiPrefix\AVForums\PrefixEssentials\Repository;



/**
 * Extends \AVForums\PrefixEssentials\Repository\PrefixEssentials
 */
class PrefixEssentials extends XFCP_PrefixEssentials
{
    /**
     * @param \XF\Entity\Forum $forum
     * @param bool             $allowOwnPending
     * @return array
     */
    public function getPrefixCountsForForum(\XF\Entity\Forum $forum, $allowOwnPending = false)
    {
        $db = $this->db();
        $conditions = [];
        $viewableStates = ['visible'];

        if ($forum->canViewDeletedThreads())
        {
            $viewableStates[] = 'deleted';
        }

        $visitor = \XF::visitor();
        if ($forum->canViewModeratedThreads())
        {
            $viewableStates[] = 'moderated';
        }
        else if ($visitor->user_id && $allowOwnPending)
        {
            $conditions[] = "(discussion_state = 'moderated' and user_id = " . $db->quote($visitor->user_id) . ')';
        }

        $conditions[] = '(discussion_state in (' . $db->quote($viewableStates) . '))';
        $sql = join(' AND ', $conditions);
        if ($sql)
        {
            $sql = ' AND '.$sql;
        }

        return $db->fetchAllKeyed('
            SELECT thread_prefix.prefix_id, COUNT(*) AS total_count
            FROM xf_thread_prefix AS thread_prefix
            INNER JOIN xf_sv_thread_prefix_link AS prefix_link ON (prefix_link.prefix_id = thread_prefix.prefix_id)
            INNER JOIN xf_thread AS thread ON (thread.thread_id = prefix_link.thread_id)
            WHERE thread.node_id = ? ' . $sql . '
            GROUP BY thread_prefix.prefix_id
            ORDER BY materialized_order ASC
        ', 'prefix_id', $forum->node_id);
    }
}