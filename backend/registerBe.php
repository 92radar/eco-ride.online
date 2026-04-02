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





$error = null;
$success = null;




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
    // Gérer l'erreur ici (par exemple, afficher un message d'erreur)
}
