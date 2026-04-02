<?php
session_start();
require_once '/home/clients/5afa198c535310a01279d2a30398c842/sites/eco-ride.online/backend/covoiturageBe.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
    <title>Recherche de covoiturage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/profile-1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/homecopy.css">
    <link rel="stylesheet" href="../styles/research.css">
    <link rel="stylesheet" href="../styles/font.css">
    <link rel="stylesheet" href="../styles/account.css">
    <link rel="stylesheet" href="../styles/covoiturage.css">
    <link rel="stylesheet" href="../styles/animation.css">
    <link rel="stylesheet" href="../styles/footer.css">


</head>



<style>
    body {
        max-width: 100%;
    }

    input,
    textarea,
    select {
        background-color: #ffffff;
        /* blanc */
        color: #000000;
        /* texte noir */

    }

    .recherche-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        transform: none;
        max-width: 100%;
        transition: opacity 0.5s ease;
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        color: #ffffff;
    }

    .eco-ride {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
        transition: opacity 0.5s ease;
        font-size: 3em;
        font-weight: lighter;
        color: #ffffff;
        display: none;
        text-decoration: none;

    }



    .eco-ride.show {
        display: block;
    }

    .content-researched {
        padding-top: 210px;

        width: 100%;
        max-width: 100%;
    }


    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 #4c6faf;
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 0 10px #4c6faf;
        }

        100% {
            transform: scale(1);
            box-shadow: 0 0 0 #4c6faf;
        }
    }



    .burger-button {
        position: fixed;
        /* Pour qu’il soit toujours visible */
        bottom: 10px;
        /* Ajuste en fonction de ton header */
        right: 20px;
        z-index: 1100;
        /* Plus que la sidebar (qui est à 1000) */

        padding: 10px;
        height: 85px;
        width: 85px;
        font-size: 18px;
        background-color: white;
        color: black;
        border: solid 2px #4c6faf;
        border-radius: 50%;
        cursor: grab;
        animation: pulse 2s infinite;
        -webkit-tap-highlight-color: transparent;
    }

    .burger-button .fas {
        color: #4c6faf;
    }

    @media screen and (max-width: 968px) {




        /* Style bouton burger */
        .burger-button {

            position: fixed;
            /* Pour qu’il soit toujours visible */
            bottom: 10px;
            /* Ajuste en fonction de ton header */
            right: 20px;
            z-index: 1000;
            /* Plus que la sidebar (qui est à 1000) */

            padding: 10px;
            height: 85px;
            width: 85px;
            font-size: 18px;
            background-color: white;
            color: black;
            border: solid 1px #4c6faf;
            border-radius: 50%;
            cursor: grab;
            animation: pulse 2s infinite;
            -webkit-tap-highlight-color: transparent;


        }

        .burger-button .fas {
            color: #4c6faf;
        }


    }



    .fas {
        color: white;
    }

    nav span {
        color: white;
    }

    .recherche-container .fas {
        color: #000000;
    }

    .menu-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 35px;
        background: white;
        color: black;
        border: 1px solid black;
        border-radius: 8px;

        min-width: 150px;
        z-index: 10;
        flex-direction: column;
    }

    .menu-dropdown button {
        background: transparent;
        border: none;
        padding: 10px;
        text-align: left;
        width: 100%;
        cursor: pointer;
        color: black;
    }

    .menu-dropdown button:hover {
        background: rgb(233, 232, 232);
    }

    .publication .menu-container {
        position: absolute;
        top: 0px;
        right: 2px;
        z-index: 10;
    }

    .menu-btn {
        background: transparent;

        border: none;
        font-size: 18px;
        cursor: pointer;
        color: #555;
        font-weight: bold;
        /* gris par défaut */



        padding: 4px 8px;
        border-radius: 25%;
        transition: background 0.2s, color 0.2s;
    }

    .menu-btn:hover {
        background: #f0f0f0;
        color: #000;


    }

    .publication-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 1em;
        color: #555;


    }

    .publication-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .profile-picture {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #ccc;
        /* Placeholder */
        margin-right: 10px;
        overflow: hidden;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info {
        flex-grow: 1;
    }

    .author-name {
        font-weight: bold;
        margin-bottom: 2px;
    }

    .publication-date {
        font-size: 0.8em;
        color: #777;
    }

    .publication {
        background-color: #fff;
        border-radius: 8px;
        border: solid 1px #3b3939;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        word-break: break-word;
        width: 90%;
        margin: 20px auto;
        /* Empêche les longs mots de casser la mise en page */
    }

    .separator {
        border-bottom: 1px solid #ddd;
        margin: 10px 0;
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }

    .publication .fas {
        color: #555;
    }

    .participer-btn {
        width: 100%;
        max-width: 100%;
        margin: 10px auto;
        padding: 10px;
        background-color: #4c6faf;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    nav li {

        text-decoration: none;
        color: white;
    }

    .filter-container {
        position: absolute;
        max-width: 300px;
        border: solid 1px #3b3939;
        border-radius: 8px;
        padding: 15px;
        z-index: 9;
        background-color: #f9f9f9;
        margin: 5px;
        top: 320px;
        height: 100%;
        max-height: 100%;
        display: none;
        animation: wobble 0.5s;


    }

    @keyframes wobble {
        0% {
            transform: translateX(100%);
        }

        50% {
            transform: translateX(-10%);
        }

        100% {
            transform: translateX(0);
        }
    }

    .filter-container.active {
        display: block;
    }



    .apply-filters-button {
        width: 100%;
        padding: 10px;
        background-color: white;
        color: black;
        border: solid 1px #4c6faf;
        border-radius: 20px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    .message {
        width: 90%;
        max-width: 100%;
        margin: auto;
    }

    footer {
        color: white;
        text-align: center;
        padding: 20px;
        background-color: #4c6faf;
        border-top: solid 1px #3b3939;
        font-weight: lighter;
    }

    .filter-group .fas {
        color: #4c6faf;
    }

    .note .fas {
        color: #4c6faf;
    }

    .iconRecherche {
        display: none;


    }

    .iconRecherche.show {
        animation: bounceIn 0.5s;
        display: block;
    }

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

    .burger-button {
        cursor: grab;
        touch-action: none;

    }
</style>





<body>
    <nav>
        <div id="brand">
            <div class="eco-ride">
                <h1>ECORIDE</h1>
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
                            <input type="date" class="date_depart" name="date" title="Choisir une date de départ">
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


    <button id="toggleSidebar" class="burger-button"><i class="fas fa-bars"></i>&nbsp;Filtres</button>





    <div class="filter-container">
        <form action="" method="post">
            <div class="filter-group">
                <label>Type de voiture</label></br>
                <input type="checkbox" name="carburant" value="Electrique">
                <label class="form-check-label" for="moteurElectrique">
                    Electrique
                </label></br>
                <input type="checkbox" name="carburant" value="Hybride">
                <label class="form-check-label" for="moteurHybride">
                    Hybride
                </label></br>
                <input type="checkbox" name="carburant" value="Essence">
                <label class="form-check-label" for="moteurEssence">
                    Essence
                </label></br>
            </div>

            <div class="filter-group">
                <label>Echelle de prix :</label> </br>
                <div class="price-range">
                    <label for="prixMini">Minimum :</label>
                    <input type="number" id="prixmini" name="prixmini" placeholder="minimum">
                    <br>
                    <label for="prixMaxi">Maximum :</label>
                    <input type="number" id="prixmaxi" name="prixmaxi" placeholder="maximum">
                </div>
            </div>

            <div class="filter-group">
                <label>Durée du voyage :</label></br>
                <div class="duration-filter">
                    <label for="dureeMax">Max (ex: 1h30):</label>
                    <input type="number" class="form-control" id="dureeMax" name="dureeMax"
                        placeholder="Durée max (minutes)">

                </div>
            </div>

            <div class="filter-group">
                <label>Evaluations :</label></br>
                <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <div class="rating-filter">
                        <input class="form-check-input" name="evaluation" type="checkbox" value="<?= $i ?>"
                            id="rating<?= $i ?>">
                        <?php for ($j = 0; $j < $i; $j++) : ?>
                            <span class="star"><i class="fas fa-star"></i></span>
                        <?php endfor; ?>
                        <?php for ($j = $i; $j < 5; $j++) : ?>
                            <span class="star"><i class="far fa-star"></i></span>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>

                <button id="applyFiltersBtn" type="submit" name="applyFilters" class="apply-filters-button">Appliquer
                    les
                    filtres</button>
            </div>

        </form>
    </div>


    <div class="content-researched">

        <div class="separator"></div></br>
        <div class="message">
            <?php if (isset($error)) : ?> <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
                <div class="alert alert-success container" role="alert">
                    <?= $success ?></br>
                    <?= $countSuccess ?>
                </div>
            <?php endif; ?></br>
        </div>


        <?php foreach ($researcheResult as $result): ?>
            <form method="post">
                <div class="publication animation-element bounce-up">
                    <div class="pub-wrapper">
                        <div class="menu-container">
                            <button type="button" class="menu-btn">&#8942;</button>
                            <div class="menu-dropdown">
                                <?php if (!empty($result->covoiturage_id)): ?>
                                    <input type="hidden" name="covoiturage_id"
                                        value="<?= htmlspecialchars($result->covoiturage_id) ?>">
                                <?php endif; ?>
                                <button type="submit" name="participer">Voir plus de détails</button>
                                <button type="button" class="menu-item">Partager</button>
                                <button type="button" class="menu-item">Signaler</button>
                            </div>
                        </div>

                        <div class="publication-header">
                            <div class="profile-picture">
                                <?php if (!empty($result->covoiturage_id) && !empty($result->nom)): ?>
                                    <img src="/backend/profilePicture.php?covoiturage_id=<?= htmlspecialchars($result->covoiturage_id) ?>"
                                        alt="Photo de <?= htmlspecialchars($result->nom) ?>" class="photo-utilisateur"
                                        height="50" width="50">
                                <?php endif; ?>
                            </div>

                            <div class="author-info">
                                <div class="author-name">
                                    <strong>
                                        <?php if (!empty($result->nom)): ?>
                                            <?= htmlspecialchars($result->nom) ?><br>
                                        <?php endif; ?>
                                        <?php if (!empty($result->prenom)): ?>
                                            <?= htmlspecialchars($result->prenom) ?>
                                        <?php endif; ?>
                                    </strong>
                                </div>

                                <div class="publication-date">
                                    <?php if (!empty($result->created_at)): ?>
                                        <?= htmlspecialchars($result->created_at) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="separator"></div>

                        <div class="publication-content">
                            <?php if (!empty($result->date_depart)): ?>
                                <i class="fas fa-calendar-day"></i>
                                <?= htmlspecialchars(date('d/m/Y', strtotime($result->date_depart))) ?>
                            <?php endif; ?>

                            <p>
                                <?php if (!empty($result->lieu_depart)): ?>
                                    <i class="fas fa-location-arrow"></i> <strong>Départ :</strong>
                                    <?= htmlspecialchars($result->lieu_depart) ?>
                                <?php endif; ?>

                                <?php if (!empty($result->heure_depart)): ?>
                                    à <?= htmlspecialchars(date('H:i', strtotime($result->heure_depart))) ?> h
                                <?php endif; ?>

                                <?php if (!empty($result->lieu_arrivee)): ?>
                                    <i class="fas fa-arrow-right"></i> <strong>Arrivée :</strong>
                                    <?= htmlspecialchars($result->lieu_arrivee) ?>
                                <?php endif; ?>

                                <?php if (!empty($result->heure_arrivee)): ?>
                                    à <?= htmlspecialchars(date('H:i', strtotime($result->heure_arrivee))) ?> h
                                <?php endif; ?>
                            </p><br />

                            <?php if (!empty($result->duree_heures_minutes)): ?>
                                <strong>Durée du trajet :</strong>
                                <span class="duree"><?= htmlspecialchars($result->duree_heures_minutes) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="separator"></div>

                        <div class="informations">
                            <p>
                                <?php if (!empty($result->energie)): ?>
                                    <i class="fas fa-car"></i> <strong>Voiture :</strong>
                                    <span class="energie"><?= htmlspecialchars($result->energie) ?></span>
                                <?php endif; ?>

                                <?php if (!empty($result->nb_place)): ?>
                                    <i class="fas fa-arrow-right"></i> <strong>Places disponibles :</strong>
                                    <?= htmlspecialchars($result->nb_place) ?>
                                <?php endif; ?>

                                <?php if (!empty($result->prix_personne)): ?>
                                    <i class="fas fa-arrow-right"></i> <strong>Prix par place :</strong>
                                    <span class="prix"><?= htmlspecialchars($result->prix_personne) ?></span>
                                    <i class="fas fa-euro-sign"></i>
                                <?php endif; ?>
                            </p><br />

                            <?php if (!empty($result->average_note)): ?>
                                <div class="note">
                                    <strong>Note :</strong>
                                    <span class="note"><?= htmlspecialchars($result->average_note) ?></span>
                                    <i class="fas fa-star"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <br>
                        <div class="separator"></div>

                        <div class="publication-actions">
                            <?php if (!empty($result->covoiturage_id)): ?>
                                <input type="hidden" name="covoiturage_id"
                                    value="<?= htmlspecialchars($result->covoiturage_id) ?>">
                            <?php endif; ?>
                            <button class="participer-btn" type="submit" name="participer">Participer</button>
                        </div>
                    </div>
            </form>
    </div>
<?php endforeach; ?>

</div>

<div class="separator"></div>
<div class="container" style="text-align: center; margin-top: 20px;">


    <h5>Foire aux questions</h5></br>


    <div class="accordion" id="accordionExample" style="color:#000000">
        <div class="accordion-item">
            <p class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Comment reserver un voyage ?
                </button>
            </p>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body"></br>
                    <strong>Rendez vous sur la page co-voiturage</strong>, connectez-vous a la plateforme et
                    effectuer
                    votre premiere recherche, une fois un cocoiturage trouver, cliquer sur le bouton participer.
                    Rentrer
                    le nombre de place dint vous avez besoin, cliquez a nouveau sur confirmer et le tour est
                    joué.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <p class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Comment annuler un covoiturage ?
                </button>
            </p>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body"></br>
                    <strong>Rendez vous sur votre profil</strong> descendez tout en bas de la page, dans la
                    section
                    "covoiturage en cours", cliquer sur annulez.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <p class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Comment poster un avis sur un covoiturage ?
                </button>
            </p>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body"></br>
                    <strong>Une fois le covoiturage terminer</strong> rendez vous sur votre profil, descendez
                    tout en
                    bas dans la section "laissez un avis".
                </div>
            </div>
        </div>
    </div></br></br></br>


    <div class="column">
        <div class="column-1">
            <h2>Merci de votre visite</h2></br>
            <img src="../images/communicate-2.png"
                alt="image de trois logo de contact,email telephone et messagerie">
        </div>
        <div class="column-1">
            <form action="" method="post">
                <fieldset>
                    <legend>Nous contacter</legend></br>

                    <label for="nom">Nom :</label></br>
                    <input type="text" id="nom" name="nom" required></br>

                    <label for="email">Email :</label></br>
                    <input type="email" id="email" name="email" required></br>

                    <label for="objet">Objet :</label></br>
                    <input type="text" id="objet" name="objet"></br>

                    <label for="message">Message :</label></br>
                    <textarea id="message" name="message" rows="5" required></textarea>

                    <button type="submit" name="formulaire_contact" id="button"> Envoyer</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<footer>
    <div class="footer-content">
        <h3>ECORIDE</h3>
        <p>Rejoignez-nous dans notre mission pour un avenir plus vert et plus durable. Ensemble, nous
            pouvons faire la différence.</p>

    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2024 ECORIDE. designed by <span>Driss</span></p>
    </div>
</footer>
<script>
    //dropdown menu
    // Gestion du menu déroulant
    document.querySelectorAll('.menu-btn').forEach(button => {
        button.addEventListener('click', () => {
            const dropdown = button.nextElementSibling;
            dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
        });
    });
    // Ferme le menu si on clique en dehors
    window.addEventListener('click', (event) => {
        document.querySelectorAll('.menu-dropdown').forEach(dropdown => {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event
                    .target)) {
                dropdown.style.display = 'none';
            }
        });
    });
    //animation on scroll
    var $animation_element = $('.animation-element');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = window_top_position + window_height;

        $.each($animation_element, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = element_top_position + element_height;

            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('in-view');
            } else {
                $element.removeClass('in-view');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');
    // filter sidebar
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".filter-container");

        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("active");
        });
    });
    //deplacer le bouton filtre 
    const button = document.querySelector('.burger-button');
    let isDragging = false;
    let offsetX = 0,
        offsetY = 0;

    // Fonction pour démarrer le drag
    function startDrag(x, y) {
        isDragging = true;
        offsetX = x - button.offsetLeft;
        offsetY = y - button.offsetTop;
        button.style.cursor = 'grabbing';
    }

    // Fonction pour déplacer
    function onDrag(x, y) {
        if (isDragging) {
            button.style.left = (x - offsetX) + 'px';
            button.style.top = (y - offsetY) + 'px';
        }
    }

    // Fonction pour stopper le drag
    function stopDrag() {
        isDragging = false;
        button.style.cursor = 'grab';
    }

    // 🖱️ Souris
    button.addEventListener('mousedown', e => startDrag(e.clientX, e.clientY));
    document.addEventListener('mousemove', e => onDrag(e.clientX, e.clientY));
    document.addEventListener('mouseup', stopDrag);

    // 📱 Touch
    button.addEventListener('touchstart', e => {
        const touch = e.touches[0];
        startDrag(touch.clientX, touch.clientY);
    });

    document.addEventListener('touchmove', e => {
        if (!isDragging) return;
        const touch = e.touches[0];
        onDrag(touch.clientX, touch.clientY);
        e.preventDefault(); // Empêche le scroll pendant le drag
    }, {
        passive: false
    });

    document.addEventListener('touchend', stopDrag);
</script>
<script src="../JS/filter_script.js"></script>
<script src="../JS/navbarOnScroll.js"></script>
<script src="../JS/toggleResearch.js"></script>
</body>