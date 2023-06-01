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

const input = document.getElementById('autocomplete-input');
const dropdown = document.getElementById('autocomplete-dropdown');

input.addEventListener('input', function () {
  const userInput = input.value;

  if (userInput.length > 0) {
    // Send AJAX request to the backend
    const request = new XMLHttpRequest();
    console.log('/autocomplete?query=' + userInput)
    request.open('GET', '/autocomplete?query=' + userInput, true);
    console.log('ok')
    request.onload = function () {
      if (request.status >= 200 && request.status < 400) {
        console.log(request.responseText)
        const response = JSON.parse(request.responseText);

        // Update the dropdown with the suggestions
        dropdown.innerHTML = '';
        response.forEach(function (suggestion) {
          const option = document.createElement('div');
          option.className = 'dropdown-item';
          option.textContent = suggestion;
          option.onclick = function () {
            input.value = suggestion;
            dropdown.innerHTML = '';
          };
          dropdown.appendChild(option);
        });
      }
    };

    request.send();
  } else {
    // Clear the dropdown if the input is empty
    dropdown.innerHTML = '';
  }
});