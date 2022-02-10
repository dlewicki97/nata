let heartContainer = document.querySelector(".heart-container");
let outline = `${baseUrl}assets/front/img/single-product/heart-outline-white.svg`;
let filled = `${baseUrl}assets/front/img/single-product/heart-white.svg`;
heartContainer.onclick = () => {
  let img = heartContainer.querySelector("img");
  img.src = img.src.includes(outline) ? filled : outline;
};
