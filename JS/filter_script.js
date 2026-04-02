
document.addEventListener("DOMContentLoaded", function () {
    const applyFiltersBtn = document.getElementById("applyFiltersBtn");
    const resultsContainer = document.querySelectorAll(".publication");

    applyFiltersBtn.addEventListener("click", function (event) {
        event.preventDefault();

        // Carburant sélectionné
        const selectedTypes = Array.from(document.querySelectorAll("input[name='carburant']:checked"))
            .map(input => input.value);

        // Prix min / max
        const minPrice = parseFloat(document.getElementById("prixmini").value) || 0;
        const maxPrice = parseFloat(document.getElementById("prixmaxi").value) || Infinity;

        // Durée max (en minutes)
        const maxDuration = parseInt(document.getElementById("dureeMax").value) || Infinity;

        // Évaluations sélectionnées
        const selectedRatings = Array.from(document.querySelectorAll("input[name='evaluation']:checked"))
            .map(input => parseInt(input.value));

        resultsContainer.forEach(result => {
            const carType = result.querySelector(".energie").textContent.trim();
            const price = parseFloat(result.querySelector(".prix").textContent.replace(",", ".").replace(/[^0-9.]/g, ""));
            const duration = parseInt(result.querySelector(".duree").dataset.minutes); // ⚠️ tu dois mettre un data-minutes

            const rating = parseInt(result.querySelector(".note").textContent.trim());

            let show = true;

            if (selectedTypes.length > 0 && !selectedTypes.includes(carType)) {
                show = false;
            }

            if (price < minPrice || price > maxPrice) {
                show = false;
            }

            if (duration > maxDuration) {
                show = false;
            }

            if (selectedRatings.length > 0 && !selectedRatings.includes(rating)) {
                show = false;
            }

            result.style.display = show ? "block" : "none";
        });
    });
});

