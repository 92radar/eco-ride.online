<?php

require_once __DIR__ . '/../backend/employeeBe.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../styles/app.css">
    <title>Espace modération Eco ride</title>
</head>



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
        <h1>Informations du profil</h1>
        <div class="profil">

            <?php if (!empty($userInfos)): ?>

                <div class="profil-info" id="">

                    <form action="" method="post">
                        <div class="form-group">
                            <div class="profil-details">
                            </div>
                            <strong>Nom :</strong><input class="form-control" type="text" name="nom"
                                value="<?= htmlspecialchars($userInfos->nom) ?>" required>
                            <strong>Prénom :</strong><input class="form-control" type="text" name="prenom"
                                value="<?= htmlspecialchars($userInfos->prenom) ?>" required>
                            <strong>Pseudo :</strong><input class="form-control" type="text" name="pseudo"
                                value="<?= htmlspecialchars($userInfos->pseudo) ?>" required>
                            <strong>Date de naissance :</strong><input class="form-control" type="date"
                                name="date_naissance" value="<?= htmlspecialchars($userInfos->date_naissance) ?>"
                                required><br />

                            <strong>Email :</strong><input class="form-control" type="email" name="email"
                                value="<?= htmlspecialchars($userInfos->email) ?>" required>
                            <strong>Adresse :</strong><input class="form-control" type="text" name="adresse"
                                value="<?= htmlspecialchars($userInfos->adresse) ?>" required>
                            <strong>
                                Ville :</strong><input class="form-control" type="text" name="ville"
                                value="<?= htmlspecialchars($userInfos->ville) ?>" required>
                            <strong>Numéro de téléphone :</strong><input class="form-control" type="text" name="telephone"
                                value="<?= htmlspecialchars($userInfos->telephone) ?>" required>



                        <?php else: ?>
                            <p>Aucune information utilisateur trouvée.</p>
                        <?php endif; ?>
                        </br>

                        <div class=" center ">
                            <button type="submit" name="modifier" class="btn btn-primary w-50">Modifier</button></br>

                        </div></br>
                    </form>
                    <form action="" method="post" class="center flex" enctype="multipart/form-data">
                        <label for="photo_profil">Modifier la photo de profil:</label>
                        <input type="file" id="photo_profil" name="photo_profil" accept="image/*">
                        <small>Formats acceptés: JPG, JPEG, PNG, GIF (max 5MB).</small>
                        <button type="submit" name="upload" class="btn btn-secondary w-50">Upload</button>
                    </form>


                </div>

            
                <div class="ligne-horizontale" id="section2"></div></br>
                <h2>Verifier les avis</h2></br>
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
                <h2>Les avis vérifiés</h2><br />



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