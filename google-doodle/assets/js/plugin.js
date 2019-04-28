jQuery(document).ready(function($){'use strict';
    $('span.close-btn, body').click(function(){
        $('.doodle-wrap').fadeOut(1000);
    });

    var visited = jQuery.cookie('visited');
    if (visited == 'yes') {
         // second page load, cookie active
    } else {
        $(window).load(function() {
            setTimeout(function(){
                $('.doodle-wrap').fadeIn(500);
            }, 3000);
        });
    }
    jQuery.cookie('visited', 'yes', {
        expires: 1 // the number of days cookie  will be effective
    });

});
