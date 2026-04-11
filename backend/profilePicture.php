<?php

require __DIR__ . '/pdo.php';

if (!isset($pdo) || !($pdo instanceof PDO)) {
    echo "Connexion à la base de données impossible.";
    exit();
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        $stmt = $pdo->prepare(" SELECT photo FROM utilisateurs WHERE user_id = :user_id ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $photo = $stmt->fetch(PDO::FETCH_OBJ); // Utilisation de fetch()
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des informations du covoiturage : " . $e->getMessage();
    }
}
header('Content-Type: image/jpeg');
echo file_get_contents('../public/uploads/' . $photo->photo);
