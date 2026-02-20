#ifndef __SDL_H__
#define __SDL_H__
#include<stdlib.h> //Sert à connaitre size_t

typedef struct sdl_s{
  int * tab;
  size_t taille_max;
  size_t taille;
  size_t debut;
  size_t fin;
}sdl_t;


#endif
