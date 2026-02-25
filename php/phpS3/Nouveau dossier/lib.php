<?php
// ============================================================
// lib.php  (VERSION ÉTUDIANTS — À COMPLÉTER)
// - stockage : sauvegarde.txt (format : Nom<TAB>Prenom<TAB>Date)
// - CRUD : lire / ajouter / modifier / supprimer
// - HTML : formulaire + tableau
// ============================================================

/* ------------------------------------------------------------
 * Helper : échappement HTML (sécurité XSS)
 * ------------------------------------------------------------ */
function h($s): string {
  return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}

/* ------------------------------------------------------------
 * Validation : date JJ-MM-AAAA (ou JJ/MM/AAAA ou JJ.MM.AAAA)
 * - année entre 1900 et aujourd'hui
 * - pas de date future
 * - sans regex (pas de preg_match)
 * ------------------------------------------------------------ */
function controlerDate(string $valeur): bool {
  // TODO 1) trim + vérifier non vide
  // TODO 2) remplacer '/' et '.' par '-'
  // TODO 3) explode('-', ...) => 3 parties
  // TODO 4) vérifier numérique + convertir en int (j, mois, an)
  // TODO 5) si année sur 2 chiffres : projection (00..69 => 2000..2069, 70..99 => 1970..1999)
  // TODO 6) checkdate(mois, jour, année)
  // TODO 7) contrainte année [1900..année courante]
  // TODO 8) refuser date future (DateTime)

  return false; // à remplacer
}

/* ============================================================
 * Modèle : Personne
 * - attributs privés : nom, prenom, dateN
 * - getters
 * - toLine() : "Nom<TAB>Prenom<TAB>Date"
 * - fromLine() : reconstruit un objet depuis une ligne du fichier
 * ============================================================ */
class Personne {
  // TODO : attributs privés (3 strings)

  // TODO : constructeur __construct(string $nom, string $prenom, string $dateN)

  // TODO : getters getNom(), getPrenom(), getDateN()

  public function toLine(): string {
    // TODO : retourner "nom\tprenom\tdateN"
    return "";
  }

  public static function fromLine(string $line): ?self {
    // TODO :
    // 1) trim
    // 2) si vide -> null
    // 3) explode("\t", $line) -> 3 champs
    // 4) si < 3 -> null
    // 5) return new self(...)
    return null;
  }
}

/* ============================================================
 * Accès fichier (CRUD)
 * ============================================================ */

/**
 * Lit toutes les personnes depuis le fichier
 * @return Personne[]
 */
function lireToutesPersonnes(string $fichier='sauvegarde.txt'): array {
  // TODO :
  // - si fichier absent -> []
  // - lire lignes avec file(..., FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
  // - pour chaque ligne : Personne::fromLine
  // - accumuler dans un tableau
  return [];
}

/**
 * Réécrit tout le fichier à partir du tableau de personnes
 * @param Personne[] $personnes
 */
function ecrireToutesPersonnes(array $personnes, string $fichier='sauvegarde.txt'): void {
  // TODO :
  // - construire un tableau de lignes $out[] = $p->toLine()
  // - écrire avec file_put_contents
  // - attention : si vide -> écrire "" (pas une ligne vide)
}

/**
 * Ajoute une personne en fin de fichier
 */
function ajouterPersonne(Personne $p, string $fichier='sauvegarde.txt'): void {
  // TODO : file_put_contents(..., FILE_APPEND)
}

/**
 * Supprime la personne d'indice $id
 * @return bool true si supprimée, false si id invalide
 */
function supprimerPersonne(int $id, string $fichier='sauvegarde.txt'): bool {
  // TODO :
  // - lireToutesPersonnes
  // - vérifier isset($personnes[$id])
  // - array_splice
  // - ecrireToutesPersonnes
  return false;
}

/**
 * Modifie la personne d'indice $id
 * @return bool true si modifiée, false si id invalide
 */
function modifierPersonne(int $id, Personne $p, string $fichier='sauvegarde.txt'): bool {
  // TODO :
  // - lireToutesPersonnes
  // - vérifier isset(...)
  // - remplacer
  // - ecrireToutesPersonnes
  return false;
}

/* ============================================================
 * HTML : tableau des personnes
 * ============================================================ */
function tablePersonnes(array $personnes): string {
  if (count($personnes) === 0) return "<p>Aucune personne enregistrée.</p>";

  $html  = "<table border=\"1\" cellpadding=\"5\">";
  $html .= "<tr><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Actions</th></tr>";

  // TODO :
  // foreach ($personnes as $i => $p) {
  //   - $nom = h($p->getNom());
  //   - $prenom = h($p->getPrenom());
  //   - $date = h($p->getDateN());
  //   - $urlEdit = "index.php?action=edit&id=$i";
  //   - $urlDel  = "index.php?action=delete&id=$i";
  //   - ajouter une ligne <tr> ... </tr>
  //   - actions : ✏️ et 🗑️ (avec confirm JS)
  // }

  $html .= "</table>";
  return $html;
}

/* ============================================================
 * HTML : formulaire "zéro notice"
 * - $action : ex "enregistrer" ou "update"
 * - $val    : valeurs pré-remplies
 * - $err    : messages d'erreur
 * - $id optionnel : champ hidden (pour update)
 * ============================================================ */
function formPersonne(string $action, array $val, array $err, ?int $id=null): string {

  // TODO 1) initialiser des defaults (nom, prenom, dateN) pour éviter les notices
  // $defaultsVal = ...
  // $defaultsErr = ...
  // $val = array_merge(...)
  // $err = array_merge(...)

  // TODO 2) échappement HTML : foreach sur $val et $err avec h()



  return <<<HTML
<form action="index.php?action={$action}" method="post">

  <table width="80%">

    <tr>
      <td><label>Nom</label></td>
      <td><input type="text" name="nom" value="<!-- TODO {$val['nom']} -->"></td>
      <td class="w3-text-red"><!-- TODO {$err['nom']} --></td>
    </tr>

    <tr>
      <td><label>Prénom</label></td>
      <td><input type="text" name="prenom" value="<!-- TODO {$val['prenom']} -->"></td>
      <td class="w3-text-red"><!-- TODO {$err['prenom']} --></td>
    </tr>

    <tr>
      <td><label>Date de naissance</label></td>
      <td><input type="text" name="dateN" placeholder="jj-mm-aaaa" value="<!-- TODO {$val['dateN']} -->"></td>
      <td class="w3-text-red"><!-- TODO {$err['dateN']} --></td>
    </tr>

    <tr>
      <td><button type="submit">Valider</button></td>
      <td></td><td></td>
    </tr>

  </table>
</form>
HTML;
}
