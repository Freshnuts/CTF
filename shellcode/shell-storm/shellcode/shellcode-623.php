<html><head><title>Linux/x86 - sys_exit(0) - 8 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Name   : 8 bytes sys_exit(0) x86 linux shellcode
Date   : may, 31 2010
Author : gunslinger_
Web    : devilzc0de.com
blog   : gunslinger.devilzc0de.com
tested on : linux debian
*/

char *bye=
 &quot;\x31\xc0&quot;                    /* xor    %eax,%eax */
 &quot;\xb0\x01&quot;                    /* mov    $0x1,%al */
 &quot;\x31\xdb&quot;                    /* xor    %ebx,%ebx */
 &quot;\xcd\x80&quot;;                   /* int    $0x80 */

int main(void)
{
		((void (*)(void)) bye)();
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
