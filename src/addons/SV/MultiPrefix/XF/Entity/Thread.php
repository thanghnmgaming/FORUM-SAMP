<?php

namespace SV\MultiPrefix\XF\Entity;

use SV\MultiPrefix\Behavior\MultiPrefixable;
use XF\Mvc\Entity\Structure;

/**
 * @property int[] sv_prefix_ids
 * @property \SV\MultiPrefix\Entity\ThreadPrefixLink PrefixesLink
 */
class Thread extends XFCP_Thread
{
    public function isPrefixEditable()
    {
        $prefixes = $this->sv_prefix_ids;
        $forum = $this->Forum;
        if (!$prefixes || !$forum)
        {
            return true;
        }

        foreach($prefixes as $prefixId)
        {
            if (!$forum->isPrefixValid($prefixId) || $forum->isPrefixUsable($prefixId))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getSvPrefixIds()
    {
        return MultiPrefixable::getSvPrefixIds($this);
    }

    /**
     * @param int $prefixId
     * @return null|string
     */
    public function _getPrefixFilterLink($prefixId)
    {
        if (!$this->Forum)
        {
            return null;
        }
        return \XF::app()->router()->buildLink('forums', $this->Forum, ['prefix_id' => $prefixId]);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return bool
     */
    protected function _setInternal($key, $value)
    {
        if ($key === 'sv_prefix_ids')
        {
            // hack work-around for XF bug;
            // https://xenforo.com/community/threads/entity-column-list_comma-list_lines-does-not-round-trip-with-integer-sub-style.144263/
            if ($value !== null)
            {
                $value = array_map('strval', $value);
            }
            else if($value && !is_array($value))
            {
                throw new \LogicException('sv_prefix_ids must be an array or null');
            }
        }
        return parent::_setInternal($key, $value);
    }

    public function rebuildCounters()
    {
        /** @var MultiPrefixable $behaviour */
        $behaviour = $this->getBehavior('SV\MultiPrefix:MultiPrefixable');
        if ($behaviour)
        {
            $db = $this->db();

            $db->beginTransaction();
            $behaviour->rebuildPrefixLinks();
            $db->commit();
        }
        return parent::rebuildCounters();
    }

    /**
     * @param Structure $structure
     *
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->relations['PrefixesLink'] = [
            'entity'        => 'SV\MultiPrefix:ThreadPrefixLink',
            'type'          => self::TO_MANY,
            'conditions'    => 'thread_id',
            'key'           => 'prefix_id',
            'cascadeDelete' => true
        ];

        $structure->behaviors['SV\MultiPrefix:MultiPrefixable'] = [
            'containerIdField' => 'node_id',
            'containerRelation' => 'Forum',
            'containerPhrase' => 'forum',
            'linkTable' => 'xf_sv_thread_prefix_link',
        ];
        MultiPrefixable::addMultiPrefixFields($structure);

        return $structure;
    }
}
