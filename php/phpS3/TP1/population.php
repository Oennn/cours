<?php
$pays_population=[
    'France' => 67595000,
    'Suède' => 9998000,
    'Suisse' => 8417000,
    'Kosovo' => 1820631,
    'Malte' => 434403,
    'Mexique' => 122273500,
    'Allemagne' => 82800000,
];
foreach($pays_population as $pays => $x){
    echo " La population de $pays est de $x habitants. \n";
}
/*

dégouté...




function minimum(array $tableau): int{
    $minimum= PHP_INT_MAX; //valeur arbitraire pour faire le moins recherche possible
    foreach ($tableau as $valeur){
        if($minimum > $valeur){
            $minimum= $valeur;
        }
    }
    return $minimum;
}
echo "valeur minimal du tableau : " . minimum($pays_population). "\n";

function minimumAvecClef(array $tableau, bool $return_key = false): array{
    $minimum= minimum($tableau);

    foreach ($tableau as $pays => $value){
        if($minimum === $value){
            
            break;
            
        }
    }
    if($return_key){
        return ['key'=>$pays,'value' => $value];
    }

    $value = $minimum; //pour respecter exactement l'exemple
    return ['value' => $value];
}
echo "minimumAvecClef (true): ";
print_r(minimumAvecClef($pays_population, true ));
echo "\nminimumAvecClef (false): ";
print_r(minimumAvecClef($pays_population, false ));

function  minEtMax(array $tableau): array{
    $minimum= minimum($tableau);
    $maximum= PHP_INT_MIN;
    foreach ($tableau as $valeur){
        if($maximum < $valeur){
            $maximum= $valeur;
        }
    }
    
    return [$minimum,$maximum];
}
echo "\nminEtMax : ";
print_r(minEtMax($pays_population));



echo"\nprint_r: ";
print_r($pays_population);
echo"\nvar_dump: ";
var_dump($pays_population);
echo"\nvar_export: ";
var_export($pays_population);

// b

asort($pays_population);
echo"resultat asort: ";
print_r($pays_population);

echo"\nresultat arsort: ";
arsort($pays_population);
print_r($pays_population);

echo"\nresultat ksort: ";
ksort($pays_population);
print_r($pays_population);

echo"\nresultat krsort: ";
krsort($pays_population);
print_r($pays_population);

echo"\nresultat sort: ";
sort($pays_population);
print_r($pays_population);

echo"\nresultat rsort: ";
rsort($pays_population);
print_r($pays_population);

echo"\nresultat shuffle: ";
shuffle($pays_population);
print_r($pays_population);
*/
?>