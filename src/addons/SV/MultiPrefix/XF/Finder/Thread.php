<?php

namespace SV\MultiPrefix\XF\Finder;

use SV\Utils\Finder\SqlJoinTrait;

class Thread extends XFCP_Thread
{
    use SqlJoinTrait;

    protected $nodeIds = [];

    protected function extractNodeIds()
    {
        $nodeIdCol = $this->columnSqlName('node_id');
        $regex = "#" . preg_quote($nodeIdCol, '#') . "\s+(?:(?:\= (\d+))|(?:in \(([^\)]+)\)))#i";
        $this->nodeIds = [];
        foreach ($this->conditions as $condition)
        {
            if (\preg_match_all($regex, $condition, $matches))
            {
                if (isset($matches[1]))
                {
                    foreach ($matches[1] as $node)
                    {
                        $node = intval($node);
                        if ($node)
                        {
                            $this->nodeIds[] = $node;
                        }
                    }
                }
                if (isset($matches[2]))
                {
                    foreach ($matches[2] as $nodeList)
                    {
                        $nodeList = explode(',', $nodeList);
                        foreach ($nodeList as $node)
                        {
                            $node = intval($node);
                            if ($node)
                            {
                                $this->nodeIds[] = $node;
                            }
                        }
                    }
                }
                break;
            }
        }
        $this->nodeIds = \array_filter(\array_unique($this->nodeIds, \SORT_NUMERIC));
    }

    /**
     * @param int|int[] $prefixIds
     * @param bool      $andWhere
     * @return $this
     */
    public function hasPrefixes($prefixIds, $andWhere = true)
    {
        if (!is_array($prefixIds))
        {
            $prefixIds = [$prefixIds];
        }

        $db = $this->db;

        $none = false;
        $prefixes = [];
        foreach ($prefixIds as $prefixId)
        {
            $prefixId = intval($prefixId);
            if ($prefixId === -1)
            {
                $none = true;
                continue;
            }
            $prefixes[$prefixId] = true;
        }
        // MySQL subquery performance is remarkably bad, so use a join...
/*
        if ($prefixes)
        {
            $this->extractNodeIds();
            $joinSQL = '';
            $whereSQL = '';
            if ($this->nodeIds)
            {
                $joinSQL = "join xf_thread on (xf_thread.thread_id = link.thread_id)";
                $whereSQL = 'AND (xf_thread.node_id in (' . $this->quote($this->nodeIds) . '))';
            }
            $prefixes = array_keys($prefixes);
            $count = $andWhere ? count($prefixes) : 1;
            $itemIdCol = $this->columnSqlName('thread_id');
            $sql = "\n ({$itemIdCol} in (
                    select link.thread_id
                    from xf_sv_thread_prefix_link link
                    {$joinSQL}
                    where link.prefix_id in (" . $db->quote($prefixes) . ") {$whereSQL}
                    group by link.thread_id
                    having count(*) >= {$count}
                )) ";
        }
        if ($none)
        {
            $prefixCol = $this->columnSqlName('prefix_id');
            $sql = "({$prefixCol} = '0' ". ($sql ? ' OR '. $sql : '')  .")";

        }
        return $this->where($this->expression($sql));
*/
        $alias = '';
        if ($prefixes)
        {
            $this->extractNodeIds();
            $joinSQL = '';
            $whereSQL = '';
            if ($this->nodeIds)
            {
                $joinSQL = "join xf_thread on (xf_thread.thread_id = link.thread_id)";
                $whereSQL = 'AND (xf_thread.node_id in (' . $this->quote($this->nodeIds) . '))';
            }

            $prefixes = array_keys($prefixes);
            $count = $andWhere ? count($prefixes) : 1;
            $alias = 'prefixLink_' . $this->aliasCounter++;

            $this->sqlJoin("(
                    select link.thread_id
                    from xf_sv_thread_prefix_link link
                    {$joinSQL}
                    where link.prefix_id in (" . $db->quote($prefixes) . ") {$whereSQL}
                    group by link.thread_id
                    having count(*) >= {$count}
                )", $alias, ['thread_id'], !$none, true);

            $this->sqlJoinConditions($alias, [
                'thread_id'
            ]);
        }
        if ($none)
        {
            $prefixCol = $this->columnSqlName('prefix_id');
            $sql = "({$prefixCol} = '0' ". ($alias ? " OR `$alias`.thread_id is not null" : '')  .")";
            $this->where($this->expression($sql));
        }

        return $this;
    }

    /**
     * @param int|int[] $prefixIds
     * @return $this
     */
    public function notHasPrefixes($prefixIds)
    {
        if (!is_array($prefixIds))
        {
            $prefixIds = [$prefixIds];
        }

        $db = $this->db;

        $none = false;
        $prefixes = [];
        foreach ($prefixIds as $prefixId)
        {
            $prefixId = intval($prefixId);
            if ($prefixId === -1)
            {
                $none = true;
                continue;
            }
            $prefixes[$prefixId] = true;
        }
        $alias = '';
        if ($prefixes)
        {
            $this->extractNodeIds();
            $joinSQL = '';
            $whereSQL = '';
            if ($this->nodeIds)
            {
                $joinSQL = "join xf_thread on (xf_thread.thread_id = link.thread_id)";
                $whereSQL = 'AND (xf_thread.node_id in (' . $this->quote($this->nodeIds) . '))';
            }

            $prefixes = array_keys($prefixes);
            $alias = 'prefixLink_' . $this->aliasCounter++;

            $this->sqlJoin("(
                    select link.thread_id
                    from xf_sv_thread_prefix_link link
                    {$joinSQL}
                    where link.prefix_id in (" . $db->quote($prefixes) . ") {$whereSQL}
                    group by link.thread_id
                    having count(*) >= 1
                )", $alias, ['thread_id'], false, true);

            $this->sqlJoinConditions($alias, [
                'thread_id'
            ]);
        }
        $this->where($alias .'.thread_id','=', null );

        if ($none)
        {
            $this->where('prefix_id', '<>', '0');
        }

        return $this;
    }
}