<?php

namespace SV\MultiPrefix;

use SV\MultiPrefix\XF\Entity\Thread;
use SV\MultiPrefix\XFRM\Entity\ResourceItem;
use XF\Mvc\Entity\Entity;
use XF\Template\Templater;

class Listener
{
    /** @var null|Entity|ResourceItem|Thread */
    public static $draftEntity = null;

    /**
     * @var null|array
     */
    public static $prefixIds = null;

    /**
     * @var null|\SV\MultiPrefix\XF\Entity\Forum|\SV\MultiPrefix\XFRM\Entity\Category
     */
    public static $prefixContentParent = null;

    /**
     * @var null|Thread|ResourceItem
     */
    public static $prefixContent = null;

    /**
     * @var bool
     */
    public static $excludeRow = null;

    public static $listenTo = null;

    public static $listenToHref = null;

    /**
     * @var array
     */
    public static $supportedContentTypes = [
        'thread'   => true,
        'resource' => true,
        'dbtechEcommerceProduct' => true,
        'dbtechShopItem' => true,
    ];

    /**
     * @param $key
     * @param $template
     * @param array $params
     *
     * @return bool
     */
    protected static function rewriteForMultiPrefixSupport($key, &$template, array &$params)
    {
        if (isset($params[$key]) && isset(self::$supportedContentTypes[$params[$key]]))
        {
            $template = 'sv_multiprefix_prefix_input';
            $params['prefixMultiple'] = true;
            $params['prefixValue'] = Listener::$prefixIds ?: ($params['prefixValue'] ?: 0);
            $params['prefixContentParent'] = Listener::$prefixContentParent;
            $params['prefixContent'] = Listener::$prefixContent;
            $params['excludeRow'] = self::$excludeRow;

            if (!empty(Listener::$listenTo) && !empty(Listener::$listenToHref))
            {
                $params['listen-to'] = Listener::$listenTo;
                $params['href'] = Listener::$listenToHref;
            }

            return true;
        }

        return false;
    }

    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     *
     * @param array $params
     */
    public static function prefixInputTemplatePreRender(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, array &$params)
    {
        self::rewriteForMultiPrefixSupport('prefixType', $template, $params);
    }

    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param $name
     * @param array $arguments
     * @param array $globalVars
     */
    public static function templateMacroPreRender_prefix_macros_row(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, &$name, array &$arguments, array &$globalVars)
    {
        if (isset(self::$supportedContentTypes[$arguments['type']]))
        {
            $template = 'sv_multiprefix_prefix_macros';
            $arguments['multiple'] = true;
        }
    }

    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param $name
     * @param array $arguments
     * @param array $globalVars
     */
    public static function templateMacroPreRender_prefix_macros_select(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, &$name, array &$arguments, array &$globalVars)
    {
        if (isset(self::$supportedContentTypes[$arguments['type']]))
        {
            $template = 'sv_multiprefix_prefix_macros';
            $arguments['multiple'] = true;
        }
    }

    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param array $params
     */
    public static function templaterTemplatePreRender_forum_prefixes(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, array &$params)
    {
        $template = 'sv_multiprefix_forum_prefixes';
    }

    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param array $params
     */
    public static function templaterTemplatePreRender_xfrm_category_prefixes(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, array &$params)
    {
        $template = 'sv_multiprefix_xfrm_category_prefixes';
    }
    
    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param array $params
     */
    public static function templaterTemplatePreRender_dbtech_ecommerce_category_prefixes(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, array &$params)
    {
        $template = 'sv_multiprefix_dbtech_ecommerce_category_prefixes';
    }
    
    /**
     * @param Templater $templater
     * @param $type
     * @param $template
     * @param array $params
     */
    public static function templaterTemplatePreRender_dbtech_shop_category_prefixes(/** @noinspection PhpUnusedParameterInspection */
        Templater $templater, &$type, &$template, array &$params)
    {
        $template = 'sv_multiprefix_dbtech_shop_category_prefixes';
    }
}