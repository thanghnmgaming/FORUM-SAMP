<?php
// FROM HASH: 2685feb9e29b2531243752858c77f7a5
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__finalCompiled .= '<ul class="xgtIstatistikListe KullaniciListe">
	';
	if ($__templater->isTraversable($__vars['results'])) {
		foreach ($__vars['results'] AS $__vars['userId'] => $__vars['data']) {
			$__finalCompiled .= '
		<li class="xgtIstatistikVerileri">					
			<div class="IstatistikHucre IstatistikAvatar ">
				' . $__templater->func('avatar', array($__vars['data']['user'], 's', false, array(
			))) . '
			</div>
			<div class="IstatistikHucre KullaniciAdi">
				' . $__templater->func('username_link', array($__vars['data']['user'], true, array(
			))) . '
			</div>
			';
			if ($__vars['data']['value']) {
				$__finalCompiled .= '
				<div class="IstatistikHucre IstatistikCevap SayisalVeri">
					' . $__templater->escape($__vars['data']['value']) . '
				</div>
			';
			}
			$__finalCompiled .= '
		</li>  
	';
		}
	}
	$__finalCompiled .= '
</ul>';
	return $__finalCompiled;
});