#include <stdio.h>
#include <string.h>


int main()
{
	// Place code in main(), section ".text".
	// If "char code[]" is made global it will be placed in ".data" section by compiler.
	char code[] = "\x31\xc0\x48\xbb\xd1\x9d\x96\x91\xd0\x8c\x97\xff\x48\xf7\xdb\x53\x54\x5f\x99\x52\x57\x54\x5e\xb0\x3b\x0f\x05";
	printf("len:%d bytes\n", strlen(code));
	(*(void(*)()) code)();
	return 0;
}

