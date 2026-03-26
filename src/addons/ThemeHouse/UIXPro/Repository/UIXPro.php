<?php

namespace ThemeHouse\UIXPro\Repository;

use ThemeHouse\UIXPro\Entity\Rating;
use XF\Mvc\Entity\Repository;

/**
 * Class UIXPro
 * @package ThemeHouse\UIXPro\Repository
 */
class UIXPro extends Repository
{
    /**
     * @var
     */
    protected $score;

    /**
     * @return array
     * @throws \XF\Db\Exception
     */
    public function getAggregates()
    {
        $types = $this->db()->query('SELECT type, count(*) as count FROM xf_th_uix_pro_rating WHERE state <> "dismissed" GROUP BY type')->fetchAll();
        $aggregates = [
            'error' => 0,
            'warning' => 0,
            'general' => 0,
            'resolved' => 0
        ];

        foreach ($types as $type) {
            $aggregates[$type['type']] = $type['count'];
        }

        return $aggregates;
    }

    /**
     * @return bool|null
     * @throws \XF\Db\Exception
     */
    public function getLastUpdate()
    {
        return $this->db()->query('SELECT max(resolve_date) FROM xf_th_uix_pro_rating')->fetchColumn(0);
    }

    /**
     * @return \XF\Phrase
     * @throws \XF\PrintableException
     */
    public function getLetterGradeHint()
    {
        $score = $this->getLetterGrade();
        return \XF::phrase("th_uixpro_lgh.{$score}");
    }

    /**
     * @return string
     * @throws \XF\PrintableException
     */
    public function getLetterGrade()
    {
        $score = $this->getScore();

        switch ($score) {
            case $score > 1450:
                return 'S';

            case $score > 1300:
                return 'A';

            case $score > 1250:
                return 'B';

            case $score > 950:
                return 'C';

            case $score > 850:
                return 'D';

            default:
                return 'F';
        }
    }

    /**
     * @return integer
     * @throws \XF\PrintableException
     * @throws \XF\Db\Exception
     * @throws \XF\Db\Exception
     */
    public function getScore()
    {
        if (!$this->score) {
            $finder = $this->finder('ThemeHouse\UIXPro:Rating');

            $totals = $finder->total();
            if (!$totals) {
                $this->rebuildRatingCache();
            }

            $this->score = $this->db()->query('SELECT SUM(value) FROM xf_th_uix_pro_rating')->fetchColumn(0);
        }

        return $this->score;
    }

    /**
     * @throws \XF\PrintableException
     */
    protected function rebuildRatingCache()
    {
        $items = $this->finder('ThemeHouse\UIXPro:Rating')
            ->where('manual', '<>', 1)
            ->where('state', '<>', 'dismissed')
            ->fetch();

        $automatedResults = $this->getAutomatedResults();

        $this->db()->beginTransaction();
        foreach ($items as $item) {
            if (!isset($automatedResults[$item->rating_id])) {
                continue;
            }

            /** @var Rating $item */
            $value = $automatedResults[$item->rating_id];

            if ($value['resolved']) {
                $item->state = 'resolved';
                $item->resolve_date = \XF::$time;
                $item->value = is_array($value['value']) ? $value['value'][0] : $value['value'];
            } else {
                $item->value = is_array($value['value']) ? $value['value'][1] : 0;
                $item->state = 'active';
                $item->resolve_date = 0;
                $item->auto_resolvable = isset($value['auto_resolvable']);
            }

            if (isset($value['extra'])) {
                $item->extra = $value['extra'];
            }

            $item->save();
        }
        $this->db()->commit();
    }

