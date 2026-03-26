<?php

namespace XenGenTr\XGTUserBanner\EventListener;

class MacroRender
{
    public static function preRender(\XF\Template\Templater $templater, &$type, &$template, &$name, array &$arguments, array &$globalVars)
    {
        if ($arguments['group']->group_id == 'XGT_Kullanici_Banner')
        {
            // Override template name
            $template = 'XGT_Kullanici_Banner_secenekler';
        }
    }
}