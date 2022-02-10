document.querySelectorAll(".layout-switch .switch").forEach((s, i) => {
  s.onclick = () => {
    if (s.classList.contains("active")) return;
    document.querySelectorAll(".layout-switch .switch").forEach((inner) => inner.classList.remove("active"));
    s.classList.add("active");
    if (i == 0)
      document.querySelector("section.listing").classList.remove("rows");
    else document.querySelector("section.listing").classList.add("rows");
  };
});
