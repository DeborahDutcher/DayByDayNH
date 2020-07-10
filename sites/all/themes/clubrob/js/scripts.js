(function ($) {
    // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
    $('.dropdown').on('show.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
    });

    // ADD SLIDEUP ANIMATION TO DROPDOWN //
    $('.dropdown').on('hide.bs.dropdown', function(e){
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
    });

    //ADD TOGGLE TO SEARCH BOX AT SMALLER SCREEN SIZES
    $( ".btn-toggle" ).click(function() {
        $( "#block-search-form " ).slideToggle(200);
    });

    //SCROLL BUTTON TO FOOTER
    $('#footer-button').click(function() {
        $('html, body').animate({
            scrollTop: $('#footer').offset().top
        }, 1000);
    });


// PDK 2019-12-12:  disabling the following.  See:  https://criterion.library.ohio.gov/issues/3394
//    var x = document.createElement("script"); 
//    x.type = "text/javascript"; 
//    x.async = true;
//    x.src = (document.location.protocol === "https:" ? "https://" : "http://") + "us.libraryh3lp.com/js/libraryh3lp.js?7604";
//    var y = document.getElementsByTagName("script")[0]; 
//    y.parentNode.insertBefore(x, y);

}(jQuery));
