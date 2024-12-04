<?php
include '../include.php'; 
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../login.php");
    exit();
}

$voitures = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    try {
        $query = "SELECT * FROM voitures WHERE Disponibilite = 1 AND ID NOT IN (
                    SELECT Voiture_ID FROM reservations WHERE (DateDebut <= :date_fin AND DateFin >= :date_debut)
                )";
        $stmt = $conn->prepare($query);
        $stmt->execute(['date_fin' => $date_fin, 'date_debut' => $date_debut]);
        $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Voitures</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <fieldset>
        <legend>Recherche de Voitures Disponibles</legend>
        <form method="POST">
            <label for="date_debut">Date de début :</label>
            <input type="date" name="date_debut" id="date_debut" required><br>
            <label for="date_fin">Date de fin :</label>
            <input type="date" name="date_fin" id="date_fin" required><br>
            <button type="submit">Rechercher</button><br>
            
            <button type="button" onclick="window.location.href='../logout.php';">deconnexion</button>

        </form>
        <?php if (!empty($voitures)): ?>
            <h3 class="mt-4">Voitures Disponibles</h3>
            <ul class="voiture-list">
                <?php foreach ($voitures as $voiture): ?>
                    <li>
                        <div>
                            <?= "{$voiture['Marque']} {$voiture['Modele']} ({$voiture['Annee']})" ?>
                        </div>
                        <div>
                            <a href="reserver.php?Voiture_ID=<?= $voiture['ID'] ?>&date_debut=<?= $date_debut ?>&date_fin=<?= $date_fin ?>" class="btn btn-success btn-sm">Réserver</a>
                        </div>
                    </li>
                <?php endforeach; ?>
             </ul>
        <?php endif; ?>
    </fieldset>
</body>
</html>
