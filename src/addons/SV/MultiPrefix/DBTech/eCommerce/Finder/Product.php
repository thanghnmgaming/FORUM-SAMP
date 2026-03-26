<?php

namespace SV\MultiPrefix\DBTech\eCommerce\Finder;

use SV\Utils\Finder\SqlJoinTrait;
use DBTech\eCommerce\Entity\ProductPrefix;

class Product extends XFCP_Product
{
    use SqlJoinTrait;

    protected $categoryIds = [];

    protected function extractNodeIds()
    {
        $nodeIdCol = $this->columnSqlName('product_category_id');
        $regex = "#" . preg_quote($nodeIdCol, '#') . "\s+(?:(?:\= (\d+))|(?:in \(([^\)]+)\)))#i";
        $this->categoryIds = [];
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
                            $this->categoryIds[] = $node;
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
                                $this->categoryIds[] = $node;
                            }
                        }
                    }
                }
                break;
            }
        }
        $this->categoryIds = \array_filter(\array_unique($this->categoryIds, \SORT_NUMERIC));
    }

    /**
     * @param int|int[]|ProductPrefix $prefixIds
     * @param bool                     $andWhere
     * @return $this
     */
    public function hasPrefixes($prefixIds, $andWhere = true)
    {
        if ($prefixIds instanceof ProductPrefix)
        {
            $prefixIds = [$prefixIds->prefix_id];
        }

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
        $sql = '';
        // MySQL subquery performance is remarkably bad, so use a join...
/*
        if ($prefixes)
        {
            $prefixes = array_keys($prefixes);
            $count = $andWhere ? count($prefixes) : 1;
            $itemIdCol = $this->columnSqlName('product_id');
            $sql = "\n ({$itemIdCol} in (
                    select link.product_id
                    from xf_sv_dbtech_ecommerce_product_prefix_link link
                    where link.prefix_id in (" . $db->quote($prefixes) . ")
                    group by link.product_id
                    having count(*) >= {$count}
                )) ";
        }
        if ($none)
        {
            $prefixCol = $this->columnSqlName('prefix_id');
            $sql = "({$prefixCol} = '0' " . ($sql ? ' OR ' . $sql : '') . ")";
        }

        return $this->where($this->expression($sql));
*/
        $alias = '';
        if ($prefixes)
        {
            $this->extractNodeIds();
            $joinSQL = '';
            $whereSQL = '';
            if ($this->categoryIds)
            {
                $joinSQL = "join xf_dbtech_ecommerce_product on (xf_dbtech_ecommerce_product.product_id = link.product_id)";
                $whereSQL = 'AND (xf_dbtech_ecommerce_product.product_category_id in (' . $this->quote($this->categoryIds) . '))';
            }

            $prefixes = array_keys($prefixes);
            $count = $andWhere ? count($prefixes) : 1;
            $alias = 'prefixLink_' . $this->aliasCounter++;

            $this->sqlJoin("(
                    select link.product_id
                    from xf_sv_dbtech_ecommerce_product_prefix_link link
                    {$joinSQL}
                    where link.prefix_id in (" . $db->quote($prefixes) . ") {$whereSQL}
                    group by link.product_id
                    having count(*) >= {$count}
                )", $alias, ['thread_id'], !$none, true);

            $this->sqlJoinConditions($alias, [
                'product_id'
            ]);
        }
        if ($none)
        {
            $prefixCol = $this->columnSqlName('prefix_id');
            $sql = "({$prefixCol} = '0' ". ($alias ? " OR `$alias`.product_id is not null" : '')  .")";
            $this->where($this->expression($sql));
        }

        return $this;
    }
}