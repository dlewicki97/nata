(function () {
  window.addEventListener("load", () => {
    let popoverElements = document.querySelectorAll('[data-toggle="popover"]');

    let popoverTemplate = `<div class="popover fade"><div class="arrow" style="top: 34px;"></div><h3 class="popover-header">{title}</h3><div class="popover-body">{content}</div></div>`;

    popoverElements.forEach((el) => {
      const title = el.dataset.originalTitle ?? el.getAttribute("title");
      const content = el.dataset.content;
      const newPopover = popoverTemplate
        .replace("{title}", title)
        .replace("{content}", content);
      el.innerHTML += newPopover;

      let popover = el.querySelector(".popover");

      popover?.addEventListener("mouseover", () => {
        popover?.classList.remove("show");
      });
    });
  });
})();
