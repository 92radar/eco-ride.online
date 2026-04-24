<?php

if (isset($_POST['search'])) {
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    header("Location: https://eco-ride.online/public/covoiturage.php?depart=$depart&arrivee=$arrivee&date=$date");
    exit();
}

?>

<nav class="">
    <div id="brand">
        <div class="desktop">
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
                <li><a href="/employee"><i class="fas fa-user"></i><span>
                    Espace employés
                </span></a></li>
                <?php elseif ($_SESSION['role'] === 'user'): ?>
                <li><a href="/account"><i class="fas fa-user"></i><span>&nbsp;Profil</span></a>
                </li>
                <?php elseif ($_SESSION['role'] === 'admin'): ?>
                <li><a href="/admin"><i class="fas fa-user"></i><span>
                    Espace admin
                </span></a></li>
                <?php endif; ?>


                <li>
                    <a href="#"><i class="fas fa-info-circle"></i><span>A propos</span></a>
                </li>

                <li>
                    <form method="post" style="display:inline;">
                        <button class="dropdown-item" name="logout"><i
                                class="fas fa-sign-out-alt"></i>Déconnexion</button>
                    </form>
                </li>
                <?php endif; ?>

            </ul>
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
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dateDepartInput = document.getElementById("date");

        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // mois 0-indexé
        const day = String(today.getDate()).padStart(2, '0');

        const minDate = `${year}-${month}-${day}`;
        dateDepartInput.min = minDate;

    });
</script>