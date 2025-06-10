import "./components/Menu.js";

let btnCloseMainNav = document.querySelector('.closeMainNav');

btnCloseMainNav.addEventListener('click', function() {
    document.body.classList.remove('has-menu-opened');
    document.body.classList.remove('no-scroll'); 
});

let btnOpenMainNav = document.querySelector('.openMainNav');

btnOpenMainNav.addEventListener('click', function() {
    document.body.classList.add('has-menu-opened');
    document.body.classList.add('no-scroll');
});




// Bouton Revenir a la page précédente 
const btnReturn = document.querySelector('.btnreturn .footerLink');

// Ajout d'un événement 
if (btnReturn) {
    btnReturn.addEventListener('click', function() {
        window.history.back(); // Retourner à la page précédente
    });
}



