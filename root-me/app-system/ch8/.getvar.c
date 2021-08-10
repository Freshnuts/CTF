#include <stdio.h>
#include <string.h>
#include <stdlib.h>
void printvar(char * p, char * varname) {
    unsigned char *q;
    q = (unsigned char *)&p;
    printf("%p  \\x%02x\\x%02x\\x%02x\\x%02x  (%s)\n", p, *q, *(q+1), *(q+2), *(q+3), varname);
}
int main(int argc, char *argv[], char *env[]) {
    if (argc == 2) {
        printvar((char*)getenv(argv[1]), argv[1]);
    } else {
        int i;
        char *p;
        for (i = 0; env[i] != NULL; i++) {
            p = strchr(env[i], (int)'=');
            if (p) {
                *p++ = 0;
                printvar(p, env[i]);
            }
        }
    }
    return 0;
}
