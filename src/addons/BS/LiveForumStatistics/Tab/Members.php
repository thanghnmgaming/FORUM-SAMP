<?php

namespace BS\LiveForumStatistics\Tab;

use XF\Mvc\Entity\ArrayCollection;

class Members extends AbstractTab
{
    protected $defaultOptions = [
        'type'  => '',
        'type_cutoff' => 0,

        'is_birthday' => false,

        'limit' => 15,
        'order' => ['register_date', 'desc']
    ];

    public function render($finalRender = true, \XF\Http\Request $request = null)
    {
        $userFinder = $this->finder('XF:User')
            ->isValidUser();

        $this->applyOptions($userFinder, $this->options, $viewParams);

        return $this->finalRender($this->getTemplateName(), $viewParams, $finalRender);
    }

    public function getPresets()
    {
        return [
            'top_posters' => [
                'title'   => \XF::phrase('lfs_member_preset.top_posters'),
                'options' => [
                    'type'        => 'top_posters',
                    'type_cutoff' => 7,
                    'template'    => 'preset'
                ]
            ],
            'top_reactions' => [
                'title'   => \XF::phrase('lfs_member_preset.top_reactions'),
                'options' => [
                    'type'        => 'top_reactions',
                    'type_cutoff' => 7,
                    'template'    => 'preset'
                ]
            ],
        ];
    }

    public function verifyOptions(\XF\Http\Request $request, array &$options, &$error = null)
    {
        $options['order'] = [
            isset($options['order']['order']) ? $options['order']['order'] : 'register_date',
            isset($options['order']['direction']) ? $options['order']['direction'] : 'desc'
        ];

        $limit = isset($options['limit']) ? (int)$options['limit'] : $this->defaultOptions['limit'];

        if ($limit < 1)
        {
            $limit = 1;
        }

        $options['limit'] = $limit;

        return true;
    }

    protected function applyOptions(\XF\Finder\User $finder, $options, &$viewParams = null)
    {
        if (! is_array($viewParams))
        {
            $viewParams = [];
        }

        if ($options['is_birthday'])
        {
            $finder->isBirthday()
                ->isRecentlyActive(365);
        }

        switch ($options['type'])
        {
            case 'top_posters':
                $topPosters = $this->getTopPosters($options['limit'], $options['type_cutoff']);
                $this->filterUserIds($finder, $topPosters);

                $users = $this->sortUsersByOtherValuesKey($finder->fetch(), $topPosters, 'post_count');

                $viewParams['topPosters'] = $topPosters;
                break;

            case 'top_reactions':
                $topReactions = $this->getTopReactions($options['limit'], $options['type_cutoff']);
                $this->filterUserIds($finder, $topReactions);

                $users = $this->sortUsersByOtherValuesKey($finder->fetch(), $topReactions, 'reaction_score');

                $viewParams['topReactions'] = $topReactions;
                break;

            default:
                $users = $finder->order($options['order'])
                    ->limit($options['limit'])
                    ->fetch();
                break;
        }

        $viewParams['users'] = $users;
    }

    protected function filterUserIds(\XF\Finder\User $finder, array $users)
    {
        $finder->where('user_id', array_column($users, 'user_id'));
    }

    protected function sortUsersByOtherValuesKey(ArrayCollection $users, $values, $key)
    {
        $iterator = $users->getIterator();
        $iterator->uasort(function ($firstUser, $secondUser) use ($values, $key)
        {
            $firstUserValue  = $values[$firstUser->user_id][$key];
            $secondUserValue = $values[$secondUser->user_id][$key];

            if ($firstUserValue == $secondUserValue)
            {
                return 0;
            }

            return ($firstUserValue < $secondUserValue) ? 1 : -1;
        });

        return new ArrayCollection(iterator_to_array($iterator));
    }

    protected function getTopPosters($limit, $cutOff)
    {
        $db = $this->db();

        $cutOff = \XF::$time - $cutOff * 86400;

        return $db->fetchAllKeyed($db->limit('
                SELECT post.user_id, 
                    COUNT(*) AS post_count
                FROM xf_post AS post
                WHERE post.post_date >= ?
                  AND post.message_state = \'visible\'
                GROUP BY post.user_id
                ORDER BY post_count DESC
        '   , $limit)
        , 'user_id', $cutOff);
    }

    protected function getTopReactions($limit, $cutOff)
    {
        $db = $this->db();

        $cutOff = \XF::$time - $cutOff * 86400;

        return $db->fetchAllKeyed($db->limit('
                SELECT reaction.content_user_id AS user_id, 
                    SUM(react.reaction_score) AS reaction_score
                FROM xf_reaction_content AS reaction
                LEFT JOIN xf_reaction AS react
                  ON (react.reaction_id = reaction.reaction_id)
                WHERE reaction.reaction_date >= ?
                  AND reaction.is_counted = 1
                GROUP BY reaction.content_user_id
                ORDER BY reaction_score DESC
        '   , $limit)
        , 'user_id', $cutOff);
    }

    public function getDefaultTemplate($preset = null)
    {
        $request = $this->app->request();

        $pathFormat = __DIR__ . '/stubs/members/%s.stub';
        $stubName = 'default';

        $template = $request->filter('member_definition_template', 'str');

        switch ($template)
        {
            case 'preset':
                $preset = $request->filter('preset', 'str');

                if (file_exists(sprintf($pathFormat, $preset)))
                {
                    $stubName = $preset;
                }
                break;

            case 'default':
                break;

            default:
                if (file_exists(sprintf($pathFormat, $template)))
                {
                    $stubName = $template;
                }
                break;
        }

        return file_get_contents(sprintf($pathFormat, $stubName));
    }
}