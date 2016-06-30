jQuery(document).ready(function() {
	jQuery('.single_content').hide();
	jQuery('.navi li:first').addClass('active');
	jQuery('.single_content:first').show();
	jQuery('.navi li').click(function() {
		jQuery('.navi li').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.single_content').hide();
		var activeTab = jQuery(this).find('a').attr('title');
		jQuery(activeTab).fadeIn(500);
	});
	var imagealt = jQuery("img").attr("alt");
	jQuery("#vertical-count").click(function() {
		jQuery('[name="tb_button" ][value="vertical"]').attr('checked', true); 
	});
	jQuery("#horizontal-count").click(function() {
		jQuery('[name="tb_button" ][value="horizontal"]').attr('checked', true); 
	});
	jQuery("#no-count").click(function() {
		jQuery('[name="tb_button" ][value="none"]').attr('checked', true); 
	});
	jQuery('[name="tb_tweet_text_custom"]').click(function() {
		jQuery('[name="tb_tweet_text" ][value="4"]').attr('checked', true); 
	});
	jQuery('[name="tb_url_custom"]').click(function() {
		jQuery('[name="tb_url" ][value="2"]').attr('checked', true); 
	});
});