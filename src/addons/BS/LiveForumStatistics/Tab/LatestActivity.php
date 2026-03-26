<?php

namespace BS\LiveForumStatistics\Tab;

use XF\Mvc\Entity\ArrayCollection;

class LatestActivity extends AbstractTab
{
    protected $defaultOptions = [
        'exclude_content_types' => [],
        'limit' => 15
    ];

    public function render($finalRender = true, \XF\Http\Request $request = null)
    {
        $options = $this->options;

        $newsFeedRepo = $this->repository('XF:NewsFeed');

        $newsFeedFinder = $newsFeedRepo->findNewsFeed();

        $this->applyOptions($newsFeedFinder, $options);

        $items = $newsFeedFinder->fetch($options['limit'] * 2);
        $newsFeedRepo->addContentToNewsFeedItems($items);
        $items = $items->filterViewable();

        /** @var ArrayCollection $items */
        $items = $items->slice(0, $options['limit']);

        return $this->finalRender($this->getTemplateName(), compact('items'), $finalRender);
    }

    protected function applyOptions(\XF\Finder\NewsFeed $finder, $options)
    {
        $excludeContentTypes = array_values(array_filter($options['exclude_content_types']));

        if (! empty($excludeContentTypes))
        {
            $finder->where('content_type', '!=', $excludeContentTypes);
        }
    }

    public function getDefaultTemplate($preset = null)
    {
        return file_get_contents(__DIR__ . '/stubs/latest_activity.stub');
    }
}