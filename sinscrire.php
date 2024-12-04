<link rel="stylesheet" href="l.css">
<?php
include 'include.php'; // Inclure la connexion PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données avec sécurité
    $Nom = htmlspecialchars(trim($_POST['Nom']));
    $Adresse = htmlspecialchars(trim($_POST['Adresse']));
    $NumTel = htmlspecialchars(trim($_POST['NumTel']));
    $Email = htmlspecialchars(trim($_POST['Email']));
    $Mdp = htmlspecialchars(trim($_POST['Mdp']));

    // Validation basique
    if (empty($Nom) || empty($Adresse) || empty($NumTel) || empty($Email) || empty($Mdp)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse e-mail invalide.";
    } else {
        try {
            // Hachage du mot de passe
            $hashedMdp = password_hash($Mdp, PASSWORD_DEFAULT);

            // Requête d'insertion
            $sql = "INSERT INTO clients (Nom, Adresse, NumeroTelephone, Email, MotDePasse) 
                    VALUES (:Nom, :Adresse, :NumTel, :Email, :Mdp)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':Nom', $Nom);
            $stmt->bindParam(':Adresse', $Adresse);
            $stmt->bindParam(':NumTel', $NumTel);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':Mdp', $hashedMdp);

            if ($stmt->execute()) {
                echo "<script>alert('Inscription effectuée avec succès.');</script>";
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Erreur pour clé unique (email)
                $error = "Cet e-mail est déjà enregistré.";
            } else {
                $error = "Erreur : " . $e->getMessage();
            }
        }
    }
}
?>
<fieldset>
    <legend>S'inscrire</legend>
    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="Nom" required><br>
        <label>Adresse :</label>
        <input type="text" name="Adresse" required><br>
        <label>NumTel :</label>
        <input type="text" name="NumTel" required><br>
        <label>Email :</label>
        <input type="text" name="Email" required><br>
        <label>Mot de passe :</label>
        <input type="text" name="Mdp" required><br>
        <button type="submit">Ajouter</button><br>
        <button type="button"  onclick="window.location.href='login.php';">Annuler</button>
    </form>
</fieldset>
