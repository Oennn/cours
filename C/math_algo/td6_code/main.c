#include<stdio.h>
#include<stdlib.h>
#include<assert.h>
#include"pile.h"
#include"file.h"


int main(){
  pile_t * p = creer_pile(10);
  file_t * f = creer_file(10);
  int i;

  for(i = 0; i < 10; i++){
    assert(empiler(p, i) == 0);
    assert(enfiler(f, i) == 0);
  }
  
  assert(empiler(p, i) == -1 && pile_est_pleine(p) == 1);
  assert(enfiler(f, i) == -1 && file_est_pleine(f) == 1);

  while( ! pile_est_vide(p) ){
    printf("%d ", depiler(p));
  }
  printf("\n");

  while( ! file_est_vide(f) ){
    printf("%d ", defiler(f));
  }
  printf("\n");

  detruire_pile(p);
  detruire_file(f);
  
  return EXIT_SUCCESS;
}
