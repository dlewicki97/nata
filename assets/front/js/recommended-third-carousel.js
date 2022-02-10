$(document).ready(function () {
  let loop = true;
  let owl = $(".recommended .third-carousel .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 5,
    responsive: {
      0: { items: 3 },
      600: { items: 4 },
      992: { items: 5 },
    },
    center: true,
    loop: loop,
    rewind: false,
    lazyLoad: true,
  });

  let owlItems = document.querySelectorAll(
    ".recommended .third-carousel .owl-carousel .owl-item"
  );
  owlItems.forEach((item, i) => {
    item.addEventListener("click", (e) => {
      let width = window.innerWidth;
      let offset = 1;
      if (width < 992) offset = 2;
      if (width < 600) offset = 3;
      $(
        ".recommended .second-carousel .owl-carousel"
      ).trigger("to.owl.carousel", [i + offset, 1]);
      console.log(i);
    });
  });
});
