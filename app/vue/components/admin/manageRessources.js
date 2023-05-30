let btnAddRessource = document.getElementById('addRes');
let overlay = document.getElementById('ol');

let addBtn = document.getElementById('addres1');
let overlay1 = document.getElementById('ol1');


btnAddRessource.addEventListener('click', function () {
    overlay.classList.toggle('active');
});
let close1 = document.getElementById('c1');

close1.addEventListener('click', function () {
    overlay.classList.toggle('active');
}
);

addBtn.addEventListener('click', function () {
    overlay1.classList.toggle('active');
});





let close2 = document.getElementById('c2');



close2.addEventListener('click', function () {
    overlay1.classList.toggle('active');
}
);