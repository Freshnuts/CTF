#include <stdio.h>

/*
 * rand() is psuedo random. It uses a 'seed' in memory to refer
 * to when generating a number. If we duplicate the seed 
 * that's on target binary we can predict what number will arrive
 * for rand(). The seed: srand(time(0)).
 */

int main() {

  int rand_num;
  srand(time(0));
  rand_num = rand();
  printf("%d\n", rand_num);

  return 0;
}
