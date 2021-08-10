#include <stdio.h>
#include <strings.h>

main () {

  int setreuid(1000, 1001);
  system("usr/bin/id");

  return 0;


}
