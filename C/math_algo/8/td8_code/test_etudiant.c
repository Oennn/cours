#include<assert.h>
#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include"etudiant.h"

void test_creer_etudiant(){
  printf("Test de la fonction creer_etudiant\n");
  etudiant_t * e = creer_etudiant("Lemoche", "Bob", 2005, 22121221);
  assert(strcmp(e->nom, "Lemoche") == 0);
  assert(strcmp(e->prenom, "Bob") == 0);
  assert(e->numero_etudiant == 22121221);
  assert(e->annee_naissance == 2005);
  etudiant_t * e2 = creer_etudiant("Ledentu", "Martine", 2004, 3);
  assert(strcmp(e2->nom, "Ledentu") == 0);
  assert(strcmp(e2->prenom, "Martine") == 0);
  assert(e2->numero_etudiant == 3);
  assert(e2->annee_naissance == 2004);
  detruire_etudiant(e);
  detruire_etudiant(e2);
  printf("Ok\n");
}


int main(){
    test_creer_etudiant();
    return EXIT_SUCCESS;
}
