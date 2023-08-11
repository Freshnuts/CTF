#include <stdio.h>
#include <stdlib.h>
#include <time.h>

// Bad seed challenge, perform srand() & rand() before the program and pipe it
// Gives the correct "random" numbers because it uses the same "seed to scramble before piping
// the answer.

int main() {
    srand(time(NULL));
    int lim = rand() % 8192;
    for (int i = 0; i < lim; i++) {
        rand();}

    for (int i = 0, a, b, c; i < 5; i++) {
        a = rand();
	b = rand();
	c = a + b;
    	printf("%d\n", c);}

    for (int i = 0, a, b, c; i < 5; i++) {
        b = rand(); 
	c = rand();
	a = c - b;
	printf("%d\n", a);}


    return 0;
}