    /**
     * @return array
     */
    protected function getAutomatedResults()
    {
        $addOnFinder = $this->finder('XF:AddOn');
        $addOnNumber = $addOnFinder->total() - 1;
        $installedAddons = $addOnFinder->fetch()->keys();
        $options = $this->app()->options();

        $nodeCount = $this->finder('XF:Node')->total();
        $nodeRootCount = $this->finder('XF:Node')->where('depth', '=', 0)->total();

        $providerCount = $this->finder('XF:ConnectedAccountProvider')->where('options', '<>', '')->total();
        $navItemCount = $this->finder('XF:Navigation')
                ->where('parent_navigation_id', '=', '')
                ->where('enabled', '=', 1)->total() - 1;

        return [
            'uix_installed' => [
                'value' => [50, -100],
                'resolved' => in_array('ThemeHouse/UIX', $installedAddons)
            ],
            'addons_installed' => [
                'value' => [50, max(29, $addOnNumber - 20) * -5],
                'resolved' => $addOnNumber <= 21,
                'extra' => ['hint' => ['count' => $addOnNumber]]
            ],
            'installandupgrade_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/InstallAndUpgrade', $installedAddons)
            ],
            'filters_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/Filters', $installedAddons)
            ],
            'covers_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/Covers', $installedAddons)
            ],
            'reactplus_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/ReactPlus', $installedAddons)
            ],
            'monetize_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/Monetize', $installedAddons)
            ],
            'imageoptimizer_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/ImageOptimizer', $installedAddons)
            ],
            'nodes_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/Nodes', $installedAddons)
            ],
            'trending_installed' => [
                'value' => 10,
                'resolved' => in_array('ThemeHouse/Trending', $installedAddons)
            ],
            'https' => [
                'value' => [100, -100],
                'resolved' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                    || $_SERVER['SERVER_PORT'] == 443
            ],
            'php7' => [
                'value' => [100, -50],
                'resolved' => PHP_MAJOR_VERSION >= 7,
                'extra' => ['hint' => ['current' => PHP_VERSION]],
            ],
            'php72' => [
                'value' => [50, -25],
                'resolved' => PHP_MAJOR_VERSION >= 7 && PHP_MINOR_VERSION >= 2,
                'extra' => ['hint' => ['current' => PHP_VERSION]],
            ],
            'php_mysqli' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('mysqli')
            ],
            'php_gd' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('gd')
            ],
            'php_pcre' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('pcre')
            ],
            'php_spl' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('SPL')
            ],
            'php_simplexml' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('SimpleXML')
            ],
            'php_dom' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('dom')
            ],
            'php_json' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('json')
            ],
            'php_iconv' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('iconv')
            ],
            'php_ctype' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('ctype')
            ],
            'php_curl' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('curl')
            ],
            'php_zip' => [
                'value' => [50, -100],
                'resolved' => extension_loaded('zip')
            ],
            'friendly_urls' => [
                'value' => 10,
                'resolved' => $options->useFriendlyUrls,
                'auto_resolvable' => true
            ],
            'romanize_urls' => [
                'value' => 10,
                'resolved' => $options->romanizeUrls,
                'auto_resolvable' => true
            ],
            'cdn_jquery' => [
                'value' => 10,
                'resolved' => $options->jQuerySource != 'local',
                'auto_resolvable' => true
            ],
            'image_proxy' => [
                'value' => [50, -50],
                'resolved' => $options->imageLinkProxy['images'],
                'auto_resolvable' => true
            ],
            'link_proxy' => [
                'value' => [25, -25],
                'resolved' => $options->imageLinkProxy['links'],
                'auto_resolvable' => true
            ],
            'meta_description' => [
                'value' => 10,
                'resolved' => $options->boardDescription != 'Forum software by XenForo'
            ],
            'node_root_count' => [
                'value' => [50, min(10, $nodeRootCount - 5) * -10],
                'resolved' => $nodeRootCount <= 5,
                'extra' => ['hint' => ['count' => $nodeRootCount]]
            ],
            'node_count' => [
                'value' => [50, min(25, $nodeCount - $nodeRootCount * 5) * -10],
                'resolved' => $nodeCount <= $nodeRootCount * 5,
                'extra' => ['hint' => ['count' => $nodeCount]]
            ],
            'oauth_providers' => [
                'value' => [$providerCount * 10, -20],
                'resolved' => $providerCount > 0,
            ],
            'nav_items' => [
                'value' => [50, ($navItemCount - 6) * -5],
                'resolved' => $navItemCount <= 6,
                'extra' => ['hint' => ['count' => $navItemCount]]
            ]
        ];
    }

    /**
     * @return \XF\Phrase
     * @throws \XF\PrintableException
     */
    public function getLetterGradeDesc()
    {
        $score = $this->getLetterGrade();
        return \XF::phrase("th_uixpro_lgd.{$score}");
    }

    /**
     * @param bool $fresh
     * @return \XF\Mvc\Entity\Finder
     * @throws \XF\PrintableException
     */
    public function getRating($fresh = false)
    {
        $finder = $this->finder('ThemeHouse\UIXPro:Rating');

        $totals = $finder->total();
        if (!$totals || $fresh) {
            $this->rebuildRatingCache();
        }

        return $finder;
    }

    /**
     *
     */
    public function createRatings()
    {
        $this->db()->emptyTable('xf_th_uix_pro_rating');
        $groups = [
            [
                'add_on' => [
                    'uix_installed' => false,
                    'addons_installed' => true,
                    'installandupgrade_installed' => true,
                    'filters_installed' => true,
                    'covers_installed' => true,
                    'reactplus_installed' => true,
                    'monetize_installed' => true,
                    'imageoptimizer_installed' => true,
                    'nodes_installed' => true,
                    'postcomments_installed' => true,
                    'trending_installed' => true
                ],
                'server_config' => [
                    'https' => false,
                    'php7' => false,
                    'php72' => true,
                    'php_mysqli' => false,
                    'php_gd' => false,
                    'php_pcre' => false,
                    'php_spl' => false,
                    'php_simplexml' => false,
                    'php_dom' => false,
                    'php_json' => false,
                    'php_iconv' => false,
                    'php_ctype' => false,
                    'php_curl' => false,
                    'php_zip' => false
                ],
                'options' => [
                    'oauth_providers' => false,
                    'friendly_urls' => false,
                    'romanize_urls' => true,
                    'cdn_jquery' => true,
                    'image_proxy' => false,
                    'link_proxy' => false
                ],
                'customisation' => [
                    'meta_description' => false
                ],
                'content_discovery' => [
                    'nav_items' => false,
                    'node_root_count' => false,
                    'node_count' => false
                ]
            ],
            [
                'customisation' => [
                    'uix_style' => false,
                    'uix_pro_style' => false,
                    'custom_child_style' => false,
                    'permissions' => false,
                    'widgets' => false,
                    'user_groups' => false,
                    'logo' => false
                ],
            ]
        ];

        $this->db()->beginTransaction();
        foreach ($groups as $manual => $group) {
            foreach ($group as $groupId => $ratingIds) {
                foreach ($ratingIds as $ratingId => $dismissible) {
                    $this->db()->insert('xf_th_uix_pro_rating', [
                        'rating_id' => $ratingId,
                        'group_id' => $groupId,
                        'dismissible' => (int)$dismissible,
                        'extra' => '[]',
                        'manual' => $manual,
                        'value' => 0
                    ]);
                }
            }
        }
        $this->db()->commit();
    }
}
