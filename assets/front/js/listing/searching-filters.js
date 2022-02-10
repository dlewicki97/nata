let searchInputs = document.querySelectorAll(".filter-wrapper .header-input");

let filterLists = [];

document.querySelectorAll(".filter-wrapper .card").forEach((card, i) => {
  filterLists.push([]);
  card.querySelectorAll("ul.filter-list li").forEach((li) => {
    filterLists[i].push(li);
  });
});

searchInputs.forEach((input, i) => {
  input.onkeyup = () => {
    $.ajax({
      type: "post",
      url: `${baseUrl}api/filter_lists/search`,
      data: {
        search: input.value,
        filter_id: document.querySelectorAll(".filter-wrapper .card")[i].id,
      },
      cache: false,
      beforeSend: function (html) {},
      complete: function (html) {
        updateFilterList(JSON.parse(html.responseText), i, input.value);
        initializeTags();
      },
    });
  };
});

function updateFilterList(response, cardIndex, search) {
  let reset = false;
  if (search === "") reset = true;

  let currentCard = document.querySelectorAll(".filter-wrapper .card")[
    cardIndex
  ];
  currentCard.querySelectorAll("ul.filter-list li").forEach((li) => {
    li.remove();
  });
  let ul = currentCard.querySelector("ul");
  if (reset) {
    filterLists[cardIndex].forEach((li) => {
      if (tagExist(li.innerText)) li.classList.add("active");
      ul.appendChild(li);
    });
  } else {
    response.forEach((row) => {
      let li = document.createElement("li");
      li.id = row.id;
      if (tagExist(row.title)) li.classList.add("active");
      li.innerHTML = row.title;
      ul.appendChild(li);
    });
  }
}

function tagExist(title) {
  let status = false;
  document.querySelectorAll(".tags .tag")?.forEach((tag) => {
    let tagText = tag.innerHTML
      .toString()
      .replace('<span class="dismiss">x</span>', "")
      .replace("\n", "")
      .trim()
      .toLowerCase();
    if (title.toLowerCase() === tagText) status = true;
  });

  return status;
}
