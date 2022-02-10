let accordions = document.querySelectorAll(".filter-wrapper > .card");

accordions.forEach((accordion) => {
  let link = accordion.querySelector("a");
  link.onclick = () => {
    if (link.getAttribute("aria-expanded") == "false") {
      link.querySelector(".icon").innerHTML = "-";
    } else {
      link.querySelector(".icon").innerHTML = "+";
    }
  };
});

const categoryCollapseButtons = document.querySelectorAll(
  ".category-collapse-button"
);

categoryCollapseButtons.forEach((button) =>
  button.addEventListener(
    "click",
    () =>
      (button.innerHTML =
        button.getAttribute("aria-expanded") == "false" ? "-" : "+")
  )
);
