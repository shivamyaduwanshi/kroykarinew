$(document).ready(function(){

    $('.header-slider .owl-carousel').owlCarousel({
        items:1,
        lazyLoad:true,
        loop:true
    });

    $('.product-slider .owl-carousel').owlCarousel({
        items:1,
        lazyLoad:true,
        loop:true,
        margin:10
    });

    $(window).scroll(function(){
        if ($(window).scrollTop() >= 45) {
            $('body').addClass('fixed-header');
        }
        else {
            $('body').removeClass('fixed-header');
        }
    });

    /***filter1***/
    $('.filter-box .filters>ul>li>div.f').click(function(){
        $(this).parent().children().next().slideToggle('open');
        $(this).toggleClass('down-arrow');
    });

    /**filter mobile**/
    $('.page-filter .filter-toggle').click(function() {
        $(".page-filter").toggleClass("show-hide-filter");
    });

    /**custom-dropdown**/
    $('.custom-dropdown .dropdown-btn').click(function(){
        $('.custom-dropdown').toggleClass('show-c-dropdown');
    });

    /**chat**/
    // $('.chat-list .nav-tabs li, button.m-backbtn').click(function () {
    //     $('body').toggleClass('chat-class');
    // });

    $('body').on('click','.chat-list .nav-tabs li, button.m-backbtn' , function () {
        $('body').toggleClass('chat-class');
    });

    /****/
    $(".toggle-menu").click(function(){
        $('header nav').slideToggle('open');
        $('body').toggleClass('navbar-toggle');
    });

    $(".social-share-box .social-share").click(function(){
        $(".social-share-box .share-options").toggleClass('show');
    });
});