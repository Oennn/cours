<?php

function afficherTable(int $borne): void {
    echo "<table>";
    for($i=1; $i <=$borne;$i++){
        echo "<tr>";
        for($j=1;$j<=$borne;$j++){
            $produit=$i*$j;
            echo"<td>$produit</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Multiplication</title>
    <style>
        table { border: 1px solid black; margin: 3em auto; }
        td { border: 1px solid black; width: 3em; }
        td { background: blanchedalmond; }
        tr:nth-child(odd) > td:nth-child(odd),
        tr:nth-child(even) > td:nth-child(even) { background: gold; }
        .erreur { font-weight: bold; color: red; }
    </style>
</head>
<body>
    <h1>Table de multiplication</h1>

    <?php
        if (!empty($_GET['borne'])){
            $borne=(int)$_GET['borne']; //si chaine de carac, devient 0
            if(!($borne>=1 && $borne<=100)){
                $borne=10;
            }
        }
        else{
            $borne=10;
        }

        afficherTable($borne);

    ?>
</body>
</html>