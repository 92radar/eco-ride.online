<?php

require_once __DIR__ . '/../backend/accountBe.php';


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title>Espace Personnel</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/app.css">


</head>

<body>
    <?php include '../elements/navigation.php'; ?>

    <div class="m-20 pt-200"></br>
        
        <?php if (isset($success)) : ?>
            <div class="alert alert-success container" role="alert">
                <?= $success ?></br>
            </div>
        <?php endif; ?>
        <?php if (isset($error_chauffeur)) : ?>
            <div class="alert alert-danger container" role="alert">
                <?= $error_chauffeur ?></br>
            </div>
        <?php endif; ?>


        <?php if (isset($error)) : ?>
            <div class="alert alert-danger container" role="alert">
                <?= $error ?></br>
            </div>
        <?php endif; ?>

        <div class="profil">
            <?php if (!empty($userInfos)): ?>
                <?php foreach ($userInfos as $userInfo): ?>
                    <h1>Informations personnelles</h1>
                    <div class="profil-info" id="">

                        <form action="" method="post">
                            <div class="form-group">
                                <div class="profil-details">


                                </div>
                                <strong>Nom :</strong></br><input class="form-control" type="text" name="nom"
                                    value="<?= htmlspecialchars($userInfo->nom) ?>" required></br>
                                <strong>Prénom :</strong></br><input class="form-control" type="text" name="prenom"
                                    value="<?= htmlspecialchars($userInfo->prenom) ?>" required></br>
                                <strong>Pseudo :</strong></br><input class="form-control" type="text" name="pseudo"
                                    value="<?= htmlspecialchars($userInfo->pseudo) ?>" required></br>
                                <strong>Date de naissance :</strong></br><input class="form-control" type="date"
                                    name="date_naissance" value="<?= htmlspecialchars($userInfo->date_naissance) ?>"
                                    required></br>

                                <strong>Email :</strong></br><input class="form-control" type="email" name="email"
                                    value="<?= htmlspecialchars($userInfo->email) ?>" required></br>
                                <strong>Adresse :</strong></br><input class="form-control" type="text" name="adresse"
                                    value="<?= htmlspecialchars($userInfo->adresse) ?>" required></br>
                                <strong>
                                    Ville :</strong></br><input class="form-control" type="text" name="ville"
                                    value="<?= htmlspecialchars($userInfo->ville) ?>" required></br>
                                <strong>Numéro de téléphone :</strong></br><input class="form-control" type="text"
                                    name="telephone" value="<?= htmlspecialchars($userInfo->telephone) ?>" required></br>
                                <strong class="form-control">Nombre de credit restant :
                                    <?= htmlspecialchars($userInfo->credits) ?></strong></br>
                                <strong class="form-control">Note moyenne :


                                    <?= htmlspecialchars($userInfo->average_note) ?>⭐</strong></br>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucune information utilisateur trouvée.</p>
                        <?php endif; ?>
                        </br>
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <div class="center">
                            <button type="submit" name="modifier" class="btn btn-primary w-50">Modifier</button></br>
                        </div></br>
                        </form>
                        <form action="" class="flex center" method="post" enctype="multipart/form-data">
                            <label for="photo_profil">Modifier la photo de profil:</label>
                            <input type="file" id="photo_profil" name="photo_profil" accept="image/*">
                            <small>Formats acceptés: JPG, JPEG, PNG, GIF (max 5MB).</small>

                            <div class="center">
                                <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                            </div>
                        </form>


                    </div>
                    <hr style="border: .5px solid #4c6faf; margin: 20px 0;">


                    <h2>AJOUTER UN VEHICULE</h2> </br>
                    <div id="section3">
                        
                        <form action="" method="post">
                            <legend>Informations</legend>
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="form-group">
                                <label for="marque_vehicule">Marque du véhicule :</label>
                                <input type="text" class="form-control" name="marque" id="marque"
                                    placeholder="Marque de la voiture" required>
                                <label for="vehicule">Modele du véhicule :</label>
                                <input type="text" class="form-control" name="modele" id="modele"
                                    placeholder="modele de la voiture" required>
                            </div>

                            <div class="form-group">
                                <label for="couleur">Couleur :</label>
                                <input type="text" class="form-control" name="couleur" id="couleur_voiture"
                                    placeholder="Couleur du vehicule, ex: bleu" required>
                            </div>

                            <div class="form-group">
                                <label for="immatriculation">Immatriculation :</label>
                                <input type="text" class="form-control" name="immatriculation" id="immatriculation_vehicule"
                                    placeholder="Immatriculation" required>
                            </div>

                            <div class="form-group">
                                <label for="date_immatriculation">Date d'immatriculation :</label>
                                <input type="date" class="form-control" name="date_premiere_immatriculation"
                                    id="date_premiere_immatriculation" placeholder="Date de la premiere immatriculation"
                                    required>
                            </div>
                            <div class="form-group">

                                <label for="energie">Type de voiture :</label></br>
                                <select class="form-control" name="energie" id="energie" required>
                                    <option value="Essence">Essence</option>
                                    <option value="Hybride">Hybride</option>
                                    <option value="Electrique">Electrique</option>
                                </select></br>
                            </div>

                            <div class="center">
                                <button  type="submit" class="btn btn-primary w-50" name="ajouter_vehicule">Ajouter
                                un
                                vehicule</button>
                            </div>
                        </form>
                        
                    </div>
                    <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
                    <h2>Publier un trajet</h2> </br>
                    <div class="publier-trajet" id="section2">
                        <div class="publier-trajet-details">
                            <form action="" method="post">
                                <legend>Informations du trajet</legend>
                                <!-- CSRF Token -->
                                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                                <div class="form-group">
                                    <label for="voiture_id">Voiture :</label>
                                    <select class="form-control" id="voiture_id" name="voiture_id" required>
                                        <option value="">Sélectionner votre voiture</option>
                                        <?php if (!empty($voitureInfos)): ?>
                                            <?php foreach ($voitureInfos as $voitureInfo): ?>
                                                <option name="voiture_id" value="<?= htmlspecialchars($voitureInfo->voiture_id) ?>">
                                                    <?= htmlspecialchars($voitureInfo->modele) ?> (Immatriculation:
                                                    <?= htmlspecialchars($voitureInfo->immatriculation) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="" disabled>Vous n'avez pas de voiture enregistrée.</option>
                                        <?php endif; ?>
                                    </select>
                                    <?php if (empty($voitureInfos)): ?>
                                        <small class="form-text text-muted">Vous devez enregistrer une voiture dans votre <a
                                                href="/pages/account.php#section3">profil</a> avant de publier un
                                            trajet.</small>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="depart">Ville de départ :</label>
                                    <input type="text" class="form-control" name="lieu_depart" id="depart"
                                        placeholder="Ville de départ" required>
                                </div>

                                <div class="form-group">
                                    <label for="arrivee">Ville d'arrivée :</label>
                                    <input type="text" class="form-control" name="lieu_arrivee" id="arrivee"
                                        placeholder="Ville d'arrivée" required>
                                </div>

                                <div class="form-group">
                                    <label for="date_depart">Date de départ :</label>
                                    <input type="date" class="form-control" name="date_depart" id="date_depart"
                                        placeholder="Date de départ" required>
                                </div>

                                <div class="form-group">
                                    <label for="heure_depart">Heure de départ :</label>
                                    <input type="time" class="form-control" name="heure_depart" id="heure_depart"
                                        placeholder="Heure de départ" required>
                                </div>

                                <div class="form-group">
                                    <label for="date_arrivee">Date d'arrivée :</label>
                                    <input type="date" class="form-control" name="date_arrivee" id="date_arrivee"
                                        placeholder="Date d'arrivée" required>

                                </div>

                                <div class="form-group">
                                    <label for="heure_arrivee">Heure d'arrivée :</label>
                                    <input type="time" class="form-control" name="heure_arrivee" id="heure_arrivee"
                                        placeholder="Heure d'arrivée" required>
                                    <small class="form-text text-muted">approximatif.</small>
                                </div>

                                <div class="form-group">
                                    <label for="prix_personne">Prix par personne (en crédits) :</label>
                                    <input type="number" class="form-control" name="prix_personne" id="prix" placeholder="Prix"
                                        min="0" required>
                                </div>

                                <div class="form-group">
                                    <label for="nb_place">Nombre de places disponibles :</label>
                                    <input type="number" class="form-control" name="nb_place" id="places"
                                        placeholder="Nombre de places" min="1" required>
                                </div>

                                <div class="form-group">
                                    <label for="commentaire">Informations complémentaires :</label>
                                    <textarea class="form-control" name="commentaire" id="commentaire" rows="3"
                                        placeholder="Ajoutez un commentaire (ex: détails sur le point de rencontre, etc.)"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="prix_publication">Nombre de credit prelevé pour publication d'un trajet
                                        :</label>
                                    <strong type="number" class="form-control" id="prix_publication">2</strong>
                                    <input type="hidden" type="number" name="prix_publication" id="prix_publication" value="2">
                                </div></br>

                                <div class="center">
                                    <button type="submit" class="btn btn-primary w-50" name="publier_trajet"
                                        <?php if (empty($voitureInfos)) echo 'disabled'; ?>>
                                        Publier le trajet
                                    </button>
                                </div>
                            </form>
                        </div>



                    </div></br>
        </div>
        <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
        <h2 id="section4">Historique des trajets en tant que voyageur</h2>
        <div class="c-container">
            <ul>

                <?php if (!empty($historiqueCovoiturages)) : ?>
                    <?php foreach ($historiqueCovoiturages as $covoiturages): ?>
                        <li>
                            <i class="fas fa-location-arrow"></i>&nbsp;<strong>Départ :</strong>
                            <?= htmlspecialchars($covoiturages->lieu_depart) ?><br />

                            <i class="fas fa-home f"></i>&nbsp;<strong>Arrivée :</strong>
                            <?= htmlspecialchars($covoiturages->lieu_arrivee) ?><br />

                            <i class="fas fa-calendar-day"></i>&nbsp;<strong>Date
                                :</strong><?= htmlspecialchars($covoiturages->date_depart) ?><br />

                            <i class="fas fa-info-circle"></i>&nbsp;<strong>Statut
                                :</strong><?= htmlspecialchars($covoiturages->statut) ?>


                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Vous n'avez pas de covoiturage en cours.</p>
                    <?php endif; ?>
                        </li>
            </ul>
            <div class="dots"></div>
        </div>

        <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
        <h2 id="section5">Co-voiturage en tant que chauffeur</h2>

        <div class="c-container">


            <ul>
                <?php if (!empty($covoituragesEnCours)) : ?>
                    <?php foreach ($covoituragesEnCours as $covoiturage): ?>
                
                        <li>
                        

                            <div class="publication">
                                <i
                                    class="fas fa-calendar-day"></i><?= htmlspecialchars(date('d/m/Y', strtotime($covoiturage->date_depart))) ?><br />

                                <p>
                                    <i class="fas fa-location-arrow"></i><strong>Départ :</strong>
                                    <?= htmlspecialchars($covoiturage->lieu_depart) ?> à
                                    <?= htmlspecialchars(date('H:i', strtotime($covoiturage->heure_depart))) ?> h

                                    <i class="fas fa-arrow-right"></i>
                                    <strong>Arrivée :</strong> <?= htmlspecialchars($covoiturage->lieu_arrivee) ?> à
                                    <?= htmlspecialchars(date('H:i', strtotime($covoiturage->heure_arrivee))) ?> h<br />
                                    <strong>Durée du trajet :</strong> <?= htmlspecialchars($covoiturage->duree) ?>
                                </p>





                                <div class="separator"></div>
                                <p>
                                    <i class="fas fa-car"></i>voiture :</strong>
                                    <?= htmlspecialchars($covoiturage->energie) ?>
                                    <i class="fas fa-arrow-right"></i>
                                    <strong>Places disponibles :</strong>
                                    <?= htmlspecialchars($covoiturage->nb_place) ?>
                                    <i class="fas fa-arrow-right"></i>
                                    <strong>Prix par place :</strong>
                                    <?= htmlspecialchars($covoiturage->prix_personne) ?>
                                    Credits
                                </p>
                            </div><br />

                            <div class="publication-actions">
                                <form method="post">
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                                    <input type="hidden" name="covoiturage_id"
                                        value="<?= htmlspecialchars($covoiturage->covoiturage_id) ?>">
                                    <button type="submit" name="demarrer_trajet" class="btn btn-success"
                                        <?= ($covoiturage->statut !== 'en_attente') ? 'disabled' : '' ?>>
                                        Démarrer le trajet
                                    </button>
                                    <button type="submit" name="terminer_trajet" class="btn btn-danger"
                                        <?= ($covoiturage->statut !== 'en_cours') ? 'disabled' : '' ?>>
                                        Terminer le trajet
                                    </button>
                                    <input type="hidden" type="number" name="prix_publication" id="prix_publication" value="2">
                                    <button type="submit" name="annuler_trajet" class="btn btn-warning"
                                        <?= ($covoiturage->statut !== 'en_attente') ? 'disabled' : '' ?>>
                                        Annuler le trajet
                                    </button>
                                </form>
                            </div>

                        
                        </li>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <p>Vous n'avez pas de covoiturage en cours.</p>
                <?php endif; ?>
            </ul>
            <div class="dots"></div>


        </div>
    </div>

    </div>

    <hr style="border: .5px solid #4c6faf; width: 90%; margin: 20px auto;">



    <?php foreach ($resultats as $resultat) : ?>
        <?php if ($resultat->statut === "terminer") : ?>
            <div class="publication-cadre">


                <div class="publication">

                    <i
                        class="fas fa-calendar-day"></i>&nbsp;<?= htmlspecialchars(date('d/m/Y', strtotime($resultat->date_depart))) ?><br />
                    <i class="fas fa-location-arrow"></i> <strong>Départ :</strong>
                    <?= htmlspecialchars($resultat->lieu_depart) ?> à
                    <?= htmlspecialchars(date('H:i', strtotime($resultat->heure_depart))) ?> h
                    <i class="fas fa-arrow-right"></i><strong>Arrivée :</strong>
                    <?= htmlspecialchars($resultat->lieu_arrivee) ?> à
                    <?= htmlspecialchars(date('H:i', strtotime($resultat->heure_arrivee))) ?> h

                    </p>
                </div>






                    <form class="center flex m-20" method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="covoiturage_id" value="<?= htmlspecialchars($resultat->covoiturage_id) ?>">
                        <input type="hidden" type="number" name="prix_personne"
                            value="<?= htmlspecialchars($resultat->prix_personne) ?>">
                        <input type="hidden" name="chauffeur_id" value="<?= htmlspecialchars($resultat->chauffeur_id) ?>">
                        <div class="form-group  w-100 p-10">
                            <label for="note">Note (sur 5) :</label>
                            <select class="form-control" name="note" id="note">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <label for="commentaire">Commentaire :</label>
                            <textarea class="form-control" name="commentaire" id="commentaire" rows="3"></textarea>
                        </div>
                        <button type="submit" name="poster_avis" class="btn btn-success w-50 ">Poster votre
                            avis</button>
                    </form>
            </div></br>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <footer>
        <div class="footer-content">
            <h2>ECORIDE</h2>
            <p>Rejoignez-nous dans notre mission pour un avenir plus vert et plus durable. Ensemble, nous
                pouvons faire la différence.</p>

        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 ECORIDE. designed by <span>Driss</span> <a
                    href="https://www.instagram.com/drissbnkiran?igsh=MWpsaTBqNjlsc2EycQ==" target="_blank"
                    rel="noopener">
                    <i class="fab fa-instagram fa-2x icon"></i>
                </a></p>
        </div>
    </footer>
    <script>
        // disparition automatique de l'alerte
        setTimeout(function() {
            var alert = document.querySelector('.alert-success');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500); 
            }
        }, 3000); 
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dateDepartInput = document.getElementById("date_depart");
            const dateArriveeInput = document.getElementById("date_arrivee");
            const today = new Date();

            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // mois 0-indexé
            const day = String(today.getDate()).padStart(2, '0');

            const minDate = `${year}-${month}-${day}`;
            dateDepartInput.min = minDate;
            dateArriveeInput.min = minDate;
        });
        document.addEventListener('DOMContentLoaded', () => {
            // Tous les carousels
            const carousels = document.querySelectorAll('.c-container, .avis');

            carousels.forEach(carousel => {
                const slides = carousel.querySelectorAll('ul li');
                const dotsContainer = carousel.querySelector('.dots');
                const viewport = carousel.querySelector('ul');

                // Créer les points
                slides.forEach((slide, i) => {
                    const dot = document.createElement('button');
                    if (i === 0) dot.classList.add('active');
                    dot.addEventListener('click', () => {
                        slide.scrollIntoView({
                            behavior: 'smooth',
                            inline: 'center'
                        });
                        setActiveDot(i);
                    });
                    dotsContainer.appendChild(dot);
                });

                function setActiveDot(index) {
                    const dots = dotsContainer.querySelectorAll('button');
                    dots.forEach(d => d.classList.remove('active'));
                    dots[index].classList.add('active');
                }

                viewport.addEventListener('scroll', () => {
                    const center = viewport.scrollLeft + viewport.offsetWidth / 2;
                    let activeIndex = 0;
                    slides.forEach((slide, i) => {
                        const slideCenter = slide.offsetLeft + slide.offsetWidth /
                            2;
                        if (Math.abs(center - slideCenter) < Math.abs(center - (
                                slides[
                                    activeIndex].offsetLeft + slides[
                                    activeIndex]
                                .offsetWidth / 2))) {
                            activeIndex = i;
                        }
                    });
                    setActiveDot(activeIndex);
                });
            });
        });
    </script>



    <script src="../JS/navbarOnScroll.js"></script>
    <script src="../JS/toggleResearch.js"></script>
</body>


</html>