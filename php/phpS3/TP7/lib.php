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
    $valeur = trim($valeur);
    if (empty($valeur)) return false;

    // TODO 2) remplacer '/' et '.' par '-'
    $valeur = str_replace(['/', '.'], '-', $valeur);

    // TODO 3) explode('-', ...) => 3 parties
    $parties = explode('-', $valeur);
    if (count($parties) !== 3) return false;

    // TODO 4) vérifier numérique + convertir en int (j, mois, an)
    $jour = (int)$parties[0];
    $mois = (int)$parties[1];
    $annee = (int)$parties[2];

    if (!is_numeric($parties[0]) || !is_numeric($parties[1]) || !is_numeric($parties[2])) {
        return false;
    }

    // TODO 5) si année sur 2 chiffres : projection (00..69 => 2000..2069, 70..99 => 1970..1999)
    if ($annee < 100) {
        $annee = ($annee <= 69) ? 2000 + $annee : 1900 + $annee;
    }

    // TODO 6) checkdate(mois, jour, année)
    if (!checkdate($mois, $jour, $annee)) {
        return false;
    }

    // TODO 7) contrainte année [1900..année courante]
    $anneeActuelle = (int)date('Y');
    if ($annee < 1900 || $annee > $anneeActuelle) {
        return false;
    }

    // TODO 8) refuser date future (DateTime)
    $dateValeur = new DateTime("{$annee}-{$mois}-{$jour}");
    $dateAujourd = new DateTime();
    if ($dateValeur > $dateAujourd) {
        return false;
    }

    return true;
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
    private string $nom;
    private string $prenom;
    private string $dateN;

    // TODO : constructeur __construct(string $nom, string $prenom, string $dateN)
    public function __construct(string $nom, string $prenom, string $dateN) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateN = $dateN;
    }

    // TODO : getters getNom(), getPrenom(), getDateN()
    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getDateN(): string {
        return $this->dateN;
    }

    public function toLine(): string {
        // TODO : retourner "nom\tprenom\tdateN"
        return $this->nom . "\t" . $this->prenom . "\t" . $this->dateN;
    }

    public static function fromLine(string $line): ?self {
        // TODO :
        // 1) trim
        $line = trim($line);
        // 2) si vide -> null
        if (empty($line)) {
            return null;
        }
        // 3) explode("\t", $line) -> 3 champs
        $champs = explode("\t", $line);
        // 4) si < 3 -> null
        if (count($champs) < 3) {
            return null;
        }
        // 5) return new self(...)
        return new self($champs[0], $champs[1], $champs[2]);
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
    if (!file_exists($fichier)){
        return [];
    }
    // - lire lignes avec file(..., FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lignes === false) {
        return [];
    }

    // - pour chaque ligne : Personne::fromLine
    // - accumuler dans un tableau
    $personnes = [];
    foreach ($lignes as $ligne) {
        $p = Personne::fromLine($ligne);
        if ($p !== null) {
            $personnes[] = $p; // ajoute a la fin du tableau a chaque itération
        }
    }
    return $personnes;
}

/**
 * Réécrit tout le fichier à partir du tableau de personnes
 * @param Personne[] $personnes
 */
function ecrireToutesPersonnes(array $personnes, string $fichier='sauvegarde.txt'): void {
    // TODO :
    // - construire un tableau de lignes $out[] = $p->toLine()
    $out = [];
    foreach ($personnes as $p) {
        $out[] = $p->toLine();
    }
    // - écrire avec file_put_contents
    // - attention : si vide -> écrire "" (pas une ligne vide)
    if (empty($out)) {
        file_put_contents($fichier, "");
    } else {
        file_put_contents($fichier, implode("\n", $out) . "\n");
    }
}

/**
 * Ajoute une personne en fin de fichier
 */
function ajouterPersonne(Personne $p, string $fichier='sauvegarde.txt'): void {
    // TODO : file_put_contents(..., FILE_APPEND)
    file_put_contents($fichier, $p->toLine() . "\n", FILE_APPEND);
}

/**
 * Supprime la personne d'indice $id
 * @return bool true si supprimée, false si id invalide
 */
