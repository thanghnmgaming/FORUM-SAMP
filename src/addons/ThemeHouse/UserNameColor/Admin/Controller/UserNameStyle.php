<?php

namespace ThemeHouse\UserNameColor\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\ControllerPlugin\Delete;
use XF\ControllerPlugin\Toggle;
use XF\Mvc\ParameterBag;

/**
 * Class UserNameStyle
 * @package ThemeHouse\UserNameColor\Admin\Controller
 */
class UserNameStyle extends AbstractController
{
    /**
     * @return \XF\Mvc\Reply\View
     */
    public function actionIndex()
    {
        $styles = $this->getUserNameStyleRepo()->findStyles()->fetch();

        $viewParams = [
            'styles' => $styles
        ];

        return $this->view('ThemeHouse\UserNameColor:UserNameStyle\List', 'th_unco_user_name_style_list', $viewParams);
    }

    /**
     * @return \XF\Mvc\Reply\View
     */
    public function actionAdd()
    {
        /** @var \ThemeHouse\UserNameColor\Entity\UserNameStyle $style */
        $style = $this->em()->create('ThemeHouse\UserNameColor:UserNameStyle');
        return $this->styleAddEdit($style);
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionEdit(ParameterBag $params)
    {
        $style = $this->assertUserNameStyleExists($params['user_name_style_id']);
        return $this->styleAddEdit($style);
    }

    /**
     * @param \ThemeHouse\UserNameColor\Entity\UserNameStyle $style
     * @return \XF\Mvc\Reply\View
     */
    protected function styleAddEdit(\ThemeHouse\UserNameColor\Entity\UserNameStyle $style)
    {
        $userCriteria = $this->app->criteria('XF:User', $style->user_criteria);

        $viewParams = [
            'style' => $style,
            'userCriteria' => $userCriteria
        ];

        return $this->view('ThemeHouse\UserNameColor:UserNameStyle\Edit', 'th_unco_user_name_style_edit', $viewParams);
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Error|\XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionDelete(ParameterBag $params)
    {
        $style = $this->assertUserNameStyleExists($params['user_name_style_id']);

        /** @var Delete $delete */
        $delete = $this->plugin('XF:Delete');
        return $delete->actionDelete(
            $style,
            $this->buildLink('th-unco/delete', $style),
            $this->buildLink('th-unco/edit', $style),
            $this->buildLink('th-unco'),
            $style->title
        );
    }

    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect
     * @throws \XF\Mvc\Reply\Exception
     * @throws \XF\PrintableException
     */
    public function actionSave(ParameterBag $params)
    {
        if ($params['user_name_style_id']) {
            $style = $this->assertUserNameStyleExists($params['user_name_style_id']);
        } else {
            $style = $this->em()->create('ThemeHouse\UserNameColor:UserNameStyle');
        }

        $this->styleSaveProcess($style)->run();

        return $this->redirect($this->buildLink('th-unco'));
    }

    protected function styleSaveProcess(\ThemeHouse\UserNameColor\Entity\UserNameStyle $style)
    {
        $form = $this->formAction();

        $input = $this->filter([
            'user_criteria' => 'array',
            'active' => 'bool',
            'display_order' => 'uint',
            'styling' => 'str'
        ]);

        $form->basicEntitySave($style, $input);

        $titlePhrase = $this->filter('title', 'str');
        $form->apply(function () use ($titlePhrase, $style) {
            $masterTitle = $style->getMasterPhrase();
            $masterTitle->phrase_text = $titlePhrase;
            $masterTitle->save();
        });

        return $form;
    }

    /**
     * @return \XF\Mvc\Reply\Message
     */
    public function actionToggle()
    {
        /** @var Toggle $toggle */
        $toggle = $this->plugin('XF:Toggle');
        return $toggle->actionToggle('ThemeHouse\UserNameColor:UserNameStyle');
    }

    /**
     * @return \XF\Mvc\Reply\Redirect|\XF\Mvc\Reply\View
     */
    public function actionSort()
    {
        $styles = $this->getUserNameStyleRepo()->findStyles()->fetch();

        if ($this->isPost()) {
            $lastOrder = 0;
            foreach (array_reverse(json_decode($this->filter('styles', 'uint'))) as $styleValue) {
                $lastOrder += 10;

                /** @var \ThemeHouse\XLink\Entity\Promotion $promotion */
                $style = $styles[$styleValue->id];
                $style->display_order = $lastOrder;
                $style->saveIfChanged();
            }

            return $this->redirect($this->buildLink('th-unco'));
        } else {
            $viewParams = [
                'styles' => $styles
            ];

            return $this->view('ThemeHouse\UserNameColor:UserNameStyle\Sort', 'th_unco_user_name_style_sort',
                $viewParams);
        }
    }

    /**
     * @param $id
     * @param null $with
     * @param null $phraseKey
     * @return \XF\Mvc\Entity\Entity|\ThemeHouse\UserNameColor\Entity\UserNameStyle
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function assertUserNameStyleExists($id, $with = null, $phraseKey = null)
    {
        return $this->assertRecordExists('ThemeHouse\UserNameColor:UserNameStyle', $id, $with, $phraseKey);
    }

    /**
     * @return \XF\Mvc\Entity\Repository|\ThemeHouse\UserNameColor\Repository\UserNameStyle
     */
    protected function getUserNameStyleRepo()
    {
        return $this->repository('ThemeHouse\UserNameColor:UserNameStyle');
    }
}
