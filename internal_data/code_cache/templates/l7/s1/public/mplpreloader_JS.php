<?php
// FROM HASH: fe86dcd7f3634f5d139349f17df994f0
return array('macros' => array(), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';
	$__templater->inlineJs('
	$(document).ready(function() {
  
  setTimeout(function() {
    $(\'#ctn-preloader\').addClass(\'loaded\');
    // Una vez haya terminado el preloader aparezca el scroll
    $(\'body\').removeClass(\'no-scroll-y\');

    if ($(\'#ctn-preloader\').hasClass(\'loaded\')) {
      // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
      $(\'#preloader\').delay(' . $__vars['xf']['options']['loadingload'] . ').queue(function() {
        $(this).remove();
      });
    }
  }, ' . $__vars['xf']['options']['loadingdelay'] . ');
  
});');
	return $__finalCompiled;
});