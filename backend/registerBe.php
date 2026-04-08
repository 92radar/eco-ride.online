<?php

require __DIR__ . '/pdo.php';





$error = null;
$success = null;

if (!isset($pdo) || !($pdo instanceof PDO)) {
    $error = "Connexion a la base de donnees impossible.";
    return;
}




try {
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, date_naissance, email, password, telephone, adresse, ville, pseudo)
    VALUES (:nom, :prenom, :date_naissance, :email, :password, :telephone, :adresse, :ville, :pseudo)");

    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['date_naissance'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $pseudo = $_POST['pseudo'];


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $dateNaissance,
            'email' => $email,
            'password' => $hashedPassword,
            'telephone' => $telephone,
            'adresse' => $adresse,
            'ville' => $ville,
            'pseudo' => $pseudo

        ]);
        $success = "Votre compte a été créé avec succès";
    }
} catch (PDOException $e) {
    $error = "Adresse e-mail déjà utilisée";
}
