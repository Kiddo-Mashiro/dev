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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table']) && isset($_POST['oldValue']) && isset($_POST['newValue']) && isset($_POST['selectedColumn'])) {

    $pdo = new PDO('mysql:host=127.0.0.1;dbname=tp2_sio1_commande', 'root2', 'pass');

    $tableName = $_POST['table'];
    $oldValue = $_POST['oldValue'];
    $newValue = $_POST['newValue'];
    $selectedColumn = $_POST['selectedColumn'];

    $updateStmt = $pdo->prepare("UPDATE `$tableName` SET `$selectedColumn` = :newValue WHERE `$selectedColumn` = :oldValue");
    $updateStmt->bindParam(':newValue', $newValue);
    $updateStmt->bindParam(':oldValue', $oldValue);
    $updateStmt->execute();

    $rowCount = $updateStmt->rowCount();
    if ($rowCount > 0) {
        echo "<p>Mise à jour effectuée avec succès.</p>";
    } else {
        echo "<p>Aucune ligne mise à jour. L'ancienne valeur '$oldValue' n'existe peut-être pas dans la colonne $selectedColumn de la table $tableName.</p>";
    }
}

?>

<p><a href="index.html">Retour à l'accueil</a></p>
</body>

</html>