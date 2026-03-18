<?php
require_once('config.php');

/**
 * Connexion à la base de données avec PDO
 */
function connexionPDO(): ?PDO
{
   try {
       $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       return $pdo;
   } catch (PDOException $e) {
       return null;
   }
}


/**
 * Fonction de protection HTML
 */
function h($s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}


/**
 * Validation des données du formulaire
 */
function validerPersonne(array $post): array
{

    $val = [
        'nom'    => trim($post['nom'] ?? ''),
        'prenom' => trim($post['prenom'] ?? ''),
        'dateN'  => trim($post['dateN'] ?? '')
    ];

    $err = [
        'nom'    => '',
        'prenom' => '',
        'dateN'  => ''
    ];

    // A COMPLETER :
    // vérifier que le nom n'est pas vide
    if(empty($val['nom'])){
        $err['nom'] = 'Veuillez saisir un nom';
    }

    // A COMPLETER :
    // vérifier que le prénom n'est pas vide
    if(empty($val['prenom'])){
        $err['prenom'] = 'Veuillez saisir un prenom';
    }


    // A COMPLETER :
    // vérifier que la date est correcte (format AAAA-MM-JJ)
    if(empty($val['dateN'])){
        $err['dateN'] = 'Veuillez saisir une date ';
    } else {
        // Vérifier le format AAAA-MM-JJ avec regex
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $val['dateN'])) {
            $err['dateN'] = 'Format invalide (aaaa-mm-jj)'; 
        } else {
            $valeur = explode('-', $val['dateN']);
            
            if (count($valeur) !== 3) {
                $err['dateN'] = 'Veuillez saisir une date valide';
            } else {
                $annee = (int)$valeur[0];
                $mois = (int)$valeur[1];
                $jour = (int)$valeur[2];
                
                if(!is_numeric($mois) || !is_numeric($jour) || !is_numeric($annee)){
                    $err['dateN'] = 'Veuillez saisir une date valide';
                } elseif (!checkDate($mois, $jour, $annee)) {
                    $err['dateN'] = 'Veuillez saisir une date valide';
                }
            }
        }
    }
    

    return [$val,$err];
}



class Personne
{
    // Pour FETCH_CLASS, le plus simple est d'utiliser des attributs publics
    public ?int $id;
    public string $nom;
    public string $prenom;
    public string $dateN;

    // Constructeur compatible avec FETCH_CLASS
    public function __construct(?int $id = null, string $nom = '', string $prenom = '', string $dateN = '')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateN = $dateN;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getDateN(): string
    {
        return $this->dateN;
    }

 
   
    


    /**
     * INSERT
     */
    public function insert(PDO $pdo,string $mode='np'): bool
    {

        if($mode === 'p')
        {

            // A COMPLETER :
            // écrire la requête SQL préparée

            $sql = "";

            $stmt = $pdo->prepare($sql);

            // A COMPLETER :
            // exécuter avec les paramètres

            return false;

        }
        else
        {

            // A COMPLETER :
            // construire la requête SQL sans requête préparée

            $sql = "";

            return $pdo->exec($sql) === 1;

        }

    }



    /**
     * UPDATE
     */
    public function update(PDO $pdo,string $mode='np'): bool
    {

        if($mode === 'p')
        {

            // A COMPLETER
            $sql = "";

            $stmt = $pdo->prepare($sql);

            return false;

        }
        else
        {

            // A COMPLETER
            $sql = "";

            return $pdo->exec($sql) !== false;

        }

    }



    /**
     * DELETE
     */
    public function delete(PDO $pdo,string $mode='np'): bool
    {

        if($mode === 'p')
        {

            // A COMPLETER
            $sql = "";

            $stmt = $pdo->prepare($sql);

            return false;

        }
        else
        {

            // A COMPLETER
            $sql = "";

            return $pdo->exec($sql) !== false;

        }

    }



    /**
     * Rechercher par ID
     */
    public static function findById(PDO $pdo,int $id,string $mode='np'): ?Personne
    {

        if($mode === 'p')
        {

            // A COMPLETER
            $sql = "";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([':id'=>$id]);

        }
        else
        {

            // A COMPLETER
            $sql = "";

            $stmt = $pdo->query($sql);

        }


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row) return null;


