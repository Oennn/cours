<?php
    // Assurez-vous que la classe Point et Polygone sont incluses
    require_once 'Point.php';
    require_once 'Polygone.php';

    // Exemple d'utilisation
    $pointA = new Point(10, 10, 'rouge');
    $pointB = new Point(20, 20, 'bleu');
    $pointC = new Point(10, 20, 'vert');

    // Création d'une instance de Polygone
    $polygone = new Polygone([$pointA, $pointB, $pointC]);

    // Affichage des informations
    echo "Je suis un polygone avec les sommets : \n$polygone \n";

    echo "Nombre de sommets : ";
    print_r($polygone->nombreSommets());
?>