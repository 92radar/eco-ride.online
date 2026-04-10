<?php



require_once __DIR__ . '/../backend/adminBe.php';

if (isset($_POST['logout'])) {
    // Détruire la session et rediriger vers la page de connexion
    session_destroy();
    header('Location: /login');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../styles/app.css">
    <title>Espace de Travail - Admin Eco ride</title>
</head>

<style>


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

</style>

<body>
    <?php include_once __DIR__ . '/../elements/navigation.php'; ?>



    <div class="m-20 pt-200">

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
                <?php foreach ($userInfos as $userInfo): ?>

                    <h2>Informations personnelles</h2>
                    <div class="profil-info" id="">

                        <form action="" method="post">
                            <div class="form-group">
                                <div class="profil-details">
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">


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


                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucune information utilisateur trouvée.</p>
                        <?php endif; ?>
                        </br>

                        <div class="center">
                            <button type="submit" name="modifier" class="btn btn-primary w-50">Modifier</button></br>

                        </div></br>
                        </form>
                        <div class="center flex">
                            <form action="" method="post" class="center flex" enctype="multipart/form-data">
                                <label for="photo_profil">Modifier la photo de profil:</label>
                                <input type="file" id="photo_profil" name="photo_profil" accept="image/*">
                                <small>Formats acceptés: JPG, JPEG, PNG, GIF (max 5MB).</small>
                                <button type="submit" name="upload" class="btn btn-secondary w-50">Upload</button>
                            </form>
                        </div>

                        <div class="ligne-horizontale" id="section2"></div></br>
                        <h2>Créer un compte</h2></br>
                        <form action="" method="post">
                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <strong>Nom :</strong></br><input class="form-control" type="text" name="nom" required></br>
                            <strong>Prénom :</strong></br><input class="form-control" type="text" name="prenom" required></br>
                            <strong>Pseudo :</strong></br><input class="form-control" type="text" name="pseudo" required></br>
                            <strong>Date de naissance :</strong></br><input class="form-control" type="date"
                                name="date_naissance" required></br>
                            <strong>Email :</strong></br><input class="form-control" type="email" name="email" required></br>
                            <strong>Adresse :</strong></br><input class="form-control" type="text" name="adresse" required></br>
                            <strong>Ville :</strong></br><input class="form-control" type="text" name="ville" required></br>
                            <strong>Numéro de téléphone :</strong></br><input class="form-control" type="text" name="telephone"
                                required></br>
                            <strong>Mot de passe :</strong></br><input class="form-control" type="password" name="password"
                                required></br>
                            <strong>Confirmer le mot de passe :</strong></br><input class="form-control" type="password"
                                name="confirm_password" required></br>
                            <legend> Role de l'utilisateur : </legend></br>
                            <select class="form-control" id="role" name="role"></br>
                                <option value="">Sélectionner un role</option>
                                <option value="employee"> Employé</option>
                                <option value="user"> Utilisateur</option>
                            </select></br>


                            <div class="center p-10 ">
                                <button type="submit" name="creer_compte_employe" class="btn btn-secondary w-50">Créer un nouveau compte
                                </button>
                            </div>


                        </form>
                    </div>
        </div>


        <div class="ligne-horizontale" id="section3"></div></br>
        <h2>Gestion des comptes employé et utilisateur</h2></br>
        <form method="GET" id="verifierAvisForm">
            <div class="form-group">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <label for="avis_id">Sélectionner un compte :</label>
                <select class="form-control" id="user_id" name="user_id" onchange="this.form.submit()">
                    <option value="">Sélectionner un compte</option>
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= htmlspecialchars($user->user_id) ?>"
                                <?= isset($_GET['user_id']) && $_GET['user_id'] == $user->user_id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user->nom) ?> <?= htmlspecialchars($user->prenom) ?>
                                (<?= htmlspecialchars($user->role) ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </form>

        <div class="ligne-horizontale"></div>

        </br>
        <?php if ($userDetails) : ?>

            <div class="form-group">
                <h3>Informations du compte sélectionné</h3>
                <strong>Nom :</strong></br><input class="form-control" type="text" name="nom"
                    value="<?= htmlspecialchars($userDetails->nom) ?>" disabled></br>
                <strong>Prénom :</strong></br><input class="form-control" type="text" name="prenom"
                    value="<?= htmlspecialchars($userDetails->prenom) ?>" disabled></br>
                <strong>Pseudo :</strong></br><input class="form-control" type="text" name="pseudo"
                    value="<?= htmlspecialchars($userDetails->pseudo) ?>" disabled></br>
                <strong>Date de naissance :</strong></br><input class="form-control" type="date" name="date_naissance"
                    value="<?= htmlspecialchars($userDetails->date_naissance) ?>" disabled></br>
                <strong>Email :</strong></br><input class="form-control" type="email" name="email"
                    value="<?= htmlspecialchars($userDetails->email) ?>" disabled></br>
                <strong>Telephone :</strong></br><input class="form-control" type="number" name="telephone"
                    value="<?= htmlspecialchars($userDetails->telephone) ?>" disabled></br>
                <form method="POST" action="">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    <label for="statut_avis">Changer le role de l'employé :</label></br>
                    <select class="form-control" id="user_role" name="user_role">
                        <option value="">Sélectionner un role</option>
                        <option value="employee">
                            Employé
                        </option>
                        <option value="user">
                            Utilisateur
                        </option>


                    </select>
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($userDetails->user_id) ?>">

                    <div class="center p-10 ">
                        <button type="submit" name="changer_role" class="btn btn-primary w-50 ">Changer le role</button>
                        <button type="submit" name="supprimer_compte" class="btn btn-danger w-50 ">Supprimer le compte</button>
                    </div>
                </form>
            </div>

        <?php else : ?>
            <p>Aucun employé sélectionné.</p>
        <?php endif; ?>
        <div class="ligne-horizontale"></div></br>
        <div class="c-container">
            <ul>
                <li>


                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





                    <h2>Graphique des activitées de l'entreprise</h2></br>
                    <h2>Nombre de covoiturages par jour (7 derniers jours)</h2>
                    <div>
                        <canvas id="monGraphiqueCovoiturages"></canvas>
                    </div>

                </li>
                <li>



                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



                    <h2>Gains de crédit par jour (<?php echo date('d/m/Y', strtotime($debutPeriode)); ?> au
                        <?php echo date('d/m/Y', strtotime($finPeriode)); ?>)</h2>

                    <div>
                        <canvas id="monGraphiqueCredits"></canvas>
                    </div>

                </li>
            </ul>
            <div class="dots">
                
            </div>

        </div>
        <script>
            const ctxCredits = document.getElementById('monGraphiqueCredits').getContext('2d');
            const monGraphiqueCredits = new Chart(ctxCredits, {
                type: 'line', // Un graphique linéaire est souvent plus approprié pour visualiser des tendances
                data: {
                    labels: <?php echo json_encode($jours); ?>,
                    datasets: [{
                        label: 'Crédits gagnés',
                        data: <?php echo json_encode($credits); ?>,
                        borderColor: 'rgba(75, 192, 192, 1)', // Couleur de la ligne
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond sous la ligne (facultatif)
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Crédits'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Jour'
                            }
                        }
                    }
                }
            });
        </script>
        <script>
            const ctxCovoiturages = document.getElementById('monGraphiqueCovoiturages').getContext('2d');
            const monGraphiqueCovoiturages = new Chart(ctxCovoiturages, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($joursCovoiturages); ?>,
                    datasets: [{
                        label: 'Nombre de covoiturages',
                        data: <?php echo json_encode($nombresCovoiturages); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de covoiturages'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Jour (JJ/MM)'
                            }
                        }
                    }
                }
            });
            //point de navigation carousel
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

        <script src="../JS/toggleResearch.js"></script>
        <script src="../JS/navbarOnScroll.js"></script>
</body>

</html>