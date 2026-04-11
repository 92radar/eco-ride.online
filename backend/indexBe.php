<?php

 ini_set('error_log', '/Users/macosdev/Documents/GitHub/ecoRide-DrissBenkirane/php-error.log');

    require __DIR__ . '/pdo.php';


    if (!isset($pdo) || !($pdo instanceof PDO)) {
        $error = "Connexion a la base de donnees impossible.";
        return;
    }


    require_once __DIR__ . '/../vendor/autoload.php'; // Ajuste selon ton chemin d'autoload


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // remonte d'un dossier vers eco-ride.online/
$dotenv->load();
