<?php 
date_default_timezone_set('Europe/Paris');
$ip = $_SERVER["REMOTE_ADDR"];
$timestamp = time();
$date = date('d/m/Y', $timestamp);
$heure = date('H:i:s', $timestamp);
$NbVisites=0;
$tab="$ip,$date,$heure\n";
$fichier = 'visiteurs.txt';

if (!file_exists($fichier)) {
    touch($fichier);
}

$f = fopen($fichier, 'a+');
fwrite($f, $tab); 
fclose($f);  

$lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$cpt=count($lignes);



foreach($lignes as $ligne){
    $parts=explode(',',$ligne);
    $lesIp= $parts[0];
    if($ip ===$lesIp){
    $NbVisites++;
    }
}
function afficherTable($lignes): void {
    echo "<table border='1'>"; 
    // En-tête
    echo "<thead>";
    echo "<tr>";
    echo "<th>IP</th>";
    echo "<th>Date</th>";
    echo "<th>Heure</th>";
    echo "</tr>";
    echo "</thead>";

    // Corps du tableau
    echo "<tbody>";
    foreach($lignes as $ligne){
        $parts = explode(',', $ligne);
        echo "<tr>";
        for($j = 0; $j < count($parts); $j++){ 
            echo "<td>" .$parts[$j] . "</td>";
        }
        echo "</tr>";
    }echo "</tbody>";

    echo "</table>";
}



$visite= "Visite de $ip le $date à $heure => Votre $NbVisites visite sur mon site (sur $cpt visites au total)\n";
        

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des visites</title>
</head>
<body>
    <h1>Bienvenue sur mon site</h1>
    <p><?php echo $visite ?></p>
    <h1>Historique</h1>
    <?php afficherTable($lignes)?>
</body>
</html>