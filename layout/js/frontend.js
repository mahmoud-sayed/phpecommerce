$(function () {
    'use strict';
    //switch >> login and sign up
    $('.login-page h1 span').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-page form').hidden();
        $('.'+$(this).data('class')).fadeIn(100);
    });

//confirming message in the button
$('.confirm').click(function () {
    return confirm('are you shore you wont to delete this item?');
});

});

