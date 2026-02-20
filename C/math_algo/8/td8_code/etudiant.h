#ifndef __ETUDIANT_H__
#define __ETUDIANT_H__

typedef struct etudiant_s{
  char * nom;
  char * prenom;
  unsigned short annee_naissance;
  unsigned int numero_etudiant;
}etudiant_t;

/**
   Cette fonction initialise une structure etudiant_t.
   @param nom est le nom de l'étudiant(e)
   @param prenom est le prénom de l'étudiant(e)
   @param annee est l'année de naissance de l'étudiant(e)
   @param num est le numéro d'étudiant(e).
   @requires nom != NULL && prenom != NULL
   @ensures strcmp(resultat->nom, nom) == 0 && strcmp(resultat->prenom, prenom) == 0
   @ensures resultat->annee_naissance == annee && resultat->numero_etudiant == num
   @return un pointeur sur une structure etudiant_t.
 */
etudiant_t * creer_etudiant(char * nom, char * prenom, unsigned short annee, unsigned int num);

/**
   Cette fonction affiche une structure etudiant_t.
   @param e contient l'adresse d'une structure etudiant_t à afficher
   @requires e a été initialisé avec la fonction creer_etudiant.
*/
void afficher_etudiant(etudiant_t * e);

/**
   Cette fonction libère l'espace mémoire utilisé par un etudiant_t.
   @param e contient l'adresse d'une structure etudiant_t à libérer.
   @requires e a été initialisé avec la fonction creer_etudiant.
*/
void detruire_etudiant(etudiant_t * e);

/**
   Fonction permettant de lire le contenu d'un fichier CSV et qui initialise un tableau
   d'étudiants.
   @param chemin est le chemin relatif ou absolu du fichier CSV
   @param est l'adresse d'un entier dans lequel on stockera le nombre de lignes dans le fichier, moins la première ligne.
   @requires chemin != NULL && taille !=NULL
   @requires le fichier CSV existe et est accessible en lecture.
   @ensures *taille == taille(resultat)
   @return un tableau d'étudiants lus dans le fichier CSV.
*/
etudiant_t ** lire_fichier_csv(char * chemin, int * taille);


#endif
