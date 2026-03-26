<?php

namespace SV\MultiPrefix\DBTech\eCommerce\Service\Product;

use SV\MultiPrefix\DBTech\eCommerce\Entity\Product;

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
        /** @var Product $product */
        $product = $this->product;
        $product->sv_prefix_ids = $prefixIds;
        $prefixId = $prefixIds ? reset($prefixIds) : 0;
		parent::setPrefix($prefixId);
    }
}