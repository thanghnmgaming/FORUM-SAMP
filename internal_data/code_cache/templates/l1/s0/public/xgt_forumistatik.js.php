<?php
// FROM HASH: c9a2768769f435ecdf4185f2f724ad10
return array('macros' => array('sadecekullanici' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'kullanici' => '!',
	), $__arguments, $__vars);
	$__finalCompiled .= '	
		';
	$__templater->inlineJs('
			!function($, window, document){
				"use strict";
				XF.ForumIstatistikEkle = XF.extend(XF.Inserter, {
					__backup: {
							\'onLoad\': \'_onLoad\'
					},
					onLoad: function(data){
						this._onLoad(data);
						if (!data.html){
							return;
							}
					},
				});
				XF.ForumIstatistikTikla = XF.Event.newHandler({
					eventNameSpace: \'ForumIstatistikTikla\',
					options: $.extend(true, {}, XF._baseInserterOptions),
					inserter: null,
					init: function(){
						this.inserter = new XF.ForumIstatistikEkle(this.$target, this.options);
					},
					click: function(e){
						this.inserter.onEvent(e);
					}
				});
    
				var refreshDelay = ' . $__vars['xf']['options']['xgtIstatistikOtoyenileme']['otoyenilemezamani'] . ';
				var autoRefreshInterval;

				$(function() {
					checkAutoRefresh(); 
				});

				var checkAutoRefresh = function(){
					resetAutoRefreshTimer();
				}
				var clearAutoRefreshTimer = function(){
					if (autoRefreshInterval){
						clearInterval(autoRefreshInterval);
					}
				}

				var resetAutoRefreshTimer = function(){
					clearAutoRefreshTimer();
					autoRefreshInterval = setInterval(refresh, refreshDelay * 1000);
				}
				
				var refresh = function(){
					var $tabs = $(\'.istatistik-blogu .tabs\').first();
					var handler = XF.Element.getHandler($tabs, \'tabs\');
					var aktifPanelIndex, $aktifPanel;
					$.each(handler.$panes, function(index, el) {        			 
						var $el = $(el);         			 
						if ($el.hasClass(\'is-active\')) {						 
							aktifPanelIndex = index;            			 
							$aktifPanel = $el;            			  
							return;          			  
						}
					});

					$aktifPanel.data(\'href\', $aktifPanel.data(\'href-initial\'));
					handler.activateTab(aktifPanelIndex);
				};
				XF.Click.register(\'forum-istatistik\', \'XF.ForumIstatistikTikla\');
			}
			(jQuery, window, document);
		');
	$__finalCompiled .= '
	';
	return $__finalCompiled;
},
'otoyenile' => function($__templater, array $__arguments, array $__vars)
{
	$__vars = $__templater->setupBaseParamsForMacro($__vars, false);
	$__finalCompiled = '';
	$__vars = $__templater->mergeMacroArguments(array(
		'kullanici' => $__vars['kullanici'],
	), $__arguments, $__vars);
	$__finalCompiled .= '	
	';
	if (!$__vars['xf']['options']['xgtIstatistikOtoyenileme']['ziyaretciler']) {
		$__finalCompiled .= '	
		';
		if ($__vars['xf']['visitor']['user_id']) {
			$__finalCompiled .= '
			' . $__templater->callMacro(null, 'sadecekullanici', array(
				'kullanici' => $__vars['kullanici'],
			), $__vars) . '
		';
		}
		$__finalCompiled .= '		
	';
	} else if ($__vars['xf']['options']['xgtIstatistikOtoyenileme']['ziyaretciler']) {
		$__finalCompiled .= '	
		' . $__templater->callMacro(null, 'sadecekullanici', array(
			'kullanici' => $__vars['kullanici'],
		), $__vars) . '
	';
	}
	$__finalCompiled .= ' 	
	' . '	
';
	return $__finalCompiled;
},), 'code' => function($__templater, array $__vars)
{
	$__finalCompiled = '';

	return $__finalCompiled;
});