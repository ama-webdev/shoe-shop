$(document).ready(function () {
    $(".top-nav-toggler").click(function () {
        $('.mobile-nav,.overlay,.wrapper').addClass('active');
    })
    $(".filter").click(function (e) {
        e.preventDefault();
        $('.wrapper .content .menu,.overlay,.wrapper').addClass('active');
    })
    $(".overlay").click(function () {
        $('.mobile-nav,.overlay,.wrapper,.wrapper .content .menu').removeClass('active');
    })
    $(".quick-add i").click(function () {
        var parent = $(this).parent().parent();
        $('.sizes', parent).toggleClass('active')
    })
});