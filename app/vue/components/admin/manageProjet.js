let btnAddRessource = document.getElementById('addRes');

let overlay = document.getElementById('ol');

btnAddRessource.addEventListener('click', function () {
    overlay.classList.toggle('active');
});


let closeBtns = document.querySelectorAll('.closeBtn');

closeBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
        overlay.classList.toggle('active');
    });
});