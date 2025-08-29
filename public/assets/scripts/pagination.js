let items = [];
const itemsPerPage = 4;
let totalPages = 0;

const contentEl = document.querySelector('.creations-list');
const paginationEl = document.querySelector('.pagination');
const pagesContainer = paginationEl.querySelector('.page-buttons-container');

console.log('contentEl:', contentEl);
console.log('paginationEl:', paginationEl);
console.log('pagesContainer:', pagesContainer);

function displayItems(page) {
  console.log(`displayItems called for page: ${page}`);
  const start = (page - 1) * itemsPerPage;
  const slice = items.slice(start, start + itemsPerPage);
  console.log('items to display:', slice);

  contentEl.innerHTML = slice.map(item => {
    // Si item.cover est undefined ou vide, on met une image par défaut
    const imgSrc = item.cover ? `assets/images/cover/${item.cover}` : 'assets/images/cover/cover_1.jpg';
    const altText = item.title || 'Création';

    return `
      <div class="creation-card">
        <img src="${imgSrc}" alt="${altText}" />
        <a href="${item.link || '#'}">
          <button class="details-button">Voir les détails</button>
        </a>
      </div>
    `;
  }).join('');
}

function renderPageButtons(currentPage) {
  console.log(`renderPageButtons called for page: ${currentPage}`);
  pagesContainer.innerHTML = '';
  for (let p = 1; p <= totalPages; p++) {
    const btn = document.createElement('button');
    btn.textContent = p;
    btn.className = 'page-button';
    if (p === currentPage) btn.classList.add('active');
    pagesContainer.appendChild(btn);
  }
}

function updatePagination(currentPage) {
  console.log(`updatePagination called for page: ${currentPage}`);
  renderPageButtons(currentPage);
  paginationEl.querySelector('.prev-button').disabled = currentPage === 1;
  paginationEl.querySelector('.next-button').disabled = currentPage === totalPages;
}

paginationEl.addEventListener('click', e => {
  if (e.target.matches('.page-button')) {
    console.log('Page button clicked:', e.target.textContent);
    goToPage(Number(e.target.textContent));
  } else if (e.target.matches('.prev-button')) {
    const cur = +paginationEl.querySelector('.page-button.active').textContent;
    console.log('Prev button clicked, current page:', cur);
    goToPage(cur - 1);
  } else if (e.target.matches('.next-button')) {
    const cur = +paginationEl.querySelector('.page-button.active').textContent;
    console.log('Next button clicked, current page:', cur);
    goToPage(cur + 1);
  }
});

function goToPage(page) {
  console.log(`goToPage called with page: ${page}`);
  if (page < 1 || page > totalPages) {
    console.warn('Page out of range:', page);
    return;
  }
  displayItems(page);
  updatePagination(page);
}

// Charge les données puis lance l’affichage
fetch('api/get_creations.php')
  .then(response => {
    console.log('Fetch response:', response);
    return response.json();
  })
  .then(data => {
    console.log('Data received from PHP:', data);
    items = data;
    totalPages = Math.ceil(items.length / itemsPerPage);
    console.log('Total pages:', totalPages);
    goToPage(1);
  })
  .catch(err => {
    console.error('Erreur de chargement:', err);
  });
