$(document).ready(function () {
  let loop = true;
  let owl = $(".recommended .first-carousel .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 4,
    responsive: {
      0: { items: 1 },
      400: { items: 2 },
      992: { items: 4 },
    },
    loop: loop,
    rewind: false,
    lazyLoad: true,
  });

  setOwlItemsPaddings();
  owl.on("change.owl.carousel", setOwlItemsPaddings);

  $(".recommended .first-carousel .right").click(function () {
    owl.trigger("next.owl.carousel");
  });
  $(".recommended .first-carousel .left").click(function () {
    owl.trigger("prev.owl.carousel");
  });

  function setOwlItemsPaddings() {
    setTimeout(() => {
      let owlItemsActive = document.querySelectorAll(
        ".recommended .first-carousel .owl-carousel .owl-item.active"
      );
      let owlItems = document.querySelectorAll(
        ".recommended .first-carousel .owl-carousel .owl-item"
      );
      owlItems.forEach((item) => item.classList.remove("pr-0"));
      owlItemsActive.forEach((item, i) => {
        if (i == owlItemsActive.length - 1) item.classList.add("pr-0");
        else item.classList.remove("pr-0");
      });
    }, 100);
  }
});
