<?php

require __DIR__ . '/pdo.php';

if (!isset($pdo) || !($pdo instanceof PDO)) {
    echo json_encode(['error' => 'Connexion à la base de données impossible.']);
    exit();
}


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
