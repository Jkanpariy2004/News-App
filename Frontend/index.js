$(document).ready(function () {
    $('.slick-slider').slick({
        slidesToShow: 4, 
        slidesToScroll: 1, 
        arrows: true, 
        prevArrow: $('.slick-prev'),
        nextArrow: $('.slick-next'), 
        responsive: [
            {
                breakpoint: 992, 
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576, 
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});