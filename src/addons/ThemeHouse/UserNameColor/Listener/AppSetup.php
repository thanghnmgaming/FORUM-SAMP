<?php

namespace ThemeHouse\UserNameColor\Listener;

use XF\App;

class AppSetup
{
    public static function appSetup(App $app)
    {
//        $app->offsetSet('prdx_ps_item_cache', $app->fromRegistry('prdx_ps_item_cache',
//            function (Container $c) use ($app) {
//                /** @var OwnedItems $repo */
//                $repo = $c['em']->getRepository('Paradox\ProfileSync:OwnedItems');
//                return $repo->buildItemCache();
//            }
//        ));
    }
}
