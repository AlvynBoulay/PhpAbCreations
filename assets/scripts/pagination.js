const items = [
  {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
  {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
  {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
    {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
    {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
    {
    image: 'images/imgCreation/img1.jpg',
    alt: 'Echo du soir',
    link: 'detailscreation.html',
  },
];

const itemsPerPage = 4; // Afficher 2 créations par page
const totalItems = items.length;
const totalPages = Math.ceil(totalItems / itemsPerPage);

const contentEl = document.querySelector('.creations-list');
const paginationEl = document.querySelector('.pagination');
const pagesContainer = paginationEl.querySelector('.page-buttons-container');

function displayItems(page) {
  const start = (page - 1) * itemsPerPage;
  const slice = items.slice(start, start + itemsPerPage);

  contentEl.innerHTML = slice.map(item => `
    <div class="creation-card">
      <img src="${item.image}" alt="${item.alt}" />
      <a href="${item.link}">
        <button class="details-button">Voir les détails</button>
      </a>
    </div>
  `).join('');
}

function renderPageButtons(currentPage) {
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
  renderPageButtons(currentPage);
  paginationEl.querySelector('.prev-button').disabled = currentPage === 1;
  paginationEl.querySelector('.next-button').disabled = currentPage === totalPages;
}

paginationEl.addEventListener('click', e => {
  if (e.target.matches('.page-button')) {
    goToPage(Number(e.target.textContent));
  } else if (e.target.matches('.prev-button')) {
    const cur = +paginationEl.querySelector('.page-button.active').textContent;
    goToPage(cur - 1);
  } else if (e.target.matches('.next-button')) {
    const cur = +paginationEl.querySelector('.page-button.active').textContent;
    goToPage(cur + 1);
  }
});

function goToPage(page) {
  if (page < 1 || page > totalPages) return;
  displayItems(page);
  updatePagination(page);
}

// Lancement initial
goToPage(1);
