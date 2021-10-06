#include <stdio.h>
#include <strings.h>
#include <unistd.h>


int main () {

  char *argv[]	= { "ls", 0 };
  char *env[]	= { "PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin" };

//  printf("printing directory\n");
//  execve("/bin/ls", argv, env);
//  perror("Error");


  printf("\n\nexecuting /bin/bash\n\n");
  execve("/bin/bash", NULL,NULL);
  perror("bash error");


return 0;

}
