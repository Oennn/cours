<?php 
$note = (int)readline('entrez soit 1, soit 2:');
switch($note){
    case 1:
        echo 'oui';
        break; // pour pas executer les autres cases en dessous
    case 2:
        echo 'non';
        break;
    default: // si != 1 ou 2
        echo 'erreur';
// . PHP_EOL .
}
?>