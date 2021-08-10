#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

/*
gcc -o ch35 ch35.c -fno-stack-protector  -Wl,-z,relro,-z,now,-z,noexecstack
*/

void callMeMaybe(){
    setreuid(geteuid(), geteuid());
    system("/bin/bash");
}

int main(int argc, char **argv){

    char buffer[256];
    int len, i;

    scanf("%s", buffer);
    len = strlen(buffer); 

    printf("Hello %s\n", buffer);

    return 0;
}
