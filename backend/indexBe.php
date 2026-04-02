<?php


ini_set('error_log', '/Users/macosdev/Documents/GitHub/ecoRide-DrissBenkirane/php-error.log');

require_once __DIR__ . '/../vendor/autoload.php'; // Ajuste selon ton chemin d'autoload
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // remonte d’un dossier vers eco-ride.online/
$dotenv->load();


if (isset($_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {




    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $dbname = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASSWORD'];


    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $stmt = $pdo->prepare("SELECT nom, prenom FROM utilisateurs WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $welcome = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($welcome) {
            $welcomeInfo = $welcome[0]; // Récupérer le premier élément
        }



        $success = "Bienvenue "  . $welcomeInfo->prenom  . " ,vous etes connecté";
    } catch (PDOException $e) {
        $error = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
