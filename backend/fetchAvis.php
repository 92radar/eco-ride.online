<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit();
}

$avisId = $_GET['avis_id'] ?? null;
if (empty($avisId)) {
    echo json_encode(['error' => 'ID de l\'avis manquant']);
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
