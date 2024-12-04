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
    <style>
        .tab-res {
            background-color: #1122ba;
            border: 1px solid #000;
            color: white;
        }
        .tab-res {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            background-color: #f9f9f9;
        }
        .tab-res thead tr {
            background-color: #1122ba;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }
        .tab-res tr{
            color: #000;
            text-align:center;
        }
        .tab-res th, .tab-res td {
            border: 1px solid #dddddd;
            padding: 12px 15px;
        }
        .tab-res tbody tr:hover {
            background-color: #f1f1f1;
        }
        .tab-res tbody tr td form button {
            background-color: #1122ba;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .tab-res tbody tr td form button:hover {
            background-color: #0e1d96;
        }
        .tab-res tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("../a.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        button {
            padding: 10px 30px;
            font-size: 1.2rem;
            font-weight: bold;
            background: linear-gradient(135deg, #3140c9, #1122ba);
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 10px rgba(255, 107, 107, 0.3);
            margin-top: 15px;
            margin-left:40%;
        }

        button:hover {
            background: linear-gradient(135deg, #ff3b3b, #c31c1c);
            box-shadow: 0 8px 15px rgba(255, 59, 59, 0.5);
            transform: scale(1.05);
         }

        button:active {
            transform: scale(1);
            box-shadow: 0 3px 8px rgba(255, 59, 59, 0.5);
        }
    </style>


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
