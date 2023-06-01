function openPopup(idProjet) {
  const popup = document.querySelector(".popup");
  popup.style.display = "flex";

  localStorage.setItem("currentProjet", idProjet);
}

function inscrireEquipe(idEquipe) {
  location.replace(`/inscrireEquipe?equipe=${idEquipe}&projet=${localStorage.getItem("currentProjet")}`);
}
