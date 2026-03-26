<?php

namespace ThemeHouse\UserNameColor\XF\Pub\Controller;

use ThemeHouse\UserNameColor\Repository\UserNameStyle;
use XF\Entity\User;
use XF\Mvc\Reply\View;
use XF\Util\Color;

/**
 * Class Account
 * @package ThemeHouse\UserNameColor\XF\Pub\Controller
 */
class Account extends XFCP_Account
{
    /**
     * @return \XF\Mvc\Reply\Redirect|View
     */
    public function actionAccountDetails()
    {
        $reply = parent::actionAccountDetails();

        if ($reply instanceof View) {
            /** @var UserNameStyle $repo */
            $repo = $this->repository('ThemeHouse\UserNameColor:UserNameStyle');
            $reply->setParam('thUncoUserNameStyles', $repo->getValidStylesForUser());
        }

        return $reply;
    }

    /**
     * @param User $visitor
     * @return \XF\Mvc\FormAction
     */
    protected function accountDetailsSaveProcess(User $visitor)
    {
        $form = parent::accountDetailsSaveProcess($visitor);

        /** @var UserNameStyle $repo */
        $repo = $this->repository('ThemeHouse\UserNameColor:UserNameStyle');
        $styleId = $this->filter('th_unco_style_id', 'int');

        $data = [];
        if (\XF::visitor()->hasPermission('th_unco', 'use')) {
            if ($styleId > 0) {
                if ($repo->isValidStyle($styleId)) {
                    $data = ['style' => $styleId];
                } else {
                    $form->logError(\XF::phrase('th_unco_custom_name_style_invalid'));
                }
            } elseif ($styleId == -1) {
                $color = Color::colorToRgb(trim($this->filter('th_unco_custom_color', 'str')));
                if (\XF::visitor()->hasPermission('th_unco',
                        'bypassCustomColorRestrict') || $repo->isValidColor($color)) {
                    $data = ['color' => '#' . Color::rgbToHex($color)];
                } else {
                    $form->logError(\XF::phrase('th_unco_color_is_not_allowed_or_valid'));
                }
            }
        }
        $form->basicEntitySave($visitor, ['th_unco_user_name_data' => $data]);

        return $form;
    }
}
