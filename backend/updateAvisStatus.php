<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit();
}
$avisId = $_POST['avis_id'] ?? null;
$nouveauStatut = $_POST['statut_avis'] ?? null;
if (empty($avisId) || empty($nouveauStatut) || !in_array($nouveauStatut, ['validé', 'refuser', 'en_attente'])) {
    echo json_encode(['error' => 'Données invalides']);
    exit();
}
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];
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
