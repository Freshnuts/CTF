#include <stdio.h>
#include <stdlib.h>

char username[512] = {1};					// char array, starts with 1.
void (*_atexit)(int) =  exit;				// call function @ proc. termination

void cp_username(char *name, const char *arg)
{
  while((*(name++) = *(arg++)));		// name++ has value of arg++
  *name = 0; 							// pointer variable name = 0
}

int main(int argc, char **argv)			// user input main()
{
  if(argc != 2)							// minimum 2 arguments
    {
      printf("[-] Usage : %s <username>\n", argv[0]);
      exit(0);
    }
   
  cp_username(username, argv[1]);		// cp argv[1] into username[512] = {1};
  printf("[+] Running program with username : %s\n", username);
   
  _atexit(0);
  return 0;
}
