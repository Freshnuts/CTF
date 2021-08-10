#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <ctype.h>
#include <unistd.h>
#include <sys/types.h>

#define BUFFER 512

struct Init									// Declare struct Init
{
  char username[128];						// username array 128 element
  uid_t uid;
  pid_t pid;  
    
};

void cpstr(char *dst, const char *src)
{
  for(; *src; src++, dst++)					// for loop; src & dst inc.
    {
      *dst = *src;							// both have same value
    }
  *dst = 0;									// reset *dst
}
void chomp(char *buff)
{
  for(; *buff; buff++)						// for loopl buff inc
    {
      if(*buff == '\n' || *buff == '\r' || *buff == '\t')
	{
	  *buff = 0;	// if *buff has value of either \n,\r,\t, then 0 out buff
	  break;
	}
    }
}
struct Init Init(char *filename)
{
   
  FILE *file;				// create FILE *variable named file
  struct Init init; 		// Initialize struct init
  char buff[BUFFER+1];  	// BUFFER is 512+1
   
   
  if((file = fopen(filename, "r")) == NULL)	// if fopen cant open file with r
    {
      perror("[-] fopen ");					// then exit()
      exit(0);
    }
   
  memset(&init, 0, sizeof(struct Init));	// set memory @ memory addr of init
   
  init.pid = getpid();						// get process id of filename
  init.uid = getuid();						// get user id of filename
   
  while(fgets(buff, BUFFER, file) != NULL)	// while fgets stream isnt NULL
    {	// while file doesnt have NULL, get value of buff, up to 512 (BUFFER)
      chomp(buff);
      if(strncmp(buff, "USERNAME=", 9) == 0) // if USERNAME= in file true.	
	{
	  cpstr(init.username, buff+9);			// EXPLOIT, array
	}										// buff = 512, username = 128
    }
  fclose(file);
  return init;
}
int main(int argc, char **argv)
{
  struct Init init;					// initiate structure
  if(argc != 2)
    {
      printf("Usage : %s <config_file>\n", argv[0]);
      exit(0);
    }
  init = Init(argv[1]);				// obtain 1st argv[1] (filename)
  printf("[+] Runing the program with username %s, uid %d and pid %d.\n", init.username, init.uid, init.pid);
   
  return 0;
}
