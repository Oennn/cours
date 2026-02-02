<?php 
/*
$chiffre;

 while($chiffre !==10) {
    $chiffre=(int)readline('entrez 10 :');
}
echo 'bien';
*/


/*
$eleves = [
    'cp'=>'Jean',
    'ce1'=> 'Marc'
];
foreach ($eleves as $classe => $eleve){
    echo " - $eleve est dans la classe $classe \n";
}
    */


/*
$eleves = [
    'cp'=>['Jean','trou','duc'],
    'ce1'=> ['Marc','fou','du','bus']
];
foreach ($eleves as $classe => $listEleve){
    echo"la classe $classe : \n";
    foreach($listEleve as $eleve){
        echo "- $eleve\n";
    }
    echo "\n";
}
    */


/*
$notes=[];
$action=null;
while($action!=='fin'){
    $action=readline('entrez notes, ou fin si terminé.');
    if($action !=='fin'){
        $notes[]=(int)$action;
    }
}
foreach($notes as $note){
    echo "- $note \n";
}
    */


/* 
 $notes=[];

while(true){
    $action=readline('entrez notes, ou fin si terminé.');
    if($action ==='fin'){
        break;
    }
    else{
        $notes[]=(int)$action;
    }
}
foreach($notes as $note){
    echo "- $note \n";
}
*/

$creneaux=[];
while(true){
    $deb=(int)readline('heure debut:');
    $fin=(int)readline('heure fin:');
    if($deb >= $fin){
        echo 'pas bien';

    }
    else{
        $creneaux[]=[$deb,$fin];
        $action=readline('voulez vous un autre créneaux ? (n)');
        if($action==='n'){
            break;
        }
    }

}
$heure = (int)readline("A quelle heure voulez vous visiter le magasin ?");
$creneauxT=false;
foreach($creneaux as $creneau){
    if($heure >= $creneau[0] && $heure <= $creneau[1]){
        $creneauxT=true;
        break;
    }
}
if($creneauxT){
    echo'le magasin est ouvert ';
}else{
    echo'pas ouvert ';
}
echo'le magasin est ouvert de ';
foreach($creneaux as $k => $creneau){
    if ($k >0){
        echo' et de ';
    }
    echo"{$creneau[0]}h a {$creneau[1]}h";
}


?>