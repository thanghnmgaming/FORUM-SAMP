<?php
// FROM HASH: b9be5a2aabdc803ba80be1036927908f
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/*****************************************
* [XenGenTr] Kullanici Banner sistemi    *
* Powered eTiKeT™                        *
* www.xenforo.gen.tr                     *
* Ver. 1.0.0                             *
*****************************************/

.xgtUserBanner, .xgtUserBanner-mesaj  
{
	border-radius: 2px;
	display: inline-block;
	position: relative;
	font-size: 90%;
	padding: 0 5px 0 32px;
	font-size: 80%;
	font-weight: normal;
	text-align: right;
	min-width: 100px;
      	
	&.userBanner--xgt1 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner1renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner1ap']) . '); 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner1ikon']) {
		$__finalCompiled .= ' 
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner1ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
     &.userBanner--xgt2 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner2renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner2ap']) . '); 
		
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner2ikon']) {
		$__finalCompiled .= ' 
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner2ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt3 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner3renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner3ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner3ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner3ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt4 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner4renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner4ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner4ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner4ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt5 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner5renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner5ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner5ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner5ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt6 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner6renk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner6ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner6ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner6ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt7 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner7renk']) . ', ' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner7ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner7ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner7ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt8 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner8renk']) . ', ' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner8ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner8ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner8ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt9 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner9renk']) . ', ' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner9ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner9ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner9ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}
	
	&.userBanner--xgt10 
	{	
		.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner10renk']) . ', ' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner10ap']) . '); 
		 
		';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner10ikon']) {
		$__finalCompiled .= ' 	
		    &::before {		
			    content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_secenekleri']['banner10ikon']) . '";
            }
		';
	}
	$__finalCompiled .= '
	}

	
	&.userBanner--xgt1, &.userBanner--xgt2, 
	&.userBanner--xgt3, &.userBanner--xgt4,
	&.userBanner--xgt5, &.userBanner--xgt6,
	&.userBanner--xgt7, &.userBanner--xgt8, 
	&.userBanner--xgt9, &.userBanner--xgt10 
	{	
		&::before 
		{ 
			background: rgba(0, 0, 0, 0.2) none repeat scroll 0 0;
			position: absolute;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
			border-right: 1px solid #fff;
			top: 0;
			bottom: 0;
			left: 0;
			padding: 0px 4px 0px 4px;
			min-width: 20px;
			font-size: 100%;
			text-align: center;		
			
			.m-faBase();
		}
	}
}

';
	if ($__vars['xf']['options']['XGT_Kullanici_Banner_yonetici']['yoneticibanneretkin']) {
		$__finalCompiled .= '
	.userBanner--staff 
	{
		border-radius: 2px;
		display: inline-block;
		position: relative;
		font-size: 90%;
		padding: 0 5px 0 32px;
		cursor: pointer;
		font-size: 80%;
		font-weight: normal;
		text-align: right;
		min-width: 100px;

			&:before {
			background:rgba(0, 0, 0,0.2) none repeat scroll 0 0;
			position: absolute;
        	border-top-right-radius: 10px;
        	border-bottom-right-radius: 10px;
        	border-right: 1px solid #fff;
			top: 0;
			bottom: 0;
			left: 0;
			padding:0px 4px 0px 4px;
			min-width: 20px;
			font-size: 100%;
			text-align: center;
			
				.m-faBase();
			}
	
	   	&.userBanner--staff
	   	{
		  	.m-userBannerVariation(' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_yonetici']['yoneticibannerrenk']) . ',' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_yonetici']['yoneticibannerap']) . ');  
			';
		if ($__vars['xf']['options']['XGT_Kullanici_Banner_yonetici']['yoneticibannerikon']) {
			$__finalCompiled .= ' 
		          &::before {		
			           content: "\\' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_Banner_yonetici']['yoneticibannerikon']) . '";
                  }
		    ';
		}
		$__finalCompiled .= '	   		   
	   	}
 	}	
';
	} else {
		$__finalCompiled .= '
	.userBanner--staff 
	{
   	    padding:0px;
   	    font-weight: normal;
   	    text-align: center;
	}
';
	}
	$__finalCompiled .= '

';
	if ($__vars['xf']['options']['XGT_Kullanici_baslik_yoneticisi']['basliketkin']) {
		$__finalCompiled .= '
    .message-userTitle 
    {
	    background-color:' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_baslik_yoneticisi']['baslikap']) . ';
	    border-radius: 2px;
	    color:' . $__templater->escape($__vars['xf']['options']['XGT_Kullanici_baslik_yoneticisi']['baslikrenk']) . ';
    }
';
	}
	return $__finalCompiled;
});