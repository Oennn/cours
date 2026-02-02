<?php 
$tab = [];
for($i=0; $i < 10;$i++){
    $tab[$i]= 3*$i+2;
}
foreach( $tab as $indice=>$val){
    echo "tab[$indice]=$val\n";
}
?>