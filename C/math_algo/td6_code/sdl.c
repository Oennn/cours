#include"sdl.h"
#include"pile.h"
#include"file.h"
#include<limits.h> // Pour connaître UINT_MAX


/**
   Initialise sur structure de données linéaire
   Complexité Temps: O(1) (en supposant malloc constant)
   Complexité Espace: O(n)
   @param taille_max le nombre d'éléments maximum dans la structure.
   @ensures s->taille == s->debut == s->fin == 0
   @return un pointeur sur une sdl_t
 */
sdl_t * creer_sdl(size_t taille_max){
  sdl_t * res = malloc( sizeof(sdl_t) );
  res->tab = malloc(sizeof(int) * taille_max);
  res->taille_max = taille_max;
  res->taille = 0;
  res->debut = 0;
  res->fin = 0;
  return res;
}


/**
   Libère l'espace alloué pour une structure de données linéaire.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @require s a été initialisé par creer_sdl
*/
void detruire_sdl(sdl_t * s){
  free(s->tab);
  free(s);
}

/**
   Vérifie si une structure est vide.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @require s a été initialisé par creer_sdl
   @ensures si resultat == 1, s->taille == 0 && s->debut == s->fin
   @ensures si resultat == 0, 0 < s->taille <= s->taille_max
   @return 1 si la structure est vide, 0 sinon.
 */
int sdl_est_vide(sdl_t * s){
  return s->taille == 0;
}

/**
   Vérifie si une structure est pleine
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @require s a été initialisé par creer_sdl
   @ensures si resultat == 1, s->taille == taille_max && s->debut == s->fin
   @ensures si resultat == 0, 0 <= s->taille < s->taille_max
   @return 1 si la structure est pleine, 0 sinon.
*/
int sdl_est_pleine(sdl_t * s){
  return s->taille == s->taille_max;
}


/**
   Ajoute un élément à la fin de la structure.
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @param val la valeur à ajouter
   @require s a été initialisé par creer_sdl
   @ensures resultat->taille == s->taille + 1
   @return 0 si l'ajout a réussi, -1 sinon.
*/
int sdl_ajouter_fin(sdl_t * s, int val){
  if(!sdl_est_pleine(s)){
    s->tab[s->fin] = val;
    s->taille++;
    s->fin = ( s->fin + 1 ) % s->taille_max;
    return 0;
  }
  return -1;
}

/**
   Extrait un élément à la fin de la structure
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @require liste_est_vide(s) == 0
   @ensures resultat->taille == s->taille - 1
   @return l'élément à la fin de la structure
 */
int sdl_extraire_fin(sdl_t * s){
  s->fin--;
  s->taille--;
  if(s->fin == ULONG_MAX)
    s->fin = s->taille_max - 1;
  return s->tab[s->fin];
}

/**
   Extrait un élément au début de la structure
   Complexité : O(1) en temps et en espace.
   @param s un pointeur sur une sdl_t
   @require liste_est_vide(s) == 0
   @ensures resultat->taille == s->taille - 1
   @return l'élément au début de la structure
*/
int sdl_extraire_debut(sdl_t * s){
  int res = s->tab[s->debut];
  s->taille--;
  s->debut = ( s->debut + 1 ) % s->taille_max;
  return res;
}



pile_t * creer_pile(size_t taille_max){
  return creer_sdl(taille_max);
}

void detruire_pile(pile_t * s){
  detruire_sdl(s);
}

int pile_est_vide(pile_t * s){
  return sdl_est_vide(s);
}

int pile_est_pleine(pile_t * s){
  return sdl_est_pleine(s);
}

int empiler(pile_t * s, int val){
  return sdl_ajouter_fin(s, val);
}

int depiler(pile_t * s){
  return sdl_extraire_fin(s);
}

file_t * creer_file(size_t taille_max){
  return creer_sdl(taille_max);
}

void detruire_file(file_t * s){
  detruire_sdl(s);
}

int file_est_vide(file_t * s){
  return sdl_est_vide(s);
}

int file_est_pleine(file_t * s){
  return sdl_est_pleine(s);
}

int enfiler(file_t * s, int val){
  return sdl_ajouter_fin(s, val);
}

int defiler(file_t * s){
  return sdl_extraire_debut(s);
}
