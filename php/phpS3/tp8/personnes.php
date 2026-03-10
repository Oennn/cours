<?php
require_once('../config.php');

function connecter(): ?PDO
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
        echo "<p><strong>Connexion établie</strong></p>";
        return $pdo;
    } catch (PDOException $e) {
        error_log("Connexion BD : " . $e->getMessage());
        echo "<p><strong>Erreur de connexion : </strong>" . $e->getMessage() . "</p>";
        return null;
    }
}
$pdo = connecter();