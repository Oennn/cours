<?php
require_once 'Point.php';
require_once 'Cercle.php';
try {
    $centre =new Point(0,0);
    $cercle = new Cercle($centre,5);
    echo"Cercle:\n".$cercle."Périmetre : ". $cercle->calculerPerimetre()."\nSurface : ". $cercle->calculerSurface()."\n\n\n";
}
 catch (InvalidArgumentException $e) {
    echo $e->getMessage(); //getMessage est def dans php, depuis la class exception.
}

try {
    $centre =new Point(0,0);
    $cercle = new Cercle($centre,-5);
    echo"Cercle:\n".$cercle."Périmetre : ". $cercle->calculerPerimetre()."\nSurface : ". $cercle->calculerSurface()."\n";
}
 catch (InvalidArgumentException $e) {
    echo $e->getMessage(); //getMessage est def dans php, depuis la class exception.
}
?>