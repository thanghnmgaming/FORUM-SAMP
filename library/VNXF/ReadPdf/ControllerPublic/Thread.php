<?php

class VNXF_ReadPdf_ControllerPublic_Thread extends XFCP_VNXF_ReadPdf_ControllerPublic_Thread
{	
	public function gettla()
	{
		return $this->getModelFromCache('VNXF_ReadPdf_Model');
    }
	public function actionIndex()
	{
		$parent = parent::actionIndex();
		$node = $parent->params['thread']['node_id'];
		$options = XenForo_Application::get('options');
		$visitor = XenForo_Visitor::getInstance();
		$size['width'] = $options->vnxf_readpdf_width;
		$size['height'] = $options->vnxf_readpdf_height;
		$size['hide'] = $options->vnxf_readpdf_hideatt;
		$ah = explode(',', $options->vnxf_readpdf_kah);
		$ahgr = explode(',', $options->vnxf_readpdf_group_kah);
		if(in_array($parent->params['thread']['node_id'], $ah) || in_array($visitor['user_group_id'], $ah)) {
			return parent::actionIndex();
		}
		$parent->params += array(
			'tlatt' => $this->gettla()->getAttachmenttl($parent->params['thread']['first_post_id']),
			'size_pdf' => $size,
		);
		return $parent;
	}
}