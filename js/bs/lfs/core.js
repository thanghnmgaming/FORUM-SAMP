jQuery.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ? 
                        matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels,'')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
    return regex.test(jQuery(elem)[attr.method](attr.property));
}

!function($, window, document) 
{
	"use strict";
	
	XF.LFS = XF.Element.newHandler({
		options: {
			updateInterval: 15,
			updateLink: '/index.php?lfs/tab',
			differentTimeout: 600,
			pollUnfocused: false,
			widgetKey: '',
			widgetId: 0
		},
		
		groups: [],
		prevTypeWindow: '',
		isActiveWindow: true,
		
		init: function() {
			var _this = this;

			this.groups = [];

			this.$target.find('.tabGroup').each(function() {
				_this.groups.push(new XF.LFSGroup(_this, $(this)));
			});

			this.$target.find('.js-refreshButton').click(XF.proxy(this, 'update'));
			
			if (this.options.updateInterval !== 0) {
                this.updateInterval = setInterval(XF.proxy(this, 'update'), this.options.updateInterval * 1000);
            }

			this.$sound = this.$target.find('.js-sound');

			$(document).on('lfs:refresh', XF.proxy(this, 'update'));
		},
		
		update: function() {
			if (! (document.hasFocus() || this.options.pollUnfocused)) {
				return;
			}
			
			$.each(this.groups, function(i, group) {
				if (!group.updateLock) {
					group.updateLock = true;
					group.tabs.selectedTab.loadData(function() {
						group.updateLock = false;
					});
				}
			});
		},

		playSoundIfHas: function () {
			if (XF.Cookie.get('lfs_mute_' + this.options.widgetId) === 'true'){
				return;
			}

			if (this.$sound.length) {
				this.$sound[0].play();
			}
		}
	});
	
	XF.LFSGroup = XF.create({
		options: {
			groupId: '',
			carouselInterval: 0
		},
		
		lfs: null,
		tabs: null,
		$target: null,
		
		ajaxData: {},
		
		updateLock: false,
		
		__construct: function(lfs, $target, options) {
			this.options = XF.applyDataOptions(this.options, $target.data(), options);
			this.lfs = lfs;
			this.$target = $target;
			this.$content = $target.find('.tabGroup-content');

			if (this.options.carouselInterval) {
				setInterval(XF.proxy(this, 'switchToNextTab'), this.options.carouselInterval * 1000);
			}
			
			this.tabs = new XF.LFSTabs(lfs, this, $target.find('ul.tabs'));
			
			$(document).on('lfs_ajax_extend-' + this.options.groupId, XF.proxy(this, 'extendAjaxData'));
			
			if (XF.Cookie.get('lfs_ajax_' + this.options.groupId)) {
				this.ajaxData = XF.Cookie.get('lfs_ajax_' + this.options.groupId);
			}
		},
		
		loading: function() {
			this.replaceContent(this.getLoadingSpinner());
		},

		switchToNextTab: function() {
			this.tabs.next().select();
		},

		clearDifferentTimeout: null,
		
		replaceContent: function($html, callback, selectChange) {
			if ($html.html().replace(' ', '').length > 0) {
				this.$content.find('*:regex(data-xf-init, [a-zA-z]*tooltip)').trigger('tooltip:hide');

				if (! selectChange) {
					if (this.markDifferentItems($html)) {
						this.lfs.playSoundIfHas();
					}
				}

				this.$content = this.$content.html($html);
				XF.activate(this.$content);

				if (this.clearDifferentTimeout) {
					clearTimeout(this.clearDifferentTimeout);
				}

				this.clearDifferentTimeout = setTimeout(XF.proxy(this, 'clearDifferentItems'), this.lfs.options.differentTimeout);
				
				if (typeof callback == 'function') {
					callback.call(null, true);
				}
				
				return;
			}
			
			if (typeof callback == 'function') {
				callback.call(null, false);
			}
		},

		markDifferentItems: function($html) {
			let $oldItems = this.$content.find('.structItem--lfsItem'),
				$newItems = $html.find('.structItem--lfsItem');

			$newItems.each(function () {
				let $item = $(this),
					$oldItem = $oldItems.filter('#' + $item.attr('id'));

				if (! ($oldItem && $oldItem.data('date') === $item.data('date'))) {
					$item.addClass('structItem--different');
				}
			});

			return $newItems.filter('.structItem--different').length > 0;
		},

		clearDifferentItems: function() {
			this.$content.find('.structItem--different').removeClass('structItem--different');
		},
		
		getLoadingSpinner: function() {
			return $('<div class="loader-block"><div class="loader"><div></div><div></div></div></div>');
		},
		
		extendAjaxData: function(e, data) {
			let _this = this;

			this.ajaxData = $.extend(true, this.ajaxData, data);
			XF.Cookie.set('lfs_ajax_' + this.options.groupId, JSON.stringify(data));
			this.updateLock = true;
			this.tabs.selectedTab.loadData(function() {
				_this.updateLock = false;
			});
		}
	});
	
	XF.LFSTabs = XF.create({
		options: {
			isMenu: false
		},
		
		lfs: null,
		group: null,
		$target: null,
		tabList: [],
		selectedTab: null,
		$menuTab: null,
		$settingButton: null,
		
		__construct: function(lfs, group, $target, options) {
			if (typeof options === 'undefined') {
				options = {};
			}
			
			this.options = XF.applyDataOptions(this.options, $target.data(), options);
			
			this.tabList = [];

			var _this = this;
			this.lfs = lfs;
			this.group = group;
			this.$target = $target;
			
			$target.find('.tab:not(.menu-open)').each(function() {
				_this.tabList.push(new XF.LFSTab(_this.lfs, _this, $(this)));
			});
			
			if (this.options.isMenu) {	
				this.$menuTab = $target.find('.tab.menu-open');
			}

			this.$settingButton = this.$target.closest('.tabs-container').find('.js-settingButton');

			if (!this.selectedTab) {
				this.first().select();
			}
		},

		selectTab: function(tab) {
			this.selectedTab = tab;

			if (this.$settingButton && this.$settingButton.length) {
				this.$settingButton.toggleClass('is-active', tab.options.canSetting).data('href', tab.options.settingHref);
				XF.Click.getElementHandler(this.$settingButton, 'overlay').loadUrl = tab.options.settingHref;
			}
		},

		remove: function(tab) {
			let index = this.indexOf(tab);
			if (index !== -1) {
				this.tabList[index].$target.remove(400);
				this.tabList.splice(index, 1);
				this.first().select();
			}
		},
		
		first: function() {
			return this.tabList[0];
		},

		next: function () {
			let nextIndex = this.indexOf(this.selectedTab) + 1;

			if (typeof this.tabList[nextIndex] !== 'undefined') {
				return this.tabList[nextIndex];
			}

			return this.first();
		},

		indexOf: function (tab) {
			return this.tabList.indexOf(tab);
		}
	});
	
	XF.LFSTab = XF.create({
		options: {
			tabId: '',
			canSetting: false,
			settingHref: ''
		},
		
		lfs: null,
		tabs: null,
		$target: null,
		selected: false,
		cache: {},
		
		__construct: function(lfs, tabs, $target, options) {
			if (typeof options === 'undefined') {
				options = {};
			}
			
			this.options = XF.applyDataOptions(this.options, $target.data(), options);
			
			this.lfs = lfs;
			this.tabs = tabs;
			this.$target = $target.click(XF.proxy(this, 'select'));
			
			if ($target.is('.is-selected')) {
				this.selected = true;
				this.tabs.selectTab(this);
				this.cache = {
					'content': $(this.tabs.group.$content.html())
				};
			}
		},
		
		loadData: function(callback, selectChange) {
			var _this = this,
				sendData = $.extend(true, this.tabs.group.ajaxData, {
					tab_id: this.options.tabId
				}),
				tabCache = this.cache;

			XF.ajax('GET', 
				this.lfs.options.updateLink,
				sendData,
				function(data) {
					if (data.html && data.html.content) {	
						XF.setupHtmlInsert(data.html, function($html) {
							if (!$.isEmptyObject(tabCache)) {
								tabCache.content = $html;
							}
							else {
								_this.cache = {
									'content': $html
								};
							}
							
							_this.tabs.group.replaceContent($html, function(success) {
								if (!success) {
									_this.tabs.remove(this);
								}
							}, selectChange);
						});
					}
					
					if (typeof callback === 'function') {
						callback.call(null);
					}
				},
				{
					global: false
				}
			);
		},
		
		select: function() {
			if (this.tabs.group.updateLock) {
				return this;
			}
			
			var _this = this,
				selectedTab = this.tabs.selectedTab;

			if (selectedTab) {
				if (selectedTab === this) {
					return this;
				}

				selectedTab.deselect();
			}
			
			this.tabs.group.updateLock = true;
			
			var callback = function() {
				_this.tabs.group.updateLock = false;
			};
			
			if (this.tabs.options.isMenu) {
				this.tabs.$menuTab.find('.title').text(_this.$target.find('.title').text());
			}
			
			this.$target.addClass('is-selected');
			this.selected = true;
			this.tabs.selectTab(this);
			XF.Cookie.set('lfs_group_' + this.tabs.group.options.groupId + '_selected_tab', this.options.tabId);
			
			if ($.isEmptyObject(this.cache)) {
				this.tabs.group.loading();
			}
			else {
				this.tabs.group.replaceContent(this.cache.content, null, true);
			}

			this.loadData(callback, true);
			
			return this;
		},
				
		deselect: function() {
			this.$target.removeClass('is-selected');
		},
		
		isSelected: function() {
			return this.selected;
		}
	});

	XF.LFSSubmitRefresh = XF.Element.newHandler({
		init: function() {
			this.$target.on('submit', function () {
				setTimeout(function () {
					$(document).trigger('lfs:refresh');
				}, 150);
			})
		}
	});
	
	XF.LFSAjaxDataReplacerClick = XF.Click.newHandler({
		eventNameSpace: 'XFLFSAjaxDataReplacerClick',

		options: {
			name: '',
			val: '',
			groupId: ''
		},
		
		init: function() {},
		
		click: function() {
			if (this.options.groupId && this.options.name && this.options.val) {
				var data = {};
				data[this.options.name] = this.options.val;
				
				$(document).trigger('lfs_ajax_extend-' + this.options.groupId, [data]);
			}
		}
	});

	XF.LFSMuteClick = XF.Click.newHandler({
		eventNameSpace: 'XFLFSMuteClick',

		options: {
			widgetId: 0
		},

		init: function() {},

		click: function() {
			this.$target.toggleClass('is-muted');
			XF.Cookie.set('lfs_mute_' + this.options.widgetId, this.$target.hasClass('is-muted'));
		}
	});
	
	XF.Element.register('lfs', 'XF.LFS');
	XF.Element.register('lfs-submit-refresh', 'XF.LFSSubmitRefresh');
	
	XF.Click.register('lfs-ajax-data-replacer', 'XF.LFSAjaxDataReplacerClick');
	XF.Click.register('lfs-mute', 'XF.LFSMuteClick');
}
(window.jQuery, window, document);