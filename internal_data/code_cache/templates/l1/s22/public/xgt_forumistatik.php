<?php
// FROM HASH: 49c87045b21629fc726bdd5162fd6158
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canIstatistikleriGor', array())) {
		$__finalCompiled .= '
	<div class="xgt-ForumIstatistik-Govde">
		<div class="block istatistik-blogu">		
			<div class="' . (($__templater->method($__vars['xf']['visitor'], 'canKullaniciIstatistikGor', array()) == $__vars['xf']['options']['xgtForumistatikKullaniciVerileri']) ? 'KonuHucre-Dar' : '') . (((!$__templater->method($__vars['xf']['visitor'], 'canKullaniciIstatistikGor', array())) OR (!$__vars['xf']['options']['xgtForumistatikKullaniciVerileri'])) ? 'KonuHucre-Genis' : '') . '">
				';
		if ($__vars['forumIstatistikleri']['pozisyonlar']['anaveri']) {
			$__finalCompiled .= '
					';
			$__vars['baslangic'] = $__vars['forumIstatistikleri']['baslangic']['anaveri'];
			$__finalCompiled .= '     
					';
			$__vars['counter'] = '1';
			$__finalCompiled .= '
					
					';
			$__vars['counter'] = '1';
			$__finalCompiled .= '
					<ul class="tabPanes">
						';
			if ($__templater->isTraversable($__vars['forumIstatistikleri']['pozisyonlar']['anaveri'])) {
				foreach ($__vars['forumIstatistikleri']['pozisyonlar']['anaveri'] AS $__vars['veri_id'] => $__vars['forumIstatistik']) {
					$__finalCompiled .= '
							';
					if ($__vars['counter'] == 1) {
						$__finalCompiled .= '
								<li class="is-active" role="tabpanel" id="istatistikveri-' . $__templater->escape($__vars['veri_id']) . '" data-href-initial="' . $__templater->func('link', array('forum-istatistik/sonuclar', $__vars['forumIstatistik'], ), true) . '">
									';
						$__compilerTemp1 = $__vars;
						$__compilerTemp1['forumIstatistik'] = $__vars['baslangic'];
						$__finalCompiled .= $__templater->includeTemplate('xgt_forumistatik_sonuclar', $__compilerTemp1) . '
								</li>
							';
					} else {
						$__finalCompiled .= '
								<li class="" role="tabpanel" id="istatistikveri-' . $__templater->escape($__vars['veri_id']) . '" data-href="' . $__templater->func('link', array('forum-istatistik/sonuclar', $__vars['forumIstatistik'], ), true) . '" data-href-initial="' . $__templater->func('link', array('forum-istatistik/sonuclar', $__vars['forumIstatistik'], ), true) . '">
									<div class="YukleniyorIkon">
										<i class="fas fa-spinner fa-pulse"></i>
									</div>
								</li>
							';
					}
					$__finalCompiled .= '
							';
					$__vars['counter'] = ($__vars['counter'] + 1);
					$__finalCompiled .= '
						';
				}
			}
			$__finalCompiled .= '
					</ul>
				';
		}
		$__finalCompiled .= '
			</div>
			';
		if ($__templater->method($__vars['xf']['visitor'], 'canKullaniciIstatistikGor', array()) AND $__vars['xf']['options']['xgtForumistatikKullaniciVerileri']) {
			$__finalCompiled .= '
				<div class="Kullanici-hucre">
					<h2 class="block-tabHeader tabs hScroller istatikKullanici-TabHeader">
						<div class="tabs-tab">
							<span class="hScroller-scroll"> 
								';
			if ($__vars['xf']['options']['xgtForumistatikOzellikler']['sekmeikon']) {
				$__finalCompiled .= '
									<i class="fad fa-user-friends"></i>
								';
			}
			$__finalCompiled .= '
								' . 'En çok mesaj' . '
							</span>
						</div>
					</h2>
					<ul class="tabPanes">
						<div class="MiniHeader KullaniciMiniHeader">
							<div class="MiniHeaderHucre">
								' . 'Kullanıcı' . '
							</div>
							<div class="MiniHeaderHucre MesajSayisi">
								' . 'Mesajı' . '
							</div>
						</div>
						' . $__templater->renderWidget('xgtForumIstatistik_encok_mesaj_kullanici', array(), array()) . '
					</ul>
				</div>
			';
		}
		$__finalCompiled .= '
			
		</div>	
	</div>
	';
		if ($__vars['xf']['options']['xgtIstatistikOtoyenileme']['otoyenileme']) {
			$__finalCompiled .= '
		' . $__templater->callMacro('xgt_forumistatik.js', 'otoyenile', array(
				'kullanici' => $__vars['kullanici'],
			), $__vars) . '
	';
		}
		$__finalCompiled .= '
	';
		$__templater->includeCss('xgt_forumistatik.less');
		$__finalCompiled .= '
';
	}
	return $__finalCompiled;
});