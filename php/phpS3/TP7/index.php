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

    $val["prenom"] = trim((string)($_POST["prenom"] ?? ""));
    if ($val["prenom"] === "")    $err["prenom"] = "Il manque un prénom";

    $val["dateN"]  = trim((string)($_POST["dateN"] ?? ""));
    if ($val["dateN"] === "") {
        $err["dateN"] = "Il manque une date de naissance";
    } elseif (!controlerDate($val["dateN"])) {
        $err["dateN"] = "Date invalide (format: jj-mm-aaaa)";
    }

    if (count(array_filter($err)) === 0) {

      $p = new Personne($val["nom"], $val["prenom"], $val["dateN"]);
      ajouterPersonne($p, $fichier);


      $zonePrincipale  = "<h2>Enregistrement OK</h2>";
      $zonePrincipale .= "<p><b>".h($val["nom"])." ".h($val["prenom"])."</b> — né(e) le <b>".h($val["dateN"])."</b>.</p>";
      $zonePrincipale .= "<p><a href='index.php?action=afficher'>Voir la liste</a></p>";


    } else {
      $zonePrincipale  = "<h2>Corriger le formulaire</h2>";
      $zonePrincipale .= formPersonne("enregistrer", $val, $err);
    }
    break;
  // ----------------------------------------------------------
  case "edit":
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    $personnes = lireToutesPersonnes($fichier);

    if (isset($personnes[$id])) {
      $p = $personnes[$id];
      $val["nom"] = $p->getNom();
      $val["prenom"] = $p->getPrenom();
      $val["dateN"] = $p->getDateN();

      $zonePrincipale  = "<h2>Modifier la personne</h2>";
      $zonePrincipale .= formPersonne("update", $val, $err, $id);
    } else {
      $zonePrincipale = "<h2>Erreur</h2><p>Personne introuvable.</p>";
    }
    break;

  // ----------------------------------------------------------
  case "update":
    $id = isset($_POST['id']) ? (int)$_POST['id'] : -1;

    $val["nom"]    = trim((string)($_POST["nom"] ?? ""));
    if ($val["nom"] === "")    $err["nom"] = "Il manque un nom";

    $val["prenom"] = trim((string)($_POST["prenom"] ?? ""));
    if ($val["prenom"] === "")    $err["prenom"] = "Il manque un prénom";

    $val["dateN"]  = trim((string)($_POST["dateN"] ?? ""));
    if ($val["dateN"] === "") {
        $err["dateN"] = "Il manque une date de naissance";
    } elseif (!controlerDate($val["dateN"])) {
        $err["dateN"] = "Date invalide (format: jj-mm-aaaa)";
    }

    if (count(array_filter($err)) === 0) {

      $p = new Personne($val["nom"], $val["prenom"], $val["dateN"]);
      $success = modifierPersonne($id, $p, $fichier);

      if ($success) {
        $zonePrincipale  = "<h2>Modification OK</h2>";
        $zonePrincipale .= "<p><b>".h($val["nom"])." ".h($val["prenom"])."</b> — né(e) le <b>".h($val["dateN"])."</b>.</p>";
        $zonePrincipale .= "<p><a href='index.php?action=afficher'>Voir la liste</a></p>";
      } else {
        $zonePrincipale = "<h2>Erreur</h2><p>Impossible de modifier la personne.</p>";
      }
    } else {
      $zonePrincipale  = "<h2>Corriger le formulaire</h2>";
      $zonePrincipale .= formPersonne("update", $val, $err, $id);
    }
    break;

  // ----------------------------------------------------------
  case "delete":
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    $success = supprimerPersonne($id, $fichier);

    if ($success) {
      $zonePrincipale  = "<h2>Suppression OK</h2>";
      $zonePrincipale .= "<p>La personne a été supprimée avec succès.</p>";
      $zonePrincipale .= "<p><a href='index.php?action=afficher'>Voir la liste</a></p>";
    } else {
      $zonePrincipale  = "<h2>Erreur</h2>";
      $zonePrincipale .= "<p>Impossible de supprimer la personne (ID invalide).</p>";
      $zonePrincipale .= "<p><a href='index.php?action=afficher'>Retour à la liste</a></p>";
    }
    break;

  // ----------------------------------------------------------
  default:
    header("Location: index.php?action=afficher");
    exit;
}

include "squelette.php";
