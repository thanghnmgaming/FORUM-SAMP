<?php

namespace ThemeHouse\UserNameColor\Repository;

use XF\Entity\Template;
use XF\Entity\User;
use XF\Mvc\Entity\Repository;
use XF\Util\Color;

/**
 * Class UserNameStyle
 * @package ThemeHouse\UserNameColor\Repository
 */
class UserNameStyle extends Repository
{
    /**
     * @param $styleId
     * @param User|null $user
     * @return bool
     */
    public function isValidStyle($styleId, User $user = null)
    {
        if (!$user) {
            $user = \XF::visitor();
        }

        $styles = $this->getValidStylesForUser($user);
        return $styles->offsetExists($styleId);
    }

    /**
     * @return \XF\Mvc\Entity\Finder|\ThemeHouse\UserNameColor\Finder\UserNameStyle
     */
    public function findStyles()
    {
        return $this->finder('ThemeHouse\UserNameColor:UserNameStyle');
    }

    /**
     * @param User|null $user
     * @return \XF\Mvc\Entity\ArrayCollection
     */
    public function getValidStylesForUser(User $user = null)
    {
        if (!$user) {
            $user = \XF::visitor();
        }

        $styles = $this->findStyles()
            ->activeOnly()
            ->fetch();

        $styles = $styles->filter(function ($style) use ($user) {
            /** @var \ThemeHouse\UserNameColor\Entity\UserNameStyle $style */
            $criteria = $this->app()->criteria('XF:User', $style->user_criteria);
            $criteria->setMatchOnEmpty(true);
            return $criteria->isMatched($user);
        });

        return $styles;
    }

    /**
     * @param $color
     * @return bool
     */
    public function isValidColor($color)
    {
        $colorSet = array_filter(array_map('trim', explode("\n", \XF::options()->thusernamecolor_disallowedColors)));
        foreach ($colorSet as $colorToMatch) {
            if (strpos($colorToMatch, '-') !== false) {
                $colorSet = array_map('trim', explode('-', $colorToMatch));
                if ($this->colorInRange($color, $colorSet[0], $colorSet[1])) {
                    return false;
                }
            } else {
                if ($this->colorsAreEqual($color, $colorToMatch)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param $color
     * @param $rangeStart
     * @param $rangeEnd
     * @return bool
     */
    protected function colorInRange($color, $rangeStart, $rangeEnd)
    {
        if (!is_array($color)) {
            $color = Color::colorToRgb($color);
        }

        if (!is_array($rangeStart)) {
            if (preg_match('/[0-9a-f]{6}/i', $rangeStart)) {
                $rangeStart = '#' . $rangeStart;
            }

            $rangeStart = Color::colorToRgb($rangeStart);
        }

        if (!is_array($rangeEnd)) {
            if (preg_match('/[0-9a-f]{6}/i', $rangeEnd)) {
                $rangeEnd = '#' . $rangeEnd;
            }

            $rangeEnd = Color::colorToRgb($rangeEnd);
        }

        $rStart = min($rangeStart[0], $rangeEnd[0]);
        $gStart = min($rangeStart[1], $rangeEnd[1]);
        $bStart = min($rangeStart[2], $rangeEnd[2]);

        $rEnd = max($rangeStart[0], $rangeEnd[0]);
        $gEnd = max($rangeStart[1], $rangeEnd[1]);
        $bEnd = max($rangeStart[2], $rangeEnd[2]);

        if ($color[0] >= $rStart && $color[0] <= $rEnd
            && $color[1] >= $gStart && $color[1] <= $gEnd
            && $color[2] >= $bStart && $color[2] <= $bEnd) {
            return true;
        }

        return false;
    }

    /**
     * @param $a
     * @param $b
     * @return bool
     */
    protected function colorsAreEqual($a, $b)
    {
        if (!is_array($a)) {
            $a = Color::colorToRgb($a);
        }

        if (!is_array($b)) {
            $b = Color::colorToRgb($b);
        }

        $a = Color::rgbToHex($a);
        $b = Color::rgbToHex($b);

        return $a == $b;
    }

    /**
     * @throws \XF\PrintableException
     */
    public function rebuildUserNameStyleCache()
    {
        $styles = $this->findStyles()->activeOnly()->fetch();

        $template = $this->finder('XF:Template')
            ->where('style_id', '=', 0)
            ->where('type', '=', 'public')
            ->where('title', '=', 'th_unco_user_name_style_cache.less')
            ->fetchOne();

        if (!$template) {
            /** @var Template $template */
            $template = $this->em->create('XF:Template');
            $template->type = 'public';
            $template->title = 'th_unco_user_name_style_cache.less';
            $template->style_id = 0;
            $template->addon_id = '';
        }

        $templateContent = '';
        foreach ($styles as $style) {
            /** @var \ThemeHouse\UserNameColor\Entity\UserNameStyle $style */
            $templateContent .= ".th-unco-user-name-style-" . $style->user_name_style_id . " > span "
                ." {\n\t";

            $styling = join("\n\t", explode("\n", $style->styling));
            $templateContent .= $styling;

            $templateContent .= "\n}\n\n";
        }

        $template->template = $templateContent;
        $template->save();
    }
}