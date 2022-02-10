function getSortUri() {
  let uri = window.location.pathname.split("/");
  if (window.location.origin.includes("localhost"))
    uri.splice(uri.indexOf(uri.find((s) => s.includes("nata"))), 1);
  if (uri[2] == "kategoria") return `/kategoria/${uri[4]}/${uri[5] ?? 0}`;
  else if (uri[1] == "nowosci") return `/nowosci/${uri[2] ?? 0}`;
  else if (uri[1] == "outlet") return `/outlet/${uri[2] ?? 0}`;
  else return `/${uri[2]}`;
}
