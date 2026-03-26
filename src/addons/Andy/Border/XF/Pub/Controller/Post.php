<?php

namespace Andy\Border\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

class Post extends XFCP_Post
{
	public function actionBorder(ParameterBag $params)
	{
		// get visitor
		$visitor = \XF::visitor();
				
		// get permission
		if (!$visitor->hasPermission('border', 'view'))
		{
			return $this->noPermission();
		}
		
		// get post
		$post = $this->assertViewablePost($params->post_id);	
		
		// get postId
		$postId = $post->post_id;			
		
		// get db
		$db = \XF::db();			

		// run query
		$attachments = $db->fetchAll("
			SELECT xf_attachment.attachment_id, 
			xf_attachment_data.data_id,
			xf_attachment_data.filename,
			xf_attachment_data.file_hash
			FROM xf_attachment
			INNER JOIN xf_attachment_data ON xf_attachment_data.data_id = xf_attachment.data_id
			WHERE xf_attachment.content_id = ?
			AND xf_attachment.content_type = ?
			AND xf_attachment_data.width > ?
			ORDER BY xf_attachment.attachment_id ASC
		", array($postId, 'post', '0'));		

		// add to multidimensional array
		foreach ($attachments as $k => $v)
		{
			// get dataId
			$dataId = $v['data_id'];
			
			// get thumbnail path
			$path = sprintf('attachments/%d/%d-%s.jpg',
				floor($dataId / 1000),
				$dataId,
				$v['file_hash']
			);

			// get fileHash
			$fileHash = $v['file_hash'];			

			// get last folder
			$lastFolder = floor($dataId / 1000);
			
			// get internalDataDir
			$internalDataDir = \XF\Util\File::canonicalizePath($this->app->config('internalDataPath'));	

			// get attachmentPath of full size image
			$attachmentPath = $internalDataDir . '/attachments/' . $lastFolder . '/' . $dataId . '-' . $fileHash . '.data';				

			// get thumbnailUrl
			$attachments[$k]['thumbnailUrl'] = $this->app()->applyExternalDataUrl($path);
			
			// get post_id
			$attachments[$k]['post_id'] = $postId;
			
			// get positions
			$pos1 = stripos($v['filename'], '.jpg');
			$pos2 = stripos($v['filename'], '.jpeg');
			$pos3 = stripos($v['filename'], '.png');
			
			// check if numeric
			if (!is_numeric($pos1) AND !is_numeric($pos2) AND !is_numeric($pos3))
			{
				unset($attachments[$k]);
			}
			
			// check if png is transparent
			if (is_numeric($pos3))
			{
				// define imagick
				$imagick = new \Imagick();
				$imagick->readImage($attachmentPath);

				// if image has a transparency
				if ($imagick->getImageAlphaChannel())
				{					
					unset($attachments[$k]);
				}
			}
		}

		// prepare viewParams
		$viewParams = [
			'post' => $post,
			'attachments' => $attachments
		];
		
		// send to template
		return $this->view('XF:AndyB\Border', 'andy_border', $viewParams);
	}
	
	public function actionBorderSave()
	{	
		// get visitor
		$visitor = \XF::visitor();
				
		// get permission
		if (!$visitor->hasPermission('border', 'view'))
		{
			return $this->noPermission();
		}
		
		// get options
		$options = \XF::options();		
		
		// get options from Admin CP -> Options -> Attachments -> Default image processor
		$imageLibrary = $options->imageLibrary;		
		
		// verify Imagemagick is enabled
		if ($imageLibrary != 'imPecl')
		{
			return $this->error(\XF::phrase('border_imagemagick_pecl_extension_not_enabled'));
		}		
		
		// get post_id
		$postId = $this->filter('post_id', 'uint');	
		
		// verify postId
		if (!is_numeric($postId))
		{
			return $this->error(\XF::phrase('border_post_id_required'));
		}				
		
		// get attachmentId
		$attachmentId = $this->filter('attachment_id', 'uint');	
		
		// verify attachmentId
		if (!is_numeric($attachmentId))
		{
			return $this->error(\XF::phrase('border_attachment_id_required'));
		}			
		
		// get db
		$db = \XF::db();			
		
		// run query
		$postId = $db->fetchOne("
			SELECT content_id
			FROM xf_attachment
			WHERE content_type = ?
			AND attachment_id = ? 
		", array('post',$attachmentId));			
		
		// run query
		$data = $db->fetchRow("
			SELECT xf_attachment.attachment_id, 
			xf_attachment_data.data_id,
			xf_attachment.content_id,
			xf_attachment_data.file_hash
			FROM xf_attachment
			INNER JOIN xf_attachment_data ON xf_attachment_data.data_id = xf_attachment.data_id
			WHERE xf_attachment.attachment_id = ?
		", $attachmentId); 
		
		// get lastfolder
		$lastfolder = floor($data['data_id'] / 1000);
		
		// get internal_data path
		$internalDataPath = \XF::app()->config('internalDataPath');
	
		// define attachmentFullPath
		$attachmentFullPath = $internalDataPath . '/attachments/' . $lastfolder . '/' . $data['data_id'] . '-' . $data['file_hash'] . '.data';
		
		//#################################################
		// add border
		//#################################################	
		
		// get options from Admin CP -> Options -> Border -> Border width
		$borderWidth = $options->borderBorderWidth;
		
		// get options from Admin CP -> Options -> Border -> Border color
		$borderColor = $options->borderBorderColor;				

		// add border
		$imagick = new \Imagick();
		$imagick->readImage($attachmentFullPath);
		$imagick->shaveImage($borderWidth, $borderWidth);
		$imagick->borderImage($borderColor, $borderWidth, $borderWidth);
		$imagick->writeImage($attachmentFullPath);
		$imagick->clear();
		$imagick->destroy();	
		
		// get data
		$filesize = filesize($attachmentFullPath);
		$filehash = hash_file('md5', $attachmentFullPath);			

		// define attachmentFullPathNew
		$attachmentFullPathNew = $internalDataPath . '/attachments/' . $lastfolder . '/' . $data['data_id'] . '-' . $filehash . '.data';
		
		// update attachment file
		rename("$attachmentFullPath", "$attachmentFullPathNew");
		
		// get new image size
		list($width, $height) = getimagesize($attachmentFullPathNew);		
		
		// assign value if image width or height could not be read
		if (is_null($width) OR is_null($height))
		{
			$width = 0;
			$height = 0;
		}
		
		// run query
		$db->query("
		UPDATE xf_attachment_data SET
			file_size = ?,
			file_hash = ?,
			width = ?,
			height = ?
			WHERE data_id = ?
		", array($filesize, $filehash, $width, $height, $data['data_id']));
		
		//#####################################
		// update thumbnail
		//#####################################
		
		// get data path					
		$externalDataPath = \XF::app()->config('externalDataPath');
		
		// define thumbnailPath
		$thumbnailFullPath = $externalDataPath . '/attachments/' . $lastfolder . '/' . $data['data_id'] . '-' . $data['file_hash'] . '.jpg';

		// get options from Admin CP -> Options -> Attachments -> Attachment thumbnail dimensions
		$thumbnailDimensions = $options->attachmentThumbnailDimensions;		

		$imagick = new \Imagick();
		$imagick->readImage($attachmentFullPathNew);
		$imagick->resizeImage($thumbnailDimensions, $thumbnailDimensions, \Imagick::FILTER_LANCZOS, 1, true);
		$imagick->writeImage($thumbnailFullPath);
		$imagick->clear();
		$imagick->destroy();	
		
		// define thumbnailFullPathNew
		$thumbnailFullPathNew = $externalDataPath . '/attachments/' . $lastfolder . '/' . $data['data_id'] . '-' . $filehash . '.jpg';

		// update thumbnail file
		rename("$thumbnailFullPath", "$thumbnailFullPathNew");
		
		// get new image size
		list($width, $height) = getimagesize($thumbnailFullPathNew);
		
		// assign value if image width or height could not be read
		if (is_null($width) OR is_null($height))
		{
			$width = 0;
			$height = 0;
		}
		
		$db->query("
		UPDATE xf_attachment_data SET
			thumbnail_width = ?
			WHERE data_id = ?
		", array($width, $data['data_id']));
		
		$db->query("
		UPDATE xf_attachment_data SET
			thumbnail_height = ?
			WHERE data_id = ?
		", array($height, $data['data_id']));

		// return redirect
		return $this->redirect($this->buildLink('posts/' . $postId . '/border/#' . time()));
	}	
}