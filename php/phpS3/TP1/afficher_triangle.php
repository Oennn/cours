<?php 

function afficherTriangle(string $motif, int $hauteur):void {
    for ($i = 1; $i <= $hauteur; $i++){
        echo str_repeat($motif,$i) . "\n";
    }
}
    /*
function afficherTriangle(string $motif, int $hauteur):void {
    for ($i = 1; $i <= $hauteur; $i++){
        for ($j = 1; $j <= $i; $j++) {
            echo $motif;
        }
        echo "\n";
    }
}*/
afficherTriangle('*', 4);

?>