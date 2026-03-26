<?php

return function($__templater, array $__vars, array $__options = [])
{
	$__widget = \XF::app()->widget()->widget('lfs_latest_activity', $__options)->render();

	return $__widget;
};