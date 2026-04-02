<?php
session_start();

require_once '/home/clients/5afa198c535310a01279d2a30398c842/sites/eco-ride.online/backend/employeeBe.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Espace de Travail - employé Eco ride</title>
</head>


<style>
    .profil {
        max-width: 100%;
        margin: 30px auto;
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

    .c-container {
        margin-top: 0;
        /* ✅ reste dans le flux */
        margin-left: 5px auto;

        padding: 10px;


        /* ✅ espace depuis le haut */
    }

    .c-container ul {
        width: 90vw;
        max-height: auto;
        padding: 20px;
        display: flex;
        gap: 4vw;
        margin: 10px;
    }

    .c-container ul li {
        list-style-type: none;
        background-color: #eeeeee;
        border: 1px solid #dddddd;
        padding: 10px;
        max-height: auto;
        color: #000000;

        flex: 0 0 100%;

    }



    .c-container ul {
        overflow-x: scroll;
        scroll-snap-type: x mandatory;

    }

    .c-container ul::-webkit-scrollbar {
        display: none;
    }

    .c-container ul li {
        scroll-snap-align: center;
    }








    .c-container ul {
        anchor-name: --my-carousel;
    }

    .dots {
        text-align: center;
        margin-top: 15px;
    }

    .dots button {
        border: none;
        background: #ccc;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
    }

    .dots button.active {
        background: #333;
    }

    footer {
        color: white;
        text-align: center;
        padding: 20px;
        background-color: #4c6faf;
        border-top: solid 1px #3b3939;
        font-weight: lighter;
    }

    footer a {
        text-decoration: none;
        color: #ffffff;

    }

    .alert-success {
        position: fixed;
        bottom: 10px;
        left: 50%;
        background-color: #d4edda;
        color: #155724;
        padding: 15px 20px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        transform: translateX(-50%);
        z-index: 1000;
        opacity: 1;
        transition: opacity 0.5s ease;
    }

    .header-profile-picture {
        position: absolute;
        top: 25px;
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
                            <label for="depart"></label>
                            <input type="text" id="depart" name="depart" placeholder="Ville de départ">
                            <label for="arrivee"></label>
                            <input type="text" id="arrivee" name="arrivee" placeholder="Ville d'arrivée"><i
                                class="fa-solid fa-location-dot"></i>
                            <label for="date_depart"></label>
                            <input type="date" id="date_depart" name="date"><i class="fa-solid fa-calendar-days"></i>
                            <button type="submit" name="search" aria-label="Rechercher" style="float: right;">
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
                            <li><a class="dropdown-item" href="/public/employee.php"><i class="fas fa-user"></i></i>Espace
                                    employés</a></li>
                        <?php elseif ($_SESSION['role'] === 'user'): ?>
                            <li><a class="dropdown-item" href="/public/account.php"><i class="fas fa-user"></i></i>Profil</a>
                            </li>
                        <?php elseif ($_SESSION['role'] === 'admin'): ?>
                            <li><a class="dropdown-item" href="/public/admin.php"><i class="fas fa-user"></i></i>Espace
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

        <div class="ligne-horizontale"></div></br>
        <?php if (isset($success)) : ?>
            <div class="alert alert-success container" role="alert">
                <?= $success ?></br>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger container" role="alert">
                <?= $error ?></br>
            </div>
        <?php endif; ?>
        <h1>Profil</h1>
        <div class="profil">

            <?php if (!empty($userInfos)): ?>


                <h3>Informations personnelles</h3>
                <div class="profil-info" id="">

                    <form action="" method="post">
                        <div class="form-group">
                            <div class="profil-details">


                            </div>
                            <strong>Nom :</strong><input class="form-control" type="text" name="nom"
                                value="<?= htmlspecialchars($userInfos->nom) ?>" required>
                            <strong>Prénom :</strong><input class="form-control" type="text" name="prenom"
                                value="<?= htmlspecialchars($userInfos->prenom) ?>" required><br />
                            <strong>Pseudo :</strong><input class="form-control" type="text" name="pseudo"
                                value="<?= htmlspecialchars($userInfos->pseudo) ?>" required><br />
                            <strong>Date de naissance :</strong><input class="form-control" type="date"
                                name="date_naissance" value="<?= htmlspecialchars($userInfos->date_naissance) ?>"
                                required><br />

                            <strong>Email :</strong><input class="form-control" type="email" name="email"
                                value="<?= htmlspecialchars($userInfos->email) ?>" required><br />
                            <strong>Adresse :</strong><input class="form-control" type="text" name="adresse"
                                value="<?= htmlspecialchars($userInfos->adresse) ?>" required><br />
                            <strong>
                                Ville :</strong><input class="form-control" type="text" name="ville"
                                value="<?= htmlspecialchars($userInfos->ville) ?>" required><br />
                            <strong>Numéro de téléphone :</strong><input class="form-control" type="text" name="telephone"
                                value="<?= htmlspecialchars($userInfos->telephone) ?>" required><br />



                        <?php else: ?>
                            <p>Aucune information utilisateur trouvée.</p>
                        <?php endif; ?>
                        </br>

                        <div class=" profil-actions">
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
                <div class="ligne-horizontale" id="section2"></div></br>
                <h3>Verifier les avis</h3></br>
                <form method="GET" id="verifierAvisForm">
                    <div class="form-group">
                        <label for="avis_id">Sélectionner un avis :</label>
                        <select class="form-control" id="avis_id" name="avis_id">
                            <option value="">Sélectionner un avis</option>
                            <?php if (!empty($avis)) : ?>
                                <?php foreach ($avis as $unAvis) : ?>
                                    <option value="<?= htmlspecialchars($unAvis->avis_id) ?>">
                                        <?= htmlspecialchars($unAvis->nom) ?> <?= htmlspecialchars($unAvis->prenom) ?>
                                        (<?= htmlspecialchars($unAvis->statut_avis) ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>


                    </div>
                </form>
                <div id="avisDetails">
                    <!-- Le formulaire chargé dynamiquement apparaîtra ici -->
                </div>




                <div class="ligne-horizontale" id="section3"></div></br>
                <h3>Les avis vérifiés</h3><br />



                <form id="verifierAvisForm">
                    <div class="form-group">
                        <label for="avis_id">Sélectionner un avis :</label>
                        <select class="form-control" id="verifiedavis_id" name="avis_id">
                            <option value="">Sélectionner un avis</option>
                            <?php if (!empty($avisVerifie)) : ?>
                                <?php foreach ($avisVerifie as $unAvisVerifie) : ?>
                                    <option value="<?= htmlspecialchars($unAvisVerifie->avis_id) ?>"
                                        <?= (isset($_GET['avis_id']) && $_GET['avis_id'] == $unAvisVerifie->avis_id) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($unAvisVerifie->nom) ?> <?= htmlspecialchars($unAvisVerifie->prenom) ?>
                                        (<?= htmlspecialchars($unAvisVerifie->statut_avis) ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </form>



                <div id="avisVerifieDetails"></div>

                <div class="ligne-horizontale"></div></br>
                <script>
                    // disparition automatique de l'alerte
                    setTimeout(function() {
                        var alert = document.querySelector('.alert-success');
                        if (alert) {
                            alert.style.opacity = '0';
                            setTimeout(function() {
                                alert.remove();
                            }, 500); // Temps pour l'effet de fondu
                        }
                    }, 3000); // Temps avant de commencer la disparition (3 secondes)
                </script>
                <script src="../JS/navbarOnScroll.js"></script>
                <script src="../JS/employeeScript.js"></script>
                <script src="../JS/toggleResearch.js"></script>
</body>