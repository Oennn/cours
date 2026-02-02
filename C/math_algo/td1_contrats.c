#include<stdio.h>
#include<stdlib.h>
#include<assert.h>
#include<limits.h>
#include<math.h>

/**
   Cette fonction calcule la somme de deux entiers.
   @param x un entier que l'on veut sommer
   @param y un entier que l'on veut sommer
   @requires INT_MIN <= x+y <= INT_MAX
   @ensures resultat == x+y 
   @return la somme de deux entiers.
*/
int addition(int x, int y){
  return x+y;
}

void test_addition_simple(){
  printf("Test addition simple\n");
  int x = 4;
  int y = 5;
  assert(addition(x,y) == x+y);
  x = 435241;
  y = -54635;
  assert(addition(x,y) == x+y);

  printf("Test validé\n");
}

void test_addition_mieux(){
  printf("Test addition mieux\n");
  int x,y,i;
  for(i = 0; i < 100; i++){
    x = rand()%(INT_MAX/2);
    y = rand()%(INT_MAX/2);
    assert(addition(x,y) == x+y);    
  }
  printf("Test validé\n");
}


/**
   Cette fonction calcule la racine carrée du nombre passé en entrée.
   @param x un nombre flottant 
   @requires x>=0
   @ensures resultat * resultat ~ x 
   @return la racine carrée du nombre passé en entrée.
*/
double racine(double x){
  return sqrt(x);
}

void test_racine_simple(){
  printf("Test racine simple\n");
  double r = 4;
  double resultat = racine(r);
  assert(resultat*resultat == r);
  printf("Test validé\n");
}

void test_racine_mieux(){
  printf("Test racine mieux\n");
  int i;
  double resultat, r;
  for(int i = 0; i < 100; i++){
    r = rand();
    resultat = racine(r);
    //assert(resultat*resultat == r);  
    assert(resultat*resultat < (r+0.0001) 
           && resultat*resultat > (r-0.0001));  
  }
  printf("Test validé\n");
}


/**
   La fonction cherche la première position de x dans le tableau tab.
   @param tab est un tableau d'entiers.
   @param n est le nombre de cases du tableau
   @param x est l'entier recherché
   @requires longueur(tab) >= n
   @ensures -1 <= resultat < n
   @ensures resultat >= 0 => tab[resultat] == x
   @ensures pour tout i < resultat, tab[i] != x
   @return la position de la première occurence de x dans le tableau et -1 si x n'y apparaît pas.
 */
int recherche(int * tab, int n, int x){
  int pos = 0;
  while(pos < n){
    if(tab[pos] == x)
      return pos;
    pos++;
  }
  return -1;
}

int test_recherche_simple(){
  printf("Test recherche simple\n");
  int tab[100];
  int i, resultat;
  for(i = 0; i < 100; i++)
    tab[i] = i;
  for(i = 1; i < 100; i++){
    resultat = recherche(tab, 100, i);
    assert( -1 <= resultat && resultat < 100);
    assert(tab[resultat] == i);
  }
  assert(recherche(tab, 100, 100) == -1);
  printf("Test validé\n");
}


int main(){  
  test_addition_simple();
  test_addition_mieux();
  test_racine_simple();
  test_racine_mieux();
  test_recherche_simple();
  return EXIT_SUCCESS;
}
