<?php

require_once('lib.php');


$pdo = connexionPDO();

$action = $_GET['action'] ?? 'afficher';
$mode = $_GET['mode'] ?? ($_POST['mode'] ?? 'np');
$zonePrincipale = '';

$from = $_GET['from'] ?? null;
$to   = $_GET['to'] ?? null;

if ($pdo === null) {
    $zonePrincipale = "<p style='color:red;'>Connexion à la base impossible.</p>";
    require('squelette.php');
    exit;
}
else{
    $zonePrincipale = "<p style='color:green;'>Connexion établie.</p>";
}



switch($action)
{


    case 'saisir':

        // A COMPLETER :
        // afficher le formulaire de saisie

        $val = ['nom' => '', 'prenom' => '', 'dateN' => ''];
        $err = ['nom' => '', 'prenom' => '', 'dateN' => ''];

        $zonePrincipale .= "<h2>Nouvelle personne</h2>";
        $zonePrincipale .= formPersonne('enregistrer&mode=' . $mode, $val, $err);
        break;

    case 'enregistrer':

        // A COMPLETER :
        // récupérer les données POST
        // valider
        // insérer en base


        break;



    case 'edit':

        // A COMPLETER :
        // récupérer id
        // charger la personne
        // afficher le formulaire pré-rempli

        break;



    case 'update':

        // A COMPLETER :
        // mettre à jour la personne

        break;



    case 'delete':

        // A COMPLETER :
        // supprimer la personne

        break;



    case 'afficher':
    default:

        // A COMPLETER :
        // afficher la liste des personnes

        $total = Personne::countAll($pdo);


        $zonePrincipale .= "<h2>Liste des personnes</h2>";
        $zonePrincipale .= "<p>Mode courant : <b>" . ($mode === 'p' ? 'requêtes préparées' : 'requêtes non préparées') . "</b></p>";
        $zonePrincipale .= "<p>Affichage des lignes </p>";
        // A completer ...
        // ...
        // ...
        break;

}


require('squelette.php');
