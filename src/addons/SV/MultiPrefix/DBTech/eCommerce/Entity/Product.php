<?php

namespace SV\MultiPrefix\DBTech\eCommerce\Entity;

use SV\MultiPrefix\Behavior\MultiPrefixable;
use XF\Mvc\Entity\Structure;

/**
 * @property int[] $sv_prefix_ids
 * @property \SV\MultiPrefix\Entity\DBTecheCommerceProductPrefixLink PrefixesLink
 */
class Product extends XFCP_Product
{
    /**
     * @return array
     */
    public function getSvPrefixIds()
    {
        return MultiPrefixable::getSvPrefixIds($this, 'sv_prefix_ids_', false, 'dbtechEcommerceProduct');
    }

    /**
     * @param int $prefixId
     * @return null|string
     */
    public function _getPrefixFilterLink($prefixId)
    {
        if (!$this->Category)
        {
            return null;
        }
        return \XF::app()->router()->buildLink('dbtech-ecommerce/categories', $this->Category, ['prefix_id' => $prefixId]);
    }
    /**
     * @param $key
     * @param $value
     *
     * @return bool
     */
    protected function _setInternal($key, $value)
    {
        if ($key === 'sv_prefix_ids')
        {
            // hack work-around for XF bug;
            // https://xenforo.com/community/threads/entity-column-list_comma-list_lines-does-not-round-trip-with-integer-sub-style.144263/
            if ($value !== null)
            {
                $value = array_map('strval', $value);
            }
            else if($value && !is_array($value))
            {
                throw new \LogicException('sv_prefix_ids must be an array or null');
            }
        }
        return parent::_setInternal($key, $value);
    }

    /**
     * @param Structure $structure
     *
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->relations['PrefixesLink'] = [
            'entity'        => 'SV\MultiPrefix:DBTecheCommerceProductPrefixLink',
            'type'          => self::TO_MANY,
            'conditions'    => 'product_id',
            'key'           => 'prefix_id',
            'cascadeDelete' => true
        ];

        $structure->behaviors['SV\MultiPrefix:MultiPrefixable'] = [
            'containerIdField' => 'product_category_id',
            'containerRelation' => 'Category',
            'containerPhrase' => 'category',
			'linkTable' => 'xf_sv_dbtech_ecommerce_product_prefix_link',
			'prefixContentType' => 'dbtechEcommerceProduct',
        ];
        MultiPrefixable::addMultiPrefixFields($structure);

        return $structure;
    }
}
