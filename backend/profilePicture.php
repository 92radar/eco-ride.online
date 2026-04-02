<?php



require_once __DIR__ . '/../vendor/autoload.php'; // Ajuste selon ton chemin d'autoload

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // remonte d’un dossier vers eco-ride.online/
$dotenv->load();





$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];


$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
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
var_dump($photo->photo);
