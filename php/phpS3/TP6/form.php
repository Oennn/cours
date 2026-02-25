<?php

$nom=isset($_POST['nom']) ? trim($_POST['nom']) : '';
$ville=isset($_POST['ville']) ? trim($_POST['ville']) : '';
$langue= $_POST['langue'] ?? []; //plus court et opti
$couleur= $_POST['couleur'] ?? '';


if (empty($ville) || $langue===[] || empty($couleur) || is_numeric($nom)) {
    header("Location: erreur.html");
    die; 
}

if (empty($nom) ) {
    $nom="Dupond";
}

$couleurs = ["rouge"=>"red", "vert"=>"green", "bleu"=>"blue"];
$couleur = $couleurs[$couleur];


for($i =0; $i < count($langue); $i++){
    if($langue[$i]==="fr"){
        $langue[$i]="Bonjour $nom !";
    }
    else if($langue[$i]==="en"){
        $langue[$i]="Hello $nom !";
    }else{
        $langue[$i]="Guten Tag $nom !";
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du formulaire</title>
</head>
<body style="background-color:<?php echo $couleur; ?>;">

<h2>Résultat du formulaire</h2>

<p>Nom : <?php echo htmlspecialchars($nom, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
<p>Ville : <?php echo htmlspecialchars($ville, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
<p>Langues : <?php echo implode(", ", $langue); ?></p>
<p>Couleur : <?php echo $couleur; ?></p>

</body>
</html>