window.addEventListener("load", function () {
  let formGroups = document.querySelectorAll(
    ".related-products .form-group.filter"
  );
  formGroups.forEach((group) => {
    group.querySelectorAll("input").forEach((input) => {
      input.onkeyup = () => {
        fetchRelatedProducts(input.value);
      };
    });
  });

  function fetchRelatedProducts(search) {
    $.ajax({
      type: "post",
      url: `${baseUrl}api/products/search_panel`,
      data: { search },
      cache: false,
      beforeSend: function (html) {},
      complete: function (html) {
        setOptions(JSON.parse(html.responseText));
      },
    });
  }

  function setOptions(products) {
    let select = document.querySelector("select.related-products");
    let selectedOptions = select.querySelectorAll("option[selected]");
    select
      .querySelectorAll("option:not([selected])")
      .forEach((option) => option.remove());

    if (products.length === 0) {
      selectedOptions.forEach((option) => (select.innerHTML += option));
    } else {
      products.forEach((row) => {
        let option = `<option value="${row.id}">${row.name}</option>`;
        select.innerHTML += option;
      });
    }
  }
});
