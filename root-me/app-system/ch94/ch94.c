#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>

void    checkArg(const char *a)
{
  while (*a)
    {
      if (   (*a == ';')
          || (*a == '&')
          || (*a == '|')
          || (*a == ',')
          || (*a == '$')
          || (*a == '(')
          || (*a == ')')
          || (*a == '{')
          || (*a == '}')
          || (*a == '`')
          || (*a == '>')
          || (*a == '<') ) {
        puts("Forbidden !!!");
        exit(2);
      }
        a++;
    }
}

int     main()
{
  char  *arg = malloc(0x20);    // fastbin: 0x20 - 0x410
  char  *cmd = malloc(0x400);   // fastbin: 0x20 - 0x410
  setreuid(geteuid(), geteuid()); // Set privileged EUID

  strcpy(cmd, "/bin/ls -l ");

  printf("Enter directory you want to display : ");

  gets(arg);        // No input sanitation
  checkArg(arg);    // Check for bad forbidden characters

  strcat(cmd, arg); // Concat user input
  system(cmd);      // Execute cmd

  return 0;
}
