<?php
try {
    $dbh = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log($e->getMessage());
    die('Une erreur s\'est produite lors de la connexion à la base de données : ' . $e->getMessage());
}