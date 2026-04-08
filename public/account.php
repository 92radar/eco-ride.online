<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: https://eco-ride.online');
    exit;
}

require_once __DIR__ . '/../backend/accountBe.php';










?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Espace Personnel</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/profile-1.css">
    <link rel="stylesheet" href="../styles/account.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/homecopy.css">
    <link rel="stylesheet" href="../styles/research.css">
    <link rel="stylesheet" href="../styles/font.css">

    <link rel="stylesheet" href="../styles/covoiturage.css">


</head>
<style>
    .profil-header {
        padding-top: 210px;
        margin: 10px;
    }

    .profil {
        max-width: 100%;
        margin: 30px auto;
    }


    .profil button {
        width: 100%;
        padding: 10px;
        background-color: #4c6faf;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .profil-header button {
        width: 100%;
        padding: 10px;
        background-color: #4c6faf;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    input[type="file"] {
        display: block;
        border: solid 1px #4c6faf;
        border-radius: 20px;
        color: black;
    }

    @media (max-width: 930px) {
        .sidebar {
            display: none;
        }

        .logout-form {
            display: block;
        }
    }




    li {

        text-decoration: none;
        color: white;
    }

    a {
        text-decoration: none;
        color: black;
    }

    .mobile-nav {
        z-index: 1000;
    }

    .avis-form h1 {
        font-size: 24px;
        color: #000000;

    }

    .avis-form h1:hover {
        font-size: 24px;
        color: #000000;
        text-decoration: none;

    }
/* 
    .c-container {
        margin-top: 0;
        margin-left: 5px auto;

        padding: 10px;


    }
        /*  */

    @keyframes bounceIn {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        50% {
            transform: scale(1.2);
            opacity: 1;
        }

        100% {
            transform: scale(1);
        }
    }

    .header-profile-picture {
        position: absolute;
        top: 20px;
        right: 10px;


    }

    .header-profile-picture img {
        object-fit: cover;
        width: 55px;
        height: 55px;
    }
</style>

