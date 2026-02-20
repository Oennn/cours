#ifndef __PILE_H__
#define __PILE_H__

#include"sdl.h"

typedef sdl_t pile_t;

/**
   Initialise une pile d'entiers de longueur bornée
   Complexité Temps: O(1) (en supposant malloc constant)
   Complexité Espace: O(n)
   @param taille_max le nombre d'éléments maximum dans la pile.
   @ensures s->taille == s->debut == s->fin == 0
   @return un pointeur sur une pile_t
 */
pile_t * creer_pile(size_t taille_max);

/**
   Libère l'espace alloué pour une pile.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une pile_t
   @require s a été initialisé par creer_pile
*/
void detruire_pile(pile_t * s);

/**
   Vérifie si une pile est vide.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une pile_t
   @require s a été initialisé par creer_pile
   @ensures si resultat == 1, s->taille == 0 && s->debut == s->fin
   @ensures si resultat == 0, 0 < s->taille <= s->taille_max
   @return 1 si la pile est vide, 0 sinon.
 */
int pile_est_vide(pile_t * s);

/**
   Vérifie si une pile est pleine
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une pile_t
   @require s a été initialisé par creer_pile
   @ensures si resultat == 1, s->taille == taille_max && s->debut == s->fin
   @ensures si resultat == 0, 0 <= s->taille < s->taille_max
   @return 1 si la pile est pleine, 0 sinon.
*/
int pile_est_pleine(pile_t * s);

/**
   Ajoute un élément à la fin de la pile.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une pile_t
   @param val la valeur à ajouter
   @require s a été initialisé par creer_pile
   @ensures resultat->taille == s->taille + 1
   @return 0 si l'ajout a réussi, -1 sinon.
*/
int empiler(pile_t * s, int val);

/**
   Extrait un élément à la fin de la pile
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une pile_t
   @require pile_est_vide(s) == 0
   @ensures resultat->taille == s->taille - 1
   @return l'élément à la fin de la pile
 */
int depiler(pile_t * s);






#endif
