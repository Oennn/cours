# Tutoriel Complet: Itérateurs et Monoïdes Libres

## 📚 Concepts Fondamentaux

### 1. Monoïde Libre
Un **monoïde libre** est une structure mathématique (E, ⊕) où:
- E est un ensemble
- ⊕ est une opération binaire associative
- Il existe un élément neutre (identité)
- **Propriété clé**: Chaque élément est généré de façon **unique** par une base (famille génératrice)

**Exemple**: Les chaînes de caractères forment un monoïde libre:
- Opération: concaténation
- Neutre: chaîne vide ""
- Base: l'alphabet {a, b, c, ...}

### 2. Itérateur en Programmation
Un **itérateur** est un objet qui encapsule la logique de parcours d'une collection:
- **Initialisation**: point de départ du parcours
- **Test de fin**: vérifier si on a atteint la fin
- **Progression**: passer à l'élément suivant

C'est un **pattern** qui généralise le concept mathématique: générer tous les éléments d'un ensemble de façon ordonnée.

---

## 🔧 EXERCICE 1: Mon Premier Itérateur

### Partie 1: Itérateur simple sur {0, ..., 10}

```c
#include <stdio.h>
#include <stdbool.h>

// Initialisation : renvoie le premier élément
int init() {
    return 0;
}

// Test de fin : vérifie si on peut continuer
bool end(int current) {
    return current <= 10;
}

// Progression : passe à l'élément suivant
int next(int current) {
    return current + 1;
}

// Boucle utilisant l'itérateur
void iterate_0_to_10() {
    for (int i = init(); end(i); i = next(i)) {
        printf("%d ", i);
    }
    printf("\n");
}
```

**Explication**:
- `init()` = **base** du monoïde (point de départ)
- `next()` = **opération** (passage à l'élément suivant)
- `end()` = **test d'arrêt** (limite de l'ensemble)

---

### Partie 2: Adaptation pour {n ∈ ℕ | n ≤ 100, n ≡ 0 [7]}

C'est l'ensemble des **multiples de 7** entre 0 et 100: {0, 7, 14, 21, 28, ...}

```c
int init_multiples_7() {
    return 0;  // Premier multiple de 7
}

bool end_multiples_7(int current) {
    return current <= 100;
}

int next_multiples_7(int current) {
    return current + 7;  // Saute de 7 en 7
}

void iterate_multiples_7() {
    for (int i = init_multiples_7(); end_multiples_7(i); i = next_multiples_7(i)) {
        printf("%d ", i);  // Affiche: 0 7 14 21 28 35 42 49 56 63 70 77 84 91 98
    }
    printf("\n");
}
```

---

### Partie 3: Itérateur pour {n ∈ ℕ | n ≡ 0 [7]} (INFINI!)

Cet ensemble = {0, 7, 14, 21, ...} **sans limite supérieure**

```c
// On peut omettre le test end() ou le rendre toujours vrai
int init_all_multiples_7() {
    return 0;
}

bool end_all_multiples_7(int current) {
    return true;  // Jamais de fin (ou on met une limite arbitraire)
}

int next_all_multiples_7(int current) {
    return current + 7;
}

// Afficher les 15 premiers
void iterate_all_multiples_7() {
    int count = 0;
    for (int i = init_all_multiples_7(); count < 15 && end_all_multiples_7(i); 
         i = next_all_multiples_7(i), count++) {
        printf("%d ", i);
    }
    printf("\n");
}
```

---

### Partie 4: Est-ce un monoïde libre?

**Avec l'opération d'addition**: (ℕ ≡ 0 [7], +)

**Réponse: OUI, c'est un monoïde libre!**

**Raisons**:
1. **Associativité**: (a + b) + c = a + (b + c) ✓
2. **Élément neutre**: 0 est l'élément neutre (0 + a = a) ✓
3. **Génération unique**: 
   - **Base**: {7} (un seul générateur)
   - Tout élément = 7k où k ∈ ℕ
   - Chaque élément s'écrit de façon **unique** comme 0 + 7 + 7 + ... + 7
   - C'est exactement comme les nombres naturels multiplié par 7

