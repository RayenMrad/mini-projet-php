<link rel="stylesheet" href="../style.css">
<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Marque = $_POST['Marque'];
    $Modele = $_POST['Modele'];
    $Annee = $_POST['Annee'];
    $mat = $_POST['mat'];

    $sql = "INSERT INTO voitures (Marque, Modele, Annee, Immatriculation) VALUES (:Marque,:Modele,:Annee,:mat)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Marque', $Marque);
    $stmt->bindParam(':Modele', $Modele);
    $stmt->bindParam(':Annee', $Annee, PDO::PARAM_INT);
    $stmt->bindParam(':mat', $mat);

    if ($stmt->execute()) {
        echo "<script>alert('Voiture ajoutée avec succès.');</script>";
    } else {
        echo "Erreur : " . $conn->error;
    }

}
?>
<fieldset>
    <legend>Ajouter une Voiture</legend>
    <form method="POST">
            <label>Marque :</label>
            <input type="text" name="Marque" required><br>
            <label>Modèle :</label>
            <input type="text" name="Modele" required><br>
            <label>Année :</label>
            <input type="number" name="Annee" required><br>
            <label>Immatriculation :</label>
            <input type="text" name="mat" required><br>
            <button type="submit">Ajouter</button>
            <button type="button" onclick="window.location.href='Admin-Interface.php';">Annuler</button>

    </form>
</fieldset>

