function initializeTags() {
  let listItems = document.querySelectorAll(
    "ul.filter-list li:not(.show-filters)"
  );
  setTagsDismissEvent();
  listItems.forEach((item) => {
    if (isTagExist(item)) item.classList.add("active");
    item.onclick = () => {
      let tags = document.querySelector(".used-filters .tags");
      if (isTagExist(item)) return;
      item.classList.add("active");
      tags.innerHTML += `<div id="tag-${item.id}" class="tag">${item.innerText}
      <span class="dismiss">x</span>
  </div>`;
      let filtersInput = document.querySelector("#filters-input");
      let filters = filtersInput.value;
      filters += `${filters.length === 0 ? "" : ","}${item.id}`;
      filtersInput.value = filters;
      setTagsDismissEvent();
      document.querySelector("form#filters-form").submit();
    };
  });
}

function isTagExist(item) {
  let tags = document.querySelector(".tags");
  let tagExist = false;
  tags.querySelectorAll(".tag").forEach((tag) => {
    let inner = tag.innerText.replace("\n", "");
    if (inner == item.innerText + "x") {
      tagExist = true;
    }
  });

  return tagExist;
}
