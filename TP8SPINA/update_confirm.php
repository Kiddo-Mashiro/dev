<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de la mise à jour</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Confirmation de la mise à jour</h1>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table']) && isset($_POST['selectedID'])) {
                // details connexion
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=tp2_sio1_commande', 'root2', 'pass');

        $tableName = $_POST['table'];
        $selectedID = $_POST['selectedID'];


    
/*
        // id existe
        $result = $pdo->query("SHOW COLUMNS FROM `$tableName` LIKE 'id'");

        if ($result->rowCount() > 0) {

            $updateQuery = "UPDATE `$tableName` SET ";
            // oui
            foreach ($_POST as $col => $value) {
                if ($col !== 'table' && $col !== 'selectedID') {
                    $updateQuery .= "`$col` = '$value', ";
                }
            }

            $updateQuery = rtrim($updateQuery, ', ');
            $updateQuery .= " WHERE id = $selectedID";
        } else {
            // non
            $updateQuery = "UPDATE `$tableName` SET ";

            foreach ($_POST as $col => $value) {
                if ($col !== 'table' && $col !== 'selectedID') {
                    $updateQuery .= "`$col` = '$value', ";
                }
            }

            $updateQuery = rtrim($updateQuery, ', ');
            $updateQuery .= " LIMIT $selectedID, 1";
        }

        // exec
        if ($pdo->query($updateQuery) === TRUE) {
            echo "<p>Données mises à jour avec succès.</p>";
        } else {
            echo "Erreur lors de la mise à jour des données: " . $pdo->error;
        }*/

    }
    ?>

    <p><a href="index.html">Retour à l'accueil</a></p>
</body>

</html>
