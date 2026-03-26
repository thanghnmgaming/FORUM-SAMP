<?php

namespace ThemeHouse\UserNameColor\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * Class User
 * @package ThemeHouse\UserNameColor\XF\Entity
 *
 * COLUMNS
 * @property array th_unco_user_name_data
 *
 * GETTERS
 * @property string th_unco_user_name_class
 * @property string th_unco_user_name_color
 */
class User extends XFCP_User
{
    /**
     * @return null|string
     */
    public function getThUncoUserNameClass()
    {
        return !empty($this->th_unco_user_name_data['style']) ? 'th-unco-user-name-style-' . $this->th_unco_user_name_data['style'] : null;
    }

    /**
     * @return null|string
     */
    public function getThUncoUserNameColor()
    {
        return !empty($this->th_unco_user_name_data['color']) ? $this->th_unco_user_name_data['color'] : null;
    }

    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->columns += [
            'th_unco_user_name_data' => ['type' => self::JSON, 'default' => []]
        ];

        $structure->getters += [
            'th_unco_user_name_class' => true,
            'th_unco_user_name_color' => true
        ];

        return $structure;
    }
}
