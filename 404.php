<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}
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

    session_destroy();

    // Rediriger vers la page de connexion ou la page actuelle (pour rafraîchir l'affichage)
    header("Location: https://eco-ride.online"); // Redirige vers la page home
    exit();
}

?>

<head>
    <!-- Encodage et viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    <meta name="description"
        content="site de covoiturage ecologique en ligne, plateforme de mise en relation entre conducteurs et passagers, covoiturage, transport écologique, mobilité durable">
    <link rel="canonical" href="https://eco-ride.online/">

    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
    <!-- Stylesheets -->

    <link rel="stylesheet" href="../styles/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/profile-1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>







    <link rel="stylesheet" href="../styles/homecopy.css">

    <link rel="stylesheet" href="../styles/research.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <title>ECORIDE - Page non trouvée</title>


</head>
<style>

    @media screen and (max-width: 968px) {

        .breathe-animation span {
            display: block;
            color: white;
            font-size: 35px;
        }

        .eco-ride img {
            display: none;
        }

    }

    .eco-ride {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 100%;
        max-height: 100%;
        transition: opacity 0.5s ease;
        font-size: 3em;
        font-weight: lighter;
        color: #ffffff;
        display: none;

    }

    @media screen and (max-width: 968px) {
        .eco-ride {
            max-width: 70%;

        }

    }

    .eco-ride.show {
        display: block;
    }

    .box p {
        color: white;
    }

    .box h3 {
        color: white;
    }

    main {
        background-color: #4c6faf;
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

    .error {
        text-align: center;
        margin-top: 200px;
    }
</style>

<?php if (isset($success)) : ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php elseif (isset($error)) : ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>




<body>
    <nav>
        <div id="brand">
            <div class="eco-ride">
                <img src="../images/FullLogo_Transparent_NoBuffer-2.png" alt="logo ecoride">
                <div class="breathe-animation">
                    <span>ECORIDE</span>
                </div>
            </div>



            <div id="word-mark">

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
    <div class="error">


        <h2>404</h2>
        <h3>Oups! La page que vous recherchez n'existe pas.</h3>
        <p>Il se peut que la page ait été supprimée, renommée ou qu'elle soit temporairement indisponible.</p>



    </div>



    <script src="../JS/navbarOnScroll.js"></script>
</body>