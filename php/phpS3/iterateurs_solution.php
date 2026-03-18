<?php
/**
 * TUTORIEL COMPLET: ITÉRATEURS ET MONOÏDES LIBRES
 * Implémentation en PHP
 */

echo "╔═════════════════════════════════════════════════════════╗\n";
echo "║    TUTORIEL ITÉRATEURS ET MONOÏDES LIBRES (PHP)        ║\n";
echo "╚═════════════════════════════════════════════════════════╝\n\n";

// ============================================================
// EXERCICE 1: Mon Premier Itérateur
// ============================================================

echo "=== EXERCICE 1.1: Itérateur simple {0,...,10} ===\n";
echo "Code:\n";
echo "  for (\$i = 0; \$i <= 10; \$i++) {\n";
echo "      echo \$i . \" \";\n";
echo "  }\n";
echo "Résultat: ";
for ($i = 0; $i <= 10; $i++) {
    echo $i . " ";
}
echo "\n\n";

// ===== Avec classe Iterator =====
class SimpleIterator {
    private $current;
    private $max;
    
    public function __construct($start = 0, $max = 10) {
        $this->current = $start;
        $this->max = $max;
    }
    
    // init: déjà fait par le constructeur
    
    public function hasNext() {
        return $this->current <= $this->max;
    }
    
    public function next() {
        return $this->current++;
    }
}

echo "=== EXERCICE 1.1b: Avec classe Iterator ===\n";
$it = new SimpleIterator(0, 10);
while ($it->hasNext()) {
    echo $it->next() . " ";
}
echo "\n\n";

// ===== 1.2 Multiples de 7 jusqu'à 100 =====
echo "=== EXERCICE 1.2: Multiples de 7 jusqu'à 100 ===\n";
echo "Ensemble: {n ∈ ℕ | n ≤ 100, n ≡ 0 [7]}\n";
echo "Résultat: ";
for ($i = 0; $i <= 100; $i += 7) {
    echo $i . " ";
}
echo "\n";
echo "Analyse: Cette progression saute de 7 en 7 au lieu de 1 en 1\n\n";

// ===== 1.3 Tous les multiples de 7 (infini) =====
echo "=== EXERCICE 1.3: Tous les multiples de 7 (INFINI) ===\n";
echo "Premier 15 éléments: ";
for ($i = 0, $n = 0; $i < 15; $i++) {
    echo $n . " ";
    $n += 7;
}
echo "\n";
echo "ANALYSE MATHÉMATIQUE:\n";
echo "  Cet ensemble avec l'opération d'addition = monoïde libre?\n";
echo "\n";
echo "  ✓ Monoïde (M, +) où M = {n ∈ ℕ | n ≡ 0 [7]}\n";
echo "    1. Associativité: (a + b) + c = a + (b + c) ✓\n";
echo "    2. Élément neutre: 0 ∈ M, et 0 + a = a pour tout a ∈ M ✓\n";
echo "    3. Stabilité: Si a, b ∈ M (multiples de 7), alors a + b ∈ M ✓\n";
echo "\n";
echo "  ✓ Monoïde LIBRE:\n";
echo "    - Base génératrice: B = {7} (générateur unique)\n";
echo "    - Chaque élément: a = 0 + 7 + 7 + ... + 7 (k fois)\n";
echo "    - PROPRIÉTÉ CRUCIALE: Cette décomposition est UNIQUE\n";
echo "    - 21 = 0 + 7 + 7 + 7 (une seule façon)\n";
echo "    - C'est l'isomorphe de (ℕ, +) via f(n) = 7n\n";
echo "\n";
echo "  → DONC: OUI, c'est un monoïde libre! ✓✓✓\n\n";

// ============================================================
// EXERCICE 2: Autres Exemples
// ============================================================

// ===== 2.1 Nombres Premiers =====
echo "=== EXERCICE 2.1: Nombres Premiers ===\n";

function is_prime($n) {
    if ($n < 2) return false;
    if ($n == 2) return true;
    if ($n % 2 == 0) return false;
    for ($i = 3; $i * $i <= $n; $i += 2) {
        if ($n % $i == 0) return false;
    }
    return true;
}

class PrimeIterator {
    private $current;
    
    public function __construct() {
        $this->current = 2;
    }
    
    public function hasNext() {
        return $this->current < 10000;
    }
    
