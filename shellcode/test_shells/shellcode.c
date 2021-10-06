#include 
char shellcode[] = 
				 
int main(int argc, char **argv) {
int *ret;
ret = (int *)&ret + 2;  
(*ret) = (int)shellcode;
}
