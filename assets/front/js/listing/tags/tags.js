function setTagsDismissEvent() {
  let tags = document.querySelectorAll(".used-filters .tags .tag");

  $('[data-toggle="popover"]').popover({ trigger: "hover" });

  tags.forEach((tag) => {
    tag.querySelector(".dismiss").onclick = () => {
      let tagId = tag.id.replace("tag-", "");
      setFilterInput(tagId);

      tag.style.display = "none";
      let listItems = [
        ...document.querySelectorAll("ul.filter-list li:not(.show-filters)"),
      ];
      let index = -1;

      listItems.forEach((item, i) => {
        if (+item.id == +tag.id.replace("tag-", "")) {
          index = i;
        }
      });
      listItems[index]?.classList.remove("active");
      document.querySelector("form#filters-form").submit();
    };
  });
}

function setFilterInput(tagId) {
  let filtersInput = document.querySelector("#filters-input");
  let filters = filtersInput.value.split(",");
  let deleteIndex = filters.indexOf(tagId);
  filters.splice(deleteIndex, 1);
  filtersInput.value = filters.join(",");
}
