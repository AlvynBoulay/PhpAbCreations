// Sélection des éléments du DOM
const addCommentBtn = document.getElementById('addCommentBtn');
const commentAuthorInput = document.getElementById('commentAuthor');
const commentTextInput = document.getElementById('commentText');
const commentsSlider = document.querySelector('.comments-slider');
const prevBtn = document.getElementById('prevComment'); // Flèche précédente
const nextBtn = document.getElementById('nextComment'); // Flèche suivante

let currentIndex = 0; // Index du slide actif

// Fonction pour mettre à jour les slides
function updateSlides() {
  // Récupérer tous les slides
  const slides = Array.from(commentsSlider.children);
  
  // Enlever la classe active-slide de tous les slides
  slides.forEach(function(slide) {
    slide.classList.remove('active-slide');
  });

  // Ajouter la classe active-slide au slide correspondant à currentIndex
  if (slides[currentIndex]) {
    slides[currentIndex].classList.add('active-slide');
  }
}

// Ajouter un commentaire
addCommentBtn.addEventListener('click', function() {
  const author = commentAuthorInput.value.trim();
  const text = commentTextInput.value.trim();

  // Si l'auteur et le texte du commentaire ne sont pas vides
  if (author && text) {
    const newSlide = document.createElement('div');
    newSlide.className = 'comment-slide';

    // Contenu du nouveau slide
    newSlide.innerHTML = `
      <img src="avatar1.jpg" alt="Avatar" class="comment-avatar" />
      <div class="comment-content">
        <strong class="comment-author">${author}</strong>
        <p class="comment-text">${text}</p>
      </div>
    `;

    commentsSlider.appendChild(newSlide); // Ajouter le nouveau slide à la liste des commentaires

    // Réinitialiser le formulaire
    commentAuthorInput.value = '';
    commentTextInput.value = '';

    // Mettre à jour les slides et index
    currentIndex = commentsSlider.children.length - 1; // Le dernier commentaire devient actif
    console.log("Nouveau commentaire ajouté. Index actuel:", currentIndex); // Affichage du nouvel index
    updateSlides(); // Mettre à jour la vue des slides
  }
});

// Flèche précédente
prevBtn.addEventListener('click', function() {
  if (currentIndex > 0) {
    currentIndex--;
    console.log("Flèche précédente. Nouvel index:", currentIndex); // Affichage du nouvel index
    updateSlides();
  } else {
    console.log("Début de la liste. Impossible de reculer.");
  }
});

// Flèche suivante
nextBtn.addEventListener('click', function() {
  if (currentIndex < commentsSlider.children.length - 1) {
    currentIndex++;
    console.log("Flèche suivante. Nouvel index:", currentIndex); // Affichage du nouvel index
    updateSlides();
  } else {
    console.log("Fin de la liste. Impossible d'avancer.");
  }
});