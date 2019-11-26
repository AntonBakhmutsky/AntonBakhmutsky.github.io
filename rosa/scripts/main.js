$('.galery_slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.galery_slider_nav'
});
$('.galery_slider_nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.galery_slider',
    centerMode: true,
    focusOnSelect: true
});
$('.galery_slider_2').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true
});
















