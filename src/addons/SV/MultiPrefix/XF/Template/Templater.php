<?php

namespace SV\MultiPrefix\XF\Template;

use SV\MultiPrefix\Listener;
use XF\Mvc\Entity\Entity;
use XF\Phrase;

/**
 * Class Templater
 *
 * @package SV\MultiPrefix\XF\Template
 */
class Templater extends XFCP_Templater
{
    public function addDefaultHandlers()
    {
        parent::addDefaultHandlers();

        $hasFromCallable = is_callable('\Closure::fromCallable');

        $callable = [$this, 'fnPrefixFilters'];
        if ($hasFromCallable)
        {
            $callable = \Closure::fromCallable($callable);
        }
        $this->addFunction('prefix_filters', $callable);

        $callable = [$this, 'fnReplaceValue'];
        if ($hasFromCallable)
        {
            $callable = \Closure::fromCallable($callable);
        }
        $this->addFilter('replacevalue', $callable);
    }

    /**
     * @param Templater  $templater
     * @param bool       $escape
     * @param string     $contentType
     * @param string     $route
     * @param Entity     $contentParent
     * @param Entity     $content
     * @param array      $filters
     * @param string     $append
     * @param bool       $showFilterControls
     * @param array|null $watchedThreadsFilter
     *
     * @return string
     */
    public function fnPrefixFilters(/** @noinspection PhpUnusedParameterInspection */
        $templater, &$escape, $contentType, $route, $contentParent, $content, $filters, $append = '', $showFilterControls = false, array $watchedThreadsFilter = null)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        $prefixIds = isset($content->sv_prefix_ids) ? $content->sv_prefix_ids : null;

        if (!$prefixIds)
        {
            return '';
        }

        $relNoFollow = ' rel="nofollow"';

        if ($showFilterControls)
        {
            $route = 'watched/threads';
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $contentParent = null;
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $filters = $watchedThreadsFilter;
        }
        if ($filters === null)
        {
            $filters = [];
        }
        $output = [];

        $func = \XF::$versionId >= 2010370 ? 'func' : 'fn';
        foreach ($prefixIds AS $position => $prefixId)
        {
            $prefixId = (int)$prefixId;
            $innerPrefix = $this->$func('prefix', [$contentType, $prefixId, 'html', $append], false);
            $watchedThreadsFilterInstalledAndActive = $this->fnIsAddonActive($templater, $escape, 'SV/WatchThreadsFilter');
            $toolTip = '';

            if ($watchedThreadsFilterInstalledAndActive && $showFilterControls)
            {
                $toolTip = ' data-xf-init="tooltip" title="' . \XF::phrase('svWatchedThreadsFilter.add_this_prefix_to_the_filters') . '"';
            }

            if (empty($filters['prefix_id']))
            {
                $output[] = '<a href="' . $this->app->router()->buildLink($route, $contentParent, array_merge($filters, ['prefix_id' => [$prefixId]])) . '" class="labelLink"' . $toolTip . $relNoFollow . '>' . $innerPrefix . '</a>';
                continue;
            }

            $preLinkFilter = $filters;
            if (!isset($preLinkFilter['prefix_id']))
            {
                $preLinkFilter['prefix_id'] = [];
            }
            if (!is_array($preLinkFilter['prefix_id']))
            {
                $preLinkFilter['prefix_id'] = [$preLinkFilter['prefix_id']];
            }

            $preLinkFilter['prefix_id'][] = $prefixId;
            $preLinkFilter['prefix_id'] = array_unique($preLinkFilter['prefix_id']);

            if (\in_array($prefixId, $filters['prefix_id'], true))
            {
                $preLinkFilter['prefix_id'] = array_diff($preLinkFilter['prefix_id'], [$prefixId]);
                if ($watchedThreadsFilterInstalledAndActive && $showFilterControls)
                {
                    $toolTip = ' data-xf-init="tooltip" title="' . \XF::phrase('svWatchedThreadsFilter.remove_this_prefix_from_filters') . '"';
                }
            }
            else
            {
                if ($watchedThreadsFilterInstalledAndActive && $showFilterControls)
                {
                    $toolTip = ' data-xf-init="tooltip" title="' . \XF::phrase('svWatchedThreadsFilter.add_this_prefix_to_the_filters') . '"';
                }
            }

            $output[] = '<a href="' . $this->app->router()->buildLink($route, $contentParent, $preLinkFilter) . '" class="labelLink"' . $toolTip . $relNoFollow . '>' . $innerPrefix . '</a>';
        }

        $escape = false;

