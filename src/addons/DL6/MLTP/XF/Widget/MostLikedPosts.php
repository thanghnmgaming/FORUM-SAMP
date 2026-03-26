<?php

namespace DL6\MLTP\XF\Widget;

use XF\Widget\AbstractWidget;

class MostLikedPosts extends AbstractWidget
{
	protected $defaultOptions = [
		'limit' => 5,
		'style' => 'simple',
		'header_url' => '',
		'time_lap' => 'today',
		'minimal' => false,
		'show_expanded_title' => false,
		'custom_time_frame_days' => 1,
		'limit_char' => 0,
		'node_ids' => []
	];

	protected function getDefaultTemplateParams($context)
	{
		$params = parent::getDefaultTemplateParams($context);
		if ($context == 'options')
		{
			$nodeRepo = $this->app->repository('XF:Node');
			$params['nodeTree'] = $nodeRepo->createNodeTree($nodeRepo->getFullNodeList());
		}
		return $params;
	}

	public function render()
	{
		$visitor = \XF::visitor();

		$options = $this->options;
		$limit = $options['limit'];
		$style = $options['style'];
		$timeLapse = $options['time_lap'];
		$nodeIds = $options['node_ids'];
		$custom_time_frame_days = $options['custom_time_frame_days'];
		$limitChar = $options['limit_char'];
		$headerUrl = $options['header_url'];

		$router = $this->app->router('public');
		
		if ($headerUrl != '')
		{
			$link = $router->buildLink($headerUrl);
		}
		else
		{
			$link = false;
		}

		/** @var \XF\Finder\Post $postFinder */
		$postFinder = $this->finder('XF:Post');
		$postFinder
			->with(['Thread.Forum.Node.Permissions|' . $visitor->permission_combination_id, 'User'])
			->where('Thread.discussion_state', 'visible')
			->where('message_state','visible')
			->where('likes', '>', 0)
			->setDefaultOrder('likes', 'DESC')
			->limit(max($limit * 2, 10));
			
			
		    switch ($timeLapse)
		    {
			    default:
			    case 'today':
			        $title = \XF::phrase('ml_most_liked_posts_today');
					$date = new \DateTime("now", new \DateTimeZone($visitor['timezone']));
        			$date->setTime(0, 0, 0);
        			$start = $date->getTimestamp();
        			$date->setTime(23, 59, 59);
        			$end = $date->getTimestamp();
					$postFinder
				        ->where('post_date', '>=', $start)
						->where('post_date', '<=', $end);
				break;

			    case 'week':
			        $title = \XF::phrase('ml_most_liked_posts_week');
					$week = date('w');
        			$week_start = date('j-M-Y', strtotime('-'.$week.' days'));
        			$week_end = date('j-M-Y', strtotime('+'.(6-$week).' days'));
					$firstDay = date_create_from_format('j-M-Y', $week_start,  new \DateTimeZone($visitor['timezone']));
					$firstDay->setTime(0, 0, 0);
					$lastDay = date_create_from_format('j-M-Y', $week_end,  new \DateTimeZone($visitor['timezone']));
					$lastDay->setTime(23, 59, 59);
        			$start_week = $firstDay->getTimestamp();
        			$end_week = $lastDay->getTimestamp();
					$postFinder
				        ->where('post_date', '>=', $start_week)
						->where('post_date', '<=', $end_week);
				break;

			    case 'month':
			        $title = null;
					$month_start = date('01-M-Y',strtotime('this month'));
					$month_end = date('t-M-Y',strtotime('this month'));
					$firstDay = date_create_from_format('j-M-Y', $month_start,  new \DateTimeZone($visitor['timezone']));
					$firstDay->setTime(0, 0, 0);
					$lastDay = date_create_from_format('j-M-Y', $month_end,  new \DateTimeZone($visitor['timezone']));
					$lastDay->setTime(23, 59, 59);
					$start_month = $firstDay->getTimestamp();
					$end_month = $lastDay->getTimestamp();
					$postFinder
				        ->where('post_date', '>=', $start_month)
						->where('post_date', '<=', $end_month);
				break;

			    case 'year':
			        $title = \XF::phrase('ml_most_liked_posts_year', ['year' => date('Y')]);
				    $year_start = date('j-M-Y', strtotime('Jan 01'));
        		    $year_end = date('j-M-Y', strtotime('Dec 31'));
				    $firstDay = date_create_from_format('j-M-Y', $year_start,  new \DateTimeZone($visitor['timezone']));
				    $firstDay->setTime(0, 0, 0);
				    $lastDay = date_create_from_format('j-M-Y', $year_end,  new \DateTimeZone($visitor['timezone']));
				    $lastDay->setTime(23, 59, 59);
        		    $start_year = $firstDay->getTimestamp();
        		    $end_year = $lastDay->getTimestamp();
					$postFinder
				        ->where('post_date', '>=', $start_year)
						->where('post_date', '<=', $end_year);
				break;

			    case 'alltime':
					$title = \XF::phrase('ml_most_liked_posts_all_time');
				break;
				
				case 'custom':
			        $date = new \DateTime();
		            $now = $date->getTimestamp();
		            $optionsDays = $custom_time_frame_days * 86400;
		            $days = $now - $optionsDays;
			        $postFinder->where('post_date', '>=', $days);
			        $title = \XF::phrase('ml_most_liked_posts_last_x_days', ['days' => $custom_time_frame_days]);
				break;
		    }			
			
		if ($nodeIds && !in_array(0, $nodeIds))
		{
			$postFinder->where('Thread.Forum.Node.node_id',$nodeIds);
		}
		
		if ($style == 'full' || $style == 'expanded')
		{
			$postFinder->forFullView();
		}
				 
		/** @var \XF\Entity\Post $post */
		foreach ($posts = $postFinder->fetch() AS $postId => $post)
		{
			if (!$post['Thread']->canView()
				|| $visitor->isIgnoring($post->user_id)
			    || $visitor->isIgnoring($post['Thread']->user_id)
			)
			{
				unset($posts[$postId]);
			}
		}
		
		$total = $posts->count();
		$posts = $posts->slice(0, $limit, true);

		$viewParams = [
			'title' => $this->getTitle() ?: $title,
			'link' => $link,
			'posts' => $posts,
			'style' => $options['style'],
			'minimal' => $options['minimal'],
			'showExpandedTitle' => $options['show_expanded_title']
		];
		return $this->renderer('widget_dl6_most_liked_posts', $viewParams);
	}

	public function verifyOptions(\XF\Http\Request $request, array &$options, &$error = null)
	{
		$options = $request->filter([
			'limit' => 'uint',
			'style' => 'str',
			'time_lap' => 'str',
			'node_ids' => 'array-uint',
			'header_url' => 'str',
			'minimal' => 'bool',
			'show_expanded_title' => 'bool',
			'limit_char' => 'uint',
			'custom_time_frame_days' => 'uint' 
		]);
		
		if ($options['limit'] < 1)
		{
			$options['limit'] = 1;
		}
		
		if ($options['style'] != 'expanded')
		{
			$options['show_expanded_title'] = false;
		}
		
		if ($options['style'] != 'simple')
		{
			$options['minimal'] = false;
		}
		
		if ($options['style'] == 'full' || $options['style'] == 'simple')
		{
		    $options['limit_char'] = 0;
		}
		
		if($options['time_lap'] != 'custom')
		{
			$options['custom_time_frame_days'] = 1;
		}
		
		return true;
	}
}