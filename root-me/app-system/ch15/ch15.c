/*
gcc -m32 -fno-stack-protector -o ch15 ch15.c
*/
     
#include <stdio.h>
#include <stdlib.h>
     
void shell() {
    system("/bin/dash");
    }

void sup() {
    printf("Hey dude ! Waaaaazzaaaaaaaa ?!\n");
}

main()
{ 
    int var;
    void (*func)()=sup;
    char buf[128];
    fgets(buf,133,stdin);
    func();
}
