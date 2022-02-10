var lazyLoadInstance = new LazyLoad();

links = document.querySelectorAll("link");
for (var i = links.length - 1; i >= 0; i--) {
  if (links[i].getAttribute("rel") == "preload") {
    links[i].setAttribute("rel", "stylesheet");
  }
}

$(window).on("load", function () {
  $("#preloader").fadeOut();
});

$("#hideInfo").delay(5000).fadeOut(1000);

// $('[data-toggle="popover"]').popover({ trigger: "click" });
