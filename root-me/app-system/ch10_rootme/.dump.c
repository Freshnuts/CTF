#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <ctype.h>

#define DEFAULT_SIZE 0x200

int main (int argc, char* argv[], char *env[]) {
    unsigned char *p, *c, *start, *end;
    start = (void *) ((unsigned int)argv & 0xfffff000);
    end = start + 0x1000;
    start = end - DEFAULT_SIZE;

    if (argc >= 2)
        sscanf(argv[1], "%p", &start);
    if (argc >= 3)
        end = start + abs(atoi(argv[2]));
    fprintf(stderr, "From %p to %p\n", start, end);
    for (p = start; p < end; p += 16) {
        printf("%08x ", p);
        for (c = p; c < p+16; c++)
            printf("%s%02x", (((unsigned int)c & 0x1) ? "" : " "), *c);
        printf("  ");
        for (c = p; c < p+16; c++)
            printf("%c", (isprint(*c) ? *c : '.'));
        printf("\n");
    }
    return 0;
}