**Structure**: C'est isomorphe à (ℕ, +) via la bijection n ↦ 7n

```
0    ↔ 0 × 7 = 0
7    ↔ 1 × 7 = 7
14   ↔ 2 × 7 = 14
21   ↔ 3 × 7 = 21
...
```

---

## 🧬 EXERCICE 2: Autres Exemples

### 2.1 Itérateur sur les Nombres Premiers

```c
#include <stdbool.h>

typedef struct {
    int current;
} PrimeIterator;

// Fonction utilitaire: tester si un nombre est premier
bool is_prime(int n) {
    if (n < 2) return false;
    if (n == 2) return true;
    if (n % 2 == 0) return false;
    for (int i = 3; i * i <= n; i += 2) {
        if (n % i == 0) return false;
    }
    return true;
}

PrimeIterator init_primes() {
    PrimeIterator it = {.current = 2};
    return it;
}

bool end_primes(PrimeIterator it, int max) {
    return it.current <= max;  // Limite optionnelle
}

PrimeIterator next_primes(PrimeIterator it) {
    it.current++;
    while (!is_prime(it.current)) {
        it.current++;
    }
    return it;
}

void iterate_primes() {
    PrimeIterator it = init_primes();
    int count = 0;
    while (count < 10) {  // 10 premiers nombres premiers
        printf("%d ", it.current);
        it = next_primes(it);
        count++;
    }
    printf("\n");  // Affiche: 2 3 5 7 11 13 17 19 23 29
}
```

**Analyse**:
- **Pas un monoïde libre** pour l'addition (2 + 3 = 5 est premier, mais 3 + 5 = 8 ne l'est pas)
- L'ensemble des nombres premiers n'a **pas de base génératrice** (propriété de Goldbach)

---

### 2.2 Nombres Carrés < 1000

{x ∈ ℕ | ∃y ∈ ℕ, x = y² ≤ 1000}

```c
typedef struct {
    int current;  // Valeur actuelle
    int base;     // Le nombre dont on cherche le carré
} SquareIterator;

SquareIterator init_squares() {
    SquareIterator it = {.base = 0, .current = 0};
    return it;
}

bool end_squares(SquareIterator it) {
    return it.current < 1000;
}

SquareIterator next_squares(SquareIterator it) {
    it.base++;
    it.current = it.base * it.base;
    return it;
}

void iterate_squares() {
    SquareIterator it = init_squares();
    while (end_squares(it)) {
        printf("%d ", it.current);
        it = next_squares(it);
    }
    printf("\n");  // Affiche: 0 1 4 9 16 25 36 49 64 81 100 121 ...
}
```

**Points clés**:
- On stocke **l'état** dans la structure (base = y)
- À chaque itération, on génère y² et on incrémente y
- Monoïde libre? Non, pour l'addition (1 + 4 = 5 n'est pas un carré)

---

### 2.3 Lettres {a, c, g, t} (Ordre Alphabétique)

```c
#include <string.h>

typedef struct {
    int index;
} DNABaseIterator;

// Les 4 bases ADN
const char* dna_bases = "acgt";

DNABaseIterator init_dna_bases() {
    return (DNABaseIterator){.index = 0};
}

bool end_dna_bases(DNABaseIterator it) {
    return it.index < 4;
}

DNABaseIterator next_dna_bases(DNABaseIterator it) {
    it.index++;
    return it;
}

void iterate_dna_bases() {
    for (DNABaseIterator it = init_dna_bases(); 
         end_dna_bases(it); 
         it = next_dna_bases(it)) {
        printf("%c ", dna_bases[it.index]);
    }
    printf("\n");  // Affiche: a c g t
}
```

**Note mathématique**: 
- Cet ensemble avec concaténation **EST un monoïde libre**!
- Base génératrice: {a, c, g, t}
- Chaque chaîne ADN = concaténation unique des bases

---

### 2.4 Séquences ADN de Taille n (Ordre Lexicographique)

C'est l'ensemble des n-uplets de {a, c, g, t}.

**Exemple pour n=2**: {aa, ac, ag, at, ca, cc, cg, ct, ga, gc, gg, gt, ta, tc, tg, tt}

