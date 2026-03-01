# 📘 Documentation TP7 — Agenda PHP (CRUD fichier)

> Application web PHP de gestion de personnes (nom, prénom, date de naissance),
> stockage dans un fichier texte (`sauvegarde.txt`), sans base de données.

---

## 🗂️ Structure des fichiers

| Fichier          | Rôle                                                                 |
|------------------|----------------------------------------------------------------------|
| `index.php`      | Contrôleur principal — gère les actions via `$_GET['action']`        |
| `lib.php`        | Toutes les fonctions métier + la classe `Personne`                   |
| `squelette.php`  | Template HTML (inclus en fin d'`index.php`)                          |
| `form.css`       | Feuille de style                                                     |
| `sauvegarde.txt` | Base de données fichier (format : `Nom⇥Prénom⇥DateN` par ligne)      |

---

## 1. 🔐 Sécurité — Échappement XSS

### `h(string $s): string`
```php
function h($s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}
```
- Convertit les caractères spéciaux HTML (`<`, `>`, `"`, `'`, `&`) en entités HTML.
- **Obligatoire** avant tout affichage d'une valeur provenant de l'utilisateur.
- Paramètres importants :
  - `ENT_QUOTES` : échappe aussi les guillemets simples `'`
  - `ENT_SUBSTITUTE` : remplace les séquences UTF-8 invalides
  - `ENT_HTML5` : utilise les entités HTML5

**Utilisation typique :**
```php
echo h($val["nom"]);           // dans une page HTML
value="{$val['nom']}"          // dans un attribut HTML (après h() sur $val)
```

---

## 2. ✅ Validation — Contrôle de date

### `controlerDate(string $valeur): bool`

Vérifie qu'une date est valide au format `JJ-MM-AAAA` (accepte aussi `/` et `.`).

**Étapes clés :**

| Étape | Code                                        | Rôle                                              |
|-------|---------------------------------------------|---------------------------------------------------|
| 1     | `trim($valeur)`                             | Supprimer les espaces                             |
| 2     | `str_replace(['/', '.'], '-', $valeur)`     | Normaliser le séparateur                          |
| 3     | `explode('-', $valeur)`                     | Découper en [jour, mois, année]                   |
| 4     | `is_numeric()` + cast `(int)`               | Vérifier que ce sont des chiffres                 |
| 5     | Projection année à 2 chiffres               | `00–69` → `2000–2069`, `70–99` → `1970–1999`     |
| 6     | `checkdate($mois, $jour, $annee)`           | Vérification calendaire (ex : 31 février invalide)|
| 7     | `$annee >= 1900 && $annee <= date('Y')`     | Contrainte d'intervalle                           |
| 8     | `new DateTime(...)` + comparaison           | Refuser les dates futures                         |

> ⚠️ `checkdate()` prend les arguments dans l'ordre : **mois, jour, année** (pas jour, mois, année).

---

## 3. 🧱 Classe `Personne` — Modèle objet

```php
class Personne {
    private string $nom;
    private string $prenom;
    private string $dateN;
    // ...
}
```

### Concepts importants

| Notion            | Description                                                                 |
|-------------------|-----------------------------------------------------------------------------|
| Attributs privés  | Encapsulation : accès uniquement via les méthodes                           |
| Constructeur      | `__construct(string $nom, string $prenom, string $dateN)`                   |
| Getters           | `getNom()`, `getPrenom()`, `getDateN()` — retournent `string`               |
| `toLine()`        | Sérialise l'objet en `"Nom\tPrénom\tDate"` pour l'écriture fichier          |
| `fromLine()`      | Méthode **statique** qui reconstruit un objet depuis une ligne du fichier   |

### `toLine()` et `fromLine()` — Sérialisation

```php
// Écriture
$p->toLine();  // → "Dupont\tJean\t01-01-1990"

// Lecture
$p = Personne::fromLine("Dupont\tJean\t01-01-1990");
```

- Le séparateur `\t` (tabulation) permet de délimiter les champs sans conflit avec les espaces.
- `fromLine()` retourne `null` si la ligne est vide ou malformée (moins de 3 champs).

---

## 4. 📂 CRUD fichier — Persistance sans BDD

Le fichier `sauvegarde.txt` joue le rôle de base de données. Chaque ligne = une personne.

### 4.1 Lire — `lireToutesPersonnes()`

```php
function lireToutesPersonnes(string $fichier): array
```

- Utilise `file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)` pour lire toutes les lignes en un tableau.
- Appelle `Personne::fromLine()` sur chaque ligne.
- Retourne un tableau indexé `Personne[]` (les indices = les IDs).

### 4.2 Écrire (réécriture complète) — `ecrireToutesPersonnes()`

```php
function ecrireToutesPersonnes(array $personnes, string $fichier): void
```

- Reconstruit tout le fichier depuis le tableau en mémoire.
- Utilise `implode("\n", $out)` pour assembler les lignes.
- Utilisé par `supprimerPersonne()` et `modifierPersonne()`.

### 4.3 Ajouter — `ajouterPersonne()`

```php
function ajouterPersonne(Personne $p, string $fichier): void
```

- Utilise `file_put_contents($fichier, $p->toLine() . "\n", FILE_APPEND)`.
- `FILE_APPEND` : ajoute à la fin sans effacer le contenu existant.

---

## 5. ✏️ Modifier une personne

### Flux complet

```
[Liste] → clic ✏️ → GET action=edit&id=X
       → formulaire pré-rempli
       → soumission POST action=update
       → validation → modifierPersonne() → confirmation
```

### Action `edit` (dans `index.php`)

```php
case "edit":
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    $personnes = lireToutesPersonnes($fichier);

    if (isset($personnes[$id])) {
        $p = $personnes[$id];
        $val["nom"]    = $p->getNom();
        $val["prenom"] = $p->getPrenom();
        $val["dateN"]  = $p->getDateN();
        $zonePrincipale = formPersonne("update", $val, $err, $id);
    }
```

- Récupère l'ID depuis `$_GET['id']` et le caste en `(int)` (sécurité).
- Pré-remplit `$val` avec les données actuelles de la personne.
- Passe `$id` à `formPersonne()` pour générer un champ `<input type="hidden" name="id">`.

### Action `update` (dans `index.php`)

```php
case "update":
    $id = isset($_POST['id']) ? (int)$_POST['id'] : -1;
    // ... validation identique à "enregistrer" ...
    if (count(array_filter($err)) === 0) {
        $p = new Personne($val["nom"], $val["prenom"], $val["dateN"]);
        modifierPersonne($id, $p, $fichier);
    }
```

- L'ID voyage via un champ `hidden` dans le formulaire POST.
- La validation est identique à l'ajout.

### Fonction `modifierPersonne()`

```php
function modifierPersonne(int $id, Personne $p, string $fichier): bool {
    $personnes = lireToutesPersonnes($fichier);
    if (!isset($personnes[$id])) return false;
    $personnes[$id] = $p;           // remplacement à l'index $id
    ecrireToutesPersonnes($personnes, $fichier);
    return true;
}
```

---

## 6. 🗑️ Supprimer une personne

### Flux complet

```
[Liste] → clic 🗑️ → confirm() JS → GET action=delete&id=X → suppression
```

### Action `delete` (dans `index.php`)

```php
case "delete":
    $id = isset($_GET['id']) ? (int)$_GET['id'] : -1;
    $success = supprimerPersonne($id, $fichier);
```

- Simple requête GET avec l'ID (pas de formulaire POST).
- Une boîte `confirm()` JavaScript demande confirmation avant d'exécuter la requête.

### Fonction `supprimerPersonne()`

```php
function supprimerPersonne(int $id, string $fichier): bool {
    $personnes = lireToutesPersonnes($fichier);
    if (!isset($personnes[$id])) return false;
    array_splice($personnes, $id, 1);   // supprime 1 élément à l'index $id
    ecrireToutesPersonnes($personnes, $fichier);
    return true;
}
```

- `array_splice($tableau, $debut, $nb)` : supprime `$nb` éléments à partir de `$debut` et **réindexe** le tableau.
- La réindexation est importante : les IDs sont recalculés à chaque lecture du fichier.

> ⚠️ **Attention** : les IDs ne sont pas permanents. Si on supprime la personne d'index 2, l'ancienne personne 3 devient la personne 2.

---

## 7. 📋 Formulaire — `formPersonne()`

```php
function formPersonne(string $action, array $val, array $err, ?int $id = null): string
```

### Paramètres

| Paramètre | Type      | Rôle                                                          |
|-----------|-----------|---------------------------------------------------------------|
| `$action` | `string`  | Action cible du formulaire (`"enregistrer"` ou `"update"`)    |
| `$val`    | `array`   | Valeurs à pré-remplir dans les champs                         |
| `$err`    | `array`   | Messages d'erreur à afficher à côté de chaque champ           |
| `$id`     | `?int`    | Si fourni, génère un champ `hidden` pour la modification      |

### Notions clés

| Notion                  | Code                                         | Explication                                    |
|-------------------------|----------------------------------------------|------------------------------------------------|
| Valeurs par défaut      | `array_merge($defaults, $val)`               | Évite les notices PHP si une clé est absente   |
| Échappement des sorties | `foreach ($val) { $val[$k] = h($v); }`       | Protection XSS sur toutes les valeurs          |
| Champ caché ID          | `<input type="hidden" name="id" value="…">` | Transmet l'ID lors d'une modification          |
| Heredoc                 | `return <<<HTML … HTML;`                     | Syntaxe multilignes pour générer du HTML       |
| Pré-remplissage         | `value="{$val['nom']}"`                      | Conserve les saisies en cas d'erreur           |
| Affichage erreurs       | `{$err['nom']}` dans la 3e colonne           | Message affiché à côté du champ invalide       |

---

## 8. 🔄 Routeur — Pattern Contrôleur Front (`index.php`)

```php
$action = isset($_GET['action']) ? trim($_GET['action']) : '';

switch ($action) {
    case "saisir":     /* affiche le formulaire vide */      break;
    case "afficher":   /* affiche la liste */                break;
    case "enregistrer":/* traite POST + sauvegarde */        break;
    case "edit":       /* affiche formulaire pré-rempli */   break;
    case "update":     /* traite POST + modification */      break;
    case "delete":     /* supprime + confirme */             break;
    default:
        header("Location: index.php?action=afficher"); exit;
}

include "squelette.php";
```

### Notions importantes

| Notion                   | Exemple                                         | Explication                                           |
|--------------------------|-------------------------------------------------|-------------------------------------------------------|
| Opérateur null-coalescent | `$_GET['action'] ?? ''`                        | Valeur par défaut si la clé n'existe pas              |
| Cast sécurisé             | `(int)$_GET['id']`                             | Convertit en entier pour éviter les injections        |
| Séparation GET/POST       | `$_GET` pour lire l'action, `$_POST` pour les données du formulaire | Bonne pratique REST |
| Redirection               | `header("Location: …"); exit;`                 | Redirige après une action (pattern PRG)               |
| Variable de vue           | `$zonePrincipale`                              | Contenu injecté dans le squelette HTML                |
| `include "squelette.php"` | En fin de script                               | Sépare la logique de la présentation                  |

---

## 9. 🗃️ Tableau HTML — `tablePersonnes()`

```php
function tablePersonnes(array $personnes): string
```

- Génère un tableau HTML avec une ligne par personne.
- Chaque ligne contient : Nom | Prénom | Date | Actions (`✏️` edit, `🗑️` delete).
- Les URLs d'action intègrent l'index `$i` comme identifiant : `index.php?action=edit&id=$i`.
- `onclick="return confirm('...')"` sur le lien de suppression : confirmation côté navigateur.

---

## 10. 🎨 Template — `squelette.php`

- Fichier HTML inclus **après** la logique PHP.
- Affiche `$zonePrincipale` (générée par le contrôleur) dans la colonne principale.
- Barre de navigation latérale avec les liens `saisir` et `afficher`.

---

## 🧩 Récapitulatif des fonctions

| Fonction                 | Fichier   | Catégorie       |
|--------------------------|-----------|-----------------|
| `h()`                    | lib.php   | Sécurité        |
| `controlerDate()`        | lib.php   | Validation      |
| `Personne::__construct`  | lib.php   | Modèle          |
| `Personne::toLine()`     | lib.php   | Sérialisation   |
| `Personne::fromLine()`   | lib.php   | Désérialisation |
| `lireToutesPersonnes()`  | lib.php   | Lecture fichier |
| `ecrireToutesPersonnes()`| lib.php   | Écriture fichier|
| `ajouterPersonne()`      | lib.php   | Ajout           |
| `modifierPersonne()`     | lib.php   | Modification    |
| `supprimerPersonne()`    | lib.php   | Suppression     |
| `formPersonne()`         | lib.php   | Vue formulaire  |
| `tablePersonnes()`       | lib.php   | Vue liste       |

