/////		ALL		/////

/* Tooltip */

$('.block--category .block-header').each(function () {

	var hc = $(this).children('a').width();
	var position = $(this).children('a').position();
	var pLeft = position.left;
	var pRight = $(this).outerWidth() - (pLeft + hc);

	if ( $("html").attr("dir") === 'RTL' )
	{
		$(this).children('.block-tooltip').css({'right': pRight + hc + 10});
	} else if ( $("html").attr("dir") === 'LTR' )
	{
		$(this).children('.block-tooltip').css({'left': pLeft + hc + 10});
	}

	$(".block-header > a").hover(function() {
		$(this).siblings('.block-tooltip').fadeIn('250');
	}, function() {
		$(this).siblings('.block-tooltip').fadeOut('250');
	});
});

/* Tooltip -- End */

/*Sub-node*/

$('.node-subNodeMenu').each(function() {
	$(this).appendTo($(this).siblings('.node-statsMeta'));
});

/*Sub-node -- End */

/* Block collapse */

$('.block--category .block-header').append('<div class="block-control block-control--collapse"><i></i></div>');

$('.block-minorHeader').append('<div class="block-control block-control--collapse"><i></i></div>');

$('.block-minorHeader').prepend('<div class="block-icon"><i></i></div>');

$('.bbWrapper > .bbCodeBlock > .bbCodeBlock-title').append('<div class="block-control block-control--collapse"><i></i></div>');

$('.message-attachments > .block-textHeader').append('<div class="block-control block-control--collapse"><i></i></div>');

$('.block-control--collapse').click(function(e) {
	e.preventDefault();
	var notthis = $('.active').not(this);
 	$(this).parent().toggleClass('active').nextUntil('.block-minorHeader').slideToggle('fast');
});

/* Block collapse -- End */

/* Sidebar-control */

var count = 0;
var wBodyMain = $('.p-body-main').width();
var wPage = $('.p-body-pageContent').width();
var wSideBar = $('.p-body-sidebar').width();

if ( $('body[data-template="forum_list"]').has('ul.p-breadcrumbs').length ) {
	$('ul.p-breadcrumbs').prepend('<span class="block-control block-control--sideBar"><i></i></span>');
}

if ( $(window).width() > 900 ) {
	$('.block-control--sideBar').click(function(e) {
		count++;
		var isEven = function(someNumber) {
			return (someNumber % 2 === 0) ? true : false;
		};
		
		if (isEven(count) === false) {
			$(".p-body-content").animate({paddingRight: 0, width: wBodyMain}, 500);
			$(".p-body-sidebar").animate({opacity: 0}, 500);
			setTimeout(function() {
				$(".p-body-sidebar").css('display', 'none');
			}, 500);
		}

		else if (isEven(count) === true) {
			setTimeout(function() {
				$(".p-body-sidebar").css('display', 'table-cell');
			}, 0);
			$('.p-body-sidebar').animate({opacity: 1}, 500);
			$('.p-body-content').animate({paddingRight: wBodyMain - wPage - wSideBar , width: wBodyMain - wSideBar}, 500);
			setTimeout(function() {
				$('.p-body-content, .p-body-sidebar').removeAttr('style');
			}, 600);
		}
	});
}

/* Sidebar-control -- End */

/* Footer */

$('.p-footer').append('<div class="p-footer-bottom"><div class="p-footer-inner"></div></div>');
$('.p-footer-debug').appendTo($('.p-footer-bottom > .p-footer-inner'));


$('.p-footer').each(function() {
	if ( $('.p-footer').has('.p-footer-top').length && !$('.p-footer').has('.p-footer-middle').length ) {
		$(this).children('.p-footer-top').children('.p-footer-inner').append('<div class="BRCopyright"><div class="content-brcpright"><a href="http://brivium.com/xenforo-add-ons" class="item-brcp" title="Brivium XenForo Add-ons">XenForo Add-ons</a><span>&nbsp;&amp;&nbsp;</span><a href="http://brivium.com/xenforo-styles" class="item-brcp" title="Brivium XenForo Styles">XenForo Styles</a><span> ™  © 2012-2018 Brivium LLC.</span></div></div>');
	} else if ( $('.p-footer').has('.p-footer-top').length && $('.p-footer').has('.p-footer-middle').length ) {
		$(this).children('.p-footer-middle').children('.p-footer-inner').append('<div class="BRCopyright"><div class="content-brcpright"><a href="http://brivium.com/xenforo-add-ons" class="item-brcp" title="Brivium XenForo Add-ons">XenForo Add-ons</a><span>&nbsp;&amp;&nbsp;</span><a href="http://brivium.com/xenforo-styles" class="item-brcp" title="Brivium XenForo Styles">XenForo Styles</a><span> ™  © 2012-2018 Brivium LLC.</span></div></div>');
	} else {
		$(this).children('.p-footer-inner').append('<div class="BRCopyright"><div class="content-brcpright"><a href="http://brivium.com/xenforo-add-ons" class="item-brcp" title="Brivium XenForo Add-ons">XenForo Add-ons</a><span>&nbsp;&amp;&nbsp;</span><a href="http://brivium.com/xenforo-styles" class="item-brcp" title="Brivium XenForo Styles">XenForo Styles</a><span> ™  © 2012-2018 Brivium LLC.</span></div></div>');
	}
});

$('.BRCopyright').css({'float': 'left', 'marginTop': 2, 'marginBottom': 2});

/* Footer -- End */

/* Bonus */

$('.button').closest('dl.formRow:not(.formSubmitRow, .formSubmitRow--sticky)').children('dd').addClass('formButtonGroup');

$('.message-attribution').each(function(){
	$(this).insertAfter($(this).siblings('.message-content'));
});
$('.message-attribution-main').each(function(){
	$(this).prependTo($(this).parent('').siblings('.message-footer').children('.message-actionBar').children('.actionBar-set--internal'));
});
$('.message-attribution-opposite').each(function(){
	$(this).appendTo($(this).parent('').siblings('.message-footer').children('.message-actionBar').children('.actionBar-set--external'));
});

$('.block-outer--after').each(function() {
	if ( ($(this).children().length == 1) && ($(this).children('.block-outer-opposite').children().length == 1) && ($(this).children('.block-outer-opposite').children('.showIgnoredLink').hasClass('is-hidden')) )
	{
		$(this).hide();
	}
});

$('.showIgnoredLink').click(function() {
	if ( ($(this).closest('.block-outer--after').children().length == 1) )
	{
		$(this).closest('.block-outer--after').hide();
	}
});

/////		Tin		/////

if ( $(window).width() > 650 ) {
	$('.message:not(.message--deleted) .message-userBanner').each(function() {
		$(this).appendTo($(this).closest('.message-cell--user'));
	});
}