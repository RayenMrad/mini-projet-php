<?php
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'gestion_location';

        try {
            $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
            $conn = new PDO($dsn, $user, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            //echo "<script>alert('Connexion réussie à la base de données.');</script>";
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
?>
