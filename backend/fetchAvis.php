<?php
header('Content-Type: application/json');


require __DIR__ . '/pdo.php';

if (!isset($pdo) || !($pdo instanceof PDO)) {
    echo json_encode(['error' => 'Connexion à la base de données impossible.']);
    exit();
}

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $avisId = $_GET['avis_id'] ?? null;
    
    if (!$avisId) {
        echo json_encode(['error' => 'ID d\'avis manquant']);
        exit();
    }

    $stmt = $pdo->prepare("
        SELECT a.*, u.nom, u.prenom
        FROM avis a
        INNER JOIN utilisateurs u ON a.voyageur_id = u.user_id
        WHERE a.avis_id = :avis_id
    ");
    $stmt->bindParam(':avis_id', $avisId, PDO::PARAM_INT);
    $stmt->execute();

    $avis = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($avis) {
        echo json_encode($avis); // ✅ ENVOI DES DONNÉES ATTENDUES PAR LE JS
    } else {
        echo json_encode(['error' => 'Avis introuvable']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur DB : ' . $e->getMessage()]);
}
