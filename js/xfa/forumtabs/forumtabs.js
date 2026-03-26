!function($, window, document, _undefined)
{
    "use strict";

    XF.XFAForumTabs = XF.extend(XF.Tabs, {
        __backup: {
            'reactToHash': '_reactToHash',
            'activateTab': '_activateTab'
        },

        reactToHash: function()
        {
            var selector = this.getSelectorFromHash();

            if (selector)
            {
                this.activateTarget(selector);
            }
            else if (XF.Cookie.get('xfaForumTabsSelectedTabId') != 'undefined')
            {
                this.activateTarget('#' + XF.Cookie.get('xfaForumTabsSelectedTabId'));
            }
            else
            {
                this._reactToHash();
            }

            /* Fix to ensure compatibility with [TH] Nodes */
            window.dispatchEvent(new Event('resize'));
        },

        activateTab: function(offset) {
            var $tab = this.$tabs.eq(offset),
                $pane = this.$panes.eq(offset);

            if (!$tab.length || !$pane.length)
            {
                console.error('Selected invalid tab ' + offset);
                return;
            }

            XF.Cookie.set('xfaForumTabsSelectedTabId', $tab[0].id);

            this._activateTab(offset);
        }
    });

    XF.Element.register('xfa-forum-tabs', 'XF.XFAForumTabs');
}
(jQuery, window, document);