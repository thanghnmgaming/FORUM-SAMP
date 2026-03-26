<?php

namespace ThemeHouse\UserNameColor\XF\Template;

use ThemeHouse\UserNameColor\XF\Entity\User;

/**
 * Class Templater
 * @package ThemeHouse\UserNameColor\XF\Template
 */
class Templater extends XFCP_Templater
{
    /**
     * @param $attributes
     * @param $key
     * @param $value
     */
    protected function thUncoSetOrExtend(&$attributes, $key, $value)
    {
        if (isset($attributes[$key])) {
            $attributes[$key] .= $value;
        } else {
            $attributes[$key] = $value;
        }
    }

    /**
     * @param $templater
     * @param $escape
     * @param $user
     * @param bool $rich
     * @param array $attributes
     * @return string
     */
    public function fnUsernameLink($templater, &$escape, $user, $rich = false, $attributes = [])
    {
        /** @var User $user */
        $class = $user->th_unco_user_name_class;
        $color = $user->th_unco_user_name_color;

        if ($class) {
            $this->thUncoSetOrExtend($attributes, 'class', $class);
            $this->includeCss('public:th_unco_user_name_style_cache.less');
        } elseif ($color) {
            $color = ' color:' . $color . ';';
            $this->thUncoSetOrExtend($attributes, 'style', $color);
        }

        return parent::fnUsernameLink($templater, $escape, $user, $rich, $attributes);
    }
}
