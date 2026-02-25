<?php
if ( !empty($_GET['nom'])) { // si nom existe dans url et que sa valeur est pas vide (donc != de 0 null ou chaine vide)

    $nom = $_GET['nom'];
    if ($nom === 'VotreNom') {

        $nom = 'DUPONT';
    }
    else{    
        $nom = htmlspecialchars($nom, ENT_QUOTES); //securise si le nom est bizarre
    }
}
 else {

    $nom = 'DUPONT';
}
//https://dev-chabaud221.users.info.unicaen.fr/page_perso.php?nom=neo
echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page HTML générée par PHP</title>
</head>
<body>
    <h1>Page personelle</h1>
    <p>Bienvenue sur la page personnelle de <strong>$nom</strong>.</p>
</body>
</html>
HTML;


// il s affiche une page avec marqué ce qu il y a dans le html.
//que le code d une page html
?>


