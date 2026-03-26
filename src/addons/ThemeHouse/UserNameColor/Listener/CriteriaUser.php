<?php

namespace ThemeHouse\UserNameColor\Listener;

use XF\Entity\User;
use XF\Util\Color;

/**
 * Class CriteriaUser
 * @package ThemeHouse\UserNameColor\Listener
 */
class CriteriaUser
{
    /**
     * @param $rule
     * @param array $data
     * @param User $user
     * @param $returnValue
     */
    public static function criteriaUser($rule, array $data, User $user, &$returnValue)
    {
        /** @var \ThemeHouse\UserNameColor\XF\Entity\User $user */
        switch ($rule) {
            case 'th_unco_user_name_color':
                $returnValue = !empty($user->th_unco_user_name_data);
                break;

            case 'th_unco_not_user_name_color':
                $returnValue = empty($user->th_unco_user_name_data);
                break;

            case 'th_unco_color_preset':
                $returnValue = (bool)$user->th_unco_user_name_class;
                break;

            case 'th_unco_custom_color':
                $returnValue = (bool)$user->th_unco_user_name_color;
                break;

            case 'th_unco_style_one_of':
                $returnValue = !empty($user->th_unco_user_name_data['style']) && in_array($user->th_unco_user_name_data['style'],
                        $data['style_ids']);
                break;

            case 'th_unco_style_not_one_of':
                $returnValue = !empty($user->th_unco_user_name_data['style']) && !in_array($user->th_unco_user_name_data['style'],
                        $data['style_ids']);
                break;

            case 'th_unco_custom_red':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[0] >= $data['value'];
                break;

            case 'th_unco_custom_max_red':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[0] <= $data['value'];
                break;

            case 'th_unco_custom_green':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[1] >= $data['value'];
                break;

            case 'th_unco_custom_max_green':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[1] <= $data['value'];
                break;

            case 'th_unco_custom_blue':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[2] >= $data['value'];
                break;

            case 'th_unco_custom_max_blue':
                $returnValue = Color::isValidColor($user->th_unco_user_name_color) && Color::colorToRgb($user->th_unco_user_name_color)[2] <= $data['value'];
                break;


            default:
                break;
        }
    }
}
