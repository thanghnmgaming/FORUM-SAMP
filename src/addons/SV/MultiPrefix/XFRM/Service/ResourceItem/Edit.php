<?php

namespace SV\MultiPrefix\XFRM\Service\ResourceItem;

use SV\MultiPrefix\XFRM\Entity\ResourceItem;

class Edit extends XFCP_Edit
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
        /** @var ResourceItem $resource */
        $resource = $this->resource;
        $resource->sv_prefix_ids = $prefixIds;
        $prefixId = $prefixIds ? reset($prefixIds) : 0;
        parent::setPrefix($prefixId);
    }
}