const select = document.querySelector('select');

select.onchange = () => {
  newUrl = location.href.split("&categorie")[0];
  location.replace(newUrl + "&categorie=" + select.value);
}