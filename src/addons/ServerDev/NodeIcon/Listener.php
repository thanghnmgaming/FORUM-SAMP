<?php

namespace ServerDev\NodeIcon;

use XF\Mvc\Entity\Entity;

class Listener
{
    public static function nodeEntityStructure(\XF\Mvc\Entity\Manager $em, \XF\Mvc\Entity\Structure &$structure)
    {
    	$structure->columns['node_icon'] = ['type' => Entity::STR, 'nullable' => true];
    	$structure->columns['node_icon_unread'] = ['type' => Entity::STR, 'nullable' => true];
    	$structure->columns['node_icon_type'] = ['type' => Entity::STR, 'default'=>'default', 
    		'allowedValues' => ['default','fa','img','custom']
    	];
    }
}