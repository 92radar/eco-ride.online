
//affiche les avis sans recharger la page

document.addEventListener('DOMContentLoaded', function () {


    const selectAvis = document.getElementById('avis_id');
    const avisDetails = document.getElementById('avisDetails');

    if (!selectAvis || !avisDetails) {
        console.error('Élément manquant : #avis_id ou #avisDetails');
        return;
    }

    selectAvis.addEventListener('change', async function () {
        const avisId = this.value;

        if (!avisId) {
            avisDetails.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`../backend/fetchAvis.php?avis_id=${avisId}`);
            if (!response.ok) throw new Error(
                'Erreur lors de la récupération des données');

            const data = await response.json();
            if (data.error) throw new Error(data.error);

            avisDetails.innerHTML = `
                <form id="formChangerStatut">
                    <label for="statut_avis">Changer le statut de l'avis :</label>
                    <select class="form-control" id="statut_avis" name="statut_avis">
                        <option value="en_attente" ${data.statut_avis === 'en_attente' ? 'selected' : ''}>En attente</option>
                        <option value="validé" ${data.statut_avis === 'validé' ? 'selected' : ''}>Accepté</option>
                        <option value="refuser" ${data.statut_avis === 'refuser' ? 'selected' : ''}>Refusé</option>
                    </select>

                    <input type="hidden" name="avis_id" value="${data.avis_id}">

                    <strong>Commentaire :</strong><br>
                    <textarea class="form-control" name="commentaire" rows="4" required>${data.commentaire}</textarea><br>

                    <strong class="form-control">Note : ${data.note}</strong><br>

                    <button type="submit" class="btn btn-primary">Changer le statut</button>
                </form>
            `;
        } catch (error) {
            alert(error.message);
        }
    });
});

document.getElementById('avisDetails').addEventListener('submit', async function (event) {
    if (event.target && event.target.id === 'formChangerStatut') {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);
        let alert = document.querySelector('.alert-success');

        if (!alert) {
            alert = document.createElement('div');
            alert.classList.add('alert', 'alert-success');
            alert.style.opacity = '0';  // Initialiser l'alerte comme invisible
            document.body.appendChild(alert);  // Ou l'ajouter dans un autre conteneur
        }
        try {
            const response = await fetch('../backend/updateAvisStatus.php', {
                method: 'POST',
                body: formData
            });
            if (!response.ok) throw new Error('Erreur lors de la mise à jour du statut');
            const result = await response.json();
            if (result.success) {
                avisDetails.innerHTML = '';
                const messageText = result.message || 'Statut mis à jour avec succès';
                if (alert) {
                    alert.textContent = messageText;
                    alert.style.opacity = '1';
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 3000);
                } else {
                    throw new Error(result.error || 'Erreur inconnue');
                }
            } else {
                throw new Error(result.error || 'Erreur inconnue');
            }
        } catch (error) {
            alert.textContent = error.message;
            alert.style.opacity = '1';
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        }
    }
});

//verifier les avis dynamiquement 
document.addEventListener('DOMContentLoaded', function () {
    const selectVerifiedAvis = document.getElementById('verifiedavis_id');
    const avisDetailsDiv = document.getElementById('avisVerifieDetails');
    let alert = document.querySelector('.alert-success');

    if (!alert) {
        alert = document.createElement('div');
        alert.classList.add('alert', 'alert-success');
        alert.style.opacity = '0';  // Initialiser l'alerte comme invisible
        document.body.appendChild(alert);  // Ou l'ajouter dans un autre conteneur
    }

    if (!selectVerifiedAvis) {
        console.error('Élément manquant : #verifiedavis_id');
        return;
    }

    selectVerifiedAvis.addEventListener('change', async function () {
        const avisId = this.value;

        if (!avisId) {
            avisDetailsDiv.innerHTML = '';
            return;
        }

        try {
            const response = await fetch(`../backend/fetchAvis.php?avis_id=${avisId}`);
            if (!response.ok) throw new Error(
                'Erreur lors de la récupération des données');

            const data = await response.json();
            if (data.error) throw new Error(data.error);

            // Affiche dynamiquement les détails et le formulaire dans avisVerifieDetails
            avisDetailsDiv.innerHTML = `
                <form id="formChangerStatutVerifie">
                    <label for="statut_avis_verifie">Changer le statut de l'avis :</label>
                    <select class="form-control" id="statut_avis_verifie" name="statut_avis">
                        <option value="en_attente" ${data.statut_avis === 'en_attente' ? 'selected' : ''}>En attente</option>
                        <option value="validé" ${data.statut_avis === 'validé' ? 'selected' : ''}>Accepté</option>
                        <option value="refuser" ${data.statut_avis === 'refuser' ? 'selected' : ''}>Refusé</option>
                    </select>

                    <input type="hidden" name="avis_id" value="${data.avis_id}">

                    <strong>Commentaire :</strong><br>
                    <textarea class="form-control" name="commentaire" rows="4" required>${data.commentaire}</textarea><br>

                    <strong class="form-control">Note : ${data.note}</strong><br>

                    <button type="submit" class="btn btn-primary">Changer le statut</button>
                </form>
            `;
        } catch (error) {
            avisDetailsDiv.innerHTML = `<p class="text-danger">${error.message}</p>`;
        }
    });

    // Gestion du submit AJAX pour mise à jour
    document.getElementById('avisVerifieDetails').addEventListener('submit', async function (event) {
        if (event.target && event.target.id === 'formChangerStatutVerifie') {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            let alert = document.querySelector('.alert-success');

            if (!alert) {
                alert = document.createElement('div');
                alert.classList.add('alert', 'alert-success');
                alert.style.opacity = '0';  // Initialiser l'alerte comme invisible
                document.body.appendChild(alert);  // Ou l'ajouter dans un autre conteneur
            }
            try {
                const response = await fetch('../backend/updateAvisStatus.php', {
                    method: 'POST',
                    body: formData
                });
                if (!response.ok) throw new Error(
                    'Erreur lors de la mise à jour du statut');
                const result = await response.json();
                if (result.success) {
                    avisDetailsDiv.innerHTML = '';
                    const messageText = result.message ||
                        'Statut mis à jour avec succès';
                    if (alert) {
                        alert.textContent = messageText;
                        alert.style.opacity = '1';
                        setTimeout(() => {
                            alert.style.opacity = '0';
                            setTimeout(() => alert.remove(), 500);
                        }, 3000);
                    } else {
                        throw new Error(result.error || 'Erreur inconnue');
                    }
                } else {
                    throw new Error(result.error || 'Erreur inconnue');
                }
            } catch (error) {
                alert.textContent = error.message;
                alert.style.opacity = '1';
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        }
    });
});

