<?php

return function($__templater, array $__vars, array $__options = [])
{
	$__widget = \XF::app()->widget()->widget('XenYeniMesaj_Widget', $__options)->render();

	return $__widget;
};