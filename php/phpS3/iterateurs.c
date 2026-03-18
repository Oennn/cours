#include <stdio.h>
#include <stdbool.h>
#include <stdlib.h>
#include <string.h>

/**
 * EXERCICE 1: Mon Premier Itérateur
 * Parcourir l'ensemble {0, ..., 10}
 */

// ===== Itérateur simple sur {0, ..., 10} =====
int init() {
    return 0;
}

bool end(int current) {
    return current <= 10;
}

int next(int current) {
    return current + 1;
}

void ex1_simple() {
    printf("=== EXERCICE 1.1: Itérateur {0,...,10} ===\n");
    for (int i = init(); end(i); i = next(i)) {
        printf("%d ", i);
    }
    printf("\n\n");
}

// ===== Itérateur sur {n ∈ ℕ | n ≤ 100, n ≡ 0 [7]} =====
int init_mult7_100() {
    return 0;
}

bool end_mult7_100(int current) {
    return current <= 100;
}

int next_mult7_100(int current) {
    return current + 7;
}

void ex1_multiples_7() {
    printf("=== EXERCICE 1.2: Multiples de 7 jusqu'à 100 ===\n");
    printf("Ensemble: {0, 7, 14, 21, ..., 98}\n");
    for (int i = init_mult7_100(); end_mult7_100(i); i = next_mult7_100(i)) {
        printf("%d ", i);
    }
    printf("\n\n");
}

// ===== Itérateur sur {n ∈ ℕ | n ≡ 0 [7]} (INFINI) =====
void ex1_multiples_7_infini() {
    printf("=== EXERCICE 1.3: Tous les multiples de 7 ===\n");
    printf("Premier 15 éléments: ");
    int count = 0;
    int current = init_mult7_100();
    while (count < 15) {
        printf("%d ", current);
        current = next_mult7_100(current);
        count++;
    }
    printf("\n");
    printf("ANALYSE: Monoïde libre avec (ℕ ≡ 0[7], +)\n");
    printf("  - Associativité: (a+b)+c = a+(b+c) ✓\n");
    printf("  - Élément neutre: 0 ✓\n");
    printf("  - Base génératrice: {7} (générateur unique)\n");
    printf("  - Chaque élément = 0 + 7 + 7 + ... + 7 (n fois)\n");
    printf("  - Isomorphe à (ℕ, +) via f(n) = 7n\n");
    printf("  → DONC OUI, c'est un monoïde libre! ✓\n\n");
}

/**
 * EXERCICE 2: Autres Exemples
 */

// ===== 2.1 Itérateur sur les nombres premiers =====
bool is_prime(int n) {
    if (n < 2) return false;
    if (n == 2) return true;
    if (n % 2 == 0) return false;
    for (int i = 3; i * i <= n; i += 2) {
        if (n % i == 0) return false;
    }
    return true;
}

typedef struct {
    int current;
} PrimeIterator;

PrimeIterator init_primes() {
    return (PrimeIterator){.current = 2};
}

bool end_primes(PrimeIterator it) {
    return it.current < 10000;  // Limite arbitraire
}

PrimeIterator next_primes(PrimeIterator it) {
    it.current++;
    while (!is_prime(it.current)) {
        it.current++;
    }
    return it;
}

void ex2_primes() {
    printf("=== EXERCICE 2.1: Nombres Premiers ===\n");
    printf("Premier 15 nombres premiers: ");
    PrimeIterator it = init_primes();
    for (int i = 0; i < 15 && end_primes(it); i++, it = next_primes(it)) {
        printf("%d ", it.current);
    }
    printf("\n");
    printf("ANALYSE: Pas un monoïde libre\n");
    printf("  - Exemple: 2+3=5 (premier), mais 3+5=8 (non premier)\n");
    printf("  - L'ensemble des premiers n'a pas de base génératrice\n\n");
}

// ===== 2.2 Nombres carrés < 1000 =====
typedef struct {
    int current;
    int base;  // Le nombre dont on cherche le carré
} SquareIterator;

SquareIterator init_squares() {
    return (SquareIterator){.base = 0, .current = 0};
}

bool end_squares(SquareIterator it) {
    return it.current < 1000;
}

SquareIterator next_squares(SquareIterator it) {
    it.base++;
    it.current = it.base * it.base;
    return it;
}

