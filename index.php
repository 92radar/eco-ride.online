<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
}

// DIR used for local and prod environments, no need to change it when deploying


require_once __DIR__ . '/backend/indexBe.php';
require_once __DIR__ . '/backend/send.php';


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
    <link rel="icon" type="image/png" href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">


    <!-- datadog -->
    <script src="https://www.datadoghq-browser-agent.com/us1/v5/datadog-rum.js" type="text/javascript"></script>
    <script type="module" src="../JS/app.js"></script>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="../styles/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <title>ECORIDE</title>


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








@media screen and (max-width: 968px) {
    .eco-ride {
        max-width: 70%;

    }

}

.box p {
    color: white;
}

.box h3 {
    color: white;
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
            <div class="">
                <!-- <img src="../images/FullLogo_Transparent_NoBuffer-2.png" alt="logo ecoride"> -->
                <!-- <div class="breathe-animation">
                    <span>ECORIDE</span>
                </div> -->
            </div>



            <div id="word-mark">
                <div class="recherche-container">
                    <form action="/covoiturage" method="get" class="recherche form">
                        <div class="recherche-multicriteres">
                            <label for="depart"></label><i class="fas fa-location-arrow"></i>&nbsp;
                            <input type="text" class="depart" name="depart" title="Choisir une ville de départ"
                                placeholder="Départ">
                            <label for="arrivee"></label>
                            <i class="fa-solid fa-location-dot"></i>&nbsp;
                            <input type="text" class="arrivee" name="arrivee" title="Choisir une ville d'arrivée"
                                placeholder="Arrivée">
                            <label for="date_depart"></label>
                            <i class="fa-solid fa-calendar-days"></i>&nbsp;
                            <input type="date" class="date_depart" name="date" title="Choisir une date de départ">
                            <button type="submit" name="search" id="submitSearchBtn" class="hide"
                                aria-label="Rechercher" style="float: right;">
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
                        <a href="/login"><i class="fas fa-user f"></i><span>Connexion</span></a>
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
    <div class="c-container">

        <h1 style="color: #000000; text-transform: uppercase;">Notre engagement</h1>


        <ul>
            <li>

                <h2>VISION</h2></br>
                <p>Une plateforme de covoiturage responsable et soucieuse de l’environnement.</p>
                <img src="../images/vision.png" alt="image d'une ampoule allumé"></br>
            </li>






            <li>

                <h2>MISSION</h2></br>
                <p> Soutenir la cause écologique est notre principale mission. Notre objectif est de réduire par
                    trois
                    l'impact environnemental de vos déplacements. Participez à la révolution verte en utilisant
                    notre
                    plateforme de covoiturage.</p>
                <img src="../images/mission.png" alt="illustration de la planete terre"></br>
            </li>




            <li>
                <h2>VALEURS</h2></br>
                <p>Chez <u>ECORIDE</u>,Nous prônons des valeurs écologiques pour une consommation responsable et
                    une
                    approche pragmatique de la résolution des problèmes actuels.</p><img src="../images/valeurs.png"
                    alt="image de trois mains qui se reunissent">
            </li>
        </ul>
        <div class="dots"></div>
    </div>


    <h2>Pourquoi nous choisir ?</h2>

    <div class="grid-container">
        <div class="grid-item">

            <h3>Notre Equipe :</h3>
            <p>Nous sommes fiers de vous présenter notre équipe engagée dans la révolution verte de nos déplacements.
                Notre équipe se compose d'un Community manager, Mateo, en charge du contenu posté sur ce site et les
                réseaux sociaux. Il a la charge de répondre à toute vos questions concernant notre plateforme et le
                service qu'elle propose. Nous avons Léa, Mathilde et Corentin, en charge du développement et de la
                maintenance de notre plateforme. C'est grâce à eux si l'application fonctionne bien et nous permet
                d'offrir un des meilleurs services de covoiturage en France.</p>
        </div>

    </div>


    <div class="grid-container">
        <div class="grid-item">
            <h3 class="">Vivez votre </br>plus belle </br>experience</h3>
            <p>Réduisez votre impact écologique de 75% en utilisant notre plateforme de co-voiturage.<br /> Nous vous
                permettons de voyager en toute sécurité et en respectant l'environnement.<br /> Nous sommes la
                plateforme la
                plus simple et facile d'accès.<br /> L'expérience que nous avons décidé de vous faire vivre est
                exceptionnel
                dans <br />le domaine du co-voiturage, une plateforme facile à prendre en main,<br /> des chauffeurs qui
                remplissent
                nos conditions et standard de voyage pour<br /> vous permettre de voyager en toute sérénité et sécurité.
            </p>
        </div>
    </div>


    <div class="content-wrap">

        <main>
            <section>
                <h2 class="mobile">Nos destinations les plus actives</h2><br />
                <p class="mobile">
                    Paris<br />Lyon<br />Marseille<br />Poitiers<br />Montpellier<br />Bordeaux<br />Toulouse<br /></p>
                <div class="content">

                    <div class="grid">
                        <div class="layer">
                            <div>
                                <img src="https://images.unsplash.com/photo-1719410092943-30d6d78a6382?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1559286024-87b48d2fedc6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1566079211528-ec2251fcefb9?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1635863153370-6cc0a7c01e46?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1635863151013-98ad529c5a39?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzB8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1632389097299-263a85c94063?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzR8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <!-- <img src="https://picsum.photos/400/500?random=1" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=2" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=3" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=4" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=5" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=6" alt="" /> -->
                        </div>
                        <div class="layer">
                            <div>
                                <img src="https://images.unsplash.com/photo-1618994834439-0abec35cc06c?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDB8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1632951910303-be174876f616?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDJ8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1615147990135-2c4ccb0876e6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTJ8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1617209122641-b2ebd32d8e31?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTV8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1632951910262-14d8674959e1?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTl8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1635972497448-4bc16d2799cd?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NjB8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <!-- <img src="https://picsum.photos/400/500?random=7" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=8" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=9" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=10" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=11" alt="" /> -->
                            <!-- <img src="https://picsum.photos/400/500?random=12" alt="" /> -->
                        </div>
                        <div class="layer">
                            <div>
                                <img src="https://images.unsplash.com/photo-1635972496054-5d488043027e?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NjJ8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                            <div>
                                <img src="https://images.unsplash.com/photo-1451857652021-e406bc6bfea9?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nzl8fHZpbGxlJTIwZGUlMjBmcmFuY2V8ZW58MHx8MHx8fDA%3D"
                                    alt="" />
                            </div>
                        </div>
                        <div class="scaler">
                            <img src="https://images.unsplash.com/photo-1655574283119-232a804c4ff6?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8dmlsbGUlMjBkZSUyMGZyYW5jZXxlbnwwfHwwfHx8MA%3D%3D"
                                alt="" />
                        </div>
                    </div>
                </div>
            </section>

        </main>
        <section class="scroll-buffer">
            <div class="box">
                <h2>Les avantages</h2>


                <p> Créer du lien social en voyageant avec des personnes qui partagent les mêmes valeurs que vous.
                    Vous avez
                    la possibilité de rencontrer des personnes de tout horizon et de partager des moments
                    inoubliables avec
                    eux. Vous avez aussi la possibilité de voyager en toute sécurité et en respectant
                    l'environnement.</p>




                <p>Soutenir la cause écologique est notre principale mission. Réduire par trois l'impact
                    environnemental de
                    vos déplacements est notre objectif. Participer à la révolution verte en utilisant notre
                    plateforme de
                    co-voiturage.</p></br>
            </div><br />




        </section>
    </div>
    <div class="search-form-section">

        <div class="search-form-button">
            <button id="add-search-btn" class="add-search-btn" type="button" aria-label="Ajouter une recherche">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <div id="ecoride-recherche" class="hide">
        <div class="recherche-container-bottom ">
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
                    <button type="submit" name="search" aria-label="Rechercher" style="float: right;">
                        <i class="fas fa-search"></i>

                    </button>
                </div>
            </form>
        </div>
    </div><br /></br></br>
    <div class="tittle"></br>

        <h3>Nos meilleurs avis</h3>
    </div>
    <div class="Avis">
        <ul>
            <li>
                <p>"J'ai récemment utilisé cette plateforme de covoiturage pour un voyage de Lyon à
                    Paris, et je suis
                    extrêmement satisfait de mon expérience. Le processus de réservation était simple et intuitif,
                    et j'ai pu trouver un conducteur fiable en quelques minutes. Le trajet s'est déroulé sans
                    encombre, avec un conducteur ponctuel et courtois. De plus, le prix était très compétitif par
                    rapport aux autres options de transport. Je recommande vivement cette plateforme à tous ceux qui
                    cherchent une alternative économique et conviviale pour leurs déplacements." - <i>Jean, 34
                        ans</i>
                </p>
            </li>
            <li>
                <p>"Utiliser cette plateforme de covoiturage a été une expérience fantastique du début à
                    la fin. J'ai
                    trouvé un trajet de Marseille à Lyon avec un conducteur très sympathique et professionnel. La
                    voiture était propre et confortable, ce qui a rendu le voyage agréable. J'ai également apprécié
                    la flexibilité offerte par la plateforme, me permettant de choisir des horaires qui convenaient
                    parfaitement à mon emploi du temps. En plus d'économiser de l'argent, j'ai eu l'occasion de
                    rencontrer des personnes intéressantes en cours de route. Je n'hésiterai pas à utiliser cette
                    plateforme à nouveau pour mes futurs voyages." - <i>Sophie, 28 ans</i></p>
            </li>
            <li>
                <p>"Je suis ravi d'avoir découvert cette plateforme de covoiturage ! Mon voyage de
                    Montpellier à
                    Nice s'est déroulé sans accroc grâce à un conducteur ponctuel et amical. Le processus de
                    réservation en ligne était fluide, et j'ai pu choisir parmi plusieurs options de trajets. Le
                    prix était très abordable, ce qui m'a permis d'économiser par rapport aux autres moyens de
                    transport. De plus, j'ai apprécié l'aspect écologique du covoiturage, contribuant ainsi à
                    réduire
                    mon empreinte carbone. Je recommande vivement cette plateforme à tous ceux qui cherchent une
                    solution pratique et économique pour leurs déplacements." - <i>Lucas, 30 ans</i></p>
            </li>
        </ul>
        <div class="dots"></div>
    </div>


    </div><br /></br>


    <h2>Foire aux questions</h2></br>


    <div class="accordion" id="accordionExample" style="color:#000000">
        <div class="accordion-item">
            <p class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
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
            <img src="../images/communicate-2.png" alt="image de trois logo de contact,email telephone et messagerie">
            
            
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
            <h2>Merci de votre visite</h2>
        </div>
    </div>
    <footer>
        <h1>ECORIDE</h1>
        <p>Designed by <span>Driss</span>Copyright &copy;2026 ECORIDE.</p> 

    </footer>
    <script>
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
    // affiche du formulaire de recherche

    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("add-search-btn");
        const searchContainer = document.querySelector("#ecoride-recherche");

        toggleButton.addEventListener("click", function() {
            searchContainer.classList.toggle("active");
        });
    });
    </script>
    <!-- Tweakpane et GSAP via CDN -->
    <script type="module" crossorigin="anonymous">
    import {
        Pane
    } from 'https://esm.sh/tweakpane@4.0.4';
    import gsap from 'https://esm.sh/gsap@3.12.0';
    import ScrollTrigger from 'https://esm.sh/gsap@3.12.0/ScrollTrigger';

    let layersCtrl;
    let centerCtrl;
    let staggerCtrl;
    let scalerTl;
    let layersTl;

    // Détection du support de View Timeline
    const hasScrollSupport = CSS.supports(
        '(animation-timeline: view()) and (animation-range: 0 100%)'
    );

    const config = {
        theme: 'system',
        enhanced: true,
        stick: true,
        layers: true,
        center: true,
        stagger: 'range',
    };

    const ctrl = new Pane({
        title: 'Config',
        expanded: true,
    });

    if (!hasScrollSupport) {
        gsap.registerPlugin(ScrollTrigger);
        console.info('GSAP ScrollTrigger registered');
    }

    const update = () => {
        document.documentElement.dataset.theme = config.theme;
        document.documentElement.dataset.enhanced = config.enhanced;
        document.documentElement.dataset.stick = config.stick;
        document.documentElement.dataset.center = config.center;
        document.documentElement.dataset.layers = config.layers;
        document.documentElement.dataset.stagger = config.stagger;

        if (config.enhanced && !hasScrollSupport) {
            // Image scaling
            scalerTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: 'main section:first-of-type',
                        start: 'top -10%',
                        end: 'bottom 80%',
                        scrub: true,
                    },
                })
                .from(
                    '.scaler img', {
                        height: window.innerHeight - 32,
                        ease: 'power1.inOut',
                    },
                    0
                )
                .from(
                    '.scaler img', {
                        width: window.innerWidth - 32,
                        ease: 'power2.inOut',
                    },
                    0
                );

            // Layers animation
            layersTl = gsap.timeline({
                    scrollTrigger: {
                        trigger: 'main section:first-of-type',
                        start: 'top -40%',
                        end: 'bottom bottom',
                        scrub: true,
                    },
                })
                .from(
                    '.layer:nth-of-type(1)', {
                        opacity: 0,
                        scale: 0,
                        ease: 'power1.inOut',
                    },
                    0
                )
                .from(
                    '.layer:nth-of-type(2)', {
                        opacity: 0,
                        scale: 0,
                        ease: 'power3.inOut',
                    },
                    0
                )
                .from(
                    '.layer:nth-of-type(3)', {
                        opacity: 0,
                        scale: 0,
                        ease: 'power4.inOut',
                    },
                    0
                );
        } else {
            gsap.set(['.scaler img', '.layer'], {
                attr: {
                    style: undefined,
                },
            });
            scalerTl?.kill();
            layersTl?.kill();
            scalerTl = undefined;
            layersTl = undefined;
        }

        if (hasScrollSupport) {
            layersCtrl.hidden = !config.enhanced;
            staggerCtrl.hidden = !config.enhanced;
            centerCtrl.hidden = !config.enhanced;
        }
    };

    const sync = (event) => {
        if (
            !document.startViewTransition ||
            event.target.controller.view.labelElement.innerText !== 'Theme'
        ) {
            return update();
        }
        document.startViewTransition(() => update());
    };

    // Bindings Tweakpane
    ctrl.addBinding(config, 'enhanced', {
        label: 'Enhance',
    });

    if (hasScrollSupport) {
        centerCtrl = ctrl.addBinding(config, 'center', {
            label: 'Center',
            hidden: !config.enhanced,
        });
        layersCtrl = ctrl.addBinding(config, 'layers', {
            label: 'Layers',
            hidden: !config.enhanced,
        });
        staggerCtrl = ctrl.addBinding(config, 'stagger', {
            label: 'Stagger',
            options: {
                Range: 'range',
                Timing: 'timing',
            },
            hidden: !config.enhanced,
        });
    }

    ctrl.addBinding(config, 'stick', {
        label: 'Stick',
    });

    ctrl.addBinding(config, 'theme', {
        label: 'Theme',
        options: {
            System: 'system',
            Light: 'light',
            Dark: 'dark',
        },
    });

    ctrl.on('change', sync);
    update();
    </script>



    <script src="../JS/navbarOnScroll.js"></script>
    <script src="../JS/toggleResearch.js"></script>
    
    


</body>