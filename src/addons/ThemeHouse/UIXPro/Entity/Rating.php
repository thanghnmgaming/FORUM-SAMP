<?php

namespace ThemeHouse\UIXPro\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;
use XF\Phrase;

/**
 * Class Rating
 * @package ThemeHouse\UIXPro\Entity
 *
 * @property string rating_id
 * @property string group_id
 * @property integer value
 * @property string hint_phrase
 * @property array extra
 * @property boolean done
 * @property boolean manual
 * @property string type
 * @property int resolve_date
 * @property string state
 * @property boolean dismissible
 *
 * @property string|Phrase title
 * @property string|Phrase hint
 */
class Rating extends Entity
{
    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_th_uix_pro_rating';
        $structure->shortName = 'ThemeHouse\UIXPro:Rating';
        $structure->primaryKey = 'rating_id';

        $structure->columns = [
            'rating_id' => ['type' => self::STR, 'required' => true, 'maxLength' => 100],
            'group_id' => ['type' => self::STR, 'required' => true, 'maxLength' => 100],
            'value' => ['type' => self::INT, 'default' => 0],
            'manual' => ['type' => self::BOOL, 'default' => 0],
            'auto_resolvable' => ['type' => self::BOOL, 'default' => 0],
            'resolve_date' => ['type' => self::UINT, 'default' => 0],
            'dismissible' => ['type' => self::BOOL, 'default' => 1],
            'state' => [
                'type' => self::STR,
                'allowedValues' => [
                    'active',
                    'resolved',
                    'dismissed'
                ],
                'default' => 'active'
            ],
            'type' => [
                'type' => self::STR,
                'allowedValues' => [
                    'error',
                    'warning',
                    'general',
                    'resolved'
                ],
                'default' => 'warning'
            ],
            'extra' => ['type' => self::JSON, 'default' => [], 'nullable' => true],
        ];

        $structure->getters = [
            'title' => true,
            'hint' => true
        ];

        return $structure;
    }

    /**
     * @return Phrase
     */
    public function getHint()
    {
        return \XF::phrase(
            "th_uix_pro_rating_hint.{$this->rating_id}",
            isset($this->extra['hint']) ? $this->extra['hint'] : []
        );
    }

    /**
     * @return Phrase
     */
    public function getTitle()
    {
        return \XF::phrase("th_uix_pro_rating.{$this->rating_id}_{$this->state}");
    }

    /**
     *
     */
    protected function _preSave()
    {
        if ($this->value < -50) {
            $this->type = 'error';
        } else {
            if ($this->value < 0) {
                $this->type = 'warning';
            } else {
                if ($this->value == 0) {
                    $this->type = 'general';
                } else {
                    $this->type = 'resolved';
                }
            }
        }
        $this->resolve_date = \XF::$time;

        parent::_preSave();
    }
}
