<?php



require_once __DIR__ . '/../backend/participerBe.php';


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

    <title>Détails du covoiturage</title>
</head>



<body>
   <?php include '../elements/navigation.php'; ?>


    <div class="c-container">
        <h1>Informations sur le chauffeur</h1>
        <p class="t-black">
            Voici les informations sur le chauffeur du trajet que vous avez choisi. Si vous souhaitez participer à ce
            trajet,
            cliquez sur le bouton "Participer".
        </p><br>
        <hr style="width: 80%; margin: auto; margin-bottom: 20px;">


        <?php if (!empty($covoiturage)) : ?>

        <div class="form-control">
            <div class="publication-header">
                <div class="utilisateur-info">
                    <div class="profile-picture">
                        <img src="/backend/profilePicture.php?covoiturage_id=<?= htmlspecialchars($covoiturage->covoiturage_id) ?>"
                        alt="Photo de <?= htmlspecialchars($covoiturage->nom) ?>" class="photo-utilisateur"
                        height="50" width="50">
                    </div>

                    <strong>
                        <p class="t-black" name="prenom">
                            <?= htmlspecialchars($covoiturage->prenom) ?>
                            <?= htmlspecialchars($covoiturage->nom) ?></p>
                    </strong>

                    <p class="t-black" name="date_naissance"><strong>Date de naissance :</strong>
                        <?= htmlspecialchars($covoiturage->date_naissance) ?>
                    </p> <p class="t-black" name="marque"><strong>Marque de la voiture :</strong>
                        <?= htmlspecialchars($covoiturage->marque) ?>
                    </p>
                    <p class="t-black" name="voiture"><strong>Modèle de la voiture :</strong>
                        <?= htmlspecialchars($covoiturage->modele) ?>
                    </p>
                    <p class="t-black" name="couleur"><strong>Couleur de la voiture :</strong>
                        <?= htmlspecialchars($covoiturage->couleur) ?>
                    </p>
                    <p class="t-black" name="nom"><strong>Immatriculation du véhicule :</strong>
                        <?= htmlspecialchars($covoiturage->immatriculation) ?>

                    </p>
                    <p class="t-black" name="note"><strong>Note moyenne :</strong>
                        <?= htmlspecialchars($covoiturage->average_note) ?> ⭐</p>

                </div>
            </div>
        </div></br>

        <h2>Préférences du chauffeur</h2>
        <p class="description">
            Voici les préférences du chauffeur du trajet que vous avez choisi.
        </p><br>
        <div class="t-black">
            <p><?= htmlspecialchars($covoiturage->commentaire ?? 'Aucune préférence') ?><br>
            </p>
        </div></br>
        <?php else: ?>
        <p>Covoiturage non trouvé.</p>
        <?php endif; ?>

        <hr style="width: 80%; margin: auto; margin-bottom: 20px; margin-top: 60px;">
        <div class="utilisateur-info">
            <h2>Avis des Participants</h2>
        </div>
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

        <hr style="width: 80%; margin: auto; margin-bottom: 20px; margin-top: 60px;">
        <h2>Information sur le trajet</h2>
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
                <button class="btn btn-primary w-100" type="submit" name="participer">Participer</button>

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