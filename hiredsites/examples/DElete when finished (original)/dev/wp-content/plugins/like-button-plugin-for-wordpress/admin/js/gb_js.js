// ####################################################### \\

// @Author: Stefan Natter
// Version 1.1
// http://www.gb-world.net
// for the WP-Plugin: Like-Button-Plugin-For-Wordpress by Stefan Natter
// ####################################################### \\
<!-- ======================== SCRIPT ======================== -->
function submitenter(myfield,e){var keycode;if(window.event)keycode=window.event.keyCode;else if(e)keycode=e.which;else return true;if(keycode==13){myfield.form.submit();return false}else return true}function post_focus(){var elem1=document.getElementById("xfbml_mod1");var elem2=document.getElementById("xfbml_mod2");if(document.settingpage.gxtb_fb_lB_jdk.checked==true){elem1.style.display="table-cell";elem2.style.display="table-cell";}else{elem1.style.display="none";elem2.style.display="none";}appID();}
