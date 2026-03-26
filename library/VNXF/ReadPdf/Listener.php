<?php

class VNXF_ReadPdf_Listener
{
	public static function Thread($class, array &$extend)
	{
		if ($class == 'XenForo_ControllerPublic_Thread')
		{
			$extend[] = 'VNXF_ReadPdf_ControllerPublic_Thread';
		}
	}
	public static function template_hook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template)
	{
		if($hookName == 'message_content')
		{
			$params = $template->getParams();
			static $counter = 0; ++$counter;
			if($params['page'] == 1 AND $counter == 1 AND isset($params['tlatt']))
			{
				$templater = $template->create('VNXF_Read_Pdf', $params + $hookParams);
				$contents .= $templater->render();
			}
		}
	}
}
?>