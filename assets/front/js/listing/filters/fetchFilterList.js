(function () {
  const uri = location.href.replace(baseUrl, "");
  const categoryId = uri.includes("kategoria") ? uri.split("/")[3] : 0;
  let showFilters = document.querySelectorAll(
    "section.product-listing-container .show-filters"
  );
  showFilters.forEach((showFilter) =>
    showFilter.addEventListener("click", (e) => {
      const filterId = showFilter.dataset.filterId;
      let allFilters = document.querySelector(
        `.all-filters[data-filter-id="${filterId}"]`
      );
      if (allFilters.innerHTML != "") return;

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          document
            .querySelector(`#allFiltersModal${filterId} .loader`)
            .classList.add("d-none");
          document
            .querySelector(`#allFiltersModal${filterId} .all-filters`)
            .classList.remove("d-none");
          let filterList = JSON.parse(xhr.responseText);
          printFilterList(filterList, filterId);
        }
      };
      xhr.open(
        "GET",
        `${baseUrl}api/filter_lists/get_by_filter_id/${filterId}/${categoryId}`,
        true
      );
      xhr.send(null);
    })
  );
})();
