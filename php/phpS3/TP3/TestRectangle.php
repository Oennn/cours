<?php
// TestRectangle.php
// Assurez-vous que la classe Rectangle est incluse
require_once 'Rectangle.php';

// Création d'une instance de Rectangle
$coinSupGauche = new Point(2, 5, 'rouge');
$coinInfDroit = new Point(8, 2, 'bleu');
$rectangle = new Rectangle($coinSupGauche, $coinInfDroit);

// Affichage des informations
echo "Rectangle :\nCoin supérieur gauche : $coinSupGauche\nCoin inférieur droit : $coinInfDroit \n\n";
echo "Ma longueur est : " . $rectangle->calculerLongueur() . "\n";
echo "Ma largeur est : " . $rectangle->calculerLargeur() . "\n";
echo "Et mon périmètre est : " . $rectangle->calculerPerimetre();

?>