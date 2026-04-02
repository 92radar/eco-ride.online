<?php
session_start();





require_once '/home/clients/5afa198c535310a01279d2a30398c842/sites/eco-ride.online/backend/registerBe.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Favicon (PNG et ICO pour compatibilité maximale) -->
<link rel="icon" type="image/png" href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
<link rel="stylesheet" href="../styles/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../styles/profile-1.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../styles/homecopy.css">
<link rel="stylesheet" href="../styles/research.css">


<link rel="stylesheet" href="../styles/font.css">
<style>
    body {
        overflow-y: scroll;
        overflow-x: hidden;
        max-width: 100%;
    }

    footer {
        color: #ffffff;
    }

    h1 {
        font-size: 24px;
        color: #ffffff;
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

    .eco-ride a {
        text-decoration: none;
        color: #ffffff;

        font-weight: lighter;
    }

    .eco-ride.show {
        display: block;
    }



    form input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #000;
        /* Couleur de l'icône */
    }
</style>


<body>
    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>
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
                            <input type="text" id="depart" name="depart" title="Choisir une ville de départ"
                                placeholder="Ville de départ">
                            <label for="arrivee"></label>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            <input type="text" id="arrivee" name="arrivee" title="Choisir une ville d'arrivée"
                                placeholder="Ville d'arrivée">
                            <label for="date_depart"></label>
                            <i class="fa-solid fa-calendar-days"></i>&nbsp;
                            <input type="date" id="date_depart" name="date" title="Choisir une date de départ">
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

    <div class="form-container">
        <h2>Inscription</h2>
        <form action="" method="post" id="form-inscription" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Pseudo:</label>
                <input type="text" id="pseudo" name="pseudo" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
                <div id="password-feedback" style="color: red; font-size: 0.9em; margin-top: 5px;"></div>

                </ul>
            </div>
            <div class="form-group">
                <label for="verif_mot_de_passe">Vérifiez le mot de passe:</label>
                <input type="password" id="verif_mot_de_passe" name="verif_mot_de_passe" required>
                <div id="password_error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="ville">Ville:</label>
                <input type="text" id="ville" name="ville" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>
            <div class="form-group">
                <label for="telephone">Numéro de téléphone:</label>
                <input type="text" id="telephone" name="telephone" required>
            </div>

            <div class="form-group">
                <label for="date_naissance">Date de naissance:</label>
                <input type="date" id="date_naissance" name="date_naissance" max="2007-04-24" required>
            </div><br />
            <button type="submit" id="submit-btn" name="submit">S'inscrire</button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const form = document.getElementById("form-inscription");

                form.addEventListener("submit", function(e) {
                    const password = document.getElementById('password').value;
                    const verifyPassword = document.getElementById('verif_mot_de_passe').value;
                    const passwordError = document.getElementById('password_error');

                    if (password !== verifyPassword) {
                        e.preventDefault(); // Stop le formulaire
                        passwordError.textContent = "Les mots de passe ne correspondent pas.";
                    } else {
                        passwordError.textContent = "";
                    }
                });
            });
            document.addEventListener("DOMContentLoaded", () => {
                const birthInput = document.getElementById("date_naissance");
                const today = new Date();
                const year = today.getFullYear() - 18;
                const month = String(today.getMonth() + 1).padStart(2, '0'); // mois 0-indexé
                const day = String(today.getDate()).padStart(2, '0');
                const maxDate = `${year}-${month}-${day}`;

                birthInput.max = maxDate;
            });
        </script>
    </div>
    <div class="container" style="margin-top:150px; margin-bottom:50px;">

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
            <ul class="socials">
                <li><i class="fab fa-instagram fa-2x icon"></i></a></li>

            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy;2024 ECORIDE. designed by <span>Driss</span></p>
        </div>
    </footer>
    <script src="../JS/navbarOnScroll.js"></script>


    <script src="/JS/passwordSecurity.js"></script>
    <script src="../JS/toggleResearch.js"></script>
</body>