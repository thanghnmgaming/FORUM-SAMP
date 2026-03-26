<?php
// FROM HASH: daff929bbf4b9533cd0824f702ece4cb
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->includeCss('mplpreloader.less');
	$__finalCompiled .= '
' . $__templater->includeTemplate('mplpreloader_JS', $__vars) . '
	
	<!-- Preloader -->
	<section>
		
	
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="animation-preloader">
					<div id="loader-logo" class="spinner"></div>
					<div class="txt-loading">
						<span data-text-preloader="' . $__templater->escape($__vars['xf']['options']['loadingtext']) . '" class="letters-loading">
							' . $__templater->escape($__vars['xf']['options']['loadingtext']) . '
						</span>
						<span data-text-preloader="' . $__templater->escape($__vars['xf']['options']['loadingtextone']) . '" class="letters-loading">
						 ' . $__templater->escape($__vars['xf']['options']['loadingtextone']) . '
						</span>	
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
	</section>';
	return $__finalCompiled;
});