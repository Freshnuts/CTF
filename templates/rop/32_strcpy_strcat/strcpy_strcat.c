#include <stdio.h>
#include <strings.h>


int main(int argc, char *argv[]) {

	char buff[32];

	strcpy(buff, argv[1]);
	puts(buff);

	strcat(buff, argv[2]);
    puts(buff);
	return 0;
}
