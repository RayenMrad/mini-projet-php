<link rel="stylesheet" href="../admin.css">
<?php
include '../include.php';

// If the form is submitted, delete the car
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $ID = $_POST['ID'];

    // Check if ID is provided
    if (empty($ID)) {
        echo "<script>alert('Veuillez sélectionner une voiture à supprimer.');</script>";
    } else {
        // Delete the selected car from the database
        $sql = "DELETE FROM voitures WHERE ID = :ID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>alert('Voiture supprimée avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression de la voiture.');</script>";
        }
    }
}

// Fetch all cars from the database to populate the dropdown
$sql = "SELECT * FROM voitures";
$stmt = $conn->prepare($sql);
$stmt->execute();
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<fieldset>
    <legend>Suppression d'une Voiture</legend>
    <form method="POST">
        <label>Choisir une voiture à supprimer :</label>
        <select name="ID" id="car_id">
            <option value="" hidden>Sélectionner une voiture</option>
            <?php
            foreach ($voitures as $voiture) {
                echo "<option value='{$voiture['ID']}'>{$voiture['ID']} - {$voiture['Marque']} {$voiture['Modele']}</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="delete">Supprimer</button>
        <button type="button" onclick="window.location.href='Admin-Interface.php';">Annuler</button>

    </form>
</fieldset>
