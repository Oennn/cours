<?php
require_once('../../config.php');

function connecter(): ?PDO
{
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, $options);
        echo "<p><strong>Connexion établie</strong></p>";
        return $pdo;
    } catch (PDOException $e) {
        error_log("Connexion BD : " . $e->getMessage());
        echo "<p><strong>Erreur de connexion : </strong>" . $e->getMessage() . "</p>";
        return null;
    }
}

$pdo = connecter();

$requete = "SELECT id, nom, prenom, dateN
FROM Personne
ORDER BY id";

$res = $pdo->query($requete);
$personnes = $res->fetchAll(PDO::FETCH_ASSOC);
$html ="<p> Total lignes : ". count($personnes) ."</p>";
$html.= "<h2>Liste des personnes </h2>";
$html .= "<p> affichage des lignes <strong>1</strong> à <strong>" . count($personnes) ."</strong></p>";
$html .= "<table border='1'>";
$html .= "<tr>
<th>ID</th>
<th>Nom</th>
<th>Prenom</th>
<th>Date de naissance</th>
</tr>";

foreach($personnes as $personne){
    $html .= "<tr><td>" . $personne['id'] . "</td><td>" . $personne['nom'] . "</td>"
        . "<td>" . $personne['prenom'] . "</td>"
        . "<td>" . $personne['dateN'] . "</td></tr>";
}

$html .= "</table>";
echo $html;

/*
etape 3:

1) cela affiche : Erreur de connexion : SQLSTATE[HY000] [1044] Access denied for user 'chabaud221'@'%' to database 'chabaud21_bd'
explication: l'user chabaud221 n’a pas les droits pour accéder à la base de données chabaud21_bd.
Cela signifie que le nom de la base est incorrect, ou que cet utilisateur n’a pas l’autorisation d’y accéder .


2) cela affiche :

Fatal error: Uncaught PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'Bla Bla Bla' at line 1 in /users/chabaud221/www-dev/TW3/tp8/personnes.php on line 28
( ! ) PDOException: SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'Bla Bla Bla' at line 1 in /users/chabaud221/www-dev/TW3/tp8/personnes.php on line 28
Call Stack
#	Time	Memory	Function	Location
1	0.0008	363176	{main}( )	.../personnes.php:0
2	0.0025	406104	query( $query = 'Bla Bla Bla', $fetchMode = ??? )	.../personnes.php:28

explication : la requête exécutée est "Bla Bla Bla", qui n’est pas une syntaxe SQL reconnue, donc la base de données renvoie une erreur de syntaxe.

3)
cela affiche:

Fatal error: Uncaught PDOException: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'chabaud221_bd.TableInexistante' doesn't exist in /users/chabaud221/www-dev/TW3/tp8/personnes.php on line 28
( ! ) PDOException: SQLSTATE[42S02]: Base table or view not found: 1146 Table 'chabaud221_bd.TableInexistante' doesn't exist in /users/chabaud221/www-dev/TW3/tp8/personnes.php on line 28
Call Stack
#	Time	Memory	Function	Location
1	0.0008	364704	{main}( )	.../personnes.php:0
2	0.0030	407632	query( $query = 'SELECT * FROM TableInexistante', $fetchMode = ??? )	.../personnes.php:28

explication : 

Cette erreur signifie que la requête SQL SELECT * FROM TableInexistante essaie d’accéder à une table qui n’existe pas dans la base de données.

*/