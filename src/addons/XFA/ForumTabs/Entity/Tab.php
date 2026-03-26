<?php
/*************************************************************************
 * XenForo Forum Tabs - Xen Factory (c) 2018
 * All Rights Reserved.
 * Created by Clement Letonnelier aka. MtoR
 *************************************************************************
 * This file is subject to the terms and conditions defined in the Licence
 * Agreement available at http://xen-factory.com/pages/license-agreement/.
 *************************************************************************/

namespace XFA\ForumTabs\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class Tab extends Entity
{
    public function canView()
    {
        foreach($this->usergroups AS $usergroupId)
        {
            if (\XF::visitor()->isMemberOf($usergroupId))
            {
                return true;
            }
        }

        return false;
    }
    
    public function getUrl()
    {
        $url = str_replace(array('[\', \']'), '', $this->title);
        $url = preg_replace('/\[.*\]/U', '', $url);
        $url = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $url);
        $url = htmlentities($url, ENT_COMPAT, 'utf-8');
        $url = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $url );
        $url = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $url);
        return strtolower(trim($url, '-'));
    }

    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xfa_forum_tabs';
        $structure->shortName = 'XFA\ForumTabs:Tab';
        $structure->primaryKey = 'tab_id';
        $structure->contentType = 'xfa_forum_tab_id';
        $structure->columns = [
            'tab_id'        => ['type' => self::UINT, 'autoIncrement' => true, 'nullable' => true],
            'title'         => ['type' => self::STR, 'maxLength' => 150,
                'required' => 'please_enter_valid_title'
            ],
            'icon'          => ['type' => self::STR, 'maxLength' => 50],
            'usergroups'    => ['type' => self::LIST_COMMA, 'default' => ''],
            'category_ids'  => ['type' => self::LIST_COMMA, 'default' => ''],
            'order'         => ['type' => self::UINT, 'default' => 0]
        ];
        $structure->getters = [];
        $structure->relations = [];
        $structure->defaultWith = [];
        $structure->options = [];

        return $structure;
    }
}