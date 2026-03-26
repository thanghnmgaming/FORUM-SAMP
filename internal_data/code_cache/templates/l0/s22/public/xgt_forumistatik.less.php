<?php
// FROM HASH: 861d8b1ed6609c78947430e45ba5988d
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '/***********************************
** [XGT] Forum istatistik LESS
** www.xenforo.gen.tr - eTiKeT™
** Yazılı: 26.01.2020 
** Son gucenlleme:23.05.2020
***********************************/
.xgt-ForumIstatistik-Govde
{
	
	.istatistik-blogu 
	{	
		display: -ms-flexbox;	
		display: -webkit-flex;	
		display: flex;	
		-webkit-flex-direction: row;	
		    -ms-flex-direction: row;	
		        flex-direction: row;	
		     -webkit-flex-wrap: wrap;	
		         -ms-flex-wrap: wrap;	
		             flex-wrap: wrap;	
		-webkit-justify-content: center;	
		        justify-content: center;	
		  -webkit-align-content: center;
		     -ms-flex-line-pack: center;	
		          -ms-flex-pack: center;
		         -ms-flex-align: start;
		align-content: center;	
		align-items: start;
		background: @xf-xgtForumIstatistikGovdeRenk;
		border-radius: @xf-xgtForumIstatistikGenelRadius;
		
		.block-tabHeader
		{
			border:none;
		}
		
	   .KonuHucre-Genis
		{
			 -webkit-box-flex: 0;
			         -ms-flex: 0 0 100%;
			             flex: 0 0 100%;
			max-width: 100%;
		   
			.istatikKonu-TabHeader
			{
			   border-top-right-radius: @xf-xgtForumIstatistikGenelRadius;
			}
		}
		
		.KonuHucre-Dar
		{
			-webkit-box-flex: 0;
			         -ms-flex: 0 0 80%;
			             flex: 0 0 80%;			
			max-width: 80%;		
			
			@media (max-width: 800px) 
			{
				-ms-flex: 0 0 10%;
				    flex: 0 0 100%;			
				max-width: 100%;
		    }
		}
		//---- Kullanici istatistik - Hucre
		.Kullanici-hucre
		{
			-webkit-box-flex: 0;
			        -ms-flex: 0 0 20%;
			            flex: 0 0 20%;
			max-width: 20%;
			
			@media (max-width: 800px) 
			{
				display:none;
		    }
			
			.xgtIstatistikVerileri
			{
				border-left: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
			}
			
			.KullaniciMiniHeader
			{
				.MiniHeaderHucre
				{
					padding:2px 4px;
				}
				.MiniHeaderHucre.MesajSayisi
				{
					text-align: right;
				}
				
				.MiniHeaderHucre.MesajSayisi
				{
					text-align: right;
				}
			}
			
			.IstatistikHucre.KullaniciAdi
			{
				width: 70%;
			}
			
			.IstatistikHucre.IstatistikCevap
			{
				width: 30%;
			}
		}
	
		//---- İstatistik TAB header
		.istatikKonu-TabHeader
		{
			background-color: @xf-xgtForumIstatistikTabHeader;
			color: @xf-xgtForumIstatistikTabHeaderMetin;
			border-top-left-radius: @xf-xgtForumIstatistikGenelRadius;
			
			@media (max-width: 800px) 
			{
				border-top-right-radius: @xf-xgtForumIstatistikGenelRadius;
		    }

			.tabs-tab
			{		
				padding:10px;
				border-right: solid 1px @xf-xgtForumIstatistikTabHeaderSagBorder;
				font-size: @xf-xgtForumIstatistikTabHeaderBoyut;
				
				&:hover
				{
					background-color: @xf-xgtForumIstatistikTabHeaderAktif;
					color:@xf-xgtForumIstatistikTabHeaderAktifMetin;
				}
				
		    }	
			
			.tabs-tab:nth-last-child(1)
			{
				border-right:none;
			}

			.is-active
			{
				background-color: @xf-xgtForumIstatistikTabHeaderAktif;
				border-bottom:solid 3px @xf-xgtForumIstatistikTabHeaderAktifBorder;
			}
			
			i
			{
				font-size: (@xf-xgtForumIstatistikTabHeaderBoyut)-2;
			}			
			
		}
		//---- Kullanici istatistik TAB header
		.istatikKullanici-TabHeader
		{
			background-color: @xf-xgtForumIstatistikTabHeader;
			color: @xf-xgtForumIstatistikTabHeaderMetin;
			border-top-right-radius: @xf-xgtForumIstatistikGenelRadius;
			//border-bottom:solid 1px @xf-xgtForumIstatistikTabHeader;	
			
			.tabs-tab
			{
				padding: 10px 0px;
				font-size: @xf-xgtForumIstatistikTabHeaderBoyut;
				
				&:hover
				{
					background: none;
					color: inherit;
					cursor: text;
				}
			}
			
			i
			{
				font-size: (@xf-xgtForumIstatistikTabHeaderBoyut)-2;
			}			
			
		}
	}

	//---- Mini header
	.MiniHeader
	{
		display: table;
		table-layout: fixed;
		list-style: none;
		margin: 0;
		padding: 2px 0px;
		width: 100%;
		background-color: @xf-xgtForumIstatistik_MiniHeader;
		color: @xf-xgtForumIstatistik_MiniHeaderMetin;
		font-size: 14px;

		.MiniHeaderHucre
		{
			display: table-cell;
			vertical-align: top;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			padding: 2px 0px;
		}
		.IstatistikAvatar
		{
			width: 30px;
		}
				
		.IstatistikForum
		{
			width: 100px;
		}
				
		.IstatistikCevap
		{
			position: relative;
			width: 80px;
			text-align: center;
		}
				
		.IstatistikGoruntuleme
		{
			position: relative;
			width: 80px;
			text-align: center;
		}
				
		.IstatistikZaman
		{
			width: 80px;
			text-align: center;
		}
				
		.IstatistikSonCevap
		{
			width: 80px;
			text-align: right;
			padding-right: 2px;
		}		
	}
	
	//---- Istatistik veri listesi
	.xgtIstatistikListe
	{
		padding: 0;
		margin: 0;
	
		.xgtIstatistikVerileri
		{
			display: table;
			table-layout: fixed;
			border-collapse: collapse;
			list-style: none;
			margin: 0;
			padding: 0;
			width: 100%;
			
			border-bottom: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
			color: @xf-xgtForumIstatistikBaglantiRenk;
			
			a
			{
				color: @xf-xgtForumIstatistikBaglantiRenk;
				
				&:hover
				{
					color: xf-intensify(@xf-xgtForumIstatistikBaglantiRenk, 10%);
				}
			}
			
			&:nth-child(n)
			{
				background-color: @xf-xgtForumIstatistikSatir1;
			}

			&:nth-child(2n) 
			{
				background-color: @xf-xgtForumIstatistikSatir2;
			}
			
			.GoogleButon
			{
				background-color: #4285f4;
				border-radius: 2px;
				display: inline-block;
				font-size: 11px;
				padding: 0px 2px 0px 2px;
				color: #fff;
			}
			
			.IstatistikHucre
			{
				display: table-cell;
				vertical-align: top;
				overflow: hidden;
				text-overflow: ellipsis;
				white-space: nowrap;
				padding: 3px 4px;
				font-size: @xf-xgtForumIstatistikSatirMetinBoyut;
			}
			
			.KonuBaglantisi.OkunmamisVeri
			{
				font-weight: 700; 
			}
			
			.IstatistikSirasi
			{
				width: 25px;
				position: relative;
				text-align: center;
				color: @xf-xgtForumIstatistikSayisalRenk;

				&:before 
				{
	        		counter-increment: steps;
	        		content: "" counter(steps) "";	
				}	
			}
		
			.IstatistikAvatar
			{
				width: 30px;
				position: relative;
				
				.avatar.avatar--s
				{
					width: 25px;
					height: 25px;
					font-size: 14px;
				}
				
				.Avatar-XS
				{
					position: absolute;
					right: 0;
					bottom: 0;
					width: 16px;
					height: 16px;
					font-size: 12px;
				}
			}
				
			.IstatistikForum
			{
				width: 100px;
				border-left: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
			}
				
			.IstatistikCevap
			{
				width: 80px;
				color: @xf-xgtForumIstatistikSayisalRenk;
				text-align: center;
				border-left: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
				
				';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['icerikvurgu']) {
		$__finalCompiled .= '
					.CevapVurgusu
					{
						background-color: @xf-xgtForumIstatistikVurgula;
						color: @xf-xgtForumIstatistikVurgulaMetin;
						border-radius: 4px;
						width: auto;
						display: inline-block;
						min-width: 40px;
					}
				';
	}
	$__finalCompiled .= '
			}
				
			.IstatistikGoruntuleme
			{
				width: 80px;
				text-align: center;
				border-left: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
				border-right: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
				color: @xf-xgtForumIstatistikSayisalRenk;
				
				';
	if ($__vars['xf']['options']['xgtForumistatikOzellikler']['icerikvurgu']) {
		$__finalCompiled .= '
					.GoruntulemeVurgusu
					{
						background: @xf-xgtForumIstatistikVurgula;
						color: @xf-xgtForumIstatistikVurgulaMetin;
						border-radius: 4px;
						width: auto;
						display: inline-block;
						min-width: 40px;
					}
				
					.TepkiVurgusu
					{
						background: @xf-xgtForumIstatistikVurgula;
						color: @xf-xgtForumIstatistikVurgulaMetin;
						border-radius: 4px;
						width: auto;
						display: inline-block;
						min-width: 40px;
				}
				';
	}
	$__finalCompiled .= '
			}
				
			.IstatistikZaman
			{
				width: 80px;
				border-right: solid 1px @xf-xgtForumIstatistikSatirSinirRengi;
			}
				
			.IstatistikSonCevap
			{
				width: 80px;
				text-align: right;
			}	
			
			//--- Kullanici Istatistik
			.KullaniciAdi
			{
				
			}
			.SayisalVeri
			{
				text-align: right;
				color:@xf-xgtForumIstatistikSayisalRenk;
			}		
		}
	}	
	//---- Istatistik yuklenyior ikon
	.YukleniyorIkon
	{
		font-size: 100px;
		text-align: center;
		color: @xf-xgtForumIstatistikTabHeaderAktifBorder;
		height: 100%;
		width: 100%;
		display: inline-block;
		margin-top:100px;
	}
	//---- Istatistik Footer
	.xgtForumIstatistik-Footer
	{
		width: 100%;
		content: "";
		height: 10px;
		background-color: @xf-xgtForumIstatistikFooter;
		border-bottom-left-radius: @xf-xgtForumIstatistikGenelRadius;
		border-bottom-right-radius: @xf-xgtForumIstatistikGenelRadius;
	}	
}

