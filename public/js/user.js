$(document).ready(function () {
    showCartCount();
    $('.back-btn').click(function (e) {
        e.preventDefault();
        window.history.go(-1);
    })
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

    // show cart count
    function showCartCount() {
        var count = 0;
        var cart = JSON.parse(localStorage.getItem('cart'));
        if (cart) {
            $.each(cart, function (i, v) {
                count += v.qty;
            });
        }

        $(".item-count").text(count);
    }
});