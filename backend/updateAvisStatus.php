<?php
header('Content-Type: application/json');


require __DIR__ . '/pdo.php';

if (!isset($pdo) || !($pdo instanceof PDO)) {
    echo json_encode(['error' => 'Connexion à la base de données impossible.']);
    exit();
}


$avisId = $_POST['avis_id'] ?? null;

$nouveauStatut = $_POST['statut_avis'] ?? null;

if (empty($avisId) || empty($nouveauStatut) || !in_array($nouveauStatut, ['validé', 'refuser', 'en_attente'])) {
    echo json_encode(['error' => 'Données invalides']);
    exit();
}

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("UPDATE avis SET statut_avis = :statut_avis WHERE avis_id = :avis_id");
    $stmt->bindParam(':statut_avis', $nouveauStatut, PDO::PARAM_STR);
    $stmt->bindParam(':avis_id', $avisId, PDO::PARAM_INT);
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => 'Statut de l\'avis mis à jour avec succès']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur DB : ' . $e->getMessage()]);
}
