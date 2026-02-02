<?php 
        require_once 'Point.php';

        // Créez une instance de la classe Point
        $pointA = new Point(10, 10, 'rouge');

        // Affichez les coordonnées du point
        echo "Coordonnées du point A : $pointA \n";

        // Créez un autre point
        $pointB = new Point(20, 20, 'bleu');

        // Affichez les coordonnées du deuxième point
        echo "Coordonnées du point B : $pointB \n";

        // Calculez la distance entre les deux points
        $distance = $pointA->calculerDistance($pointB);

        // Affichez la distance
        echo "Distance entre A et B : $distance";


?>