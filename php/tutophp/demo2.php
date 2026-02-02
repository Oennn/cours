<?php
$notes=['Marc','Teuc',[10,20]];
$notes2 = [
    'nom' => 'Doe',
    'prenom' => 'marc',
    'notes'=>[10,20,15]];
echo $notes[2][1];
$notes2['prenom']='Jean';
$notes2['notes'][3]=16;
$notes2['notes'][]=6;
echo "\n". $notes2['nom']. ' '. $notes2['prenom']."\n";
$notes2[]='COM';
print_r($notes2);
?>