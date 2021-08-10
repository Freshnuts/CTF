#include <stdio.h>
#include <string.h>

int main (int argc, char ** argv){
    char message[20];

    if (argc != 2){
        printf ("Usage: %s <message>\n", argv[0]);
        return -1;
    }

    strcpy (message, argv[1]);
    printf ("Your message: %s\n", message);
    return 0;
}
