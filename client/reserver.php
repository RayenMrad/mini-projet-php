<?php
include '../include.php';
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['Voiture_ID'], $_GET['date_debut'], $_GET['date_fin'])) {
    $voiture_id = $_GET['Voiture_ID'];
    $date_debut = $_GET['date_debut'];
    $date_fin = $_GET['date_fin'];
    $client_id = $_SESSION['client_id'];

    $query = "INSERT INTO reservations (DateDebut,DateFin,Voiture_ID,Client_ID) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$date_debut, $date_fin,$voiture_id,$client_id]);


    // Mettre à jour la disponibilité de la voiture
    $updateQuery = "UPDATE voitures SET Disponibilite = 0 WHERE ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute([$voiture_id]);

    echo "<div class='alert alert-success'>Réservation confirmée!</div>";
    header("Location: results.php");
    exit();
} else {
    echo "<div class='alert alert-danger'>Informations manquantes pour la réservation.</div>";
}
?>

