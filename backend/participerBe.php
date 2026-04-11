<?php




require __DIR__ . '/pdo.php';


if (!isset($pdo) || !($pdo instanceof PDO)) {
    $error = "Connexion a la base de donnees impossible.";
    return;
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$covoiturage = null; // Initialisation de $covoiturage



if (isset($_GET['covoiturage_id'])) {
    $covoiturage_id = $_GET['covoiturage_id'];



    try {
        $stmt = $pdo->prepare("SELECT user_id FROM covoiturages WHERE covoiturage_id = :covoiturage_id");
        $stmt->bindParam(':covoiturage_id', $covoiturage_id);
        $stmt->execute();
        $userId = $stmt->fetch(PDO::FETCH_ASSOC);
        $userId = $userId['user_id'];
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des avis : " . $e->getMessage();
    }


    try {
        $stmt = $pdo->prepare("
            SELECT c.*, u.nom AS nom, u.average_note AS average_note, u.prenom AS prenom, u.date_naissance, u.photo,
                   v.marque, v.modele, v.couleur, v.immatriculation, v.energie
            FROM covoiturages c
            LEFT JOIN utilisateurs u ON c.user_id = u.user_id
            LEFT JOIN voitures v ON c.voiture_id = v.voiture_id
            WHERE c.covoiturage_id = :covoiturage_id
        ");
        $stmt->bindParam(':covoiturage_id', $covoiturage_id, PDO::PARAM_INT);
        $stmt->execute();
        $covoiturage = $stmt->fetch(PDO::FETCH_OBJ); // Utilisation de fetch()
        // var_dump($covoiturage);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des informations du covoiturage : " . $e->getMessage();
    }

    try {
        $stmt = $pdo->prepare("
            SELECT DISTINCT
                u.user_id,
                u.nom,
                u.prenom,
                u.photo,
                a.avis_id,
                a.commentaire,
                a.note
            FROM participations p
            INNER JOIN avis a ON p.voyageur_id = a.voyageur_id
            INNER JOIN utilisateurs u ON a.voyageur_id = u.user_id
            WHERE p.chauffeur_id = :chauffeur_id
            AND a.statut_avis = 'validé' 
        ");

        $stmt->bindParam(':chauffeur_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $avis = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
    }
}


if (isset($_POST['participer']) && $covoiturage) {
    $covoiturage_id = $covoiturage->covoiturage_id;
    header("Location: https://eco-ride.online/confirmation?covoiturage_id=$covoiturage_id");
    exit();
}
