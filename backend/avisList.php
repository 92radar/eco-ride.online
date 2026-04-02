<?php
session_start();
// ...vérifications d'authentification...

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
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'avis' => $avis]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
