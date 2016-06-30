jQuery(document).ready(function() {
	appendClasses();
});

function appendClasses() {
	//level 0
	jQuery('div.widget_pages ul').addClass('accordion-menu');
	var widgetTitle0 = jQuery('div.widget_pages').attr('id');
	jQuery('div.widget_pages ul').attr('id', 'accordion-menu-' + widgetTitle0 + '-level0');
	//initialize
	initMenus();
}

function initMenus() {
	jQuery('ul.accordion-menu ul').hide();
	jQuery(".current_page_item ul:first").slideDown('normal');

	jQuery('ul.accordion-menu li a').click(function() {
		var checkElement = jQuery(this).next();
		var parent = this.parentNode.parentNode.id;
		if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
			if(jQuery('#' + parent).hasClass('collapsible')) {
				jQuery('#' + parent + ' ul:visible').slideUp('normal');
			}
			return false;
		}
		if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
			jQuery('#' + parent + ' ul:visible').slideUp('normal');
			checkElement.slideDown('normal');
			return false;
		}
	});
}