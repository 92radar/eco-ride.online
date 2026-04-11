<?php


require __DIR__ . '/pdo.php';


if (!isset($pdo) || !($pdo instanceof PDO)) {
    $error = "Connexion a la base de donnees impossible.";
    return;
}

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $avisDetails = null;
    $userInfos = null;
    $avisVerifie = [];
    $avis = [];

    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'employee') {

        $userId = $_SESSION['user_id'];


        try {
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $userInfos = $stmt->fetch(PDO::FETCH_OBJ); // Utilisation de fetchAll pour récupérer tous les résultats
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
        }
        try {
            $stmt = $pdo->prepare("
                SELECT DISTINCT
                u.user_id,
                u.nom AS nom,
                u.prenom AS prenom,
                
                u.average_note AS average_note,
                a.avis_id,
                a.commentaire,
                a.statut_avis,
                a.voyageur_id
                    
                    
                FROM participations p
                INNER JOIN avis a ON p.voyageur_id = a.voyageur_id
                INNER JOIN utilisateurs u ON a.voyageur_id = u.user_id
                
            ");


            $stmt->execute();
            $avisVerifie = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
        }
        try {
            $stmt = $pdo->prepare("
                SELECT DISTINCT
                u.user_id,
                u.nom AS nom,
                u.prenom AS prenom,
                
                u.average_note AS average_note,
                a.avis_id,
                a.commentaire,
                a.statut_avis,
                a.voyageur_id
                    
                    
                FROM participations p
                INNER JOIN avis a ON p.voyageur_id = a.voyageur_id
                INNER JOIN utilisateurs u ON a.voyageur_id = u.user_id
                WHERE statut_avis = 'en_attente'
            ");


            $stmt->execute();
            $avis = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des données : " . $e->getMessage();
        }

    if (isset($_POST['modifier'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['date_naissance'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $telephone = $_POST['telephone'];
        $pseudo = $_POST['pseudo'];

        try {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, email = :email, adresse = :adresse, ville = :ville, telephone = :telephone, pseudo = :pseudo WHERE user_id = :user_id");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':date_naissance', $dateNaissance);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $success = "Vos informations ont été mises à jour avec succès.";
        } catch (PDOException $e) {
            $error = "Erreur lors de la mise à jour des informations : " . $e->getMessage();
        }
    }
    if (isset($_FILES["photo_profil"]) && $_FILES["photo_profil"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo_profil"]["name"];
        $filetype = $_FILES["photo_profil"]["type"];
        $filesize = $_FILES["photo_profil"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        var_dump($ext);


        if (array_key_exists($ext, $allowed) && in_array($filetype, $allowed) && $filesize <= (5 * 1024 * 1024)) { // Exemple de validation
            $new_filename = uniqid() . "." . $ext;

            $upload_dir = "uploads/"; // Assurez-vous que ce dossier existe et est accessible en écriture
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $photo_profil_path = $upload_dir . $new_filename;

            if (!move_uploaded_file($_FILES["photo_profil"]["tmp_name"], $photo_profil_path)) {
                $error = "Erreur lors de l'upload de la photo.";
            } else {
                // Mettre à jour le chemin de la photo de profil dans la base de données
                try {
                    $stmt = $pdo->prepare("UPDATE utilisateurs SET photo = :photo_profil WHERE user_id = :id");
                    $stmt->bindParam(':photo_profil', $photo_profil_path);
                    $stmt->bindParam(':id', $userId);
                    $stmt->execute();
                    $success = "Informations et photo de profil mises à jour avec succès!";
                    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE user_id = :id");
                    $stmt->bindParam(':id', $userId);
                    $stmt->execute();
                    $userInfos = $stmt->fetchAll(PDO::FETCH_OBJ);
                } catch (PDOException $e) {
                    $error = "Erreur lors de la mise à jour du chemin de la photo de profil : " . $e->getMessage();
                }
            }
        } else {
            $error = "Format ou taille de fichier non autorisé pour la photo.";
        }
    }
} else {
    $error = "Vous devez être connecté en tant qu'employé pour accéder à cette page.";
}

if (isset($_POST['logout'])) {
    // Détruire la session et rediriger vers la page de connexion
    session_destroy();

    header("Location: https://eco-ride.online/login");
    exit();
}
