(function ($) {
    //Masonry for the million partner logos in footer
    var $container = $('#partner-wrap');
    // initialize Masonry after all images have loaded
    $container.imagesLoaded( function() {
      $container.masonry();
    });

    /*//Masonry for month grid
    var $containerTwo = $('#month-grid');
    // initialize
    $containerTwo.masonry({
      itemSelector: '.day-div'
    });*/

    //Load header and main background images
    function stringInArray(needleString, hayArray)
    {
        needleString = needleString.toLowerCase();

        for (var i = 0; i < hayArray.length; i++) {
            if ( hayArray[i].toLowerCase().match(needleString) ) {
                return true;
            }
        }
        return false;
    }

    var months = new Array( "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    var pathArray = window.location.pathname.split('/');
    var monthURL = pathArray[1];
    var bgImg = Math.floor((Math.random() * 2) + 1);

    if(stringInArray(monthURL, months)) {
        $(".sub-nav-wrap").backstretch("/sites/all/themes/daybydaysc_theme/images/months/bg-" + monthURL + ".jpg");
        $(".header").backstretch("/sites/all/themes/daybydaysc_theme/images/months/head-bg-" + monthURL + ".png");
    } else {
        $(".sub-nav-wrap").backstretch("/sites/all/themes/daybydaysc_theme/images/months/bg-cover" + bgImg +".jpg");
    }

    // Responsive image map for Places page
    $('img[usemap]').rwdImageMaps();

}(jQuery));