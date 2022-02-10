let baseUrl =
  window.location.origin +
  (window.location.host.includes("localhost") ? "/nata/" : "/");
window.addEventListener("load", function () {
  let formGroups = document.querySelectorAll(
    ".additional-attributes .form-group.filter"
  );
  formGroups.forEach((group) => {
    group.querySelectorAll("input").forEach((input) => {
      input.onkeyup = () => {
        fetchFiltersLists(group.id, input.value);
      };
    });
  });

  // let producerGroup = document.getElementById("producer");
  // let producerInput = producerGroup.querySelector("input[list]");
  // let producerHidden = producerGroup.querySelector("#producer-input");

  // producerInput.addEventListener("keyup", () => {
  //   fetchFiltersLists(producerGroup.id, producerInput.value, "datalist");
  // });
  // setProducerInput();
  // producerInput.addEventListener("input", () => {
  //   setProducerInput();
  // });

  function setProducerInput() {
    let datalistOption = [
      ...producerGroup.querySelectorAll("datalist option"),
    ].find((option) => {
      console.log(producerInput.value, option.value);
      return producerInput.value === option.value;
    });
    producerInput.value = datalistOption.innerHTML;
    producerHidden.value = datalistOption.value;
  }

  function fetchFiltersLists(filterSortKey, search, selectTag = "select") {
    $.ajax({
      type: "post",
      url: `${baseUrl}api/filter_lists/search_panel`,
      data: {
        search: search,
        filter_sort_key: filterSortKey,
      },
      cache: false,
      beforeSend: function (html) {},
      complete: function (html) {
        setOptions(JSON.parse(html.responseText), filterSortKey, selectTag);
      },
    });
  }
  function setOptions(filterLists, filterSortKey, selectTag) {
    let select = document
      .getElementById(filterSortKey)
      .querySelector(selectTag);
    let selectedOptions = select.querySelectorAll("option[selected]");
    select
      .querySelectorAll("option:not([selected])")
      .forEach((option) => option.remove());

    if (filterLists.length === 0) {
      selectedOptions.forEach((option) => (select.innerHTML += option));
    } else {
      filterLists.forEach((row) => {
        let option = `<option value="${row.id}">${row.title}</option>`;
        select.innerHTML += option;
      });
    }
  }
});
