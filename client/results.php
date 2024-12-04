<?php
include '../include.php';
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../login.php");
    exit();
}

$reservations = [];

try {
    $query = "SELECT r.*, v.Marque, v.Modele, v.Annee FROM reservations r 
              JOIN voitures v ON r.Voiture_ID = v.ID 
              WHERE r.Client_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$_SESSION['client_id']]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="../client.css">

</head>
<body>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h2 class="mb-0">Mes Réservations</h2>
            </div>
            <div class="card-body">
                <?php if (empty($reservations)): ?>
                    <div class="alert alert-warning text-center">
                        <p>Aucune réservation trouvée.</p>
                    </div>
                <?php else: ?>
                    <div >
                        <table class="tab-res">
                            <thead >
                                <tr>
                                    <th>Voiture</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation): ?>
                                    <tr>
                                        <td><?= "{$reservation['Marque']} {$reservation['Modele']} ({$reservation['Annee']})" ?></td>
                                        <td><?= $reservation['DateDebut'] ?></td>
                                        <td><?= $reservation['DateFin'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="button" onclick="window.location.href='Recherche.php';">retour</button>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