    public function next() {
        $result = $this->current;
        do {
            $this->current++;
        } while (!is_prime($this->current));
        return $result;
    }
}

echo "Premier 15 nombres premiers: ";
$primes = new PrimeIterator();
for ($i = 0; $i < 15 && $primes->hasNext(); $i++) {
    echo $primes->next() . " ";
}
echo "\n";
echo "ANALYSE: Pas un monoïde libre\n";
echo "  - Raison: L'addition ne préserve pas la propriété \"premier\"\n";
echo "  - Contre-exemple: 2 + 3 = 5 (premier), mais 3 + 5 = 8 (NON premier)\n";
echo "  - Conclusion: Pas de base génératrice unique\n\n";

// ===== 2.2 Carrés < 1000 =====
echo "=== EXERCICE 2.2: Nombres Carrés < 1000 ===\n";
echo "Ensemble: {x ∈ ℕ | ∃y ∈ ℕ, x = y² ≤ 1000}\n";
echo "Résultat: ";

class SquareIterator {
    private $base = 0;
    
    public function hasNext() {
        return $this->base * $this->base < 1000;
    }
    
    public function next() {
        $result = $this->base * $this->base;
        $this->base++;
        return $result;
    }
}

$squares = new SquareIterator();
while ($squares->hasNext()) {
    echo $squares->next() . " ";
}
echo "\n";
echo "Total: " . floor(sqrt(999)) . " carrés\n";
echo "ANALYSE: Pas un monoïde libre\n";
echo "  - 1 + 4 = 5 (NON un carré)\n";
echo "  - 9 + 16 = 25 (oui un carré), mais pas toujours\n\n";

// ===== 2.3 Bases ADN {a, c, g, t} =====
echo "=== EXERCICE 2.3: Bases ADN {a, c, g, t} ===\n";
echo "Ordre alphabétique: ";

$bases = ['a', 'c', 'g', 't'];
foreach ($bases as $base) {
    echo $base . " ";
}
echo "\n";

echo "ANALYSE: C'est un monoïde libre!\n";
echo "  - Ensemble: {a, c, g, t}* (toutes les séquences possibles)\n";
echo "  - Opération: concaténation (juxtaposition)\n";
echo "  - Élément neutre: chaîne vide \"\"\n";
echo "  - Base génératrice: {a, c, g, t}\n";
echo "  - PROPRIÉTÉ CLÉS:\n";
echo "    * \"acgt\" = \"a\" · \"c\" · \"g\" · \"t\" (unique décomposition)\n";
echo "    * \"atcg\" = \"a\" · \"t\" · \"c\" · \"g\" (différent de acgt!)\n";
echo "    * Chaque séquence = concaténation UNIQUE des bases\n";
echo "\n";
echo "  → Donc OUI, c'est un monoïde libre! ✓\n\n";

// ===== 2.4 Séquences ADN de taille n =====
echo "=== EXERCICE 2.4: Séquences ADN de taille n ===\n";

class DNASequenceIterator {
    private $sequence;
    private $length;
    private $finished = false;
    
    public function __construct($length) {
        $this->length = $length;
        // Initialiser avec "aa...a"
        $this->sequence = str_repeat('a', $length);
    }
    
    public function hasNext() {
        return !$this->finished;
    }
    
    public function current() {
        return $this->sequence;
    }
    
    public function next() {
        $seq = str_split($this->sequence);
        $pos = count($seq) - 1;
        
        // Incrémenter en base 4: a->c->g->t->a
        while ($pos >= 0) {
            switch ($seq[$pos]) {
                case 'a': $seq[$pos] = 'c'; return;
                case 'c': $seq[$pos] = 'g'; return;
                case 'g': $seq[$pos] = 't'; return;
                case 't': $seq[$pos] = 'a'; $pos--; break;
            }
        }
        
        // Si on arrive ici, on a fini (tt...t atteint)
        $this->finished = true;
    }
}

echo "Séquences ADN de taille 2 (ordre lexicographique):\n";
$dna = new DNASequenceIterator(2);
$count = 0;
while ($dna->hasNext()) {
    echo $dna->current() . " ";
    $dna->next();
    $count++;
}
echo "\n";
echo "Total: " . pow(4, 2) . " séquences\n";

echo "\nSéquences ADN de taille 3 (premiers 16):\n";
$dna3 = new DNASequenceIterator(3);
$count = 0;
while ($dna3->hasNext() && $count < 16) {
    echo $dna3->current() . " ";
    $dna3->next();
    $count++;
}
echo "...\n";
echo "Total: " . pow(4, 3) . " séquences\n";

