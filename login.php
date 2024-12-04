<?php

session_start();
include 'include.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['Email'];
    $Mdp = $_POST['Mdp'];

    if (!empty($email) && !empty($Mdp)) {
        try {
            if ($email === 'Admin@gmail.com' && $Mdp === 'Admin123') {
                $_SESSION['user_role'] = 'admin';
                header('Location: admin/Admin-Interface.php'); 
                exit;
            }

            // Vérifier si l'utilisateur existe dans la base de données
            $sql = "SELECT * FROM clients WHERE Email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $client = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($client && password_verify($Mdp, $client['MotDePasse'])) {
                // Stockage des informations utilisateur dans la session
                $_SESSION['client_id'] = $client['ID'];
                $_SESSION['client_name'] = $client['Nom'];

                echo "<script>alert('Connexion réussie !');</script>";
                header('Location: client/Recherche.php'); // Redirection vers une page utilisateur
                exit();
            } else {
                $error = "E-mail ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la connexion : " . $e->getMessage();
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="l.css">
</head>
<body>
    <fieldset>
        <legend>Connexion</legend>
        <?php
            if (!empty($error)){
                echo '<p style="color: red;">'.$error.'</p>';
            }
        ?>
        <form method="POST">
            <label for="Email">E-mail :</label>
            <input type="text" name="Email" id="Email" required><br>
            <label for="Mdp">Mot de passe :</label>
            <input type="password" name="Mdp" id="Mdp" required><br>
            <a href="sinscrire.php" id="a">S'inscrire</a><br>
            <button type="submit">Se connecter</button>
        </form>
    </fieldset>
</body>
</html>
