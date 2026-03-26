<?php

namespace XenGenTr\Xenistatistik\EventListener;

class MakroOlustur
{
    public static function preRender(\XF\Template\Templater $templater, &$type, &$template, &$name, array &$arguments, array &$globalVars)
    {
        if ($arguments['group']->group_id == 'Xenistatistik_secenekler')
        {
            $template = 'Xenistatistik_acp_tab_sistem';
        }
    }
}