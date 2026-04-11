<?php


require_once __DIR__ . '/../backend/confirmationBe.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
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
    <title>Confirmer votre participation</title>
</head>

<style>
    nav li {

        text-decoration: none;
        color: white;
    }

    .container {
        margin-top: 210px;
    }

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
        margin: 10px;
        width: 100%;
    }



    .fas {
        color: white;
    }

    nav span {
        color: white;
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

    .container-1 {
        background-color: #fff;
        border-radius: 8px;
        border: solid 1px #3b3939;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        word-break: break-word;
        width: 90%;
        margin: 20px auto;
    }

    .separator {
        border-bottom: 1px solid #ddd;
        margin: 10px 0;
    }

    .publication .fas {
        color: #555;
    }

    .informations .fas {
        color: #555;
    }

    .container-1 .fas {
        color: #555;
    }

    .container-1 p {
        text-align: center;
        margin-bottom: 20px;
    }

    .container-1 {
        padding: 10px;
    }

    .container-1 h2 {
        margin: 20px 0;

    }

    .container-1 input {
        width: 50%;
        padding: 5px;
        margin: 10px auto;
        border: 1px solid #ccc;
        border-radius: 4px;

    }

    .container-1 button {
        display: block;
        /* 👈 Ajoute ça pour forcer le centrage */
        width: 100%;
        max-width: 300px;
        padding: 10px;
        margin: 10px auto;
        margin-top: 5px;
        background-color: #4c6faf;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .center {
        text-align: center;
        font-size: 2em;
        color: #555;
        margin-top: 10px;
    }

    .center .fas {
        color: #555;
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






    <div class="container">
        <h1>Confirmer votre participation</h1>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($success_message) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <h2>Détails du covoiturage</h2>
        <?php if ($covoiturageInfo): ?>
            <div class="publication animation-element bounce-up">

                <div class="publication-header">
                    <div class="profile-picture">

                        <img src="/backend/profilePicture.php?covoiturage_id=<?= htmlspecialchars($covoiturageInfo->covoiturage_id) ?>"
                            alt="Photo de <?= htmlspecialchars($covoiturageInfo->nom) ?>" class="photo-utilisateur"
                            height="50" width="50">
                    </div>
                    <div class="author-info">
                        <div class="author-name">
                            <strong>

                                <?= htmlspecialchars($covoiturageInfo->nom) ?>
                                <?= htmlspecialchars($covoiturageInfo->prenom) ?>
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>

                <div class="publication-content">

                    <i class="fas fa-calendar-day"></i>&nbsp;
                    <?= htmlspecialchars(date('d/m/Y', strtotime($covoiturageInfo->date_depart))) ?>
                    <p> <i class="fas fa-location-arrow"></i><strong>Départ :</strong>
                        <?= htmlspecialchars($covoiturageInfo->lieu_depart) ?> à
                        <?= htmlspecialchars(date('H:i', strtotime($covoiturageInfo->heure_depart))) ?> h


                        <i class="fas fa-arrow-right"></i><strong>Arrivée :</strong>
                        <?= htmlspecialchars($covoiturageInfo->lieu_arrivee) ?> à
                        <?= htmlspecialchars(date('H:i', strtotime($covoiturageInfo->heure_arrivee))) ?> h
                    </p>
                </div><br />

                <div class="separator"></div>




                <p>
                    <i class="fas fa-car"></i> <strong>voiture :</strong>
                    <?= htmlspecialchars($covoiturageInfo->energie) ?>
                    <i class="fas fa-arrow-right"></i>
                    <strong>Places disponibles :</strong>
                    <?= htmlspecialchars($covoiturageInfo->nb_place) ?>
                    <i class="fas fa-arrow-right"></i>
                    <strong>Prix par place :</strong>
                    <?= htmlspecialchars($covoiturageInfo->prix_personne) ?>
                    Credits
                </p><br />

            </div>

        <?php else: ?>
            <p>Covoiturage non trouvé.</p>
        <?php endif; ?>

    </div>
    <div class="center"><i class="fas fa-arrow-down"></i> </div>


    <div class="container-1 animation-element bounce-up">


        <?php if ($covoiturageInfo): ?>
            <p> Confirmer votre participation à ce covoiturage ?</p>

            <p>
                <i class="fas fa-calendar-day"></i>&nbsp;
                <?= htmlspecialchars(date('d/m/Y', strtotime($covoiturageInfo->date_depart))) ?>
            <p> <i class="fas fa-location-arrow"></i><strong>Départ :</strong>
                <?= htmlspecialchars($covoiturageInfo->lieu_depart) ?> à
                <?= htmlspecialchars(date('H:i', strtotime($covoiturageInfo->heure_depart))) ?> h


                <i class="fas fa-arrow-right"></i><strong>Arrivée :</strong>
                <?= htmlspecialchars($covoiturageInfo->lieu_arrivee) ?> à
                <?= htmlspecialchars(date('H:i', strtotime($covoiturageInfo->heure_arrivee))) ?> h
            </p><br />
            <p>
                <strong>Prix :</strong> <?= htmlspecialchars($covoiturageInfo->prix_personne) ?> Credits<br>
                <strong>Places restantes :</strong> <?= htmlspecialchars($covoiturageInfo->nb_place) ?>
            </p><br />
            <form action="" method="post">
                <p>
                    <strong>Nombre de places demandées :</strong>
                </p></br />
                <input type="number" name="nb_place" class="form-control" placeholder="exemple: 1" value="" min="1"
                    max="<?= htmlspecialchars($covoiturageInfo->nb_place) ?>" required>

                <input type="hidden" name="covoiturage_id"
                    value="<?= htmlspecialchars($covoiturageInfo->covoiturage_id) ?>">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <button type="submit" name="confirmer_participation">Confirmer</button>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <p>Covoiturage non trouvé.</p>
        <?php endif; ?>


    </div>

    <script>
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
    </script>
    <script src="../JS/navbarOnScroll.js"></script>
    <script src="../JS/toggleResearch.js"></script>
</body>