#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <fcntl.h>

#define BUFFER 128

void read_data(char *data, int fd, int size)
{
  while(read(fd, data, 1) == 1 && *data && size)
    {
      size--;
      data++;
    }
}
void read_file(int fd)
{
  char path[BUFFER+1] = {0};
  int size;  
   
  if(read(fd, &size, sizeof(int)) != sizeof(int))
    {
      printf("[-] File too short.\n");
      exit(0);
    }
   
  if(size >= BUFFER)
    {
      printf("[-] Path too long.\n");
      exit(0);
    }
  read_data(path, fd, size);
   
  if(path[0] != '/')
    {
      printf("[-] Need a absolute path.\n");
      exit(0);
    }  
   
  printf("[+] The pathname is : %s\n", path);
}
int main(int argc, char **argv)
{
  int fd;
   
  if(argc != 2)
    {
      printf("[-] Usage : %s <filename>\n", argv[0]);
      exit(0);
    }
   
  if((fd = open(argv[1], O_RDONLY)) == -1)
    {
      perror("[-] open ");
      exit(0);
    }
   
  read_file(fd);
  close(fd);
  return 0;
}
