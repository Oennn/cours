#include"etudiant.h"
#include<stdio.h>
#include<stdlib.h>
#include<string.h>



etudiant_t * creer_etudiant(char * nom, char * prenom, unsigned short annee, unsigned int num){
  etudiant_t * res = malloc(sizeof(etudiant_t));
  res->nom = malloc(sizeof(char) * (strlen(nom) + 1) );
  strcpy(res->nom, nom);
  res->prenom = malloc(sizeof(char) * (strlen(prenom) + 1) );
  strcpy(res->prenom, prenom);
  res->annee_naissance = annee;
  res->numero_etudiant = num;
  return res;
}

void afficher_etudiant(etudiant_t * e){
  printf("%s %s %u %u\n", e->nom, e->prenom, e->annee_naissance, e->numero_etudiant);
}

void detruire_etudiant(etudiant_t * e){
  free(e->nom);
  free(e->prenom);
  free(e);
}

int compter_ligne(FILE * f){
  int res = 0;
  for (char c = getc(f); c != EOF; c = getc(f))
    if (c == '\n') 
      res = res + 1;
  rewind(f);
  return res;
}

etudiant_t * ligne_vers_etudiant(char * ligne){
  char * nom = strtok(ligne, ",");
  char * prenom = strtok(NULL, ",");
  unsigned short annee = atoi(strtok(NULL, ","));
  unsigned int num = atoi(strtok(NULL, ","));
  return creer_etudiant(nom, prenom, annee, num);
}

etudiant_t ** lire_fichier_csv(char * chemin, int * taille){
  FILE * f;
  if((f = fopen(chemin, "r")) == NULL)
    return NULL;
  *taille = compter_ligne(f)-1;
  etudiant_t ** res = malloc(sizeof(etudiant_t *)*(*taille));
  char ligne[1024];
  fgets(ligne, 1024, f);// On saute la première ligne
  for(int i = 0; i < *taille; i++){
    fgets(ligne, 1024, f);
    res[i] = ligne_vers_etudiant(ligne);
  }
  
  fclose(f);
  return res;
}

