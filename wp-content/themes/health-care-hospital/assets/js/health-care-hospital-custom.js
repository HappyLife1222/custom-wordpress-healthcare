/**
  * Theme Js file.
**/

// ===== Slider ==== 

jQuery('document').ready(function(){
  var owl = jQuery('#abt-product .owl-carousel');
    owl.owlCarousel({
    margin:20,
    nav: true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots:true,
    navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 2
      },
      1200: {
        items: 2
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});