void ex2_squares() {
    printf("=== EXERCICE 2.2: Nombres Carrés < 1000 ===\n");
    printf("Ensemble: {0, 1, 4, 9, 16, 25, ...}\n");
    SquareIterator it = init_squares();
    while (end_squares(it)) {
        printf("%d ", it.current);
        it = next_squares(it);
    }
    printf("\n");
    printf("ANALYSE: Pas un monoïde libre\n");
    printf("  - 1 + 4 = 5 (non carré)\n");
    printf("  - 9 + 16 = 25 (oui carré!), mais pas toujours\n\n");
}

// ===== 2.3 Lettres {a, c, g, t} =====
typedef struct {
    int index;
} DNABaseIterator;

const char dna_bases[] = {'a', 'c', 'g', 't'};

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

void ex2_dna_bases() {
    printf("=== EXERCICE 2.3: Bases ADN {a, c, g, t} ===\n");
    for (DNABaseIterator it = init_dna_bases();
         end_dna_bases(it);
         it = next_dna_bases(it)) {
        printf("%c ", dna_bases[it.index]);
    }
    printf("\n");
    printf("ANALYSE: C'est un monoïde libre!\n");
    printf("  - Opération: concaténation\n");
    printf("  - Base génératrice: {a, c, g, t}\n");
    printf("  - Neutre: chaîne vide \"\"\n");
    printf("  - Chaque séquence = concaténation unique des bases\n\n");
}

// ===== 2.4 Séquences ADN de taille n =====
typedef struct {
    char* sequence;
    int length;
} DNASequenceIterator;

DNASequenceIterator init_dna_sequences(int length) {
    DNASequenceIterator it;
    it.length = length;
    it.sequence = (char*)malloc(length + 1);

    // Initialiser avec "aa...a"
    for (int i = 0; i < length; i++) {
        it.sequence[i] = 'a';
    }
    it.sequence[length] = '\0';

    return it;
}

bool end_dna_sequences(DNASequenceIterator it) {
    // Vérifie que ce n'est pas "tt...t" (last element)
    for (int i = 0; i < it.length; i++) {
        if (it.sequence[i] != 't') {
            return true;
        }
    }
    return false;
}

DNASequenceIterator next_dna_sequences(DNASequenceIterator it) {
    // Incrémenter lexicographiquement (base 4)
    int position = it.length - 1;

    while (position >= 0) {
        char current = it.sequence[position];
        if (current == 'a') {
            it.sequence[position] = 'c';
            return it;
        } else if (current == 'c') {
            it.sequence[position] = 'g';
            return it;
        } else if (current == 'g') {
            it.sequence[position] = 't';
            return it;
        } else {  // current == 't'
            it.sequence[position] = 'a';
            position--;
        }
    }

    return it;
}

void ex2_dna_sequences(int length) {
    printf("=== EXERCICE 2.4: Séquences ADN de taille %d ===\n", length);
    printf("Nombre total: 4^%d = %d\n", length,
           (int)pow(4, length));
    printf("Ordre lexicographique: ");

    DNASequenceIterator it = init_dna_sequences(length);
    int total = 1;
    for (int i = 0; i < length; i++) total *= 4;

    for (int i = 0; i < total; i++) {
        if (i < 16)  // Afficher les 16 premiers
            printf("%s ", it.sequence);
        if (i < total - 1) {
            it = next_dna_sequences(it);
        }
    }
    if (total > 16) printf("...");
    printf("\n");

    printf("ANALYSE: C'est un monoïde libre (fini)\n");
    printf("  - Base génératrice: {a, c, g, t}\n");
    printf("  - Opération: concaténation\n");
    printf("  - Cardinal: 4^n = %d\n", total);
    printf("  - Ordre lexicographique: aa..a < ... < tt..t\n");
    printf("  - Chaque séquence est unique\n\n");

    free(it.sequence);
}

// ===== FONCTION UTILITAIRE =====
#include <math.h>
double pow(double base, int exp) {
    double result = 1;
    for (int i = 0; i < exp; i++) {
        result *= base;
    }
    return result;
}

int main() {
    printf("╔═════════════════════════════════════════════════════════╗\n");
    printf("║    TUTORIEL ITÉRATEURS ET MONOÏDES LIBRES              ║\n");
    printf("╚═════════════════════════════════════════════════════════╝\n\n");

    // Exercice 1
    ex1_simple();
    ex1_multiples_7();
    ex1_multiples_7_infini();

    // Exercice 2
    ex2_primes();
    ex2_squares();
    ex2_dna_bases();
    ex2_dna_sequences(2);

    printf("╔═════════════════════════════════════════════════════════╗\n");
    printf("║              FIN DU PROGRAMME                          ║\n");
    printf("╚═════════════════════════════════════════════════════════╝\n");

    return 0;
}

