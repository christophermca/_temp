jQuery(document).ready(function($) {
    $.each($("span.md5hash"), function () {
      var elem = $(this);
      $.ajax({ type: "GET",
          dataType: "jsonp",
          url: "http://feeds.delicious.com/v2/json/urlinfo/"+$(this).html(),
          success: function(data){
                 if (data.length > 0) {
                 elem.next().prepend(data[0].total_posts + " ");
                 }
             }
        });
    });
});


function popitup(url) {
	newwindow=window.open(url,'name','height=400,width=650');
	if (window.focus) {newwindow.focus()}
	return false;
}
