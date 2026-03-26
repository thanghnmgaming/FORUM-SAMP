<?php

namespace ThemeHouse\UserNameColor\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * Class UserNameStyle
 * @package ThemeHouse\UserNameColor\Entity
 *
 * COLUMNS
 * @property integer user_name_style_id
 * @property array user_criteria
 * @property string styling
 *
 * GETTERS
 * @property string title
 *
 * RELATIONS
 * @property \XF\Entity\Phrase MasterTitle
 */
class UserNameStyle extends Entity
{
    /**
     * @return \XF\Phrase
     */
    public function getTitle()
    {
        return \XF::phrase($this->getPhraseName());
    }

    /**
     * @return string
     */
    public function getPhraseName()
    {
        return 'th_unco_user_name_style.' . $this->user_name_style_id;
    }

    /**
     * @return mixed|null|Entity
     */
    public function getMasterPhrase()
    {
        $phrase = $this->MasterTitle;
        if (!$phrase) {
            /** @var \XF\Entity\Phrase $phrase */
            $phrase = $this->_em->create('XF:Phrase');
            $phrase->title = $this->_getDeferredValue(function () {
                return $this->getPhraseName();
            });
            $phrase->language_id = 0;
        }

        return $phrase;
    }

    /**
     *
     * @throws \XF\PrintableException
     */
    protected function _postDelete()
    {
        /** @var \XF\Entity\Phrase $phrase */
        $phrase = $this->MasterTitle;
        if ($phrase) {
            $phrase->delete();
        }
    }

    /**
     *
     */
    protected function _postSave()
    {
        \XF::runOnce('th-unco-rebuild-style-cache', function () {
            $repo = $this->getUserNameStyleRepo();
            $repo->rebuildUserNameStyleCache();
        });

        if ($this->isChanged('user_criteria')) {
            $this->app()->jobManager()->enqueueUnique('th-unco-rebuild-' . $this->user_name_style_id,
                'ThemeHouse\UserNameColor:RebuildStylingCriteriaCheck', [
                    'user_name_style_id' => $this->user_name_style_id
                ]);
        }
    }

    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'th_unco_user_name_style';
        $structure->primaryKey = 'user_name_style_id';
        $structure->shortName = 'ThemeHouse\UserNameColor:UserNameStyle';

        $structure->columns = [
            'user_name_style_id' => ['type' => self::UINT, 'autoIncrement' => true],
            'user_criteria' => ['type' => self::JSON_ARRAY, 'default' => []],
            'styling' => ['type' => self::STR, 'default' => ''],
            'active' => ['type' => self::BOOL, 'default' => 1],
            'display_order' => ['type' => self::UINT, 'default' => 10]
        ];

        $structure->getters = [
            'title' => true
        ];

        $structure->relations = [
            'MasterTitle' => [
                'entity' => 'XF:Phrase',
                'type' => self::TO_ONE,
                'conditions' => [
                    ['language_id', '=', 0],
                    ['title', '=', 'th_unco_user_name_style.', '$user_name_style_id']
                ]
            ]
        ];

        return $structure;
    }

    /**
     * @return \XF\Mvc\Entity\Repository|\ThemeHouse\UserNameColor\Repository\UserNameStyle
     */
    protected function getUserNameStyleRepo()
    {
        return $this->repository('ThemeHouse\UserNameColor:UserNameStyle');
    }
}