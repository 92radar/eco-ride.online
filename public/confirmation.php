<?php


require_once __DIR__ . '/../backend/confirmationBe.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (PNG et ICO pour compatibilité maximale) -->
    <link rel="icon" type="image/png"
        href="https://eco-ride.online/images/IconOnly_Transparent_NoBuffer-2-copie-32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Confirmer votre participation</title>
</head>


<body>


    <?php include '../elements/navigation.php'; ?>






    <div class="pt-200 m-20">
        
        <h1 class="center">Confirmer votre participation</h1>
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

                                <span class="t-black">
                                    <?= htmlspecialchars($covoiturageInfo->nom) ?>
                                    <?= htmlspecialchars($covoiturageInfo->prenom) ?>
                                    
                                </span>

                                propose :

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


         <?php 
            if ($userInfo && isset($userInfo->nom)) {
                echo '<h2>' . htmlspecialchars($userInfo->nom . ' ' . $userInfo->prenom) . '</h2>';
            } else {
                echo '<h2>Utilisateur inconnu</h2>';
            }
            ?>

        <?php if ($covoiturageInfo): ?>
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
            <form action="" method="post" class="center flex">
                <p>
                    <strong>Nombre de places demandées :</strong>
                </p></br />
                <input type="number" name="nb_place" class="form-control" placeholder="exemple: 1" value="" min="1"
                    max="<?= htmlspecialchars($covoiturageInfo->nb_place) ?>" required>

                <input type="hidden" name="covoiturage_id"
                    value="<?= htmlspecialchars($covoiturageInfo->covoiturage_id) ?>">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                    <button type="submit" class="btn btn-primary w-50" name="confirmer_participation">Confirmer</button>
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