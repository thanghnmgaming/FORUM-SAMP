<?php

namespace ThemeHouse\UIXPro\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Entity\Option;
use XF\Mvc\ParameterBag;

/**
 * Class UixPro
 * @package ThemeHouse\UIXPro\Admin\Controller
 */
class UixPro extends AbstractController
{
    /**
     * @return \XF\Mvc\Reply\View
     * @throws \XF\PrintableException
     * @throws \XF\Db\Exception
     * @throws \XF\Db\Exception
     * @throws \XF\Db\Exception
     */
    public function actionIndex()
    {
        /** @var \ThemeHouse\UIXPro\Repository\UIXPro $repo */
        $repo = $this->repository('ThemeHouse\UIXPro:UIXPro');
        $ratingInfo = $repo->getRating(true)->fetch();

        $viewParams = [
            'ratingInfo' => $ratingInfo,
            'score' => $repo->getScore(),
            'grade' => $repo->getLetterGrade(),
            'grade_hint' => $repo->getLetterGradeHint(),
            'grade_desc' => $repo->getLetterGradeDesc(),
            'aggregates' => $repo->getAggregates(),
            'lastUpdate' => $repo->getLastUpdate()
        ];

        return $this->view('ThemeHouse\UIXPro:UIXPro', 'th_uixpro_rating_info', $viewParams);
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect
     */
    public function actionAutoResolve(ParameterBag $params)
    {
        switch ($params['rating_id']) {
            case 'friendly_urls':
                $this->setOptionValue('useFriendlyUrls', true);
                break;

            case 'romanize_urls':
                $this->setOptionValue('romanizeUrls', true);
                break;

            case 'cdn_jquery':
                $this->setOptionValue('jQuerySource', 'jquery');
                break;

            case 'image_proxy':
                $this->setOptionValue('imageLinkProxy',
                    array_merge(\XF::options()->imageLinkProxy, ['images' => true]));
                break;

            case 'link_proxy':
                $this->setOptionValue('imageLinkProxy', array_merge(\XF::options()->imageLinkProxy, ['links' => true]));
                break;

            default:
                return $this->notFound(\XF::phrase('th_uixpro_cannot_be_automatically_resolved'));
        }

        return $this->redirect($this->buildLink('uix-pro') . "#__{$params['rating_id']}");
    }

    /**
     * @param $optionId
     * @param $value
     */
    protected function setOptionValue($optionId, $value)
    {
        /** @var Option $option */
        $option = \XF::em()->find('XF:Option', $optionId);
        $option->option_value = $value;
        $option->saveIfChanged();
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     * @throws \XF\Db\Exception
     */
    public function actionRestoreDismissed(ParameterBag $params)
    {
        if (!$this->isPost()) {
            return $this->view('ThemeHouse\UIXPro:Rating\Restore', 'th_uixpro_restore_dismissed');
        }

        \XF::db()->query('UPDATE xf_th_uix_pro_rating SET state = "active" WHERE state = "dismissed"');
        return $this->redirect($this->buildLink('uix-pro'));
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     * @throws \XF\PrintableException
     */
    public function actionResolve(ParameterBag $params)
    {
        $rating = $this->assertRatingExists($params['rating_id']);

        if (!$rating->manual) {
            return $this->noPermission(\XF::phrase('th_uixpro_item_cannot_be_manually_resolved'));
        }

        if (!$this->isPost()) {
            return $this->view('ThemeHouse\UIXPro:Rating\Resolve', 'th_uixpro_rating_resolve', ['rating' => $rating]);
        }

        $rating->state = 'resolved';
        $rating->value = 20;
        $rating->save();

        return $this->redirect($this->buildLink('uix-pro') . "#__{$params['rating_id']}");
    }

    /**
     * @param $id
     * @param null $with
     * @param null $phraseKey
     * @return \ThemeHouse\UIXPro\Entity\Rating
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function assertRatingExists($id, $with = null, $phraseKey = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->assertRecordExists('ThemeHouse\UIXPro:Rating', $id, $with, $phraseKey);
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionDismiss(ParameterBag $params)
    {
        $rating = $this->assertRatingExists($params['rating_id']);

        if (!$rating->dismissible) {
            return $this->noPermission(\XF::phrase('th_uixpro_item_cannot_be_dismissed'));
        }

        if (!$this->isPost()) {
            return $this->view('ThemeHouse\UIXPro:Rating\Dismiss', 'th_uixpro_rating_dismiss', ['rating' => $rating]);
        }

        $rating->state = 'dismissed';
        $rating->saveIfChanged();

        return $this->redirect($this->buildLink('uix-pro'));
    }
}
