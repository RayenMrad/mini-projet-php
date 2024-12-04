<?php
define('BASE_URL', '/gestion_location');
session_start();
session_unset(); // Libère toutes les variables de session
session_destroy(); // Détruit la session

// Redirection vers la page de login
header('Location: login.php');
exit();
?>