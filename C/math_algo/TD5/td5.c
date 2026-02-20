#include<stdio.h>
#include<stdlib.h>
#include<assert.h>

/**
   Fonction qui recherche x dans un tableau dans les n premières cases du tableau  et renvoie sa position.
   Complexité en temps: O(1) dans le meilleur des cas et O(n) dans le pire des cas.
   Complexité en espace: O(1)
   @param tab est le tableau où la recherche est effectuée.
   @param n est la taille du tableau.
   @param x est la valeur recherchée.
   @requires n <= taille(tab)
   @ensures resultat != -1 => resultat = min{ pos \in {0, ..., n-1} | tab[pos] == x}
   @ensures resultat == -1 => il n'existe pas de pos dans {0, ..., n-1} tel que tab[pos] == x
   @return la position de la première occurrence de x dans tab dans les n premières cases du tableau et -1 s'il n'apparaît pas.
 */
int recherche(int * tab, int n, int x){
  int pos = 0;
  while( pos < n){
    if( tab[pos] == x )
      return pos;
    pos++;
  }
  return -1;
}

/**
   Fonction qui recherche x dans un tableau dans les n premières cases du tableau  et renvoie sa position.
   Complexité en temps: O(1) dans le meilleur des cas et O(n) dans le pire des cas.
   Complexité en espace: O(1) dans le meilleur des cas et O(n) dans le pire des cas.
   @param tab est le tableau où la recherche est effectuée.
   @param n est la taille du tableau.
   @param x est la valeur recherchée.
   @requires n <= taille(tab)
   @ensures resultat != -1 => resultat = max{ pos \in {0, ..., n-1} | tab[pos] == x}
   @ensures resultat == -1 => il n'existe pas de pos dans {0, ..., n-1} tel que tab[pos] == x
   @return la position de la première occurrence de x dans tab dans les n premières cases du tableau et -1 s'il n'apparaît pas.
 */
int recherche_rec_fin(int * tab, int n, int x){
  if( n <= 0 )
    return -1;
  if( tab[n-1] == x )
    return n-1;
  return recherche_rec_fin(tab, n-1, x);
}

/**
   Fonction qui recherche x dans un tableau dans les n premières cases du tableau  et renvoie sa position.
   Complexité en temps: O(1) dans le meilleur des cas et O(n) dans le pire des cas.
   Complexité en espace: O(1) dans le meilleur des cas et O(n) dans le pire des cas.
   @param tab est le tableau où la recherche est effectuée.
   @param n est la taille du tableau.
   @param x est la valeur recherchée.
   @requires n <= taille(tab)
   @ensures resultat != -1 => resultat = min{ pos \in {0, ..., n-1} | tab[pos] == x}
   @ensures resultat == -1 => il n'existe pas de pos dans {0, ..., n-1} tel que tab[pos] == x
   @return la position de la première occurrence de x dans tab dans les n premières cases du tableau et -1 s'il n'apparaît pas.
 */
int recherche_rec_debut(int * tab, int n, int x){
  if( n <= 0 )
    return -1;
  if( tab[0] == x )
    return 0;
  int res = recherche_rec_debut(&tab[1], n-1, x);
  return (res == -1)? res: res+1;
}


/**
   Fonction qui recherche x dans un tableau dans les n premières cases du tableau  et renvoie sa position.
   Complexité en temps: O(1) dans le meilleur des cas et O(log(n)) dans le pire des cas.
   Complexité en espace: O(1) dans le meilleur des cas et O(log(n)) dans le pire des cas.
   @param tab est le tableau où la recherche est effectuée.
   @param n est la taille du tableau.
   @param x est la valeur recherchée.
   @requires n <= taille(tab)
   @requires tab est trié dans l'ordre croissant.
   @ensures resultat != -1 => resultat = min{ pos \in {0, ..., n-1} | tab[pos] == x}
   @ensures resultat == -1 => il n'existe pas de pos dans {0, ..., n-1} tel que tab[pos] == x
   @return la position de la première occurrence de x dans tab dans les n premières cases du tableau et -1 s'il n'apparaît pas.
 */
int dichotomie_rec(int * tab, int n, int x){
  if( n <= 0 )
    return -1;
  int milieu = n>>1; // n<<1 == n/2;
  if( tab[milieu] == x )
    return milieu;
  if( tab[milieu] > x)
    return dichotomie_rec(tab, milieu, x);
  int res = dichotomie_rec(&tab[milieu+1], n-(milieu+1), x);
  return (res == -1)? res: res+milieu+1;
}

/**
   Fonction qui recherche x dans un tableau dans les n premières cases du tableau  et renvoie sa position.
   Complexité en temps: O(1) dans le meilleur des cas et O(log(n)) dans le pire des cas.
   Complexité en espace: O(1) 
   @param tab est le tableau où la recherche est effectuée.
   @param n est la taille du tableau.
   @param x est la valeur recherchée.
   @requires n <= taille(tab)
   @requires tab est trié dans l'ordre croissant.
   @ensures resultat != -1 => resultat = min{ pos \in {0, ..., n-1} | tab[pos] == x}
   @ensures resultat == -1 => il n'existe pas de pos dans {0, ..., n-1} tel que tab[pos] == x
   @return la position de la première occurrence de x dans tab dans les n premières cases du tableau et -1 s'il n'apparaît pas.
 */
int dichotomie(int * tab, int n, int x){
  int debut = 0;
  int fin = n;
  int milieu;
  while(debut < fin){
    milieu = (debut+fin)/2;
    if( tab[milieu] == x )
      return milieu;
    if( tab[milieu] > x )
      fin = milieu;
    else
      debut = milieu+1;
  }
  return -1;
}



int main(){
  int tab[10] = {0,1,2,3,4,5,6,7,8,9};
  int i;

  printf("Début des tests\n");
  for(i = 0; i < 10; i ++){
    assert(recherche(tab, 10, i) == i);
    assert(recherche_rec_debut(tab, 10, i) == i);
    assert(dichotomie_rec(tab, 10, i) == i);
    assert(dichotomie(tab, 10, i) == i);
  }
  printf("Fin des tests\n");
  return EXIT_SUCCESS;
}
