$(document).ready(function () {
  let owl = $(".brands .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 11,
    responsive: {
      0: { items: 1 },
      400: { items: 2 },
      500: { items: 3 },
      700: { items: 5 },
      900: { items: 7 },
      1100: { items: 9 },
      1200: { items: 11 },
    },
    rewind: false,
    lazyLoad: true,
  });

  $(".brands .right").click(function () {
    owl.trigger("next.owl.carousel");
  });
  $(".brands .left").click(function () {
    owl.trigger("prev.owl.carousel");
  });
  let brandSearch = document.getElementById("brand-search");
  brandSearch.addEventListener("keyup", () => {
    owl.trigger("to.owl.carousel", [0, 1]);
    let owlItems = document.querySelectorAll(".brands .owl-item");
    owlItems.forEach((item) => {
      if (
        item
          .querySelector(".bg-picture")
          .title.toLowerCase()
          .includes(brandSearch.value.toLowerCase())
      ) {
        item.classList.add("d-block");
        item.classList.remove("d-none");
      } else {
        item.classList.remove("d-block");
        item.classList.add("d-none");
      }
    });
  });
});
