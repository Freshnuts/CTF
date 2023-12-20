#include <stdio.h>
#include <unistd.h>

char name[32] = {0};
char email[16] = {0};

void (*pf)(int) = _exit;

void main(int argc, char *argv[])
{
	char msg[1024] = {0};
	puts("Welcome to support contact!\nYour name: ");
	read(0, name, 32);
	puts("Your email: ");
	read(0, email, 12);
	puts("Your message: ");
	read(0, msg, 512);
	puts("Thank you for contacting us! You will get a reply to ");
	printf(email);
        puts("\r\n");

        pf(0);
}
