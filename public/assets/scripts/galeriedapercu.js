/* let slideIndex = 1;
showSlides(slideIndex);

/* // Contrôles des boutons "Suivant" et "Précédent"
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Contrôles des images miniatures
function currentSlide(n) {
  showSlides(slideIndex = n);
}
 
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("image-slide");  // Anciennement mySlides
  let thumbnails = document.getElementsByClassName("thumbnail");  // Anciennement demo
  let captionText = document.getElementById("caption");
  
  // Si l'index est supérieur au nombre de slides, recommencer au premier
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  
  // Cacher toutes les images
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // Retirer la classe "active" des miniatures
  for (i = 0; i < thumbnails.length; i++) {
    thumbnails[i].className = thumbnails[i].className.replace(" active", "");
  }

  // Afficher l'image active
  slides[slideIndex-1].style.display = "block";
  
  // Ajouter la classe "active" à la miniature active
  thumbnails[slideIndex-1].className += " active";
  
  // Mettre à jour la légende de l'image
  captionText.innerHTML = thumbnails[slideIndex-1].alt;
}
 */