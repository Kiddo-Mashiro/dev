<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insérer une ligne</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Insérer une ligne</h1>

    <form action="insert.php" method="post">
        <label for="table">Choisir une table :</label>
        <select name="table" id="table">
            <option value="client">client</option>
            <option value="produit">produit</option>
            <option value="commande">commande</option>
            <option value="lignecom">lignecom</option>
        </select>

        <button type="submit">Afficher les champs</button>
    </form>
    <a href='index.html'><button>Retour à l'accueil</button></a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $table = $_POST["table"];

        $dsn = "mysql:host=localhost;dbname=tp2_sio1_commande";
        $username = "root2";
        $password = "pass";

        try {
            $pdo = new PDO($dsn, $username, $password);

            $columns = [];
            $stmt = $pdo->query("SHOW COLUMNS FROM `$table`");

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $columns[] = $row['Field'];
            }
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Insérer une ligne</title>
                <link rel="stylesheet" href="styles.css">
            </head>
            <body>
                <h1>Insérer une ligne</h1>

                <form action="insert.php" method="post">
                    <?php
                    foreach ($columns as $column) {
                        echo "<label for='$column'>$column :</label>";
                        echo "<input type='text' name='$column' id='$column' required>";
                    }
                    ?>

                    <button type="submit">Insérer</button>
                </form>

                <a href="index.html"><button>Retour à l'accueil</button></a>
            </body>
            </html>

            <?php
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }
    ?>
</body>
</html>
