#include <stdio.h>
#include <string.h>

/*
gcc -o ch34 ch34.c -fno-stack-protector  -Wl,-z,relro,-z,now,-z,noexecstack -static
*/

int main(int argc, char **argv){

    char buffer[256];
    int len, i;

    gets(buffer);
    len = strlen(buffer); 

    printf("Hex result: ");

    for (i=0; i<len; i++){
        printf("%02x", buffer[i]);
    }
    printf("\n");

    return 0;

}
