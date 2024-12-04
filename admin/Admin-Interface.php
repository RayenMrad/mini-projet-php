<link rel="stylesheet" href="../admin.css">
<?php include '../include.php'; ?>

<!-- Admin Interface -->
<div class="Admin-F">
    <p>Choisir une Option</p>
    <div class="admin-container">
        <button onclick="window.location.href='ajouter.php'">Ajouter</button>
        <button onclick="window.location.href='modifier.php'">Modifier</button>
        <button onclick="window.location.href='supprimer.php'">Supprimer</button>
    </div>
    <button type="button" id="logout" onclick="window.location.href='../logout.php';">deconnexion</button>
</div>


