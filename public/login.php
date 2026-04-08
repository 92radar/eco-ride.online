<?php
session_start();



require_once __DIR__ . '/../backend/loginBe.php';
// Si le token CSRF n'existe pas encore, on le génère
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <title>Login to Ecoride</title>
</head>
<style>


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
<?php if (isset($error)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<body>
    <nav>
        <div id="brand">



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
        <form action="" method="post">
            <h2>Log in</h2>
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Se connecter</button>
            <p>Pas encore de compte ? <a href="../register">Inscrivez-vous</a></p>
        </form>
    </div>
    <div class="container" style="margin-top:150px; margin-bottom:50px;">

        <h3>Foire aux questions</h3></br>


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

                        <button type="" name="formulaire_contact" id="button"> Envoyer</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <h1>ECORIDE</h1>
        <p>Designed by <span>Driss</span>Copyright &copy;2026 ECORIDE.</p> 

    </footer>
    <script src="../JS/navbarOnScroll.js"></script>
    <script src="../JS/toggleResearch.js"></script>
</body>