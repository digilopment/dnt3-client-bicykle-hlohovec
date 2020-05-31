/* Write here your custom javascript codes */
$(document).ready(function () {
    $(".btn-eshop-menu").click(function () {
        if ($(window).width() <= 991) {
            if ($(".eshop-nav").css('display') == 'block') {
                $(".eshop-nav").fadeOut();
            } else {
                $(".eshop-nav").fadeIn();
            }
        }
    });
});