//--- Mobil sistemler
.xgt-ForumIstatistik-Govde 
{
	@media (max-width: 1000px) 
    {
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikZaman,
		.istatistik-blogu .KonuHucre-Dar .MiniHeader .MiniHeaderHucre.IstatistikZaman,
		.MiniHeader .IstatistikZaman
		{
			display:none;
		}
	}	
	
	@media (max-width: 800px) 
    {
		.MiniHeader.KullaniciMiniHeader,
		.xgtIstatistikListe.KullaniciListe,
		.istatistik-blogu .istatikKullanici-TabHeader
		{
			display:none;
		}
	}	
	
	@media (max-width: 700px) 
    {
		.MiniHeader .IstatistikForum,
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikForum
		{
			display:none;
		}
	}
	
	@media (max-width: 600px) 
    {
		.MiniHeader .IstatistikGoruntuleme,
		.MiniHeader .IstatistikCevap, .MiniHeader .IstatistikSonCevap,
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikCevap,
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikGoruntuleme,
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikSonCevap,
		.xgtIstatistikListe .xgtIstatistikVerileri .IstatistikSirasi
		{
			display:none;
		}
	}	
}
body .xgt-ForumIstatistik-Govde
{
	counter-reset: steps !important;
}';
	return $__finalCompiled;
});