let hearts = document.querySelectorAll(".product .heart");
let heartOutline = "img/listing/heart-outline.svg";
let heartFilled = "img/listing/heart.svg";
hearts.forEach((heart) => {
  heart.onclick = () => {
    if (heart.src.includes(heartOutline)) heart.src = heartFilled;
    else heart.src = heartOutline;
  };
});
