$(document).ready(function() {
      $('.slideshow__slides').not('.slick-initialized').slick({
      autoplay: true,
      autoplaySpeed: 4000,
      infinite: true,
      // adaptiveHeight: true,
      // useTransform: true,
      // dots: false,
      fade: true,
      // cssEase: 'linear',
      appendArrows: $('.slideshow__slides'),
      prevArrow: $('.slideshow__prev'),
      nextArrow: $('.slideshow__next'),
    });

    // $('.slideshow__prev, .slideshow__next').on('click', function(e) {
    //   e.preventDefault();
    // });
    //  $('.slideshow__slides').slick({
    //     dots: true,
        // infinite: true,
    //     autoplay: true,
    //   autoplaySpeed: 4000,
    //     fade: true,
    //     slide: 'div',
    //     cssEase: 'linear',
    //     appendArrows: $('.slideshow__slides'),
    //     prevArrow: $('.slideshow__prev'),
    //   nextArrow: $('.slideshow__next')
    // })

});