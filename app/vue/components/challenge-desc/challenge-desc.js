const popupOverlay = document.querySelector(".popup-overlay");
const popup = document.querySelector(".popup");

function openPopup(idProjet) {
  popup.style.display = "flex";
  popupOverlay.style.display = "flex";

  localStorage.setItem("currentProjet", idProjet);
}

popupOverlay.addEventListener("click", () => {
  popup.style.display = "none";
  popupOverlay.style.display = "none";
});

function inscrireEquipe(idEquipe, idChallenge) {
  if (!idEquipe || !idChallenge) {
    alert("Paramètres manquants, veuillez réessayer, ou contacter un administrateur si le problème persiste.");
    return;
  }
  location.replace(`/inscrireEquipe?equipe=${idEquipe}&projet=${localStorage.getItem("currentProjet")}&challenge=${idChallenge}`);
}
