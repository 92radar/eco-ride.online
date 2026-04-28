// afficher le bouton apres remplissage des champs pour envoyer la recherche 

document.addEventListener('DOMContentLoaded', function () {
    const departInput = document.querySelector('.depart');
    const arriveeInput = document.querySelector('.arrivee');
    const dateInput = document.querySelector('.date_depart');
    const submitBtn = document.querySelector('#submitSearchBtn');

    function checkFieldsFilled() {
        const depart = departInput.value.trim();
        const arrivee = arriveeInput.value.trim();
        const date = dateInput.value.trim();

        if (depart && arrivee && date) {
            submitBtn.classList.remove('hide');
            submitBtn.classList.add('show');
        } else {
            submitBtn.classList.remove('show');
            submitBtn.classList.add('hide');
        }
    }

    // Écoute chaque champ
    [departInput, arriveeInput, dateInput].forEach(input => {
        input.addEventListener('input', checkFieldsFilled);
    });

    // Vérifie au chargement si les champs sont déjà remplis
    checkFieldsFilled();
});


// date minimum pour le champ date
document.addEventListener("DOMContentLoaded", () => {
    const dateDepartInput = document.getElementById("date_depart");

    const today = new Date();

    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // mois 0-indexé
    const day = String(today.getDate()).padStart(2, '0');

    const minDate = `${year}-${month}-${day}`;

    if (!dateDepartInput || minDate === "NaN-NaN-NaN") {
        return;
    }

    dateDepartInput.setAttribute("min", minDate);

    console.log("Date minimum définie pour le champ date_depart :", minDate);


});