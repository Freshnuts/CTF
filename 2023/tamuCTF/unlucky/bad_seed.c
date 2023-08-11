#include <stdio.h>
#include <stdlib.h>
#include <time.h>     // Enables use of time()

int main(void) {
   srand((int)time(0)); // Unique seed
   srand(93824992247912); // Unique seed
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());
   printf("%d\n", rand());

   return 0;
}

