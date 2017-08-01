/**
 * Author: Caylin James
 */

var $ = jQuery.noConflict();

$(document).ready(function() {
    var sidebar = $('.side-content');
    // Make sure the sidebar exists so that everything doesn't break!
    if (sidebar.length == 0 )
        return;

    var sidebarHeight = sidebar.innerHeight();

    var sidebarTop = sidebar.offset().top;
    var sidebarBottom = sidebarTop + sidebarHeight;
    var footerTop = $('footer').offset().top;

    // The stop point is 50px above the footer
    var sidebarStopPoint = footerTop - 50;
    if (sidebarBottom >= sidebarStopPoint) {
        sidebar.addClass('bottom');
    }
})


$(window).scroll(function () {
    if ($(window).width() > 1075) {
        var sidebar = $('.side-content');

        if (sidebar.length > 0) {
            var windowTop = $(window).scrollTop();

            var sidebarHeight = sidebar.innerHeight();
            var sidebarTop = sidebar.offset().top;
            var sidebarBottom = sidebarTop + sidebarHeight;

            var footerTop = $('footer').offset().top;

            var sidebarStartingTop = 250;

            // The stop point is 50px above the footer
            var sidebarStopPoint = footerTop - 50;

            if ((!sidebar.hasClass('bottom')) && sidebarBottom >= sidebarStopPoint) {
                sidebar.addClass('bottom');
            }
            else if (sidebar.hasClass('bottom') && sidebarTop - windowTop > sidebarStartingTop) {
                sidebar.removeClass('bottom');
            }
        }
    }
});
