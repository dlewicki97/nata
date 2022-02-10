function priceSort(min, max) {
  let baseUrl = window.location.origin;
  baseUrl += baseUrl.includes("localhost") ? "/nata/" : "/";

  document.getElementById("render-listing").innerHTML =
    '<div class="elements-preloader"><i class="fas fa-spinner fa-pulse"></i></div>';
  setCookie("priceSort", JSON.stringify([min, max]));
  $("#render-listing").load(
    `${baseUrl}generuj/lista_produktow${getSortUri()}`,
    function () {
      scriptsAfterRenderListing();
    }
  );
}