        return new Personne(
            $row['id'],
            $row['nom'],
            $row['prenom'],
            $row['dateN']
        );

    }

    // Compte le nombre total d'enregistrements dans la table et retourne le résultat sous forme d'entier.
    
    public static function countAll(PDO $pdo): int
    {
        $nb=0;
        //$nb= (int) $pdo->query("SELECT COUNT(*) ...") //
        return $nb;
    }


    /**
     * Liste de toutes les personnes
     */
    public static function findAll(PDO $pdo,string $mode='np'): array
    {

        // A COMPLETER :
        // écrire la requête SELECT

        $sql = "";


        if($mode === 'p')
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }
        else
        {
            $stmt = $pdo->query($sql);
        }


        $res = [];

        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
        {

            $res[] = new Personne(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['dateN']
            );

        }

        return $res;

    }

}



function tablePersonnes(array $personnes, string $mode = 'np', ?int $from = null, ?int $to = null): string
{
    $params = '';
    if ($from !== null && $to !== null) {
        $params = "&from=" . (int)$from . "&to=" . (int)$to;
    }

    $html = "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>";

    foreach ($personnes as $p) {
        $id = (int)$p->getId();

        $urlEdit = "index.php?action=edit&id={$id}&mode={$mode}{$params}";
        $urlDel  = "index.php?action=delete&id={$id}&mode={$mode}{$params}";

        $html .= "<tr>";
        $html .= "<td>{$id}</td>";
        $html .= "<td>" . h($p->getNom()) . "</td>";
        $html .= "<td>" . h($p->getPrenom()) . "</td>";
        $html .= "<td>" . h($p->getDateN()) . "</td>";
        $html .= "<td>
                    <a href='{$urlEdit}'>✏️</a>
                    <a href='{$urlDel}' onclick=\"return confirm('Supprimer ?')\">🗑️</a>
                  </td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}


function formRecherche(string $mode = 'np', string $q = ''): string
{
    // 1. Sécuriser la valeur de recherche pour l'affichage HTML
    $q = h($q);

    return <<<HTML
<form action="index.php" method="..."> <!-- 2. méthode HTTP -->

  <!-- 3. action demandée au contrôleur -->
  <input type="hidden" name="action" value="...">

  <!-- mode de recherche -->
  <input type="hidden" name="mode" value="{$mode}">

  <label for="q"><b>Recherche :</b></label><br>

  <!-- 4. champ de saisie -->
  <input type="text" id="q" name="..." value="{$q}" placeholder="ali+mar">

  <!-- 5. bouton -->
  <button type="submit">...</button>

</form>
HTML;
}


function formPersonne(
    string $action,
    array $val,
    array $err,
    ?int $id = null,
    ?int $from = null,
    ?int $to = null
): string {

    // Compléter éventuellement les valeurs manquantes
    // valeurs attendues : nom, prenom, dateN
    $val = array_merge([
        'nom' => '',
        'prenom' => '',
        'dateN' => ''
    ], $val);

    // Compléter éventuellement les erreurs
    // erreurs possibles : nom, prenom, dateN
    $err = array_merge([
        'nom' => null,
        'prenom' => null,
        'dateN' => null
    ], $err);

    // Sécurisation pour affichage HTML
    foreach ($val as $k => $v) {
        $val[$k] = h($v);
    }

    foreach ($err as $k => $v) {
        $err[$k] = h($v);
    }

    $hiddenId = ($id !== null)
        ? '<input type="hidden" name="id" value="' . (int)$id . '">'
        : '';

    $hiddenFrom = ($from !== null)
        ? '<input type="hidden" name="from" value="' . (int)$from . '">'
        : '';

    $hiddenTo = ($to !== null)
        ? '<input type="hidden" name="to" value="' . (int)$to . '">'
        : '';

    return <<<HTML
<form action="index.php?action={$action}" method="post">
  {$hiddenId}
  {$hiddenFrom}
  {$hiddenTo}

  <table>

    <tr>
      <td><label for="nom">Nom</label></td>
      <td><input id="nom" type="text" name="nom" value="{$val['nom']}"></td>
      <td style="color:red;">{$err['nom']}</td>
    </tr>

    <tr>
      <td><label for="prenom">Prénom</label></td>
      <td><input id="prenom" type="text" name="prenom" value="{$val['prenom']}"></td>
      <td style="color:red;">{$err['prenom']}</td>
    </tr>

    <tr>
      <td><label for="dateN">Date de naissance</label></td>
      <td>
        <input id="dateN" type="text"
               name="dateN"
               placeholder="aaaa-mm-jj"
               value="{$val['dateN']}">
      </td>
      <td style="color:red;">{$err['dateN']}</td>
    </tr>

    <tr>
      <td><button type="submit">Valider</button></td>
      <td></td>
      <td></td>
    </tr>

  </table>
</form>
HTML;
}
