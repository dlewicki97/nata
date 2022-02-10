function setContentsListeners() {
  let allFilters = document.querySelector(`.all-filters`);
  const filtersForm = document.querySelector("form#filters-form");
  const filterInput = document.querySelector("#filters-input");
  let currentFilters = filterInput.value.split(",");

  allFilters.querySelectorAll(".content").forEach((content) =>
    content.addEventListener("click", () => {
      content.classList.toggle("active");
      const filterListId = content.dataset.filterListId;
      if (!currentFilters.includes(filterListId))
        currentFilters.push(filterListId);
      else
        currentFilters = currentFilters.filter(
          (filter) => filterListId != filter
        );

      filterInput.value = currentFilters.join(",");

      filtersForm.submit();
    })
  );
}
