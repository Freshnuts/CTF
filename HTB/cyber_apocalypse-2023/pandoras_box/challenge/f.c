#include <stdio.h>
#include <string.h>

int main() {
    char str[] = "Hello, world!\n";
    size_t len = strlen(str);
    fwrite(str, sizeof(char), len, stdout);
    return 0;
}

