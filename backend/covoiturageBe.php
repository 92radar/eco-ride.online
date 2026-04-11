<?php

require __DIR__ . '/pdo.php';


if (!isset($pdo) || !($pdo instanceof PDO)) {
    $error = "Connexion a la base de donnees impossible.";
    return;
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $researcheResult = [];

    $success = null;
    $error = null;


    if (isset($_GET['depart']) && isset($_GET['arrivee']) || isset($_GET['date'])) {
        $depart = $_GET['depart'];
        $arrivee = $_GET['arrivee'];
        $date = $_GET['date']; {
            try {
                $researchStmt = $pdo->prepare("SELECT COUNT(*) FROM covoiturages WHERE lieu_depart = :lieu_depart AND lieu_arrivee = :lieu_arrivee AND nb_place > 0 AND statut = 'en_attente'");
                $researchStmt->bindParam(':lieu_depart', $depart, PDO::PARAM_STR);
                $researchStmt->bindParam(':lieu_arrivee', $arrivee, PDO::PARAM_STR);

                $researchStmt->execute();
                $resultNumber = $researchStmt->fetchAll(PDO::FETCH_ASSOC);
                $resultNumber = $resultNumber[0];
                $count = $resultNumber['COUNT(*)'];
                $countSuccess = 'Nombre de covoiturages trouvés : ' . $count;


                if ($count > 0) {
                    $researchStmt = $pdo->prepare("SELECT 
                c.*, 
                u.nom AS nom, 
                u.average_note AS average_note,
                u.photo AS photo,
                u.prenom AS prenom, 
                v.energie AS energie, 
                c.statut AS statut,
                c.duree_heures_minutes
            FROM covoiturages c
            INNER JOIN utilisateurs u ON c.user_id = u.user_id
            INNER JOIN voitures v ON c.voiture_id = v.voiture_id
            WHERE c.nb_place > 0
            AND c.statut = 'en_attente'
              AND c.lieu_depart = :lieu_depart
              AND c.lieu_arrivee = :lieu_arrivee
              AND c.date_depart LIKE :date_depart ORDER BY c.date_depart ASC
        ");

                    $researchStmt->bindParam(':lieu_depart', $depart, PDO::PARAM_STR);
                    $researchStmt->bindParam(':lieu_arrivee', $arrivee, PDO::PARAM_STR);
                    $researchStmt->bindValue(':date_depart', $date . '%', PDO::PARAM_STR);

                    $researchStmt->execute();
                    $researcheResult = $researchStmt->fetchAll(PDO::FETCH_OBJ);
                    $success = 'Recherche effectuée avec succès. ';
                } else {
                    $error = 'Aucun covoiturage trouvé';
                    $researcheResult = [];
                }
            } catch (PDOException $e) {
                $error = $e->getMessage();
            }
        }
    }





    if (isset($_POST['participer'])) {

        $covoiturage_id = $_POST['covoiturage_id'];
        header("Location: https://eco-ride.online/participer?covoiturage_id=$covoiturage_id");
    }


// else {
//     header("Location: https://eco-ride.online/login");
//     exit();
// }
