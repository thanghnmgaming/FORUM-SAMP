<?php

namespace XenGenTr\XGTForumistatistik\Listener;

use XF\Mvc\Entity\Entity;

class Listener
{
    public static function templaterGlobalData(\XF\App $app, array &$data, $reply)
    {
        $data['xengentrForumIstatistikleriForumIstatistikRepo'] = $app->repository('XenGenTr\XGTForumistatistik:ForumIstatistik');
    }
}