        return join('<span class="label-append">&nbsp;</span>', $output);
    }

    /**
     * @param Templater $templater
     * @param int[]     $value
     * @param string    $escape
     * @param int       $toReplace
     * @param int|null  $replaceWith
     *
     * @return int[]
     */
    public function fnReplaceValue(/** @noinspection PhpUnusedParameterInspection */
        $templater, $value, &$escape, $toReplace, $replaceWith)
    {
        foreach ($value AS $key => $_val)
        {
            if ($_val == $toReplace)
            {
                if ($replaceWith === null)
                {
                    unset($value[$key]);
                }
                else
                {
                    $value[$key] = $replaceWith;
                }
            }
        }

        return $value;
    }

    /**
     * @param $prefixes
     * @param array $controlOptions
     * @param array $rowOptions
     *
     * @return string
     */
    public function formPrefixInputRow($prefixes, array $controlOptions, array $rowOptions)
    {
        $this->addToClassAttribute($rowOptions, 'formRow--input', 'rowclass');

        $controlId = $this->assignFormControlId($controlOptions);
        $controlHtml = '';

        if (isset($controlOptions['full-row']) && $controlOptions['full-row'] === true && !empty($prefixes))
        {
            $controlHtmlTitleExcluded = $this->formPrefixInput($prefixes, array_merge($controlOptions, ['exclude' => 'title']));
            $controlHtmlPrefixExcluded = $this->formPrefixInput($prefixes, array_merge($controlOptions, ['exclude' => 'prefix']));
            $controlHtml .= $this->formRow($controlHtmlTitleExcluded, array_merge($rowOptions, ['label' => \XF::phrase('prefixes')]), $controlId);
            $controlHtml .= $this->formRow($controlHtmlPrefixExcluded, $rowOptions, $controlId);
        }
        else
        {
            $controlHtml .= $this->formPrefixInput($prefixes, $controlOptions);
            $controlHtml = $this->formRow($controlHtml, $rowOptions, $controlId);
        }

        return $controlHtml;
    }

    /**
     * @param $prefixes
     * @param array $controlOptions
     *
     * @return string
     */
    public function formPrefixInput($prefixes, array $controlOptions)
    {
        $oldPrefixIds = Listener::$prefixIds;
        $oldPrefixContentParent = Listener::$prefixContentParent;
        $oldPrefixContent = Listener::$prefixContent;
        $oldExcludeRow = Listener::$excludeRow;
        $oldListenTo = Listener::$listenTo;
        $oldListenToHref = Listener::$listenToHref;

        Listener::$prefixIds = $controlOptions['multi-prefix-value'] ?: null;
        Listener::$prefixContentParent = $controlOptions['multi-prefix-content-parent'] ?: null;
        Listener::$prefixContent = $controlOptions['multi-prefix-content'] ?: null;
        Listener::$excludeRow = $controlOptions['exclude'] ?: null;
        Listener::$listenTo = $controlOptions['listen-to'] ?: null;
        Listener::$listenToHref = $controlOptions['href'] ?: null;

        try
        {
            return parent::formPrefixInput($prefixes, $controlOptions);
        }
        finally
        {
            Listener::$prefixIds = $oldPrefixIds;
            Listener::$prefixContentParent = $oldPrefixContentParent;
            Listener::$prefixContent = $oldPrefixContent;
            Listener::$excludeRow = $oldExcludeRow;
            Listener::$listenTo = $oldListenTo;
            Listener::$listenToHref = $oldListenToHref;
        }
    }

    /**
     * @param Templater  $templater
     * @param string     $escape
     * @param string     $contentType
     * @param int|Entity $prefixId
     * @param string     $format
     * @param null       $append
     *
     * @return string
     */
    public function fnPrefix($templater, &$escape, $contentType, $prefixId, $format = 'html', $append = null)
    {
        if (!($prefixId instanceof Entity) || !isset($prefixId->sv_prefix_ids))
        {
            return parent::fnPrefix($templater, $escape, $contentType, $prefixId, $format, $append);
        }

        /** @var Entity $content */
        $content = $prefixId;
        $canLinkPrefixFilter = ($format === 'html-clicky') && \is_callable([$content, '_getPrefixFilterLink']) && \XF::options()->svClickablePrefixes;
        /** @noinspection PhpUndefinedFieldInspection */
        $prefixIds = $content->sv_prefix_ids;

        if (!$prefixIds)
        {
            return '';
        }

        $prefixCache = $this->app->container('prefixes.' . $contentType);

        $output = [];
        $appendGlue = null;
        $func = \XF::$versionId >= 2010370 ? 'func' : 'fn';

        foreach ($prefixIds AS $prefixId)
        {
            $prefixClass = isset($prefixCache[$prefixId]) ? $prefixCache[$prefixId] : null;

            if (!$prefixClass)
            {
                continue;
            }

            $phraseTitle = $this->$func('prefix_title', [$contentType, $prefixId], false);

            switch ($format)
            {
                case 'html-clicky':
                case 'html':
                    $span = '<span class="' . htmlspecialchars($prefixClass) . '" dir="auto">'
                                . \XF::escapeString($phraseTitle, 'html') . '</span>';
                    if ($canLinkPrefixFilter)
                    {
                        /** @noinspection PhpUndefinedMethodInspection */
                        $link = $content->_getPrefixFilterLink($prefixId);
                        if ($link)
                        {
                            $span = "<a href=\"{$link}\" class=\"labelLink\" rel=\"nofollow\">{$span}</a>";
                        }
                    }
                    $output[] = $span;
                    if ($append === null)
                    {
                        $append = '<span class="label-append">&nbsp;</span>';
                    }
                    if ($appendGlue === null)
                    {
                        $appendGlue = '<span class="label-append">&nbsp;</span>';
                    }
                    break;

                case 'plain':
                    if ($phraseTitle instanceof Phrase)
                    {
                        $output[] = $phraseTitle->render('raw');
                    }
                    else
                    {
                        $output[] = $phraseTitle;
                    }

                    if ($append === null)
                    {
                        $append = ' - ';
                    }
                    if ($appendGlue === null)
                    {
                        $appendGlue = ' - ';
                    }
                    break; // ok as is

                default:
                    $output[] = \XF::escapeString($phraseTitle, 'html'); // just be safe and escape everything else
                    if ($append === null)
                    {
                        $append = ' - ';
                    }
                    if ($appendGlue === null)
                    {
                        $appendGlue = ' - ';
                    }
            }
        }

        $escape = false;

        return join($appendGlue, $output) . ' ';
    }
}