

    // (function($){
    //     $(document).ready(function(){
    //                 $(window).scroll(function(){
    //                     if ($(this).scrollTop() > 100) {
    //                        $('#block-mainnavigation').addClass('header-scrolled');
    //                     } else {
    //                        $('#block-mainnavigation').removeClass('header-scrolled');
    //                     }
    //                 });
    //     });
    // }(jQuery));


    // var classadddd = document.getElementById("#block-mainnavigation");
    // classadddd.classList.add("wow");



//running 



   (function($){
$(document).ready(function(){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 100) {
          $("#block-mainnavigation").css("background" , "rgba(29,200,205,0.9)");
        }
  
        else{
            $("#block-mainnavigation").css("background" , "");  	
        }
    })
  })
}(jQuery));

