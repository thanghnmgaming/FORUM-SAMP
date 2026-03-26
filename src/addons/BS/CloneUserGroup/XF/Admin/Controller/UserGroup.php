<?php

namespace BS\CloneUserGroup\XF\Admin\Controller;

class UserGroup extends XFCP_UserGroup
{
	public function actionAdd()
	{
		$reply = parent::actionAdd();

		$cloneUserGroupId = $this->filter('clone_id', 'uint');
		if ($cloneUserGroupId && $reply instanceof \XF\Mvc\Reply\View)
		{
			$userGroupInput = $this->assertUserGroupExists($cloneUserGroupId)->toArray();
			$userGroup = $reply->getParam('userGroup');

			unset($userGroupInput['user_group_id'], $userGroupInput['title'], $userGroupInput['user_title']);
			$userGroup->bulkSet($userGroupInput);

			$entryRepo = $this->repository('XF:PermissionEntry');
			$permissionData = $reply->getParam('permissionData');
			$permissionData['values'] = $entryRepo->getGlobalUserGroupPermissionEntries($cloneUserGroupId);

			$reply->setParams([
				'userGroup' => $userGroup,
				
				'permissionData' => $permissionData
			]);
		}

		return $reply;
	}
}