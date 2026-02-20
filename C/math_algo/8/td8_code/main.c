#include"etudiant.h"
#include<stdio.h>
#include<stdlib.h>

int main(){
  int taille;
  etudiant_t ** liste = lire_fichier_csv("liste.csv", &taille);
  for(int i = 0; i < taille; i++){
    afficher_etudiant(liste[i]);
    detruire_etudiant(liste[i]);
  }
  free(liste);
  return EXIT_SUCCESS;
}
