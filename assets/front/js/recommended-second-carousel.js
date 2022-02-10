$(document).ready(function () {
  let loop = true;
  let owl = $(".recommended .second-carousel .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 1,
    loop: loop,
    rewind: false,
    lazyLoad: true,
  });

  $(".recommended .second-carousel .right").click(function () {
    owl.trigger("next.owl.carousel");
  });
  $(".recommended .second-carousel .left").click(function () {
    owl.trigger("prev.owl.carousel");
  });
});
