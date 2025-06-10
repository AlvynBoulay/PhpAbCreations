import { links } from "../data/navigation.js";

/* <ul>
<li><a href="index.html" title="" class="selected">Accueil</a></li>
<li><a href="portfolio.html" title="">Portfolio</a></li>
<li><a href="a-propos.html" title="">A propos</a></li>
<li><a href="contact.html" title="">Contact</a></li>
<li><a href="profil.html" title="">Espace membre</a></li>
</ul> */
let menuContainer = document.getElementById("menu");
let pageSlug = document.body.dataset.page;

let menu = `<ul>`;
let selectedClass = '';
//  class="selected"

links.forEach(function(link) {
    if (pageSlug == link.id) { 
        selectedClass = `class="selected"`;
    }
    
    menu += `<li><a href=${link.url} ${selectedClass} title="${link.title}">${link.title}</a></li>`;

    // Réinitialisation de la classe
    selectedClass = '';
});
menu += `</ul>`;
menuContainer.innerHTML = menu;