```c
#include <string.h>
#include <stdlib.h>

typedef struct {
    char* sequence;
    int length;
    int bases_count;  // Toujours 4 pour {a, c, g, t}
} DNASequenceIterator;

const char dna_alphabet[] = {'a', 'c', 'g', 't'};

DNASequenceIterator init_dna_sequences(int length) {
    DNASequenceIterator it;
    it.length = length;
    it.bases_count = 4;
    it.sequence = (char*)malloc(length + 1);
    
    // Initialiser avec la première séquence (tout 'a')
    for (int i = 0; i < length; i++) {
        it.sequence[i] = 'a';
    }
    it.sequence[length] = '\0';
    
    return it;
}

bool end_dna_sequences(DNASequenceIterator it) {
    // Vérifier que la séquence n'a pas dépassé 'tt...t'
    for (int i = 0; i < it.length; i++) {
        if (it.sequence[i] != 't') {
            return true;
        }
    }
    return false;  // Tous les caractères sont 't' = fin
}

DNASequenceIterator next_dna_sequences(DNASequenceIterator it) {
    // Incrémenter comme un nombre en base 4 (en ordre lexicographique)
    int position = it.length - 1;  // Commencer par la droite
    
    while (position >= 0) {
        // Trouver l'index du caractère actuel
        int char_index = 0;
        for (int i = 0; i < 4; i++) {
            if (dna_alphabet[i] == it.sequence[position]) {
                char_index = i;
                break;
            }
        }
        
        if (char_index < 3) {  // Pas encore 't'
            it.sequence[position] = dna_alphabet[char_index + 1];
            break;
        } else {
            // Remettre à 'a' et passer à la position suivante
            it.sequence[position] = 'a';
            position--;
        }
    }
    
    return it;
}

void iterate_dna_sequences(int length) {
    DNASequenceIterator it = init_dna_sequences(length);
    
    printf("Séquences ADN de taille %d (ordre lexicographique):\n", length);
    
    do {
        printf("%s ", it.sequence);
    } while (end_dna_sequences(it) && 
             (it = next_dna_sequences(it), 1));  // Hack pour appel dans while
    
    printf("\n");
    free(it.sequence);
}

// Meilleure version avec compte explicite:
void iterate_dna_sequences_v2(int length) {
    DNASequenceIterator it = init_dna_sequences(length);
    int total_sequences = 1;
    for (int i = 0; i < length; i++) total_sequences *= 4;  // 4^length
    
    for (int i = 0; i < total_sequences; i++) {
        printf("%s ", it.sequence);
        if (i < total_sequences - 1) {
            it = next_dna_sequences(it);
        }
    }
    printf("\n");
    free(it.sequence);
}
```

**Exemple de sortie pour length=2**:
```
aa ac ag at ca cc cg ct ga gc gg gt ta tc tg tt
```

**Algorithme expliqué**:
1. Initialiser avec "aa...a"
2. À chaque étape: incrémenter lexicographiquement (comme un compteur en base 4)
3. 'a' → 'c' → 'g' → 't' → (remise à 'a' et passage à la position précédente)

---

## 📊 Résumé Comparatif

| Ensemble | Monoïde Libre? | Base | Opération | Infini? |
|----------|---|---|---|---|
| {0,...,10} | Non (pas d'opération) | - | - | Non |
| {7k \| k ∈ ℕ} + addition | **OUI** | {7} | + | Oui |
| Nombres premiers | Non | Indéfini | - | Oui |
| Carrés < 1000 | Non | - | - | Non |
| {a,c,g,t}* (avec concat) | **OUI** | {a,c,g,t} | concat | Oui |
| ADN taille n | Oui (fini) | {a,c,g,t} | concat | Non |

---

## 🎯 Points Clés à Retenir

1. **Itérateur** = moyen de générer une collection ordonnée
2. **Monoïde libre** = chaque élément genéré de façon unique par une base
3. **Lien**: Un itérateur qui génère un monoïde + une opération associative = monoïde libre possible
4. **Pattern**: Utiliser une structure pour encapsuler l'état itératif
5. **Ordre**: L'ordre de parcours (croissant, lexicographique) est crucial


