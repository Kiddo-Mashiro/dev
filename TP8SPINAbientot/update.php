<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour d'une ligne</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Mise à jour d'une ligne</h1>

    <form action="update.php" method="post">
        <label for="table">Choisir une table :</label>
        <select name="table" id="table">
            <option value="client">Client</option>
            <option value="produit">Produit</option>
            <option value="commande">Commande</option>
            <option value="lignecom">Lignecom</option>
        </select>
        <button type="submit">Afficher le tableau</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table'])) {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=tp2_sio1_commande', 'root2', 'pass');

        $tableName = $_POST['table'];

        $result = $pdo->query("SELECT * FROM `$tableName`");
        if ($result->rowCount() > 0) {
            echo "<table border='1'>";

            $columns = $result->fetch(PDO::FETCH_ASSOC);
            foreach ($columns as $col => $value) {
                echo "<th>$col</th>";
            }

            echo "</tr>";

            $rowCount = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }

                echo "</tr>";
                $rowCount++;
            }

            echo "</table>";

            echo "<form action='update_process.php' method='post'>";
            echo "<input type='hidden' name='table' value='$tableName'>";

            // Menu déroulant pour choisir la colonne
            echo "<label for='selectedColumn'>Choisir la colonne :</label>";
            echo "<select name='selectedColumn' id='selectedColumn'>";
            $columnsStmt = $pdo->query("SHOW COLUMNS FROM `$tableName`");
            $columns = $columnsStmt->fetchAll(PDO::FETCH_COLUMN);
            foreach ($columns as $column) {
                echo "<option value='$column'>$column</option>";
            }
            echo "</select>";

            // Champ pour l'ancienne valeur
            echo "<label for='oldValue'>Ancienne valeur :</label>";
            echo "<input type='text' name='oldValue' required>";

            // Champ pour la nouvelle valeur
            echo "<label for='newValue'>Nouvelle valeur :</label>";
            echo "<input type='text' name='newValue' required>";

            echo "<button type='submit'>Mettre à jour</button>";
            echo "</form>";
        } else {
            echo "<p>Aucune donnée trouvée dans la table $tableName.</p>";
        }
    }
    ?>


</body>

</html>
