jQuery(function() {

	jQuery("#menu-header ul.menu ul").css({ display: 'none' });
	jQuery("#menu-header ul.menu li").click(function() {
		jQuery(this).find('ul.sub-menu')
			.stop(true, true).delay(50).animate({ "height": "show", "opacity": "show" }, 200 );
	}, function(){
		jQuery(this).find('ul.sub-menu')
			.stop(true, true).delay(50).animate({ "height": "hide", "opacity": "hide" }, 200 );
	});

});

