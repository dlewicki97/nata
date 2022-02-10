function doubleSliderConfig() {
  (function () {
    let clearFiltersButtons = document.querySelectorAll(".clear-filters");
    let filtersForm = document.querySelector("#filters-form");
    let minPrice = document.querySelector("#price-range-min");
    let maxPrice = document.querySelector("#price-range-max");

    clearFiltersButtons.forEach((button) =>
      button.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector("#filters-input").value = "";
        minPrice.value = minPrice.getAttribute("min-price");
        maxPrice.value = maxPrice.getAttribute("max-price");

        setCookie(
          "priceSort",
          JSON.stringify([minPrice.value, maxPrice.value])
        );

        filtersForm.submit();
      })
    );
  })();

  let inputMin = document.getElementById("price-range-min");
  let inputMax = document.getElementById("price-range-max");

  let minValue = parseInt(inputMin?.getAttribute("min-price"));
  let start = 0;
  let max = parseInt(inputMax?.getAttribute("max-price"));
  let slider = document.getElementById("price-slider");
  // prettier-ignore
  let priceSortCookie = JSON.parse(document.cookie.split("; ").find((el) => el.includes("priceSort"))?.replace("priceSort=", "") || false);
  let maxRange = 0;
  if (priceSortCookie) {
    minValue = +priceSortCookie[0];
    maxRange = +priceSortCookie[1];
  }

  noUiSlider.create(slider, {
    start: [minValue, maxRange || max],
    connect: true,
    range: {
      min: start,
      max: max,
    },
    step: 1,
    format: wNumb({
      decimals: 0,
    }),
    ariaFormat: wNumb({
      decimals: 0,
      suffix: "",
    }),
  });

  document.querySelector("#price-sort-button").addEventListener("click", () => {
    // document.querySelector('.popover').remove();
    priceSort(inputMin.value, inputMax.value);
  });

  slider.noUiSlider.on("update", function (values, handle) {
    handle === 0
      ? (inputMin.value = values[handle])
      : (inputMax.value = values[handle]);
  });

  inputMin.addEventListener("change", function () {
    slider.noUiSlider.setHandle(0, inputMin.value);
  });

  inputMax.addEventListener("change", function () {
    slider.noUiSlider.setHandle(1, inputMax.value);
  });
}
