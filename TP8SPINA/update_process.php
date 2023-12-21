<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour d'une ligne - Processus</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Mise à jour d'une ligne - Processus</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table']) && isset($_POST['selectedID'])) {
                // details connexion
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=tp2_sio1_commande', 'root2', 'pass');


        // Récupérer le nom de la table et le numéro de ligne depuis le formulaire POST
        $tableName = $_POST['table'];
        $selectedID = $_POST['selectedID'];

        // Vérifier si la colonne 'id' existe dans la table
        $result = $pdo->query("SHOW COLUMNS FROM `$tableName` LIKE 'id'");

        if ($result->rowCount() > 0){
            // Si la colonne 'id' existe, utiliser la clause WHERE
            $result = $pdo->query("SELECT * FROM `$tableName` WHERE id = $selectedID");
        } else {
            // Sinon, utiliser LIMIT pour récupérer la ligne spécifique
            $result = $pdo->query("SELECT * FROM `$tableName` LIMIT $selectedID, 1");
        }

        if ($result->rowCount() > 0){
            while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            echo "<form action='update_confirm.php' method='post'>";
            echo "<input type='hidden' name='table' value='$tableName'>";
            echo "<input type='hidden' name='selectedID' value='$selectedID'>";
            }
            $columns = $result->fetchAll(PDO::FETCH_ASSOC);
            /*for($n = 0; $n < $row;$n++) {
                echo "<label for='$columns'>$columns :</label>";
                echo "<input type='text' name='$columns' value='$row'>"; 
            }*/
            foreach ($row as $col => $value) {
                echo "<label for='$col'>$col :</label>";
                echo "<input type='text' name='$col' value='$value'>";
            }

            echo "<button type='submit'>Mettre à jour</button>";
            echo "</form>";
        } else {
            echo "<p>Aucune donnée trouvée pour l'ID $selectedID dans la table $tableName.</p>";
        }

    }
    ?>

</body>

</html>