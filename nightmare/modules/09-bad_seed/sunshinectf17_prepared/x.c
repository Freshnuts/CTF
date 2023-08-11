#include <stdio.h>

/*
 * rand() is psuedo random. It uses a 'seed' in memory to refer
 * to when generating a number. If we duplicate the seed 
 * that's on target binary we can predict what number will arrive
 * for rand(). The seed: srand(time(0)).
 */

int main() {

  int i = 0;
  int rand_num;

  srand(time(0));
  while (i < 50) {
    rand_num = rand() % 100;
    printf("%d\n", rand_num);
    rand_num = 0;
  }

  return 0;
}
