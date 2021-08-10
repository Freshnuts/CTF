#include <stdio.h>
#include <stdlib.h>

/*
gcc -m32 -o ch14 ch14.c
*/

int main( int argc, char ** argv )

{

	int var;
	int check  = 0x04030201;

	char fmt[128];

	if (argc <2)
		exit(0);

	memset( fmt, 0, sizeof(fmt) );

	printf( "check at 0x%x\n", &check );
	printf( "argv[1] = [%s]\n", argv[1] );

	snprintf( fmt, sizeof(fmt), argv[1] );

	if ((check != 0x04030201) && (check != 0xdeadbeef))	
		printf ("\nYou are on the right way !\n");

	printf( "fmt=[%s]\n", fmt );
	printf( "check=0x%x\n", check );

	if (check==0xdeadbeef)
   	{
		printf("Yeah dude ! You win !\n");
     		system("/bin/dash");
   	}
}
