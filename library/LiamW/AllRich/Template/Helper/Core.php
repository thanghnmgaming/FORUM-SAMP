<?php

class LiamW_AllRich_Template_Helper_Core extends \XenForo_Template_Helper_Core
{
	public static $displayStyleIds;

	public static function helperUserNameHtml(array $user, $username = '', $rich = false, array $attributes = array())
	{
		if ($username == '')
		{
			// no username? Just return it anyway.
			$username = htmlspecialchars($user['username']);
		}

		// If we don't have an ID for the display style group in the user array, we need to get it...
		if (!array_key_exists('display_style_group_id', $user))
		{
			// ...If it isn't already in the cache array.
			if (!isset(self::$displayStyleIds[$user['user_id']]))
			{
				// Get the user array
				$tmp = XenForo_Model::create('XenForo_Model_User')->getVisitingUserById($user['user_id']);
				// Set the group ID.
				self::$displayStyleIds[$user['user_id']] = $tmp['display_style_group_id'];
			}

			// Set the group ID in the user array
			$user['display_style_group_id'] = self::$displayStyleIds[$user['user_id']];
		}

		// Get the actual username.
		$username = self::callHelper('richusername', array(
			$user,
			$username
		));

		// Get the User href. Also allows the use of a href tag in the <xen:user /> tag.
		$href = self::getUserHref($user, $attributes);

		// Check if there is a class...
		$class = (empty($attributes['class']) ? '' : ' ' . htmlspecialchars($attributes['class']));

		// Unset the class and href attributes
		unset($attributes['href'], $attributes['class']);

		// Get the rest of the attributes
		$attribs = self::getAttributes($attributes);

		// Return the link
		return "<a{$href} class=\"username{$class}\"{$attribs}>{$username}</a>";
	}
} 