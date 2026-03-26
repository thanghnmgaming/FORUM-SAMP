<?php

namespace SV\MultiPrefix\DBTech\Shop\Service\Item;

use SV\MultiPrefix\DBTech\Shop\Entity\Item;

class Create extends XFCP_Create
{
    /**
     * @param $prefixId
     */
    public function setPrefix($prefixId)
    {
        if (is_array($prefixId))
        {
            $this->setPrefixIds($prefixId);
        }
        else
        {
            parent::setPrefix($prefixId);
        }
    }

    /**
     * @param array $prefixIds
     */
    public function setPrefixIds(array $prefixIds)
    {
        /** @var Item $item */
        $item = $this->item;
        $item->sv_prefix_ids = $prefixIds;
        $prefixId = $prefixIds ? reset($prefixIds) : 0;
        parent::setPrefix($prefixId);
    }
}