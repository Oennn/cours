<?php
require_once "lib.php";

$fichier = 'sauvegarde.txt';

$err = ["nom"=>"","prenom"=>"","dateN"=>""];
$val = ["nom"=>"","prenom"=>"","dateN"=>""];

$action = isset($_GET['action']) ? trim($_GET['action']) : '';
$zonePrincipale = "";


switch ($action) {

  // ----------------------------------------------------------
  case "saisir":
    $zonePrincipale  = "<h2>Saisie</h2>";
    $zonePrincipale .= formPersonne("enregistrer", $val, $err);
    break;
  // ----------------------------------------------------------
  case "afficher":
    $zonePrincipale  = "<h2>Personnes enregistrées</h2>";
    $zonePrincipale .= tablePersonnes(lireToutesPersonnes($fichier));
    break;
  // ----------------------------------------------------------
  case "enregistrer":
    $val["nom"]    = trim((string)($_POST["nom"] ?? ""));
    if ($val["nom"] === "")    $err["nom"] = "Il manque un nom";
    // A compléter ...
    // ...
    if (count(array_filter($err)) === 0) {
      $zonePrincipale  = "<h2>Enregistrement OK</h2>";
      $zonePrincipale .= "<p><b>".h($val["nom"])." ".h($val["prenom"])."</b> — né(e) le <b>".h($val["dateN"])."</b>.</p>";
      // ou Rediection ==>      header("Location:index.php?action=afficher");exit;
      // A compléter ...
      // ...
      //$p=new Personne($val["nom"], $val["prenom"], $val["dateN"]);
      //ajouterPersonne($p, $fichier);
    } else {
      $zonePrincipale  = "<h2>Corriger le formulaire</h2>";
      $zonePrincipale .= formPersonne("enregistrer", $val, $err);
    }
    break;
  // ----------------------------------------------------------
  case "edit":
    // A compléter ...
    // ...
    break;

  // ----------------------------------------------------------
  case "update":
    // A compléter ...
    // ...
    break;

  // ----------------------------------------------------------
  case "delete":
    // A compléter ...
    // ...
    break;

  // ----------------------------------------------------------
  default:
    header("Location: index.php?action=afficher");
    exit;
}

include "squelette.php";