function supprimerPersonne(int $id, string $fichier='sauvegarde.txt'): bool {
    // TODO :
    // - lireToutesPersonnes
    $personnes = lireToutesPersonnes($fichier);
    // - vérifier isset($personnes[$id])
    if (!isset($personnes[$id])) {
        return false;
    }
    // - array_splice
    array_splice($personnes, $id, 1);
    // - ecrireToutesPersonnes
    ecrireToutesPersonnes($personnes, $fichier);
    return true;
}

/**
 * Modifie la personne d'indice $id
 * @return bool true si modifiée, false si id invalide
 */
function modifierPersonne(int $id, Personne $p, string $fichier='sauvegarde.txt'): bool {
    // TODO :
    // - lireToutesPersonnes
    $personnes = lireToutesPersonnes($fichier);
    // - vérifier isset(...)
    if (!isset($personnes[$id])) {
        return false;
    }
    // - remplacer
    $personnes[$id] = $p;
    // - ecrireToutesPersonnes
    ecrireToutesPersonnes($personnes, $fichier);
    return true;
}

/* ============================================================
 * HTML : tableau des personnes
 * ============================================================ */
function tablePersonnes(array $personnes): string {
    if (count($personnes) === 0) return "<p>Aucune personne enregistrée.</p>";

    $html  = "<table border=\"1\" cellpadding=\"5\">";
    $html .= "<tr><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Actions</th></tr>";

    // TODO :
    foreach ($personnes as $i => $p) {
        //   - $nom = h($p->getNom());
        $nom = h($p->getNom());
        //   - $prenom = h($p->getPrenom());
        $prenom = h($p->getPrenom());
        //   - $date = h($p->getDateN());
        $date = h($p->getDateN());
        //   - $urlEdit = "index.php?action=edit&id=$i";
        $urlEdit = "index.php?action=edit&id=$i";
        //   - $urlDel  = "index.php?action=delete&id=$i";
        $urlDel  = "index.php?action=delete&id=$i";
        //   - ajouter une ligne <tr> ... </tr>
        //   - actions : ✏️ et 🗑️ (avec confirm JS)
        $html .= "<tr>";
        $html .= "<td>$nom</td>";
        $html .= "<td>$prenom</td>";
        $html .= "<td>$date</td>";
        $html .= "<td>";
        $html .= "<a href=\"$urlEdit\">✏️</a> ";
        $html .= "<a href=\"$urlDel\" onclick=\"return confirm('Êtes-vous sûr ?')\">🗑️</a>";
        $html .= "</td>";
        $html .= "</tr>";
    }

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
    $defaultsVal = ["nom"=>"","prenom"=>"","dateN"=>""];
    $defaultsErr = ["nom"=>"","prenom"=>"","dateN"=>""];
    $val = array_merge($defaultsVal, $val);
    $err = array_merge($defaultsErr, $err);

    // TODO 2) échappement HTML : foreach sur $val et $err avec h()
    foreach ($val as $k => $v) {
        $val[$k] = h($v);
    }
    foreach ($err as $k => $v) {
        $err[$k] = h($v);
    }

    $action = h($action);
    $hiddenId = $id !== null ? "<input type=\"hidden\" name=\"id\" value=\"{$id}\">" : "";

    return <<<HTML
<form action="index.php?action={$action}" method="post">
  {$hiddenId}

  <table width="80%">

    <tr>
      <td><label>Nom</label></td>
      <td><input type="text" name="nom" value="{$val['nom']}"></td>
      <td class="w3-text-red">{$err['nom']}</td>
    </tr>

    <tr>
      <td><label>Prénom</label></td>
      <td><input type="text" name="prenom" value="{$val['prenom']}"></td>
      <td class="w3-text-red">{$err['prenom']}</td>
    </tr>

    <tr>
      <td><label>Date de naissance</label></td>
      <td><input type="text" name="dateN" placeholder="jj-mm-aaaa" value="{$val['dateN']}"></td>
      <td class="w3-text-red">{$err['dateN']}</td>
    </tr>

    <tr>
      <td><button type="submit">Valider</button></td>
      <td></td><td></td>
    </tr>

  </table>
</form>
HTML;
}
