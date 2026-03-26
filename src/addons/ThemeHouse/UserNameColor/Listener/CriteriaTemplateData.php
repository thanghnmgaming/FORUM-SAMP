<?php

namespace ThemeHouse\UserNameColor\Listener;

use ThemeHouse\UserNameColor\Repository\UserNameStyle;

/**
 * Class CriteriaTemplateData
 * @package ThemeHouse\UserNameColor\Listener
 */
class CriteriaTemplateData
{
    /**
     * @param array $templateData
     */
    public static function criteriaTemplateData(array &$templateData)
    {
        /** @var UserNameStyle $repo */
        $repo = \XF::repository('ThemeHouse\UserNameColor:UserNameStyle');
        $templateData['thUncoStyles'] = $repo->findStyles()->fetch();
    }
}
