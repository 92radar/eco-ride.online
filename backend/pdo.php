<?php

session_start();


require_once __DIR__ . '/../vendor/autoload.php';

// Chemin vers la racine du projet (où se trouvent .env et .env.local)
$projectRoot = __DIR__ . '/..';

// Détecte l'environnement en priorité via APP_ENV, sinon via l'hôte.
$appEnv = $_SERVER['APP_ENV'] ?? (getenv('APP_ENV') ?: '');
$serverName = $_SERVER['SERVER_NAME'] ?? '';

$isLocal = in_array(strtolower($appEnv), ['local', 'dev', 'development'], true)
    || in_array($serverName, ['localhost', '127.0.0.1', '::1'], true);

if ($isLocal && file_exists($projectRoot . '/.env.local')) {
    $dotenv = Dotenv\Dotenv::createImmutable($projectRoot, '.env.local');
} else {
    $dotenv = Dotenv\Dotenv::createImmutable($projectRoot, '.env');
}

$dotenv->safeLoad();

try {
    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $port = $_ENV['DB_PORT'] ?? '3306';
    $dbname = $_ENV['DB_NAME'] ?? '';
    $user = $_ENV['DB_USER'] ?? '';
    $pass = $_ENV['DB_PASSWORD'] ?? '';

    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    
    die("Erreur de connexion SQL : " . $e->getMessage());
}



if (isset($_POST['logout'])) {
    // Détruire toutes les variables de session
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    // Rediriger vers la page de connexion ou la page actuelle (pour rafraîchir l'affichage)
    header("Location: https://eco-ride.online"); // Redirige vers la page home
    exit();
}