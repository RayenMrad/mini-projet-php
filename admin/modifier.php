<link rel="stylesheet" href="../admin.css">
<?php
include '../include.php';

// Initialize variables for form fields
$ID = $Marque = $Modele = $Annee = $mat = '';

// If the form is submitted, update the car details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ID = $_POST['ID'];
    $Marque = $_POST['Marque'];
    $Modele = $_POST['Modele'];
    $Annee = $_POST['Annee'];
    $mat = $_POST['mat'];

    if (empty($mat)) {
        //echo "<script>alert('L\'immatriculation ne peut pas être vide.');</script>";
    } else {
        $sql_check = "SELECT * FROM voitures WHERE Immatriculation = :mat AND ID != :ID";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':mat', $mat);
        $stmt_check->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            echo "<script>alert('L\'immatriculation existe déjà pour une autre voiture.');</script>";
        } else {
            // Update the selected car's details in the database
            $sql = "UPDATE voitures SET Marque = :Marque, Modele = :Modele, Annee = :Annee, Immatriculation = :mat WHERE ID = :ID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':Marque', $Marque);
            $stmt->bindParam(':Modele', $Modele);
            $stmt->bindParam(':Annee', $Annee, PDO::PARAM_INT);
            $stmt->bindParam(':mat', $mat);
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Clear the form fields after successful submission
                $ID = $Marque = $Modele = $Annee = $mat = '';
                // Optionally reload the page to reset the form
                echo "<script>
                    alert('Détails de la voiture mis à jour avec succès.');
                    window.location.href = window.location.href;
                </script>";
            } else {
                echo "<script>alert('Erreur lors de la mise à jour.');</script>";
            }
        }
    }
}

// Fetch all cars from the database to populate the dropdown
$sql = "SELECT * FROM voitures";
$stmt = $conn->prepare($sql);
$stmt->execute();
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the car details if a car ID is selected
$selectedV = null;
if (isset($_POST['ID']) && !empty($_POST['ID'])) {
    $ID = $_POST['ID'];
    $sql = "SELECT * FROM voitures WHERE ID = :ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
    $stmt->execute();
    $selectedV = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<fieldset>
    <legend>Modification des Détails d'une Voiture</legend>
    <form method="POST">
        <label>Choisir une voiture à modifier :</label>
        <select name="ID" id="car_id" onchange="this.form.submit()">
            <option value="" hidden>Sélectionner une voiture</option>
            <?php
            foreach ($voitures as $voiture) {
                $selected = isset($selectedV) && $selectedV['ID'] == $voiture['ID'] ? 'selected' : '';
                echo "<option value='{$voiture['ID']}' {$selected}>{$voiture['ID']} - {$voiture['Marque']} {$voiture['Modele']}</option>";
            }
            ?>
        </select><br>

        <label>Marque :</label>
        <input type="text" name="Marque" id="Marque" value="<?php echo isset($selectedV) ? $selectedV['Marque'] : ''; ?>"><br>

        <label>Modèle :</label>
        <input type="text" name="Modele" id="Modele" value="<?php echo isset($selectedV) ? $selectedV['Modele'] : ''; ?>"><br>

        <label>Année :</label>
        <input type="number" name="Annee" id="Annee" value="<?php echo isset($selectedV) ? $selectedV['Annee'] : ''; ?>"><br>

        <label>Immatriculation :</label>
        <input type="text" name="mat" id="mat" value="<?php echo isset($selectedV) ? $selectedV['Immatriculation'] : ''; ?>"><br>

        <button type="submit">Modifier</button>
        <button type="button" onclick="window.location.href='Admin-Interface.php';">Annuler</button>

    </form>
</fieldset>