echo "\nANALYSE: C'est un monoïde libre (fini)\n";
echo "  - Ensemble: {a,c,g,t}^n (exactement n bases)\n";
echo "  - Opération: concaténation (mais limité à taille fixe)\n";
echo "  - Base génératrice: {a, c, g, t}\n";
echo "  - Nombre d'éléments: 4^n\n";
echo "  - Ordre: lexicographique (aa...a < ... < tt...t)\n";
echo "  - Propriété: Chaque séquence est générée de façon UNIQUE\n";
echo "              par concaténation des bases\n";
echo "\n";
echo "  → Donc OUI, c'est un monoïde libre (fini)! ✓\n\n";

// ============================================================
// TABLEAU RÉCAPITULATIF
// ============================================================
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║              TABLEAU RÉCAPITULATIF                             ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

$data = [
    [
        "Ensemble" => "{0, ..., 10}",
        "Monoïde libre?" => "Non (pas d'opération)",
        "Base" => "-",
        "Infini?" => "Non"
    ],
    [
        "Ensemble" => "{7k | k ∈ ℕ}",
        "Monoïde libre?" => "✓ OUI",
        "Base" => "{7}",
        "Infini?" => "Oui"
    ],
    [
        "Ensemble" => "Nombres premiers",
        "Monoïde libre?" => "Non",
        "Base" => "Indéfini",
        "Infini?" => "Oui"
    ],
    [
        "Ensemble" => "Carrés < 1000",
        "Monoïde libre?" => "Non",
        "Base" => "Aucune",
        "Infini?" => "Non (31 éléments)"
    ],
    [
        "Ensemble" => "{a,c,g,t}* (concat)",
        "Monoïde libre?" => "✓ OUI",
        "Base" => "{a,c,g,t}",
        "Infini?" => "Oui"
    ],
    [
        "Ensemble" => "ADN taille n",
        "Monoïde libre?" => "✓ OUI",
        "Base" => "{a,c,g,t}",
        "Infini?" => "Non (4^n)"
    ]
];

// Afficher le tableau
printf("%-25s | %-25s | %-15s | %-15s\n", "Ensemble", "Monoïde libre?", "Base", "Infini?");
printf("%-25s | %-25s | %-15s | %-15s\n", str_repeat("-", 24), str_repeat("-", 24), str_repeat("-", 14), str_repeat("-", 14));

foreach ($data as $row) {
    printf("%-25s | %-25s | %-15s | %-15s\n", 
        $row["Ensemble"], 
        $row["Monoïde libre?"], 
        $row["Base"], 
        $row["Infini?"]
    );
}

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║             POINTS CLÉS À RETENIR                              ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

$points = [
    "1. ITÉRATEUR" => "C'est une abstraction pour parcourir une collection ordonnée",
    "   Composants" => "init(), hasNext(), next()",
    "",
    "2. MONOÏDE LIBRE" => "Structure où chaque élément est généré de façon UNIQUE",
    "   Propriétés" => [
        "- Associativité: (a⊕b)⊕c = a⊕(b⊕c)",
        "- Élément neutre: e⊕a = a pour tout a",
        "- Base génératrice unique",
        "- Chaque élément s'écrit UNE SEULE FAÇON"
    ],
    "",
    "3. LIEN ITÉRATEUR ↔ MONOÏDE LIBRE" => [
        "- L'itérateur génère les éléments du monoïde",
        "- L'ordre de parcours reflète la structure",
        "- next() implémente l'opération du monoïde"
    ],
    "",
    "4. ORDRE CRUCIAL" => "L'ordre de parcours est ESSENTIEL",
    "   Exemples" => [
        "- Croissant: 0 < 7 < 14 < ...",
        "- Lexicographique: aa < ac < ag < at < ca < ...",
        "- Prime: 2 < 3 < 5 < 7 < 11 < ..."
    ]
];

foreach ($points as $key => $value) {
    if (is_array($value)) {
        echo "$key:\n";
        foreach ($value as $item) {
            echo "  $item\n";
        }
    } else {
        echo "$key: $value\n";
    }
}

echo "\n╔════════════════════════════════════════════════════════════════╗\n";
echo "║              FIN DU TUTORIEL                                   ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
?>

