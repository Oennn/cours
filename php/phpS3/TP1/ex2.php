<?php
//Utilisation de l'extension mbstring


$chaine = mb_strtolower(readline('entrez une chaine de caractères : '));
$voyelles = "aeiouyàâäéèêëîïôöùûüÿ";
$nb_voyelles = 0;



for($i=0;$i<mb_strlen($chaine);$i++){
    $lettre=mb_substr($chaine, $i, 1);
    if(mb_strpos($voyelles, $lettre)!==false){
        $nb_voyelles++;
    }
}
if($nb_voyelles>0){
    echo "La chaîne contient $nb_voyelles voyelles.\n";
}
else{
    echo"La chaîne ne contient aucune voyelle.\n";
}
/*
$inverse = '';
$len = mb_strlen($chaine);
//on parcourt dans le sens inverse pour inverser la chaine
for ($i = $len - 1; $i >= 0; $i--) {
    $inverse =$inverse . mb_substr($chaine, $i, 1); //mb_substr est le caractère de position $i
}
if(!($chaine === $inverse)){
    echo "\nce n'est pas un palindrome\n";
}
else{
    echo "\n cette chaine est un palindrome\n";
}



$longueur= mb_strlen($chaine); 
echo "\nnombre de caractères : $longueur\n";
//echo mb_strlen("🐳");

if(mb_strpos($chaine, 'aiueo')=== false){ //mb_stripos pas sensible a la casse
    echo "Vous n'avez pas de a dans votre chaine\n";
}
$pos_a= mb_strpos($chaine, 'a', 0) +1;

echo "Vous avez un a en position $pos_a dans votre chaine\n";

*/
?>