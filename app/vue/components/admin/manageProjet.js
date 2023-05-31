let btnAddRessource = document.getElementById('addRes');
let addPartenaire = document.getElementById('addPart');
let overlay = document.getElementById('ol');
let overlayPart = document.getElementById('olPart');
let c1 = document.getElementById('c1');
let c2 = document.getElementById('c2');

c1.addEventListener('click', function () {
    overlay.classList.toggle('active');
});
c2.addEventListener('click', function () {
    overlayPart.classList.toggle('active');
});

btnAddRessource.addEventListener('click', function () {
    overlay.classList.toggle('active');
});

addPartenaire.addEventListener('click', function () {
    overlayPart.classList.toggle('active');
});


