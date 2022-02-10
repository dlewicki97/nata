function scriptsAfterRenderListing() {
  doubleSliderConfig();
  fillTagsAfterRenderListing();
  initializeTags();
  $('[data-toggle="popover"]').popover({
    trigger: "hover",
  });
  paginationRowLastChildWidth();
  new LazyLoad();
}
