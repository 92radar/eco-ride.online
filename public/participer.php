<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: https://eco-ride.online');
    exit;
}


require_once __DIR__ . '/../backend/participerBe.php';

if (isset($_POST['logout'])) {
    // Détruire toutes les variables de session
    $_SESSION = array();


    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finalement, détruire la session.
    session_destroy();

    // Rediriger vers la page de connexion ou d'accueil
    header("Location: /login");
    exit();
}

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
    <title>Détails du covoiturage</title>
</head>



<style>
@media screen and (max-width: 968px) {
    p {
        font-size: 14px;
    }
}

body {
    max-width: 100%;
}

nav li {

    text-decoration: none;
    color: white;
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
    margin: 10px;
    width: 100%;
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
}

.publication-content .fas {
    color: #555;
}

.informations .fas {
    color: #555;
}

.participer-btn {
    width: 100%;

    padding: 10px;
    background-color: #4c6faf;
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
}

.container {
    margin-top: 200px;
}

.container h1 {
    color: #4c6faf;
    font-size: 2em;
    font-weight: bold;
    text-align: center;
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
        <h1>Informations sur le chauffeur</h1>
        <p class="description">
            Voici les informations sur le chauffeur du trajet que vous avez choisi. Si vous souhaitez participer à ce
            trajet,
            cliquez sur le bouton "Participer".
        </p><br>
        <div class="ligne-horizontale"></div>


        <?php if (!empty($covoiturage)) : ?>

        <div class="form-control">
            <div class="publication-header">
                <div class="utilisateur-info">
                    <div class="profile-picture">


                        <img src="/backend/profilePicture.php?covoiturage_id=<?= htmlspecialchars($covoiturage->covoiturage_id) ?>"
                            alt="Photo de <?= htmlspecialchars($covoiturage->nom) ?>" class="photo-utilisateur"
                            height="50" width="50">
                    </div>
                    <span class="utilisateur" name="prenom">
                        <?= htmlspecialchars($covoiturage->prenom) ?>
                    </span>
                    <span class="utilisateur" name="nom">
                        <?= htmlspecialchars($covoiturage->nom) ?></span><br><br><br><br>

                    <span class="utilisateur" name="date_naissance">Date de naissance :
                        <?= htmlspecialchars($covoiturage->date_naissance) ?><br>
                    </span> <span class="utilisateur" name="marque">Marque de la voiture :
                        <?= htmlspecialchars($covoiturage->marque) ?><br>
                    </span>
                    <span class="utilisateur" name="voiture">Modèle de la voiture :
                        <?= htmlspecialchars($covoiturage->modele) ?><br>
                    </span>
                    <span class="utilisateur" name="couleur">Couleur de la voiture :
                        <?= htmlspecialchars($covoiturage->couleur) ?><br>
                    </span>
                    <span class="utilisateur" name="nom">Immatriculation du véhicule :
                        <?= htmlspecialchars($covoiturage->immatriculation) ?><br>

                    </span>
                    <span class="utilisateur" name="note">Note moyenne :
                        <?= htmlspecialchars($covoiturage->average_note) ?> ⭐</span><br>

                </div>
            </div>
        </div></br>

        <h1>Préférences du chauffeur</h1>
        <div class="ligne-horizontale"></div></br>
        <p2 class="description">
            Voici les préférences du chauffeur du trajet que vous avez choisi.
        </p2><br>
        <div class="utilisateur">
            <p>Préférences : <?= htmlspecialchars($covoiturage->commentaire) ?><br>
            </p>
        </div></br>
        <?php else: ?>
        <p>Covoiturage non trouvé.</p>
        <?php endif; ?>

        <div class="ligne-horizontale"></div>
        <div class="utilisateur-info">
            <h3>Avis des Participants</h3>
        </div></br>
        <?php if (!empty($avis)) : ?>
        <?php foreach ($avis as $unAvis) : ?>
        <div class="publication-cadre animation-element bounce-up">
            <div class="publication-header">

            </div>
            <div class="publication-details">
                <div class="avis-section">

                    <div class="avis-cadre">
                        <div class="avis-header">


                            <?= htmlspecialchars($unAvis->prenom) ?>
                            <?= htmlspecialchars($unAvis->nom) ?>,
                            <strong>a donné son avis : </strong>

                        </div>

                        <div class="avis-contenu">
                            <p>"<?= htmlspecialchars($unAvis->commentaire) ?>"</p><br />
                            <span class="container">Note : <?= htmlspecialchars($unAvis->note) ?>/5</span>

                        </div>
                    </div>




                </div>
            </div>

        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <p>Aucun avis pour ce chauffeur pour le moment.</p>
        <?php endif; ?>


        <h1>Information sur le trajet</h1></br>
        <div class="ligne-horizontale"></div></br>
        <p class="description">Voici les informations sur le trajet que vous avez choisi. Si vous souhaitez participer à
            ce
            trajet, cliquez sur le bouton "Participer".</p></br>

        <form method="post">
            <?php if (!empty($covoiturage)) : ?>

            <div class="publication">
                <div class="publication-header">
                    <div class="profile-picture">


                        <img src="/backend/profilePicture.php?covoiturage_id=<?= htmlspecialchars($covoiturage->covoiturage_id) ?>"
                            alt="Photo de <?= htmlspecialchars($covoiturage->nom) ?>" class="photo-utilisateur"
                            height="50" width="50">
                    </div>
                    <div class="author-info">
                        <div class="author-name">
                            <?= htmlspecialchars($covoiturage->nom) ?></br><?= htmlspecialchars($covoiturage->prenom) ?>

                        </div>

                        <div class="publication-date" name="created_at">
                            <?= htmlspecialchars($covoiturage->created_at) ?>**

                        </div>
                    </div>
                </div>
                <div class="separator"></div>

                <div class="publication-content">
                    <i
                        class="fas fa-calendar-day"></i>&nbsp;<?= htmlspecialchars(date('d/m/Y', strtotime($covoiturage->date_depart))) ?>
                    <p>
                        <i class="fas fa-location-arrow"></i><strong>Départ :</strong>
                        <?= htmlspecialchars($covoiturage->lieu_depart) ?> à
                        <?= htmlspecialchars(date('H:i', strtotime($covoiturage->heure_depart))) ?> h
                        <i class="fas fa-arrow-right"></i>
                        <strong>Arrivée :</strong> <?= htmlspecialchars($covoiturage->lieu_arrivee) ?>
                        <?= htmlspecialchars(date('d/m/Y', strtotime($covoiturage->date_arrivee))) ?> à
                        <?= htmlspecialchars(date('H:i', strtotime($covoiturage->heure_arrivee))) ?> h
                    </p>
                </div><br />
                <strong>Durée du trajet :</strong> <span
                    class="duree"><?= htmlspecialchars($covoiturage->duree_heures_minutes) ?></span>
                </p>



                <div class="separator"></div>
                <div class="informations">
                    <i class="fas fa-car"></i> <strong>voiture :</strong>
                    <?= htmlspecialchars($covoiturage->energie) ?>
                    <i class="fas fa-arrow-right"></i>
                    <strong>Places disponibles :</strong> <?= htmlspecialchars($covoiturage->nb_place) ?>
                    <i class="fas fa-arrow-right"></i>
                    <strong>Prix par place :</strong> <?= htmlspecialchars($covoiturage->prix_personne) ?>
                    Credits
                    </p>
                </div>
            </div> <br />
            <div class="separator"></div>

            <div class="publication-actions">
                <input type="hidden" name="covoiturage_id"
                    value="<?= htmlspecialchars($covoiturage->covoiturage_id) ?>">
                <button class="participer-btn" type="submit" name="participer">Participer</button>

            </div>

    </div>

    </div>

    </div></br></br></br></br></br>
    <?php else: ?>
    <p>Covoiturage non trouvé.</p>
    <?php endif; ?>
    </form>

    </div>



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