#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <stdlib.h>

// Format String Vulnerability Example

int exploit;

void vuln(char *input) {

  printf(input);

  if(exploit) {
	printf("Execution Successful\n");
  }
}


int main(int argc, char **argv)
{
  vuln(argv[1]);
}
