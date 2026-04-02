<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_POST['formulaire'])) {


    // Validation de l'email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = "L'adresse e-mail n'est pas valide.";
    }


    // Récupération des données du formulaire
    $name = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $objet = $_POST['objet'];

    // Configuration de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'eco.ride.studi@gmail.com'; // Ton adresse Gmail
        $mail->Password = 'ewiv oucj nytx nlek'; // Ton mot de passe d'app
        $mail->SMTPSecure = 'tls'; // Ou 'ssl'
        $mail->Port = 587; // 465 pour SSL

        // Infos de l'email
        $mail->setFrom($email, 'Formulaire Contact');
        $mail->addAddress('eco.ride.studi@gmail.com'); // Adresse de réception

        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message du formulaire';
        $mail->Body = "
        <h2>Nouveau message</h2>
        <p><strong>Nom:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Objet:</strong> {$objet}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

        $mail->send();
        $success = 'Message envoyé avec succès !';
    } catch (Exception $e) {
        $error = "Le message n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
    }
}
