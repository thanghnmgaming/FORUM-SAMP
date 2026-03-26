<?php
class VNXF_ReadPdf_Model extends XenForo_Model
{
	public function getAttachmenttl($contentId)
	{
		$root = str_replace('library/VNXF/ReadPdf','',dirname(__FILE__));	
		$news = $this->_getDb()->fetchAll("
			SELECT attachment.*, data.*
			FROM xf_attachment AS attachment
			INNER JOIN xf_attachment_data AS data ON (data.data_id = attachment.data_id)
			WHERE attachment.content_type = 'post' AND attachment.content_id = '$contentId' AND data.height = 0 AND data.filename LIKE '%.pdf%'
			ORDER BY attachment.content_id, attachment.attach_date");
		foreach ($news AS &$post)
		{
			$post['patha'] = str_replace('.jpg','.pdf',$this->getModelFromCache('XenForo_Model_Attachment')->getAttachmentDataFilePath($post));
			$post['pdf_name'] = md5('vnxf'.$post['attachment_id']);
			$post['pdf_site'] = $this->get_full_url();
			$post['pdf_root'] = $root;
			if (!file_exists($root.'/pdfdata/'.$post['pdf_name'].'.pdf')) {copy($post['patha'], $root.'/pdfdata/'.$post['pdf_name'].'.pdf');}
		}
		return $news;
	}
	
	public function xcopy($source, $dest, $permissions = 0755)
	{
		// Check for symlinks
		if (is_link($source)) {
			return symlink(readlink($source), $dest);
		}
	
		// Simple copy for a file
		if (is_file($source)) {
			return copy($source, $dest);
		}
	
		// Make destination directory
		if (!is_dir($dest)) {
			mkdir($dest, $permissions);
		}
	
		// Loop through the folder
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}
	
			// Deep copy directories
			xcopy("$source/$entry", "$dest/$entry", $permissions);
		}
	
		// Clean up
		$dir->close();
		return true;
	}
	
	public function getAttachment($dataId)
	{
		return $this->_getDb()->fetchRow('
			SELECT a.*, b.*
			FROM xf_attachment AS a
			LEFT JOIN xf_attachment_data AS b ON (b.data_id = a.attachment_id) 
			WHERE  a.attachment_id  = ?
		', $dataId);
	}
	public function getAttachmentbyct($dataId)
	{
		return $this->_getDb()->fetchRow("SELECT a.*, b.*
			FROM xf_attachment AS a
			LEFT JOIN xf_attachment_data AS b ON (b.data_id = a.attachment_id) 
			WHERE a.content_type = 'post' AND a.content_id = '$dataId'");
	}
	public function get_full_url() {
		$https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
		return
			($https ? 'https://' : 'http://').
			(!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
			(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
			($https && $_SERVER['SERVER_PORT'] === 443 ||
			$_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
			substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/')).'/';
	}
}
?>