$(document).ready(function () {
    $('.auth-user').click(function () {
        $('.auth-user-menu').toggle('fast');
    })
    $('.sidebar-toggler').click(function () {
        $('.sidebar').toggleClass('toggle');
        $('.overlay').toggleClass('active');
    })
    $('.overlay').click(function () {
        $('.sidebar').toggleClass('toggle');
        $('.overlay').toggleClass('active');
    })
    $('.logout').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
        })
    })
})