$(document).ready(function () {
  let owl1 = $(".recommended-products #recommend1 .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 4,
    responsive: {
      0: { items: 1 },
      400: { items: 2 },
      992: { items: 4 },
    },
    autoplay: true,
    loop: true,
    rewind: false,
    lazyLoad: true,
  });
  $("#recommend1 .right").click(function () {
    owl1.trigger("next.owl.carousel");
  });
  $("#recommend1 .left").click(function () {
    owl1.trigger("prev.owl.carousel");
  });
  let owl2 = $(".recommended-products #recommend2 .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 4,
    responsive: {
      0: { items: 1 },
      400: { items: 2 },
      992: { items: 4 },
    },
    autoplay: true,
    loop: true,
    rewind: false,
    lazyLoad: true,
  });
  $("#recommend2 .right").click(function () {
    owl2.trigger("next.owl.carousel");
  });
  $("#recommend2 .left").click(function () {
    owl2.trigger("prev.owl.carousel");
  });
  let owl3 = $(".recommended-products #recommend3 .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 4,
    responsive: {
      0: { items: 1 },
      400: { items: 2 },
      992: { items: 4 },
    },
    autoplay: true,
    loop: true,
    rewind: false,
    lazyLoad: true,
  });
  $("#recommend3 .right").click(function () {
    owl3.trigger("next.owl.carousel");
  });
  $("#recommend3 .left").click(function () {
    owl3.trigger("prev.owl.carousel");
  });
});
