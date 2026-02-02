<?php 

function calculerMoyenne(array $tableau): float {
    return array_sum($tableau)/count($tableau);
}
$tab = [5, 10, 15, 20, 25];
echo "Moyenne = " . calculerMoyenne($tab);
?>