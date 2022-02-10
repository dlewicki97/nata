function printFilterList(filterList, filterId) {
  let allFilters = document.querySelector(
    `.all-filters[data-filter-id="${filterId}"]`
  );
  const filterInput = document.querySelector("#filters-input");

  let currentFilters = filterInput.value.split(",");

  allFilters.innerHTML = "";

  filterList = filterList.sort((a, b) => {
    if (a.title > b.title) return 1;
    if (a.title < b.title) return -1;
    return 0;
  });

  for (let i = 0; i < filterList.length; i++) {
    const item = filterList[i];
    allFilters.innerHTML += `<li><div data-filter-list-id="${
      item.filter_list_id
    }" class="content ${currentFilters.includes(item.id) ? "active" : ""}">${
      item.title
    }</div></li>`;
  }

  setContentsListeners();
}
