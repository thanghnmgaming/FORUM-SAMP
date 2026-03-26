<?php

namespace XenGenTr\XGTUserBanner\XF\Admin\Controller;

use XF\Mvc\ParameterBag;
use XF\Mvc\FormAction;
use XF\Pub\Controller\AbstractController;

class UserGroup extends XFCP_UserGroup
{
	protected function userGroupAddEdit(\XF\Entity\UserGroup $userGroup)
	{

	    $isAddonEnabledGlobally =! \XF::options()->offsetGet('XGT_Kullanici_Banner_Kapat');

		if(!$isAddonEnabledGlobally)
		{
			$displayStyles = [
				'userBanner userBanner--hidden',
				'userBanner userBanner--primary',
				'userBanner userBanner--accent',
				'userBanner userBanner--red',
				'userBanner userBanner--green',
				'userBanner userBanner--olive',
				'userBanner userBanner--lightGreen',
				'userBanner userBanner--blue',
				'userBanner userBanner--royalBlue',
				'userBanner userBanner--skyBlue',
				'userBanner userBanner--gray',
				'userBanner userBanner--silver',
				'userBanner userBanner--yellow',
				'userBanner userBanner--orange',
				'xgtUserBanner userBanner--xgt1',
				'xgtUserBanner userBanner--xgt2',
				'xgtUserBanner userBanner--xgt3',
				'xgtUserBanner userBanner--xgt4',
				'xgtUserBanner userBanner--xgt5',
				'xgtUserBanner userBanner--xgt6',
				'xgtUserBanner userBanner--xgt7',
				'xgtUserBanner userBanner--xgt8',
				'xgtUserBanner userBanner--xgt9',
				'xgtUserBanner userBanner--xgt10',
			];

			/** @var \XF\Repository\Permission $permissionRepo */
			$permissionRepo = $this->repository('XF:Permission');
			$permissionData = $permissionRepo->getGlobalPermissionListData();

			/** @var \XF\Repository\PermissionEntry $entryRepo */
			$entryRepo = $this->repository('XF:PermissionEntry');
			$permissionData['values'] = $entryRepo->getGlobalUserGroupPermissionEntries($userGroup->user_group_id);

			$viewParams = [
				'userGroup' => $userGroup,
				'displayStyles' => $displayStyles,
				'permissionData' => $permissionData
			];
				
			return $this->view('XF:UserGroup\Edit', 'user_group_edit', $viewParams);
		}

		else 
		{ 			
			$displayStyles = [
				'userBanner userBanner--hidden',
				'userBanner userBanner--primary',
				'userBanner userBanner--accent',
				'userBanner userBanner--red',
				'userBanner userBanner--green',
				'userBanner userBanner--olive',
				'userBanner userBanner--lightGreen',
				'userBanner userBanner--blue',
				'userBanner userBanner--royalBlue',
				'userBanner userBanner--skyBlue',
				'userBanner userBanner--gray',
				'userBanner userBanner--silver',
				'userBanner userBanner--yellow',
				'userBanner userBanner--orange',
			];

			/** @var \XF\Repository\Permission $permissionRepo */
			$permissionRepo = $this->repository('XF:Permission');
			$permissionData = $permissionRepo->getGlobalPermissionListData();

			/** @var \XF\Repository\PermissionEntry $entryRepo */
			$entryRepo = $this->repository('XF:PermissionEntry');
			$permissionData['values'] = $entryRepo->getGlobalUserGroupPermissionEntries($userGroup->user_group_id);

			$viewParams = [
				'userGroup' => $userGroup,
				'displayStyles' => $displayStyles,
				'permissionData' => $permissionData
			];

			return $this->view('XF:UserGroup\Edit', 'user_group_edit', $viewParams);
		}
	}
}