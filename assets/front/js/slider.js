$(document).ready(function () {
  let loop = true;
  let owl = $(".slider .owl-carousel").owlCarousel({
    dots: false,
    nav: false,
    items: 1,
    autoplay: true,
    center: true,
    loop: loop,
    rewind: false,
    lazyLoad: true,
  });

  let slides = document.querySelectorAll(".slider .owl-carousel .slider-item");
  owl.on("changed.owl.carousel", slideCounter);
  owl.on("initialize.owl.carousel", slideCounter);
  let currentIndex = 0;
  let direction = 1;
  function slideCounter(e) {
    owl.trigger("stop.owl.autoplay");
    owl.trigger("play.owl.autoplay");
    setItemsHeight();
    let length = e.item.count;
    direction = checkDirection(parseInt(e.item.index - length / 2), length);
    currentIndex = parseInt(e.item.index - length / 2);
    if (currentIndex == length) currentIndex = 0;

    let elements = document.querySelectorAll(".slider-counter .element");
    let element = elements[Math.floor(currentIndex % 3)];
    elements.forEach((element) => {
      element.classList.remove("active");
      element.querySelector(".line").style.height = "0%";
    });
    setTimeout(() => {
      element.classList.add("active");
      let fmtNum = formatNumber(currentIndex);

      setCounterNumbers(currentIndex, length);
    }, 10);
  }
  function checkDirection(nextIndex, length) {
    let result = 0;
    if (
      currentIndex < nextIndex &&
      !(currentIndex == 0 && nextIndex == length - 1)
    ) {
      result = 1;
    } else {
      result = -1;
    }
    if (nextIndex == 0) result = 1;

    return result;
  }
  function setCounterNumbers(currentIndex, length) {
    let right = direction == 1;
    let elements = document.querySelectorAll(".slider-counter .element");
    let modulo = getLastItemModulo(length);

    if (
      modulo == 2 &&
      (parseInt(currentIndex % 3) == (right ? 0 : 2) || isLastItem(length))
    ) {
      if (right && isLastItem(length)) return;
      elements.forEach((element, i) => {
        let start = right ? currentIndex + i : currentIndex - 2 + i;
        element.querySelector(".number").innerHTML = formatNumber(start);
      });
    }

    if (
      modulo == 1 &&
      (parseInt(currentIndex % 3) == (right ? 0 : 2) || isLastItem(length))
    ) {
      if (right && isLastItem(length)) return;
      elements.forEach((element, i) => {
        let start = right
          ? currentIndex + i
          : currentIndex - (isLastItem(length) ? 1 : 2) + i;
        element.querySelector(".number").innerHTML = formatNumber(start);
      });
    }

    if (
      modulo == 0 &&
      (parseInt(currentIndex % 3) == (right ? 0 : 2) || isLastItem(length))
    ) {
      elements.forEach((element, i) => {
        let start = right
          ? currentIndex + i
          : currentIndex - (isLastItem(length) ? 0 : 2) + i;
        element.querySelector(".number").innerHTML = formatNumber(start);
      });
    }
  }
  function isLastItem(length) {
    return currentIndex == length - 1;
  }
  function getLastItemModulo(length) {
    return parseInt((length - 1) % 3);
  }
  function formatNumber(num) {
    num = parseInt(num);
    return num < 9 ? `0${num + 1}` : num + 1;
  }

  function setItemsHeight() {
    if (window.innerWidth <= 992) return;
    let items = document.querySelectorAll(".slider .owl-item");
    let max = 0;
    items.forEach((item) => {
      let height = item.getBoundingClientRect().height;
      if (height > max) max = height;
    });
    // items.forEach((item) => (item.style.height = `${max}px`));
  }

  document.querySelectorAll(".slider-counter .number").forEach((number) => {
    number.onclick = () => {
      let index = parseInt(number.innerText);
      console.log(index);
      owl.trigger("to.owl.carousel", [index - 1, 1]);
    };
  });
});
