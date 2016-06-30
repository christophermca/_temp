/**
 * We use the initCallback callback
 * to assign functionality to the controls
 */



 
function mycarousel_initCallback(carousel) {
    jQuery('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

    jQuery('.jcarousel-scroll select').bind('change', function() {
        carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
        return false;
    });

    jQuery('#mycarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });
    

    jQuery('#mycarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
};

$(document).ready(function(){
//Insert Jquery below

jQuery('#mycarousel').jcarousel({
      
       scroll:1,
       auto:3,
       wrap:'circular',
       initCallback: mycarousel_initCallback ,
        // This tells jCarousel NOT to autobuild prev/next buttons
         buttonPrevHTML: null ,
        buttonNextHTML: null 
       
        
	});
	
	});



// ************************* pre-cache five actor pictures

Rollimage = new Array()
   
Rollimage[0] = new Image(64,32) 
Rollimage[0].src = "http://www.cancerspokenhere.com/wp-content/themes/csp/images/nav/ribbons.png"
Rollimage[1] = new Image(64,32) 
Rollimage[1].src = "http://www.cancerspokenhere.com/wp-content/themes/csp/images/nav/ribbons_hover.png"
Rollimage[3] = new Image(64,32) 
Rollimage[3].src = "http://www.cancerspokenhere.com/wp-content/themes/csp/images/nav/ribbons_sel.png"

 function SwapOut(){
    document.navhome.src = Rollimage[1].src;
    return true;
  }

  function SwapBack(){
    document.navhome.src = Rollimage[0].src; 
    return true;
  }
  
   function SwapOut_about(){
    document.navabout.src = Rollimage[1].src;
    return true;
  }

  function SwapBack_about(){
    document.navabout.src = Rollimage[0].src; 
    return true;
  }
   function SwapOut_book(){
    document.navbook.src = Rollimage[1].src;
    return true;
  }

  function SwapBack_book(){
    document.navbook.src = Rollimage[0].src; 
    return true;
  }
  function SwapOut_prod(){
    document.navproducts.src = Rollimage[1].src;
    return true;
  }

  function SwapBack_prod(){
    document.navproducts.src = Rollimage[0].src; 
    return true;
  }
  function SwapOut_res(){
    document.navres.src = Rollimage[1].src;
    return true;
  }

  function SwapBack_res(){
    document.navres.src = Rollimage[0].src; 
    return true;
  }
  
  function SwapOut_blog(){
    document.navblog.src = Rollimage[1].src;
    return true;
  }

  function SwapBack_blog(){
    document.navblog.src = Rollimage[0].src; 
    return true;
  }