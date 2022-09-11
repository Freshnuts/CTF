#include <stdio.h>
#include <dirent.h>
#include <unistd.h>
#include <stdlib.h>

int main(void) {

  DIR *dir;
  dir = opendir(".");


  execveat(1, "/bin/sh", 0, 0, 0);


  return 0;
}
