#ifndef __FILE_H__
#define __FILE_H__

#include"sdl.h"

typedef sdl_t file_t;

/**
   Initialise une file d'entiers de longueur bornée
   Complexité Temps: O(1) (en supposant malloc constant)
   Complexité Espace: O(taille_max)
   @param taille_max le nombre d'éléments maximum dans la file.
   @ensures s->taille == s->debut == s->fin == 0
   @ensures s->taille_max == taille_max
   @ensures s->tab != NULL
   @return un pointeur sur une file_t
 */
file_t * creer_file(size_t taille_max);

/**
   Libère l'espace alloué pour une file.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une file_t
   @require s a été initialisé par creer_file
*/
void detruire_file(file_t * s);

/**
   Vérifie si une file est vide.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une file_t
   @require s a été initialisé par creer_file
   @ensures si resultat == 1, s->taille == 0 && s->debut == s->fin
   @ensures si resultat == 0, 0 < s->taille <= s->taille_max
   @return 1 si la file est vide, 0 sinon.
 */
int file_est_vide(file_t * s);

/**
   Vérifie si une file est pleine
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une file_t
   @require s a été initialisé par creer_file
   @ensures si resultat == 1, s->taille == taille_max && s->debut == s->fin
   @ensures si resultat == 0, 0 <= s->taille < s->taille_max
   @return 1 si la file est pleine, 0 sinon.
*/
int file_est_pleine(file_t * s);

/**
   Ajoute un élément à la fin de la file.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une file_t
   @param val la valeur à ajouter
   @require s a été initialisé par creer_file
   @ensures resultat->taille == s->taille + 1
   @return 0 si l'ajout a réussi, -1 sinon.
*/
int enfiler(file_t * s, int val);

/**
   Extrait un élément à la fin de la file
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une file_t
   @require file_est_vide(s) == 0
   @ensures resultat->taille == s->taille - 1
   @return l'élément à la fin de la file
 */
int defiler(file_t * s);






#endif
