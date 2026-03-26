<?php

return function($__templater, array $__vars, array $__options = [])
{
	$__widget = \XF::app()->widget()->widget('show_threads', $__options)->render();

	return $__widget;
};