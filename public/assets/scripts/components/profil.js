document.addEventListener('DOMContentLoaded', () => {
    const btnShowForm = document.getElementById('btnShowForm');
    const btnCancel = document.getElementById('btnCancel');
    const profileCard = document.querySelector('.profile-card');

    console.log('btnShowForm:', btnShowForm);
    console.log('btnCancel:', btnCancel);
    console.log('profileCard:', profileCard);

    if (!btnShowForm || !btnCancel || !profileCard) {
        console.warn("Un ou plusieurs éléments sont introuvables dans le DOM.");
        return;
    }

    btnShowForm.addEventListener('click', () => {
        profileCard.classList.add('editing');
        console.log("Classe 'editing' ajoutée !");
    });

    btnCancel.addEventListener('click', () => {
        profileCard.classList.remove('editing');
        console.log("Classe 'editing' retirée !");
    });
});