<body>
    <nav>
        <div id="brand">
            <div class="eco-ride">
                <h1>ECORIDE</h1>
            </div>
            <div class="header-profile-picture">
                <?php if (isset($_SESSION['photo'])): ?>
                    <img src="/backend/image.php" alt="Photo de profil" class="photo-utilisateur" height="50" width="50">

                <?php endif; ?>

            </div>



            <div id="word-mark">
                <div class="recherche-container">
                    <form action="/covoiturage" method="get" class="form">
                        <div class="recherche-multicriteres text-black">
                            <label for="depart"></label><i class="fas fa-location-arrow"></i>&nbsp;
                            <input type="text" class="depart" name="depart" title="Choisir une ville de départ"
                                placeholder="Ville de départ">
                            <label for="arrivee"></label>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            <input type="text" class="arrivee" name="arrivee" title="Choisir une ville d'arrivée"
                                placeholder="Ville d'arrivée">
                            <label for="date_depart"></label>
                            <i class="fa-solid fa-calendar-days"></i>&nbsp;
                            <input type="date" class="date_depart" name="date" class="iconRecherche"
                                title="Choisir une date de départ">
                            <button type="submit" name="search" class="iconRecherche" aria-label="Rechercher"
                                style="float: right;">
                                <i class="fas fa-search"></i>

                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div id="menu">
                <!-- Menu Burger -->
                <div id="menu-toggle">
                    <div id="menu-icon">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>

                <!-- Menu Classique -->
                <ul>
                    <li>
                        <a href="/"><i class="fas fa-home f"></i><span>Accueil</span></a>
                    </li>
                    <?php if (!isset($_SESSION['role'])): ?>
                        <!-- Affiché seulement si l'utilisateur n'est pas connecté -->
                        <li class="active">
                            <a href="/login"><i class="fas fa-home f"></i><span>Connexion</span></a>
                        </li>
                        <li>
                            <a href="../register"><i class="fas fa-key"></i><span>Inscription</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role'])): ?>
                        <?php if ($_SESSION['role'] === 'employee'): ?>
                            <li><a class="dropdown-item" href="/employee"><i class="fas fa-user"></i></i>Espace
                                    employés</a></li>
                        <?php elseif ($_SESSION['role'] === 'user'): ?>
                            <li><a class="dropdown-item" href="/account"><i class="fas fa-user"></i></i>Profil</a>
                            </li>
                        <?php elseif ($_SESSION['role'] === 'admin'): ?>
                            <li><a class="dropdown-item" href="/admin"><i class="fas fa-user"></i></i>Espace
                                    admin</a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <form method="post" style="display:inline;">
                                <button class="dropdown-item" name="logout"><i
                                        class="fas fa-sign-out-alt"></i>Déconnexion</button>
                            </form>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="#"><i class="fas fa-info-circle"></i><span>A propos</span></a>
                    </li>
                </ul>


            </div>
    </nav>


    <div class="profil-header"></br>
        <form method="post" class="logout-form" type="hidden">
            <button type="submit" name="logout" class="logout-btn">Se déconnecter</button>
        </form>
        <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
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
                    <h3>Informations personnelles</h3>
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
                        <div class="profil-actions">
                            <button type="submit" name="modifier" class="profil-btn">Modifier</button></br>

                        </div></br>
                        </form>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="photo_profil">Modifier la photo de profil:</label></br>
                            <input type="file" id="photo_profil" name="photo_profil" accept="image/*"></br>
                            <small>Formats acceptés: JPG, JPEG, PNG, GIF (max 5MB).</small></br>
                            <button type="submit" name="upload" class="upload-btn">Upload</button></br>
                        </form>


                    </div>
                    <hr style="border: .5px solid #4c6faf; margin: 20px 0;">


                    <h3>AJOUTER UN VEHICULE</h3> </br>
                    <div class="devenir-chauffeur" id="section3">
                        <div class="devenir-chauffeur-details">
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



                                <div class="devenir-chauffeur-actions">
                                    <button class="devenir-chauffeur-btn" type="submit" name="ajouter_vehicule">Ajouter
                                        un
                                        vehicule</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
                    <h3>Publier un trajet</h3> </br>
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

                                <div class="publier-trajet-actions">
                                    <button type="submit" class="btn btn-primary publier-trajet-btn" name="publier_trajet"
                                        <?php if (empty($voitureInfos)) echo 'disabled'; ?>>
                                        Publier le trajet
                                    </button>
                                </div>
                            </form>
                        </div>



                    </div></br>
        </div>
        <hr style="border: .5px solid #4c6faf; margin: 20px 0;">
        <h3 id="section4">Historique des trajets en tant que voyageur</h3>
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

                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Vous n'avez pas de covoiturage en cours.</p>
                    <?php endif; ?>

                        </li>
            </ul>
            <div class="dots"></div>





        </div>
    </div>

    </div>

    <hr style="border: .5px solid #4c6faf; margin: 20px 0;">



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





                <div class="avis-form">

                    <form method="post">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="covoiturage_id" value="<?= htmlspecialchars($resultat->covoiturage_id) ?>">
                        <input type="hidden" type="number" name="prix_personne"
                            value="<?= htmlspecialchars($resultat->prix_personne) ?>">
                        <input type="hidden" name="chauffeur_id" value="<?= htmlspecialchars($resultat->chauffeur_id) ?>">
                        <div class="form-group">
                            <label for="note">Note (sur 5) :</label>
                            <select class="form-control" name="note" id="note">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="commentaire">Commentaire :</label>
                            <textarea class="form-control" name="commentaire" id="commentaire" rows="3"></textarea>
                        </div>
                        <button type="submit" name="poster_avis" class="btn btn-success">Poster votre
                            avis</button>
                    </form>
                </div>
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

                // Mettre à jour le point actif lors du scroll
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