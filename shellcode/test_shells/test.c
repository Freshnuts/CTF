#include <stdio.h>
#include <string.h>


int main()
{
	// Place code in main(), section ".text".
	// If "char code[]" is made global it will be placed in ".data" section by compiler.
	char code[] = "\x48\xc7\xc0\x01\x00\x00\x00\x48\xc7\xc7\x01\x00\x00\x00\x48\xbe\x41\x41\x41\x41\x41\x41\x00\x00\x48\xc7\xc2\x0d\x00\x00\x00\x0f\x05\x48\xc7\xc0\x3c\x00\x00\x00\x48\x31\xff\x0f\x05";
	printf("len:%d bytes\n", strlen(code));
	(*(void(*)()) code)();
	return 0;
}

