<?php

namespace XFRM\Template;

class TemplaterSetup
{
	public function fnResourceIcon($templater, &$escape, \XFRM\Entity\ResourceItem $resource, $size = 'm', $href = '')
	{
		$escape = false;

		if ($href)
		{
			$tag = 'a';
			$hrefAttr = 'href="' . htmlspecialchars($href) . '"';
		}
		else
		{
			$tag = 'span';
			$hrefAttr = '';
		}

		if (!$resource->icon_date)
		{
			return "<{$tag} {$hrefAttr} class=\"avatar avatar--{$size} avatar--resourceIconDefault\"><span></span><span class=\"u-srOnly\">" . \XF::phrase('xfrm_resource_icon') . "</span></{$tag}>";
		}
		else
		{
			$src = $resource->getIconUrl($size);

			return "<{$tag} {$hrefAttr} class=\"avatar avatar--{$size}\">"
				. '<img src="' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($resource->title) . '" />'
				. "</{$tag}>";
		}
	}
}