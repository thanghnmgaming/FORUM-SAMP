<?php

namespace ThemeHouse\UserNameColor\Finder;

use XF\Mvc\Entity\Finder;

/**
 * Class UserNameStyle
 * @package ThemeHouse\UserNameColor\Finder
 */
class UserNameStyle extends Finder
{
    /**
     * @return $this
     */
    public function activeOnly()
    {
        return $this->where('active', '=', 1);
    }
}