<?php

namespace ThemeHouse\UserNameColor\Job;

use ThemeHouse\UserNameColor\Entity\UserNameStyle;
use ThemeHouse\UserNameColor\XF\Entity\User;
use XF\Job\AbstractRebuildJob;

/**
 * Class RebuildStylingCriteriaCheck
 * @package ThemeHouse\UserNameColor\Job
 */
class RebuildStylingCriteriaCheck extends AbstractRebuildJob
{
    /**
     * @var array
     */
    protected $defaultData = [
        'user_name_style_id' => 0
    ];

    /**
     * @param $start
     * @param $batch
     * @return array
     */
    protected function getNextIds($start, $batch)
    {
        $db = $this->app->db();

        return $db->fetchAllColumn($db->limit(
            "
				SELECT user_id
				FROM xf_user
				WHERE user_id > ?
				ORDER BY user_id
			", $batch
        ), $start);
    }

    /**
     * @param $id
     * @throws \XF\PrintableException
     */
    protected function rebuildById($id)
    {
        $em = \XF::em();

        /** @var UserNameStyle $userNameStyle */
        $userNameStyle = $em->find('ThemeHouse\UserNameColor:UserNameStyle', $this->data['user_name_style_id']);
        /** @var User $user */
        $user = $em->find('XF:User', $id);

        if (!$userNameStyle || !$user) {
            return;
        }

        if (empty($user->th_unco_user_name_data['style']) || $user->th_unco_user_name_data['style'] != $userNameStyle->user_name_style_id) {
            return;
        }

        $criteria = $this->app->criteria('XF:User', $userNameStyle->user_criteria);
        $criteria->setMatchOnEmpty(true);

        if (!$criteria->isMatched($user)) {
            $user->th_unco_user_name_data = [];
            $user->save();
        }

        return;
    }

    /**
     * @return \XF\Phrase
     */
    protected function getStatusType()
    {
        return \XF::phrase('th_unco_user_name_styling');
    }
}