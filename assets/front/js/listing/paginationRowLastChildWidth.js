function paginationRowLastChildWidth() {
  let paginationRow = document.querySelector(".pagination-row");
  let paginationRowAs = paginationRow.querySelectorAll("a");
  if (paginationRowAs.length == 0) return;

  paginationRowAs[paginationRowAs.length - 1].style.width = "fit-content";
  paginationRowAs[paginationRowAs.length - 1].style.paddingLeft = ".5rem";
  paginationRowAs[paginationRowAs.length - 1].style.paddingRight = ".5rem";
}
