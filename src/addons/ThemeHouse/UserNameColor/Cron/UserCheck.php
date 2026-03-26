<?php

namespace ThemeHouse\UserNameColor\Cron;

use ThemeHouse\UserNameColor\Repository\UserNameStyle;
use XF\Finder\User;

/**
 * Class UserCheck
 * @package ThemeHouse\UserNameColor\Cron
 */
class UserCheck
{
    /**
     *
     */
    public static function run()
    {
        /** @var UserNameStyle $userStylingRepo */
        $userStylingRepo = \XF::repository('ThemeHouse\UserNameColor:UserNameStyle');
        $styles = [];
        foreach ($userStylingRepo->findStyles()->activeOnly()->fetch() as $style) {
            $criteria = \XF::app()->criteria('XF:User', $style->user_criteria);;
            $criteria->setMatchOnEmpty(true);

            /** @var \ThemeHouse\UserNameColor\Entity\UserNameStyle $style */
            $styles[$style->user_name_style_id] = $criteria;
        }

        /** @var User $userFinder */
        $userFinder = \XF::finder('XF:User');

        $users = $userFinder
            ->where('last_activity', '>=', time() - 2 * 3600)
            ->isValidUser(false)
            ->fetch();

        foreach ($users as $user) {
            /** @var \ThemeHouse\UserNameColor\XF\Entity\User $user */
            if (!empty($user->th_unco_user_name_data['style'])) {
                if (isset($styles[$user->th_unco_user_name_data['style']])) {
                    $criteria = $styles[$user->th_unco_user_name_data['style']];

                    /** @var \XF\Criteria\User $criteria */
                    if (!$criteria->isMatched($user)) {
                        $user->th_unco_user_name_data = [];
                    }
                } else {
                    $user->th_unco_user_name_data = [];
                }
            } elseif (!empty($user->th_unco_user_name_data['color'])) {
                if (!$user->hasPermission('th_unco', 'useCustom')) {
                    $user->th_unco_user_name_data = [];
                }
            }

            $user->saveIfChanged();
        }
    }
}