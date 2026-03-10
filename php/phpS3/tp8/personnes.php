<?php
$pdo = new PDO('mysql:host=localhost;dbname=tp8', 'root', '');

$stmt = $pdo->query('SELECT * FROM Personne');
$personnes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($personnes as $personne) {
    echo $personne['nom'] . ' ' . $personne['prenom'] . '<br>';
}


?>
